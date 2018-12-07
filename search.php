<!--search.html-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script src="validate.js"></script>
<script type="text/javascript" src="geolocation.js"></script>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Search</title>
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
	<img src = "parking1.png">
	<h1>PARKY</h1>
</div>



<p>You can enter the name of a sparking spot, a distance, a price, and a rating to search for a parking space:</p>

<!--form to search for parking spaces-->
<!-- send this info to results.php to process and dynamically generate that page -->
<form onsubmit="return validateSearch(this);" action="results.php" method="get">

<!-- button to get geolocation of user -->
<button class="button" id="locateMe" onclick="getLocation()">Where Am I?</button>
<input type="text" name="longitude" id="geoLongitude" value="<?php echo $longit; ?>" placeholder="Longitude">
<input type="text" name="latitude" id="geoLatitude" value="<?php echo $latit; ?>" placeholder="Latitude">
<br>

<hr>
  <input type="text" name="name" class="search" value="<?php echo $name; ?>" placeholder ="Name of parking spot" required>
  <br>
  <input type="number" step=0.1 name="dist" class="search" value="<?php echo $dist; ?>"  placeholder ="Distance (km)" required>
  <br>
  <input type="text" name="price" class="search" value="<?php echo $price; ?>"  placeholder="Price ($/hr)" required>
 <br>
  <select name="Rating" value=5>
  	<option value=1>1 star</option>
  	<option value=2>2 stars</option>
  	<option value=3>3 stars</option>
  	<option value=4>4 stars</option>
  	<option value=5>5 stars</option>
  </select>
 <br>
  <input type="submit"  value="Submit">
</form>

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
