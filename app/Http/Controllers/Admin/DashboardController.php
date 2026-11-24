<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLaporans = DB::table('laporans')->count();
        $totalReports = DB::table('reports')->count();
        $totalHandovers = DB::table('handovers')->count();
        $totalUsers = DB::table('users')->count();

        return view('admin.dashboard', compact(
            'totalLaporans',
            'totalReports',
            'totalHandovers',
            'totalUsers'
        ));
    }
}