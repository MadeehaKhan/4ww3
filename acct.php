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
//start the session
session_start();

if ( isset( $_SESSION['id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("location: index.php");
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
