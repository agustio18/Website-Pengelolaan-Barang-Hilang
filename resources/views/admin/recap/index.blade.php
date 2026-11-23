@extends('layouts.admin') @section('title','Rekapitulasi') @section('page-title','Laporan Rekapitulasi') @section('content')
<div class="panel">
    <form class="toolbar align-end" method="GET" action="{{ route('admin.recap.index') }}">
        <label class="filter-field" title="Tampilkan laporan yang tanggal kejadiannya mulai dari tanggal ini">Tanggal kejadian: dari
            <input type="date" name="from" value="{{ request('from') }}">
        </label>
        <label class="filter-field" title="Tampilkan laporan yang tanggal kejadiannya sampai tanggal ini">Tanggal kejadian: sampai
            <input type="date" name="to" value="{{ request('to') }}">
        </label>
        <select name="category_id" title="Saring berdasarkan kategori barang">
            <option value="">Semua Kategori</option>
            @foreach($categories as $c)<option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ $c->name }}</option>@endforeach
        </select>
        <select name="type" title="Saring berdasarkan jenis laporan">
            <option value="">Semua Jenis</option>
            <option value="lost" @selected(request('type')==='lost')>Hilang</option>
            <option value="found" @selected(request('type')==='found')>Temuan</option>
        </select>
        <select name="status" title="Saring berdasarkan status laporan">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Menunggu Verifikasi','verified'=>'Disetujui','returned'=>'Sudah Diambil','rejected'=>'Ditolak'] as $v=>$label)<option value="{{ $v }}" @selected(request('status')===$v)>{{ $label }}</option>@endforeach
        </select>
        <button class="btn" title="Terapkan semua filter di atas">Terapkan</button>
        <a class="btn light" href="{{ route('admin.recap.index') }}" title="Hapus semua filter, tampilkan seluruh data">Reset</a>
        <a class="btn" href="{{ route('admin.recap.export',request()->query()) }}" title="Unduh data sesuai filter dalam format CSV (bisa dibuka di Excel)">Export CSV</a>
    </form>
    <div class="stats five">
        <div class="stat purple" title="Jumlah semua laporan sesuai filter"><strong>{{ $summary['total'] }}</strong><span>Total Laporan</span></div>
        <div class="stat orange" title="Laporan yang belum diperiksa admin"><strong>{{ $summary['pending'] }}</strong><span>Menunggu Verifikasi</span></div>
        <div class="stat blue" title="Laporan yang sudah disetujui admin"><strong>{{ $summary['verified'] }}</strong><span>Disetujui</span></div>
        <div class="stat green" title="Barang yang sudah diambil pemiliknya"><strong>{{ $summary['returned'] }}</strong><span>Sudah Diambil</span></div>
        <div class="stat red" title="Laporan yang ditolak admin"><strong>{{ $summary['rejected'] }}</strong><span>Ditolak</span></div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Kode</th><th>Jenis</th><th>Barang</th><th>Kategori</th><th>Pelapor</th><th>Tgl Kejadian</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($reports as $r)
                <tr>
                    <td>{{ $r->code }}</td>
                    <td>{{ $r->type==='lost'?'Hilang':'Temuan' }}</td>
                    <td>{{ $r->item_name }}</td>
                    <td>{{ $r->category?->name }}</td>
                    <td>{{ $r->reporter_name }}</td>
                    <td>{{ $r->event_date?->format('d/m/Y') }}</td>
                    <td><span class="badge {{ $r->status }}">{{ ['pending'=>'Menunggu Verifikasi','verified'=>'Disetujui','returned'=>'Sudah Diambil','rejected'=>'Ditolak'][$r->status] }}</span></td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty">Tidak ada data sesuai filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $reports->links() }}</div>
</div>@endsection
