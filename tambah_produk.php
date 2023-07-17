<?php
session_start();

// Check if the user is already logged in, if yes then redirect to the home page

// Include config file
require_once "config_db.php";

// Initialize variables
$nama_produk = $kategori = $harga = $stok = "";
$nama_produk_err = $kategori_err = $harga_err = $stok_err = "";

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate nama_produk
    if (empty(trim($_POST["nama_produk"]))) {
        $nama_produk_err = "Please enter the product name.";
    } else {
        $nama_produk = trim($_POST["nama_produk"]);
    }

    // Validate kategori
    if (empty(trim($_POST["kategori"])) || $_POST["kategori"] == "Pilih Kategori") {
        $kategori_err = "Please select the product category.";
    } else {
        $kategori = trim($_POST["kategori"]);
    }

    // Validate harga
    if (empty(trim($_POST["harga"]))) {
        $harga_err = "Please enter the product price.";
    } else {
        $harga = trim($_POST["harga"]);
    }

    // Validate stok
    if (empty(trim($_POST["stok"]))) {
        $stok_err = "Please enter the product stock.";
    } else {
        $stok = trim($_POST["stok"]);
    }

    // Check input errors before inserting into the database
    if (empty($nama_produk_err) && empty($kategori_err) && empty($harga_err) && empty($stok_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO tb_produk (nama_produk, kategori, harga, stok) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db_connect, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssii", $param_nama_produk, $param_kategori, $param_harga, $param_stok);

            // Set parameters
            $param_nama_produk = $nama_produk;
            $param_kategori = $kategori;
            $param_harga = $harga;
            $param_stok = $stok;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the list_produk page
                header("location: list_produk.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($db_connect);
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
    <title>Tambah Produk</title>

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
                    <a class="nav-link fw-bold py-1 px-0" href="list_produk.php">Produk</a>
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Tambah Produk</a>
                    <a class="nav-link fw-bold py-1 px-0" href="#">Edit Produk</a>
                </nav>
            </div>
        </header>

        <main class="form-produk w-100 m-auto">
            <div class="d-flex flex-row justify-content-center">
                <img class="mb-4" src="./dist/image/digitalent.png" alt="" width="72" height="57" />
            </div>
            <div class="d-flex flex-row justify-content-center">
                <h1 class="h3 mb-3 fw-normal">Tambah Produk</h1>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-floating py-2">
                    <input type="text" class="form-control " name="nama_produk" id="nama_produk"
                        placeholder="Nama Produk" autocomplete="nama_produk" value="<?php echo $nama_produk; ?>" />
                    <label for="nama_produk">Nama Produk</label>
                    <span class="invalid-feedback"><?php echo $nama_produk_err; ?></span>
                </div>
                <div class="form-floating py-2">
                    <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                        <option selected disabled>Pilih Kategori</option>
                        <option value="makanan" <?php echo ($kategori === 'makanan') ? 'selected' : ''; ?>>Makanan
                        </option>
                        <option value="minuman" <?php echo ($kategori === 'minuman') ? 'selected' : ''; ?>>Minuman
                        </option>
                    </select>
                    <label for="kategori">Kategori</label>
                    <span class="invalid-feedback"><?php echo $kategori_err; ?></span>
                </div>
                <div class="form-floating py-2">
                    <input type="number" class="form-control " name="harga" id="harga" placeholder="Harga"
                        autocomplete="harga" value="<?php echo $harga; ?>" />
                    <label for="harga">Harga</label>
                    <span class="invalid-feedback"><?php echo $harga_err; ?></span>
                </div>
                <div class="form-floating py-2">
                    <input type="number" class="form-control " name="stok" id="stok" placeholder="Stok"
                        autocomplete="stok" value="<?php echo $stok; ?>" />
                    <label for="stok">Stok</label>
                    <span class="invalid-feedback"><?php echo $stok_err; ?></span>
                </div>
                <div class="d-flex flex-row py-2 justify-content-between">
                    <button class="btn btn-primary  py-2" type="submit" name="submit">
                        Tambah
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