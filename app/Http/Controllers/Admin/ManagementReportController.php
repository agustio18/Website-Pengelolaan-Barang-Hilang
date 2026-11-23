<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagementReportController extends Controller
{
    /**
     * Halaman manajemen HANYA menampilkan laporan berstatus "disetujui" (verified).
     * Status lain dilihat di menu lain: pending -> Verifikasi Laporan,
     * returned -> Serah Terima, dan semua status -> Rekapitulasi.
     */
    public function index(Request $request)
    {
        $reports = Report::with('category')
            ->where('status', 'verified')
            ->when($request->filled('search'), fn ($q) => $q->where(fn ($s) => $s
                ->where('code', 'like', '%' . $request->search . '%')
                ->orWhere('item_name', 'like', '%' . $request->search . '%')
                ->orWhere('reporter_name', 'like', '%' . $request->search . '%')))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.form', [
            'report' => new Report,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, creating: true);

        // Laporan buatan admin langsung "disetujui" supaya muncul di daftar ini.
        $data['status'] = 'verified';
        $data['code'] = 'AD-' . now()->format('ymd') . '-' . Str::upper(Str::random(5));

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reports', 'public');
        }

        Report::create($data);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function edit(Report $report)
    {
        $this->ensureApproved($report);

        return view('admin.reports.form', [
            'report' => $report,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Report $report)
    {
        $this->ensureApproved($report);

        // Jenis laporan dan status tidak ikut diproses, jadi tidak bisa diubah di sini.
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reports', 'public');
        }

        $report->update($data);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Report $report)
    {
        $this->ensureApproved($report);

        $report->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Laporan yang belum/tidak disetujui tidak boleh dibuka lewat halaman ini
     * (termasuk bila alamatnya diketik langsung di browser).
     */
    private function ensureApproved(Report $report): void
    {
        abort_unless($report->status === 'verified', 404);
    }

    private function validated(Request $request, bool $creating = false): array
    {
        $rules = [
            'reporter_name' => ['required', 'string', 'max:120'],
            'reporter_phone' => ['required', 'string', 'max:40'],
            'category_id' => ['required', 'exists:categories,id'],
            'item_name' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'location' => ['required', 'string', 'max:180'],
            'event_date' => ['required', 'date'],
            'receiver_staff' => ['nullable', 'string', 'max:120'],
            'admin_note' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
        ];

        // Jenis laporan hanya boleh dipilih saat membuat laporan baru.
        if ($creating) {
            $rules['type'] = ['required', 'in:lost,found'];
        }

        return $request->validate($rules);
    }
}
