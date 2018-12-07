<!--results.html-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin=""></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="map.js"></script>
<title>Results</title>
</head>
<body  >

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



<p> Click on the name of the parking lot to see more details </p>


<!--table with results of parking-->
<table style="width:100%">
  <tr>
  <!-- headers of columns -->
    <th>Name of parking</th>
    <th>Address</th>
    <th>Rate</th>
  </tr>
  <!-- filled in with the results from the SQL query -->
  <!-- php code to get spaces from the database -->
<?php

  try {
    //use access file
    require_once "access.php";
 
        //prepare variables
       $name = $_GET["name"];
       $dist = $_GET["dist"];
       $price = $_GET["price"];
       $longit = $_GET["longitude"];
       $latit = $_GET["latitude"];
       $stars = $_GET["Rating"];


       //need to match the foreign key from parkings to reviews to get the average star review for that space
          //and need the value of the ratings to compare to user wants
       //also need the longitude and latitude to compare to the current user coordinates and find distance from that to compare to user given distance
       //need fee and name to compare to what user wants
       $sql = "SELECT * 
	       FROM parkings
	       WHERE parkings.name = '$name' 
		     AND parkings.fee <= $price
		     AND (111.111 * DEGREES(ACOS(LEAST(COS(RADIANS(parkings.latitude))* COS(RADIANS($latit))* COS(RADIANS(parkings.longitude - $longit ))+ SIN(RADIANS(parkings.latitude ))* SIN(RADIANS($latit)), 1.0))) ) >= $dist";
          
	      // HAVING AVG(reviews.value) = :stars" ;
        

      $stmt = $pdo->query($sql);
	    while ($row = $stmt->fetch()) {
            echo "<tr>
                  <td><a href='info.php?id={$row['id']}'>{$row['name']}</a></td>
                  <td>{$row['address']}</td>
                  <td>{$row['fee']}$</td>
                  </tr>\n"; 
  }
	
  
  // Close statement
  unset($stmt);
  // Close connection
  unset($pdo);
  } 

  catch(PDOException $ex) {
        echo "An Error occured!"; //user friendly message
        echo $ex->getMessage();
  }

?>
</table>

<br>
<!-- live map to show above results 
<div id="resultsMap" style="width:90%;height:450px;"></div> -->
    

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
