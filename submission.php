<!--submission.html-->
<!DOCTYPE html>
<html>
<head>
<script src="validate.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Submission</title>
</head>
<body>

<?php
// Want to make sure that ONLY logged-in users can access this page

//start the session
session_start();

if ( isset( $_SESSION['id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.php");
}
?>


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

<p>Enter the required details below: <br> The name of the spot, a description, the location as a pair of latitude, longitude coordinates. <br> Optionally, you can also add an image of the parking spot </p>

<!-- name of the spot, a description, and its location as a pair  of  latitude-longitude  coordinates.The  form  should  also  allow ownersto upload an image for the parking service -->
<form onsubmit="return validateS(this);" method="post">
  <input type="text" name="name" placeholder="Name" required>
  <br>
  <input type="text" name="desc" class="desc" placeholder="Description" required>
  <br>
  <input type="text" name="place" placeholder="Latitude, Longitude" pattern="[0-9]{3,}\.[0-9]+\,[0-9]{3,}\.[0-9]+" required>
  <br>
  <input type="file" name="pic" accept="image/*">
  <br>
  <input type="submit" value="Submit">
</form>

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>