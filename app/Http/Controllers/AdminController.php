<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = DB::table('users')->count();
        $totalLaporans = DB::table('laporans')->count();
        $totalReports = DB::table('reports')->count();
        $totalHandovers = DB::table('handovers')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLaporans',
            'totalReports',
            'totalHandovers'
        ));
    }
}