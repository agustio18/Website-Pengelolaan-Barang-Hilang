<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Lost & Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #212529; color: white; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: #343a40; color: white; border-left: 4px solid #0d6efd; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="p-3 border-bottom border-secondary">
                <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Admin Panel</h5>
                <small class="text-secondary">db_lostfound</small>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.dashboard') }}" class="active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a href="#"><i class="bi bi-journal-text me-2"></i> Data Laporans</a>
                <a href="#"><i class="bi bi-file-earmark-check me-2"></i> Data Reports</a>
                <a href="#"><i class="bi bi-arrow-left-right me-2"></i> Handovers</a>
                <a href="#"><i class="bi bi-people me-2"></i> Users</a>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2">Dashboard Admin</h1>
                <span class="badge bg-primary p-2">Admin</span>
            </div>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm border-start border-primary border-4">
                        <div class="card-body">
                            <h6 class="text-muted">Total Laporans</h6>
                            <h2 class="fw-bold">{{ $totalLaporans }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm border-start border-success border-4">
                        <div class="card-body">
                            <h6 class="text-muted">Total Reports</h6>
                            <h2 class="fw-bold">{{ $totalReports }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm border-start border-warning border-4">
                        <div class="card-body">
                            <h6 class="text-muted">Total Handovers</h6>
                            <h2 class="fw-bold">{{ $totalHandovers }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm border-start border-dark border-4">
                        <div class="card-body">
                            <h6 class="text-muted">Total Users</h6>
                            <h2 class="fw-bold">{{ $totalUsers }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>