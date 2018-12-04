<!--index.html-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script src="validate.js"></script>
<script src="location.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Home</title>
</head>

<body>

<!-- navigation bar, has links to the other elements of the site that make sense -->
<ul class="navigation">
  <li><a href="index.php">Home</a></li>
  <li><a href="search.html">Search</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="submission.php">Submit</a></li>
  <li><a href="acct.php">My Account</a></li>
</ul>

<div class="header">
	<img src = "parking1.png"/>
	<h1>PARKY</h1>
</div>
 
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: acct.php");
    exit;
}
 
// Include config file
require_once "access.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$password_err = $username_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // POST username
    $username = trim($_POST["username"]);
    
    // POST password
    $password = trim($_POST["password"]);
    
    
    // Validate credentials
     if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: acct.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
    <div class="wrapper">
        <h2>Login</h2>
        <p>Log in to access the full features of the site:</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" placeholder="Username (e-mail)" class="form-control" value="<?php echo $username; ?>" required >
               
                <input type="password" name="password" placeholder="Password" class="form-control" required >
	    <div class="form-group">
		<br>
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>If you don't have an account, you can register now! <a href="register.php">Registration page</a>.</p>
        </form>
    </div>

    

</body>
</html>
