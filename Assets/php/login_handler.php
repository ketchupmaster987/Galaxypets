<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    header("location: ../../Pages/petprofile.php");
    exit;
}

// Include config file
require_once './config.php';

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
                                header("location: ../../Pages/petprofile.php");
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