@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard Admin')
@section('content')
<div class="stats"><div class="stat red" title="Jumlah seluruh laporan barang hilang yang masuk"><strong>{{ $totalBarangHilang }}</strong><span>Total Laporan Kehilangan</span></div><div class="stat blue" title="Jumlah seluruh laporan barang temuan yang masuk"><strong>{{ $totalBarangTemuan }}</strong><span>Total Laporan Temuan</span></div><div class="stat orange" title="Laporan baru yang belum diperiksa admin"><strong>{{ $menungguVerifikasi }}</strong><span>Menunggu Verifikasi</span></div><div class="stat green" title="Barang yang sudah diambil pemiliknya"><strong>{{ $sudahDikembalikan }}</strong><span>Sudah Diserahterimakan</span></div></div>
<div class="panel"><h2>Alur Pengelolaan Laporan</h2><p style="color:#78809b;line-height:1.8;margin:0">Periksa laporan baru melalui menu <b>Verifikasi Laporan</b>. Laporan temuan yang disetujui akan muncul di beranda publik. Setelah pemilik mengambil barang, catat prosesnya melalui menu <b>Serah Terima</b>.</p></div>
@endsection
