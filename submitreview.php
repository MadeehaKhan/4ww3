<!--submission.html-->
<!DOCTYPE html>
<html>
<head>
<script src="validate.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Submit a Review</title>
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

<?php
//use access file
require_once "access.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  

?>

<main>
  <p> Below, you can submit a review of the parking space __ </p>

  <form class="subreview" method="POST" >
    <input type="text" name="desc" placeholder="Review">
    <br>
    <select name="Rating">
      <option value="1">1 star</option>
      <option value="2">2 stars</option>
      <option value="3">3 stars</option>
      <option value="4">4 stars</option>
      <option value="5">5 stars</option> 
    </select>
     <br>
  <input type="submit"  value="Submit">
  </form>
