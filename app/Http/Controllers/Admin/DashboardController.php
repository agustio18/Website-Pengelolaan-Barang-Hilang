<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarangHilang = Report::where('type', 'lost')->count();

        $totalBarangTemuan = Report::where('type', 'found')->count();

        $menungguVerifikasi = Report::where('status', 'pending')->count();

        $sudahDikembalikan = Report::where('status', 'returned')->count();

        return view('admin.dashboard', compact(
            'totalBarangHilang',
            'totalBarangTemuan',
            'menungguVerifikasi',
            'sudahDikembalikan'
        ));
    }
}
