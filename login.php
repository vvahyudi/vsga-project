<?php
session_start();

// Check if the user is already logged in, if yes then redirect to the home page


// Include config file
require_once "config_db.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if the password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id_user, username, password FROM tb_user WHERE username = ?";

        if ($stmt = mysqli_prepare($db_connect, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id_user, $username, $db_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($password === $db_password) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_user"] = $id_user;
                            $_SESSION["username"] = $username;

                            // Redirect user to the dashboard page
                            header("location: list_produk.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <!-- <script src="../assets/js/color-modes.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="Ahmad Wahyudi" content="VSGA-2023" />
    <meta name="generator" content="Hugo 0.112.5" />
    <title>Login</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./dist/css/auth.css" rel="stylesheet" />
</head>

<body class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main class="form-signin w-100 m-auto">
            <div>

                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <?php if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        } 
        ?>

                <img class="mb-4" src="./dist/image/digitalent.png" alt="" width="72" height="57" />
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" autocomplete="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" autocomplete="current-password"
                            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
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