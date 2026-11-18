<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RecapController extends Controller
{
    private function filtered(Request $request) { return Report::with('category')->when($request->filled('from'),fn($q)=>$q->whereDate('created_at','>=',$request->from))->when($request->filled('to'),fn($q)=>$q->whereDate('created_at','<=',$request->to))->when($request->filled('category_id'),fn($q)=>$q->where('category_id',$request->category_id))->when($request->filled('status'),fn($q)=>$q->where('status',$request->status))->when($request->filled('type'),fn($q)=>$q->where('type',$request->type)); }
    public function index(Request $request) { $query=$this->filtered($request); $reports=(clone $query)->latest()->paginate(15)->withQueryString(); $summary=['total'=>(clone $query)->count(),'pending'=>(clone $query)->where('status','pending')->count(),'returned'=>(clone $query)->where('status','returned')->count(),'rejected'=>(clone $query)->where('status','rejected')->count()]; $categories=Category::orderBy('name')->get(); return view('admin.recap.index',compact('reports','summary','categories')); }
    public function export(Request $request): StreamedResponse { $rows=$this->filtered($request)->latest()->get(); return response()->streamDownload(function() use($rows){ $out=fopen('php://output','w'); fputcsv($out,['Kode','Jenis','Nama Barang','Kategori','Pelapor','Kontak','Lokasi','Tanggal','Status']); foreach($rows as $r) fputcsv($out,[$r->code,$r->type==='lost'?'Hilang':'Temuan',$r->item_name,$r->category?->name,$r->reporter_name,$r->reporter_phone,$r->location,$r->event_date?->format('Y-m-d'),$r->status]); fclose($out); },'rekap-lost-found-'.now()->format('Ymd-His').'.csv',['Content-Type'=>'text/csv; charset=UTF-8']); }
}
