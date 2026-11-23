@extends('layouts.admin') @section('title','Manajemen Laporan') @section('page-title','Manajemen Laporan') @section('content')
<div class="panel">
    <form class="toolbar" method="GET">
        <input name="search" value="{{ request('search') }}" placeholder="Cari kode, barang, pelapor..." title="Cari berdasarkan kode laporan, nama barang, atau nama pelapor">
        <select name="type" title="Saring berdasarkan jenis laporan">
            <option value="">Semua Jenis</option>
            <option value="lost" @selected(request('type')==='lost')>Hilang</option>
            <option value="found" @selected(request('type')==='found')>Temuan</option>
        </select>
        <button class="btn" title="Terapkan pencarian dan filter jenis">Filter</button>
        <a class="btn light" href="{{ route('admin.reports.index') }}" title="Hapus pencarian dan filter, tampilkan semua laporan disetujui">Reset</a>
        <a class="btn" style="margin-left:auto" href="{{ route('admin.reports.create') }}" title="Buat laporan baru (langsung berstatus Disetujui)">+ Tambah Laporan</a>
    </form>
    <p style="color:#78809b;font-size:12px;margin:-4px 0 14px">Hanya laporan berstatus <b>Disetujui</b> yang ditampilkan di halaman ini.</p>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Kode</th><th>Jenis</th><th>Barang</th><th>Kategori</th><th>Pelapor</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($reports as $r)
                <tr>
                    <td><b>{{ $r->code }}</b></td>
                    <td>{{ $r->type==='lost'?'Hilang':'Temuan' }}</td>
                    <td>{{ $r->item_name }}</td>
                    <td>{{ $r->category?->name }}</td>
                    <td>{{ $r->reporter_name }}</td>
                    <td>{{ $r->event_date?->format('d/m/Y') }}</td>
                    <td><span class="badge {{ $r->status }}">{{ ['pending'=>'Menunggu Verifikasi','verified'=>'Disetujui','returned'=>'Sudah Diambil','rejected'=>'Ditolak'][$r->status] }}</span></td>
                    <td>
                        <div class="actions">
                            <a class="btn light" href="{{ route('admin.reports.edit',$r) }}" title="Ubah data laporan ini">Edit</a>
                            <form method="POST" action="{{ route('admin.reports.destroy',$r) }}" onsubmit="return confirm('Hapus laporan ini?')">@csrf @method('DELETE')<button class="btn danger" title="Hapus laporan ini secara permanen">Hapus</button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="empty">Tidak ada laporan disetujui yang cocok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $reports->links() }}</div>
</div>@endsection
