<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RecapController extends Controller
{
    private const STATUS_LABELS = [
        'pending' => 'Menunggu Verifikasi',
        'verified' => 'Disetujui',
        'returned' => 'Sudah Diambil',
        'rejected' => 'Ditolak',
    ];

    /**
     * Filter tanggal memakai event_date (tanggal kejadian), sama seperti
     * kolom tanggal yang ditampilkan di tabel dan CSV.
     */
    private function filtered(Request $request)
    {
        return Report::with('category')
            ->when($request->filled('from'), fn ($q) => $q->whereDate('event_date', '>=', $request->from))
            ->when($request->filled('to'), fn ($q) => $q->whereDate('event_date', '<=', $request->to))
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->category_id))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type));
    }

    public function index(Request $request)
    {
        $query = $this->filtered($request);

        $reports = (clone $query)->latest()->paginate(15)->withQueryString();

        // Total = pending + verified + returned + rejected, jadi angkanya saling cocok.
        $summary = [
            'total' => (clone $query)->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'verified' => (clone $query)->where('status', 'verified')->count(),
            'returned' => (clone $query)->where('status', 'returned')->count(),
            'rejected' => (clone $query)->where('status', 'rejected')->count(),
        ];

        $categories = Category::orderBy('name')->get();

        return view('admin.recap.index', compact('reports', 'summary', 'categories'));
    }

    public function export(Request $request): StreamedResponse
    {
        $rows = $this->filtered($request)->latest()->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');

            fputcsv($out, ['Kode', 'Jenis', 'Nama Barang', 'Kategori', 'Pelapor', 'Kontak', 'Lokasi', 'Tanggal Kejadian', 'Status']);

            foreach ($rows as $r) {
                fputcsv($out, [
                    $this->safe($r->code),
                    $r->type === 'lost' ? 'Hilang' : 'Temuan',
                    $this->safe($r->item_name),
                    $this->safe($r->category?->name),
                    $this->safe($r->reporter_name),
                    $this->safe($r->reporter_phone, isPhone: true),
                    $this->safe($r->location),
                    $r->event_date?->format('Y-m-d'),
                    self::STATUS_LABELS[$r->status] ?? $r->status,
                ]);
            }

            fclose($out);
        }, 'rekap-lost-found-' . now()->format('Ymd-His') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Mencegah "CSV injection": sel yang diawali = + - @ (atau spasi/tab)
     * akan dibaca Excel sebagai RUMUS. Kita beri tanda ' di depannya agar
     * dibaca sebagai teks biasa. Nomor telepon yang murni angka (mis. +62812...)
     * dibiarkan apa adanya karena tidak berbahaya.
     */
    private function safe(mixed $value, bool $isPhone = false): string
    {
        $text = (string) $value;

        if ($isPhone && preg_match('/^\+?[0-9\s\-()]+$/', $text)) {
            return $text;
        }

        return preg_match('/^[\s=+\-@]/', $text) ? "'" . $text : $text;
    }
}
