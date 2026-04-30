<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

$unit = $_SESSION['unit'];

// Nama unit & warna
if($unit == 'ra'){
    $nama_unit = "R.A";
    $warna = "#f59e0b";
} elseif($unit == 'mi'){
    $nama_unit = "MI";
    $warna = "#16a34a";
} else {
    $nama_unit = "SMP";
    $warna = "#2563eb";
}

// Ambil data guru sesuai unit
$query = mysqli_query($conn, "SELECT * FROM guru WHERE unit='$unit'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
        }

        .header-top {
            background: <?= $warna ?>;
            color: white;
            padding: 15px;
        }

        .header-bottom {
            background: #e2e8f0;
            padding: 15px;
        }

        .card-guru {
            border-radius: 15px;
            background: white;
            transition: 0.3s;
        }

        .card-guru:hover {
            transform: scale(1.03);
        }

        .profile-img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .btn-aksi {
            background: <?= $warna ?>;
            color: white;
            border-radius: 8px;
            border: none;
        }

        .btn-aksi:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

<!-- HEADER ATAS -->
<div class="header-top">
    <div class="container-fluid d-flex align-items-center px-4">

        <div class="d-flex align-items-center">
            <img src="logo.png" style="width:45px;" class="me-2">
            <div>
                <h6 class="mb-0 fw-bold">YAYASAN AL-ISTIQOMAH</h6>
            </div>
        </div>

        <a href="logout.php" class="btn btn-light btn-sm ms-auto">
            Keluar
        </a>
    </div>
</div>

<!-- HEADER BAWAH -->
<div class="header-bottom">
    <div class="container-fluid mt-4 px-4">
        <h4 class="fw-bold mb-0">DASHBOARD GURU <?= $nama_unit ?></h4>
        <small class="text-muted">Login sebagai: <?= $_SESSION['email'] ?></small>
    </div>
</div>

<!-- CONTENT -->
<div class="container-fluid mt-4 px-4">

    <h5 class="mb-3">Data Guru</h5>

    <div class="row">

    <?php if(mysqli_num_rows($query) > 0): ?>

        <?php while($g = mysqli_fetch_assoc($query)): ?>

        <div class="col-md-6 mb-4">
            <div class="card card-guru shadow p-3 d-flex flex-row align-items-center">

                <img src="foto/<?= $g['foto'] ?>" class="profile-img me-3">

                <div>
                    <h6 class="mb-1"><?= $g['nama'] ?></h6>
                    <small class="text-muted"><?= $g['mapel'] ?></small><br>

                    <button class="btn btn-aksi btn-sm mt-2"
                        onclick="bukaProfil('<?= $g['nama'] ?>')">
                        Upload Berkas & Absen
                    </button>
                </div>

            </div>
        </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="col-12">
            <div class="alert alert-warning text-center">
                Data guru untuk <?= $nama_unit ?> belum tersedia
            </div>
        </div>

    <?php endif; ?>

    </div>

    <!-- DETAIL PROFIL -->
    <div id="areaProfil" class="mt-4 d-none">
        <div class="card p-4 shadow">
            <h5 id="namaGuru"></h5>

            <div class="row mt-3">
                <div class="col-6">
                    <button class="btn btn-success w-100">ABSENSI</button>
                </div>

                <div class="col-6">
                    <button class="btn btn-info w-100 text-white" data-bs-toggle="modal" data-bs-target="#modalUpload">
                        UPLOAD BERKAS
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content p-3">

            <h5>Upload Dokumen Guru</h5>

            <form>
                <div class="mb-3">
                    <label>Jenis Berkas</label>
                    <select class="form-control">
                        <option>-- Pilih --</option>
                        <option>SK Mengajar</option>
                        <option>Ijazah</option>
                        <option>Sertifikat</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control">
                </div>

                <button class="btn btn-primary w-100">Unggah Sekarang</button>
            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function bukaProfil(nama){
    document.getElementById('areaProfil').classList.remove('d-none');
    document.getElementById('namaGuru').innerText = "Profil: " + nama;
}
</script>

</body>
</html>