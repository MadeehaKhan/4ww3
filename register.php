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
  <li><a href="index.php">Home</a></li>
  <li><a href="search.html">Search</a></li>
  <li><a href="register.html">Register</a></li>
  <li><a href="submission.php">Submit</a></li>
  <li><a href="acct.php">My Account</a></li>
</ul>

<div class="header">
	<img src = "parking1.png"/>
	<h1>PARKY</h1>
</div>



<?php
//use access file
require_once "access.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    
    
    // Validate password
     if(strlen(trim($_POST["password"])) < 6){
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
    }
    
    // Check input errors before inserting in database
    if(empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 


<p>Fill out the following to create an account:</p>

<div class="wrapper">
	<form class="register" name="registerForm" onsubmit="return validate(this);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" >
		<strong>Personal data</strong> <br>
			<input type="text" name="fname" placeholder="First name"  required>
			<input type="text" name="lname" placeholder="Last name" required>
			<input type="email" name="username" placeholder="E-mail" value="<?php echo $username; ?>" required> 
			<input type="tel" name="num" placeholder="Phone #" required>
			<input type="password" name="password" placeholder="Password"  class="form-control" value="<?php echo $password; ?>" required>
            		<input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>" required>
            

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
</div>
</form>

<br>
<p><strong> To submit a parking space, sign in and go to the <a href="submit.html">Submit page</a>.</strong></p>



<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
