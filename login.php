<?php include 'Assets/php/login_handler.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galaxy Pets - Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="Assets/css/loginstyle.css">
</head>

<body>
<header class="border-bottom sticky-top">
    <div id="navbar-container"></div>
</header>

<marquee behavior="scroll" direction="right" scrollamount="5" class="marquee-text">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

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
<script src="./Assets/js/navbar.js"></script>
</body>
</html>
