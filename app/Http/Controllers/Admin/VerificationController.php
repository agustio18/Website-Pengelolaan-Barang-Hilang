<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index() { $reports=Report::with('category')->where('status','pending')->latest()->paginate(12); return view('admin.verification.index',compact('reports')); }
    public function approve(Request $request, Report $report) { abort_unless($report->status==='pending',422); $report->update(['status'=>'verified','admin_note'=>$request->validate(['admin_note'=>['nullable','string','max:2000']])['admin_note']??null]); return back()->with('success','Laporan berhasil diverifikasi.'); }
    public function reject(Request $request, Report $report) { abort_unless($report->status==='pending',422); $data=$request->validate(['admin_note'=>['required','string','max:2000']]); $report->update(['status'=>'rejected','admin_note'=>$data['admin_note']]); return back()->with('success','Laporan ditolak dengan catatan.'); }
}
