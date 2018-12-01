<!--register.html-->
<!DOCTYPE html>
<html>
<head>
<script src="validate.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Register</title>
</head>
<body>

<ul class="navigation">
  <li><a href="index.html">Home</a></li>
  <li><a href="search.html">Search</a></li>
  <li>  <a href="register.html">Register</a></li>
  <li>  <a href="submission.html">Submit</a></li>
  <!-- Don't work yet -->
  <li><a href="search.html">About</a></li>

</ul>

<div class="header">
	<img src = "parking1.png"/>
	<h1>PARKY</h1>
</div>

<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'khanm57');
define('DB_PASSWORD', 'test');
define('DB_NAME', 'comp4ww3');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php


<p>Fill out the following to create an account:</p>

<div class="wrapper">
	<form class="register" name="registerForm" onsubmit="return validate(this);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<!--Your registration page should include several, at least 4,different HTML form elements, including text boxes and check boxes or radio items, at least one of which is an “HTML5” form element such as “type=email” or “type=search” or “type=date”-->
		<strong>Personal data</strong> <br>
			<input type="text" name="fname" placeholder="First name"  required>
			<input type="text" name="lname" placeholder="Last name" required>
			<input type="email" name="mail" placeholder="E-mail" required value="<?php echo $username; ?>">
			<input type="tel" name="num" placeholder="Phone #" required>
			<input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
</div>            

	<br><br>
	<strong>Vehicle data (optional)</strong>
		<br>
		Number of vehicles to be registered : <input type="number" name="vnum" placeholder="# of vehicles"> 
		Type of vehicle(s) <br>
		<div class="inline-field">
 			 <input type="checkbox" id="checkbox1">
 			 <label for="checkbox1">Car</label>
 			 <input type="checkbox" id="checkbox2">
 			 <label for="checkbox2">Other</label>
		</div>
<!--
<input type="checkbox" name="vehicle1" value="Car"> Car
<br>
<input type="checkbox" name="vehicle2" value="Other"> Other
-->
	<br><br>
	<input type="submit" value="Submit">
</form>

<br>
<p><strong> To submit a parking space, sign in and go to the <a href="submit.html">Submit page</a>.</strong></p>

<?php
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
// Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
