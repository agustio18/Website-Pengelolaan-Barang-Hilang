<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lost&amp;Found - Temukan Barangmu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #000456;
            --blue: #2347e0;
            --blue-soft: #e9efff;
            --text: #202744;
            --muted: #7c8294;
            --border: #e3e8f2;
            --surface: #fff;
            --page: #f7f8fc;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            color: var(--text);
            background: var(--page);
            font: 14px 'Poppins', Arial, sans-serif;
        }
        a { color: inherit; }
        .site-header {
            position: relative;
            z-index: 2;
            min-height: 78px;
            padding: 14px max(5%, calc((100% - 1180px) / 2));
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            background: #fff;
            box-shadow: 0 3px 14px rgba(16, 27, 69, .07);
        }
        .brand {
            color: var(--navy);
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1.5px;
            text-decoration: none;
            white-space: nowrap;
        }
        .main-nav { display: flex; align-items: center; gap: 22px; }
        .main-nav a {
            color: #656b81;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }
        .main-nav a:hover { color: var(--blue); }
        .main-nav .admin-link {
            padding: 10px 17px;
            border-radius: 24px;
            color: #fff;
            background: var(--navy);
        }
        .main-nav .admin-link:hover { color: #fff; background: var(--blue); }
        .hero {
            padding: 58px 20px 78px;
            color: #fff;
            text-align: center;
            background: linear-gradient(115deg, #000456 0%, #1633b8 55%, #3546e2 100%);
        }
        .hero h1 {
            margin: 0 0 12px;
            font-size: clamp(27px, 4vw, 42px);
            line-height: 1.25;
            font-weight: 800;
        }
        .hero p { max-width: 720px; margin: 0 auto; color: #dce4ff; font-size: 13px; line-height: 1.8; }
        .content-wrap {
            width: min(1180px, 100%);
            margin: -30px auto 58px;
            padding: 0 20px;
        }
        .flash-message {
            margin: 0 0 18px;
            padding: 13px 17px;
            border: 1px solid #bdebd7;
            border-radius: 11px;
            color: #087b59;
            background: #e8f8f0;
            font-size: 12px;
            line-height: 1.7;
        }
        .search-panel {
            display: grid;
            grid-template-columns: minmax(220px, 1fr) 230px auto auto;
            gap: 10px;
            padding: 19px;
            border: 1px solid rgba(227, 232, 242, .8);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 10px 28px rgba(21, 34, 76, .13);
        }
        .search-panel input, .search-panel select {
            width: 100%;
            min-width: 0;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            color: var(--text);
            background: #fff;
            font: 12px 'Poppins', sans-serif;
        }
        .search-panel input:focus, .search-panel select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(35, 71, 224, .1);
        }
        .search-panel input, .search-panel select { transition: border-color .2s, box-shadow .2s; }
        .search-panel input:hover, .search-panel select:hover {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(35, 71, 224, .06);
        }
        .btn {
            display: inline-flex;
            min-height: 43px;
            align-items: center;
            justify-content: center;
            padding: 10px 17px;
            border: 0;
            border-radius: 10px;
            color: #fff;
            background: var(--navy);
            font: 600 12px 'Poppins', sans-serif;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }
        .btn:hover { background: var(--blue); transform: translateY(-1px); }
        .btn-secondary { color: var(--navy); background: var(--blue-soft); }
        .btn-secondary:hover { color: #fff; background: var(--blue); }
        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin: 34px 0 18px;
        }
        .section-heading h2 { margin: 0; color: var(--navy); font-size: 21px; font-weight: 700; }
        .result-count { color: var(--muted); font-size: 11px; white-space: nowrap; }
        .items-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }
        .item-card {
            min-width: 0;
            padding: 14px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 17px;
            background: var(--surface);
            box-shadow: 0 7px 20px rgba(23, 38, 83, .055);
            transition: transform .2s, box-shadow .2s;
        }
        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 13px 26px rgba(23, 38, 83, .12);
        }
        .item-photo {
            height: 185px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 12px;
            color: #8994b2;
            background: linear-gradient(135deg, #edf3ff, #d9e7ff);
            font-size: 12px;
        }
        .item-photo img { display: block; width: 100%; height: 100%; object-fit: cover; }
        .category-badge {
            display: inline-block;
            margin: 13px 0 8px;
            padding: 5px 10px;
            border-radius: 30px;
            color: #2639a2;
            background: #e5efff;
            font-size: 10px;
            font-weight: 700;
        }
        .item-card h3 { margin: 0 0 7px; color: var(--navy); font-size: 16px; line-height: 1.45; }
        .item-meta { min-height: 42px; margin-bottom: 13px; color: var(--muted); font-size: 10px; line-height: 1.9; }
        .item-card .btn { width: 100%; }
        .empty-state {
            grid-column: 1 / -1;
            padding: 48px 18px;
            border: 1px dashed #d5dced;
            border-radius: 16px;
            color: var(--muted);
            background: #fff;
            text-align: center;
            font-size: 12px;
            line-height: 1.8;
        }
        .empty-state strong { display: block; margin-bottom: 5px; color: var(--navy); font-size: 15px; }
        .pagination { margin-top: 25px; }
        .pagination nav { display: flex; justify-content: center; }
        .pagination a, .pagination span { border-radius: 7px; }
        .site-footer {
            padding: 27px 20px;
            color: var(--muted);
            background: #fff;
            text-align: center;
            font-size: 10px;
        }
        @media (max-width: 850px) {
            .site-header { padding: 15px 22px; flex-wrap: wrap; }
            .main-nav { gap: 14px; flex-wrap: wrap; }
            .search-panel { grid-template-columns: 1fr 1fr; }
            .items-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 560px) {
            .site-header { align-items: flex-start; flex-direction: column; gap: 12px; }
            .brand { font-size: 25px; }
            .main-nav { width: 100%; gap: 10px 15px; }
            .main-nav a { font-size: 10px; }
            .main-nav .admin-link { padding: 8px 12px; }
            .hero { padding: 46px 18px 62px; }
            .hero p { font-size: 11px; }
            .content-wrap { padding: 0 14px; }
            .search-panel, .items-grid { grid-template-columns: 1fr; }
            .section-heading { align-items: flex-start; flex-direction: column; gap: 5px; }
            .section-heading h2 { font-size: 19px; }
            .item-photo { height: 205px; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('home') }}">Lost&amp;Found</a>
        <nav class="main-nav" aria-label="Navigasi utama">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('reports.create', 'lost') }}">Lapor Kehilangan</a>
            <a href="{{ route('reports.create', 'found') }}">Lapor Temuan</a>
            <a class="admin-link" href="{{ route('admin.login') }}">Login Admin</a>
        </nav>
    </header>

    <section class="hero">
        <h1>Temukan Kembali Barang Berhargamu</h1>
        <p>Platform informasi kehilangan dan temuan barang. Mari saling membantu agar barang yang ditemukan dapat kembali kepada pemiliknya.</p>
    </section>

    <main class="content-wrap">
        @if (session('success'))
            <div class="flash-message" role="status">{{ session('success') }}</div>
        @endif

        <form class="search-panel" method="GET" action="{{ route('home') }}">
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama barang, deskripsi, atau lokasi..."
                aria-label="Kata kunci pencarian"
                title="Ketik nama barang, deskripsi, atau lokasi untuk mencari"
            >
            <select name="category_id" aria-label="Filter kategori" title="Pilih kategori untuk menyaring daftar barang">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn" type="submit">Cari Barang</button>
            <a class="btn btn-secondary" href="{{ route('home') }}">Reset</a>
        </form>

        <div class="section-heading">
            <h2>Barang Temuan Terverifikasi</h2>
            <span class="result-count">{{ $reports->total() }} barang tersedia</span>
        </div>

        <section class="items-grid" aria-label="Daftar barang temuan terverifikasi">
            @forelse ($reports as $report)
                <article class="item-card">
                    <div class="item-photo">
                        @if ($report->photo)
                            <img src="{{ asset('storage/' . $report->photo) }}" alt="Foto {{ $report->item_name }}" loading="lazy">
                        @else
                            <span>Foto belum tersedia</span>
                        @endif
                    </div>

                    <span class="category-badge">{{ $report->category?->name ?? 'Lainnya' }}</span>
                    <h3>{{ $report->item_name }}</h3>
                    <div class="item-meta">
                        Lokasi ditemukan: {{ $report->location }}<br>
                        Tanggal ditemukan: {{ $report->event_date?->format('d M Y') ?? '-' }}
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <strong>Belum ada barang temuan yang ditampilkan.</strong>
                    Barang temuan akan muncul di halaman ini setelah diverifikasi oleh admin.
                    <br>Silakan coba kata kunci atau kategori lain jika sedang melakukan pencarian.
                </div>
            @endforelse
        </section>

        @if ($reports->hasPages())
            <div class="pagination">{{ $reports->links() }}</div>
        @endif
    </main>

    <footer class="site-footer">
        &copy; {{ date('Y') }} Lost&amp;Found - Sistem Informasi Kehilangan dan Temuan Barang
    </footer>
</body>
</html>
