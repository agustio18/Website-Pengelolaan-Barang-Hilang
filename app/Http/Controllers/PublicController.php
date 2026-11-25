<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Beranda pengunjung hanya menampilkan laporan TEMUAN yang sudah
     * disetujui admin (status verified). Laporan KEHILANGAN tetap
     * tersimpan dan dikelola melalui halaman admin.
     */
    public function index(Request $request)
    {
        $reportsQuery = Report::query()
            ->with('category')
            ->where('type', 'found')
            ->where('status', 'verified');

        if ($request->filled('search')) {
            $keyword = trim((string) $request->input('search'));

            $reportsQuery->where(function ($query) use ($keyword) {
                $query->where('item_name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('category_id')) {
            $reportsQuery->where('category_id', $request->integer('category_id'));
        }

        $reports = $reportsQuery
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('public.home', compact('reports', 'categories'));
    }

    public function create(string $type)
    {
        abort_unless(in_array($type, ['lost', 'found'], true), 404);

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('public.form', compact('type', 'categories'));
    }
}
