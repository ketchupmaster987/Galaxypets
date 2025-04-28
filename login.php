<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    header("location: Pages/petprofile.php");
    exit;
}

// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = 'Please enter username.';
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION['username'] = $username;

                            $sql2 = "INSERT INTO latestLogin (username) VALUES ('$username') 
                                     ON DUPLICATE KEY UPDATE prevDate = latestDate, latestDate = CURRENT_TIMESTAMP";

                            if ($link->query($sql2) === TRUE) {
                                header("location: Pages/petprofile.php");
                                exit;
                            } else {
                                echo "Error: " . $sql2 . "<br>" . $link->error;
                            }
                        } else {
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else {
                    $username_err = 'No account found with that username.';
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galaxy Pets - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/css/style.css">
    <style>
        body {
            background-color: #0b0c2a;
            color: #17ffee;
        }
        .login-form {
            background: #1a1c44;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 20px #17ffee;
        }
        .marquee-text {
            color: #17ffee;
            font-size: 1.2rem;
        }
        header h2, footer p {
            text-align: center;
            margin: 1rem 0;
        }
    </style>
</head>
<body>

<marquee behavior="scroll" direction="left" scrollamount="5" class="marquee-text">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<header>
    <h2>Sign In</h2>
</header>

<marquee behavior="scroll" direction="right" scrollamount="5" class="marquee-text">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Galaxy Pets</a>
        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="login.php">Sign In</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="d-flex justify-content-center align-items-center min-vh-50">
    <div class="login-form w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <div class="invalid-feedback"><?php echo $username_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $password_err; ?></div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="text-center">
                <p>Don't have an account? <a href="register.php" class="text-info">Sign up now</a></p>
                <p><a href="ForgotMyPassword.php" class="text-info">I forgot my password</a></p>
            </div>
        </form>
    </div>
</main>

<marquee behavior="scroll" direction="left" scrollamount="5" class="marquee-text mt-4">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<footer class="text-center mt-4">
    <p>&copy; 2025 Galaxy Pets</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
