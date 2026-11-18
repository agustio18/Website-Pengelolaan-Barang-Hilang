<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function store(Request $request, string $type)
    {
        abort_unless(in_array($type, ['lost', 'found'], true), 404);
        $data = $request->validate([
            'reporter_name' => ['required', 'string', 'max:120'],
            'reporter_phone' => ['required', 'string', 'max:40'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'max:2000'],
            'location' => ['required', 'string', 'max:180'],
            'event_date' => ['required', 'date', 'before_or_equal:today'],
            'receiver_staff' => [$type === 'found' ? 'required' : 'nullable', 'string', 'max:120'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
        ]);
        $description = trim($data['description']);
        $data['item_name'] = Str::limit(implode(' ', array_slice(preg_split('/\s+/', $description), 0, 3)), 100, '');
        $data['type'] = $type;
        $data['status'] = 'pending';
        $data['code'] = strtoupper($type === 'lost' ? 'LH' : 'LT').'-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('reports', 'public');
        Report::create($data);
        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim. Simpan kode laporan Anda: '.$data['code'].'. Laporan menunggu verifikasi admin.');
    }
}
