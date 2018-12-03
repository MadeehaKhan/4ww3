<!--submitreview.php-->
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

if (isset($_SESSION['id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.php");
}
?>


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
//use access file
require_once "access.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//ask the user to enter a name for their review
	//want to create a table with their username, number of stars, and their review verbatim
	$name = trim($_POST["name"]);
	$descr = trim($_POST["descr"]);
	$pid = 1;
        $value = 1;	

  	// Prepare an insert statement
  	$sql = "INSERT INTO reviews (name, review, pid, value) VALUES (:name, :descr, :pid, :value)";
         
 	if($stmt = $pdo->prepare($sql)){
       	// Bind variables to the prepared statement as parameters
       	$stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
       	$stmt->bindParam(":descr", $param_descr, PDO::PARAM_STR);
       	$stmt->bindParam(":pid", $param_pid, PDO::PARAM_INT);
       	$stmt->bindParam(":value", $param_value, PDO::PARAM_INT);


      	// Set parameters
      	$param_name = $name;
      	$param_descr = $descr;
      	$param_pid = $pid;
      	$param_value = $value;

 	// Attempt to execute the prepared statement
      	if($stmt->execute()){
          // Redirect back to submission
          header("location: submission.php");
      	} 
      	else{
          echo "Something went wrong. Please try again later.";
      	}
  }
         
  // Close statement
  unset($stmt);
  // Close connection
  unset($pdo);
}
?>

<main>
<!-- only required to leave their name and a star rating, not a text review -->
  <p> Below, you can submit a review of the parking space </p>

  <form class="subreview"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
  	<input type="text" name="name" placeholder="Your name" value="<?php echo $name; ?>" required>
    <input type="text" class="desc" name="descr" value="<?php echo $descr; ?>" placeholder="Review">
    <br>
    <select name="Rating" required>
      <option value="1">1 star</option>
      <option value="2">2 stars</option>
      <option value="3">3 stars</option>
      <option value="4">4 stars</option>
      <option value="5">5 stars</option> 
    </select>
     <br>
  <input type="submit"  value="Submit">
  </form>
