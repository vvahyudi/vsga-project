<?php
session_start();

require_once 'config_db.php';

// Fetch data from tb_produk table
$sql = "SELECT * FROM db_vsga.tb_produk";
$result = mysqli_query($db_connect, $sql);
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
    <title>List Produk</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./dist/css/index.css" rel="stylesheet" />
</head>

<body class="d-flex h-100 text-center text-bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">SMSTokoLontong</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Produk</a>
                    <a class="nav-link fw-bold py-1 px-0" href="tambah_produk.php">Tambah Produk</a>
                    <a class="nav-link fw-bold py-1 px-0" href="#">Edit Produk</a>
                </nav>
            </div>
        </header>
        <?php 
        if ($result) {
            // Display table headers
            echo '
            <main class="px-3">
                <h1>List Produk Makanan</h1>
                <table class="table h-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';

            // Fetch and display data rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                    <th scope="row">' . $row['id_produk'] . '</th>
                    <td>' . $row['nama_produk'] . '</td>
                    <td>' . $row['kategori'] . '</td>
                    <td>Rp. ' . $row['harga'] . ',-</td>
                    <td>' . $row['stok'] . '</td>
                    <td>
                        <a href="edit_produk.php?id=' . $row['id_produk'] . '">Edit</a> | 
                        <a href="delete_produk.php?id=' . $row['id_produk'] . '">Hapus</a>
                    </td>
                </tr>';
            }

            // Close table
            echo '
                    </tbody>
                </table>
            </main>';
        } else {
            echo "Error: " . mysqli_error($db_connect);
        }

        // Close connection
        mysqli_close($db_connect);
        ?>

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