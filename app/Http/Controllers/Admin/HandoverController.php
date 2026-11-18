<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Handover;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class HandoverController extends Controller
{
    public function index() { $reports=Report::with('category')->where('type','found')->where('status','verified')->whereDoesntHave('handover')->latest()->get(); $handovers=Handover::with('report')->latest('handover_date')->paginate(10); return view('admin.handovers.index',compact('reports','handovers')); }
    public function store(Request $request, Report $report) {
        $data=$request->validate(['recipient_name'=>['required','string','max:120'],'recipient_identity'=>['required','string','max:80'],'handover_date'=>['required','date'],'officer_name'=>['required','string','max:120'],'notes'=>['nullable','string','max:2000']]);
        DB::transaction(function() use($report,$data){ $locked=Report::whereKey($report->id)->lockForUpdate()->firstOrFail(); if($locked->type!=='found'||$locked->status!=='verified'||$locked->handover()->exists()) throw ValidationException::withMessages(['report'=>'Laporan tidak memenuhi syarat serah terima atau sudah diproses.']); Handover::create(['report_id'=>$locked->id]+$data); $locked->update(['status'=>'returned']); });
        return back()->with('success','Serah terima berhasil dicatat.');
    }
}
