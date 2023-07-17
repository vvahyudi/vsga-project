<?php
session_start();

require_once 'config_db.php';
?>
<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <!-- <script src="../assets/js/color-modes.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="Ahmad Wahyudi" content="VSGA-2023" />
    <meta name="generator" content="Hugo 0.112.5" />
    <title>Selamat Datang</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./dist/css/index.css" rel="stylesheet" />
</head>

<body class="d-flex h-100 text-center text-bg-dark">


    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0" href="#">SMSTokoLontong</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="#">Produk</a>
                    <a class="nav-link fw-bold py-1 px-0" href="#">Tambah Produk</a>
                    <a class="nav-link fw-bold py-1 px-0 " href="#">Edit Produk</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>SMSTokoLontong</h1>
            <p class="lead">
                SMSTokoLontong adalah solusi manajemen stok yang didesain khusus untuk toko kelontong. Dengan antarmuka
                yang mudah digunakan, pemilik toko dapat dengan cepat memperbarui daftar barang, mengatur harga, dan
                melihat laporan penjualan. Sistem ini membantu mengoptimalkan pengelolaan stok, mengurangi kerugian
                akibat persediaan yang tidak terkelola dengan baik, dan meningkatkan kepuasan pelanggan dengan
                menyediakan persediaan barang yang memadai. SMSTokoLontong dapat diimplementasikan dengan mudah dan
                dapat diakses melalui web browser, memberikan fleksibilitas dalam mengelola stok toko kelontong secara
                efisien.
            </p>
            <p class="lead">
                <a href="login.php" class="btn btn-lg btn-light fw-bold border-white bg-white">Login Sekarang</a>
            </p>
        </main>

        <footer class="mt-auto text-white-50">
            <p>
                Cover template for
                <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>,
                by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.
            </p>
        </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>