<!DOCTYPE html>

<html>

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>galaxy pets</title>
	
	<link rel="stylesheet" href="../Assets/css/style.css">	
	
</head>


<?php 
session_start();
?>

<body>

		<?php

    
    if (isset($_SESSION['username'])){
        
        header("location: Pages/petprofile.php");
    }
                
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();

                            $_SESSION['username'] = $username;

                            $sql2 = "INSERT INTO latestLogin (username) VALUES ('".$username."') ON DUPLICATE KEY UPDATE prevDate = latestDate, latestDate = CURRENT_TIMESTAMP";

							if ($link->query($sql2) === TRUE) {
								header("location: Pages/petprofile.php");
							} else {
							  echo "Error: " . $sql . "<br>" . $link->error;
							}

                            $_SESSION['id'] = $id;
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
	}
	?>

	<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ</marquee>
	  <header>
		<h2>Sign In</h2>
	  </header>
	  <marquee behavior=scroll direction="right" scrollamount="5" style="color: #17ffee;">•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ</marquee>
	  

	  <div id="nav2">
		<ul>
		  <li><a href="index.php">Home</a></li>
		  <li><a href="login.php">Sign In</a></li>
		  <li><a href="about.html">About us</a></li>
		</ul>
	</div>
	  <main>
		<div class="login-form">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:</label><br>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:</label><br>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a></p>
            <p><a href="ForgotMyPassword.php">I forgot my password</a></p>
        </form>
    </div>
	  </main>

	  <marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ</marquee>
	  <footer>
		<p>Footer</p>
	  </footer>
  

</body>
	
</html>
