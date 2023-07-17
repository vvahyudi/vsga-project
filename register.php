<?php
require_once 'config_db.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_user FROM tb_user WHERE username = ?";

        if ($stmt = mysqli_prepare($db_connect, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO tb_user (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($db_connect, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = $password; // Store the password as plain text (without hashing)

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($db_connect);
}
?>

<!DOCTYPE html>
<html lang="en" class='h-100' data-bs-theme="auto">

<head>
    <!-- <script src="../assets/js/color-modes.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="Ahmad Wahyudi" content="VSGA-2023" />
    <meta name="generator" content="Hugo 0.112.5" />
    <title>Register</title>

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./dist/css/auth.css" rel="stylesheet" />
</head>


<body class="d-flex h-100 text-center text-bg-dark">


    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <main class="form-signin w-100 m-auto">
            <img class="mb-4" src="./dist/image/digitalent.png" alt="" width="72" height="57" />
            <h1 class="h3 mb-3 fw-normal">Register Now</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                class="text-body-secondary">

                <div class="form-floating py-2">
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        name="username" id="username" placeholder="username" autocomplete="username"
                        value="<?php echo $username;?>" />
                    <label for="username">Username</label>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-floating py-2">
                    <input type="password"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password"
                        placeholder="Password" autocomplete="current-password" value="<?php echo $password; ?>" />
                    <label for="password">Password</label>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-floating py-2">
                    <input type="password"
                        class="form-control<?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $confirm_password; ?>" name="confirm_password" placeholder="Confirm Password"
                        autocomplete="current-password" />
                    <label for="confirm_password">Confirm Password</label>
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="d-flex flex-row py-2 justify-content-between">

                    <button class="btn btn-primary  py-2" type="submit" name="submit">
                        Register
                    </button>
                    <button class="btn btn-secondary" type="reset" name="reset">
                        Reset
                    </button>
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
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