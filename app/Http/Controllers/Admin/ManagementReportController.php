<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagementReportController extends Controller
{
    public function index(Request $request) {
        $reports=Report::with('category')->when($request->filled('search'),fn($q)=>$q->where(fn($s)=>$s->where('code','like','%'.$request->search.'%')->orWhere('item_name','like','%'.$request->search.'%')->orWhere('reporter_name','like','%'.$request->search.'%')))->when($request->filled('type'),fn($q)=>$q->where('type',$request->type))->when($request->filled('status'),fn($q)=>$q->where('status',$request->status))->latest()->paginate(15)->withQueryString();
        return view('admin.reports.index',compact('reports'));
    }
    public function create() { return view('admin.reports.form',['report'=>new Report,'categories'=>Category::orderBy('name')->get()]); }
    public function store(Request $request) { $data=$this->validated($request); $data['code']='AD-'.now()->format('ymd').'-'.Str::upper(Str::random(5)); if($request->hasFile('photo'))$data['photo']=$request->file('photo')->store('reports','public'); Report::create($data); return redirect()->route('admin.reports.index')->with('success','Laporan berhasil dibuat.'); }
    public function edit(Report $report) { return view('admin.reports.form',['report'=>$report,'categories'=>Category::orderBy('name')->get()]); }
    public function update(Request $request, Report $report) { $data=$this->validated($request); if($request->hasFile('photo'))$data['photo']=$request->file('photo')->store('reports','public'); $report->update($data); return redirect()->route('admin.reports.index')->with('success','Laporan berhasil diperbarui.'); }
    public function destroy(Report $report) { $report->delete(); return back()->with('success','Laporan berhasil dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['type'=>['required','in:lost,found'],'reporter_name'=>['required','string','max:120'],'reporter_phone'=>['required','string','max:40'],'category_id'=>['required','exists:categories,id'],'item_name'=>['required','string','max:120'],'description'=>['required','string','max:2000'],'location'=>['required','string','max:180'],'event_date'=>['required','date'],'receiver_staff'=>['nullable','string','max:120'],'status'=>['required','in:pending,verified,rejected,returned'],'admin_note'=>['nullable','string','max:2000'],'photo'=>['nullable','image','mimes:jpg,jpeg,png','max:3072']]); }
}
