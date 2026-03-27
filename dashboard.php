<?php
// Koneksi database dan logika session biasanya diletakkan di sini
// include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rossi Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1"><i class="bi bi-check2-square"></i> Rossi Task Manager</span>
    </div>
</nav>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Selamat Datang di Fitur Task Management</h2>
            <p class="text-muted">Kelola tugas harian Anda dengan efisien.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="task_create.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Tugas Baru
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body">
                    <h5>Total Tugas</h5>
                    <h2 class="fw-bold">12</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body">
                    <h5>Sedang Berjalan</h5>
                    <h2 class="fw-bold">5</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <h5>Selesai</h5>
                    <h2 class="fw-bold">7</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Daftar Tugas Anda</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Tugas</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><strong>Integrasi API Rossi</strong></td>
                            <td><span class="badge bg-danger">Tinggi</span></td>
                            <td><span class="badge bg-secondary">Pending</span></td>
                            <td>2026-03-30</td>
                            <td>
                                <a href="task_edit.php?id=1" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="task_delete.php?id=1" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Update Dokumentasi UI</td>
                            <td><span class="badge bg-info">Rendah</span></td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>2026-03-25</td>
                            <td>
                                <a href="task_edit.php?id=2" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="task_delete.php?id=2" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>