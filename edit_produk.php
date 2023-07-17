<?php
session_start();

require_once 'config_db.php';

// Check if the product ID is provided in the query string
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Fetch the product data from the database
    $sql = "SELECT * FROM db_vsga.tb_produk WHERE id_produk = '$productID'";
    $result = mysqli_query($db_connect, $sql);
    $row = mysqli_fetch_assoc($result);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data
        $namaProduk = $_POST["nama_produk"];
        $kategori = $_POST["kategori"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];

        // Update the product in the database
        $updateSql = "UPDATE db_vsga.tb_produk SET nama_produk='$namaProduk', kategori='$kategori', harga='$harga', stok='$stok' WHERE id_produk='$productID'";
        $updateResult = mysqli_query($db_connect, $updateSql);

        if ($updateResult) {
            // Redirect back to the product list page
            header("Location: list_produk.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($db_connect);
        }
    }
} else {
    echo "Product ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script src="../assets/js/color-modes.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="Ahmad Wahyudi" content="VSGA-2023" />
    <meta name="generator" content="Hugo 0.112.5" />
    <title>Edit Produk</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./dist/css/produk.css" rel="stylesheet" />
</head>

<body class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">


        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">SMSTokoLontong</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="list_produk.php">Produk</a>
                    <a class="nav-link fw-bold py-1 px-0" href="tambah_produk.php">Tambah Produk</a>
                    <a class="nav-link fw-bold py-1 px-0 active" href="#">Edit Produk</a>
                </nav>
            </div>
        </header>

        <main class="form-produk w-100 m-auto">
            <div class="d-flex flex-row justify-content-center">
                <img class="mb-4" src="./dist/image/digitalent.png" alt="" width="72" height="57" />
            </div>
            <div class="d-flex flex-row justify-content-center">
                <h1 class="h3 mb-3 fw-normal">Edit Produk</h1>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $productID; ?>" method="post">

                <div class="form-floating py-2">
                    <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                        placeholder="Nama Produk" autocomplete="nama_produk"
                        value="<?php echo $row['nama_produk']; ?>" />
                    <label for="nama_produk">Nama Produk</label>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-floating py-2">
                    <select class="form-select" name="kategori" aria-label="Default select example">
                        <option selected disabled>Pilih Kategori</option>
                        <option value="makanan" <?php if ($row['kategori'] === 'makanan') echo 'selected'; ?>>Makanan
                        </option>
                        <option value="minuman" <?php if ($row['kategori'] === 'minuman') echo 'selected'; ?>>Minuman
                        </option>
                    </select>
                    <label for="kategori">Kategori</label>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-floating py-2">
                    <input type="number" class="form-control" name="harga" id="harga" placeholder="harga"
                        autocomplete="harga" value="<?php echo $row['harga']; ?>" />
                    <label for="harga">Harga</label>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-floating py-2">
                    <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok"
                        autocomplete="stok" value="<?php echo $row['stok']; ?>" />
                    <label for="stok">Stok</label>
                    <span class="invalid-feedback"></span>
                </div>

                <div class="d-flex flex-row py-2 justify-content-between">

                    <button class="btn btn-primary py-2" type="submit" name="submit">
                        Update
                    </button>
                    <button class="btn btn-secondary" type="reset" name="reset">
                        Reset
                    </button>
                </div>
            </form>
        </main>
        <footer class="mt-auto text-white-50">
            <p>
                Cover template for
                <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>,
                by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.
            </p>
        </footer>
        <script src="./dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>