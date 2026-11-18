@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard Admin')
@section('content')
<div class="stats"><div class="stat"><strong>{{ $totalBarangHilang }}</strong><span>Total Laporan Kehilangan</span></div><div class="stat"><strong>{{ $totalBarangTemuan }}</strong><span>Total Laporan Temuan</span></div><div class="stat"><strong>{{ $menungguVerifikasi }}</strong><span>Menunggu Verifikasi</span></div><div class="stat"><strong>{{ $sudahDikembalikan }}</strong><span>Sudah Diserahterimakan</span></div></div>
<div class="panel"><h2>Alur Pengelolaan Laporan</h2><p style="color:#78809b;line-height:1.8;margin:0">Periksa laporan baru melalui menu <b>Verifikasi Laporan</b>. Laporan temuan yang disetujui akan muncul di beranda publik. Setelah pemilik mengambil barang, catat prosesnya melalui menu <b>Serah Terima</b>.</p><div class="actions" style="margin-top:18px"><a class="btn" href="{{ route('admin.verification.index') }}">Periksa antrean verifikasi</a><a class="btn light" href="{{ route('admin.reports.index') }}">Kelola semua laporan</a></div></div>
@endsection
