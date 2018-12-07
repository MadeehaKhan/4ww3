<!--index.html-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script src="validate.js"></script>
<script src="location.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>My Account</title>
</head>

<body>

<!-- navigation bar, has links to the other elements of the site that make sense -->
<?php include "header.php" ?>

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

<h2 style="color:"> You are signed in! </h2>
<p> Now you can submit your own parking spaces at <a href="/submission.php">our submit page!</a></p>


<button class = "button" onclick="window.location.href='logout.php'">Log Out of Your Account</button>

<?php include "end.php" ?>
  
</body>
</html>
