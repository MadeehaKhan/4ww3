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
<body onload="show()" >

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

//use access file
require_once "access.php";
  try {
 
        //prepare variables
       $name = trim($_GET["name"]);
       $dist = $_GET["dist"];
       $price = trim($_GET["price"]);
       $longit = $_GET["longit"];
       $latit = $_GET["latit"];
       $stars = $_GET["Rating"];

       //prepare select statement
       //need to match the foreign key from parkings to reviews to get the average star review for that space
          //and need the value of the ratings to compare to user wants
       //also need the longitude and latitude to compare to the current user coordinates and find distance from that to compare to user given distance
       //need fee and name to compare to what user wants
      $sql = "SELECT p. address, p.longitude, p.latitude, p.id, p.fee, p.name r.value, r.p_id FROM parkings p, reviews r 
        WHERE 
        p.id == r.p_id 
        AND p.name == :name 
        AND p.fee <= :price
        AND AVG(r.value) >= :stars  
        #need a way to find the distance between two longitude, latitude coordinates to compare it to the max distance the user wants
        AND (111.111 *
         DEGREES(ACOS(LEAST(COS(RADIANS(p.latitude))
         * COS(RADIANS(:latit))
         * COS(RADIANS(p.longitude - :longit ))
         + SIN(RADIANS(p.latitude ))
         * SIN(RADIANS(:latit)), 1.0))) ) <= :dist"
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":stars", $param_value, PDO::PARAM_INT);
            $stmt->bindParam(":price", $param_price, PDO::PARAM_STR);
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":latit", $param_latit, PDO::PARAM_STR);
            $stmt->bindParam(":longit", $param_longit, PDO::PARAM_STR);
            $stmt->bindParam(":dist", $param_dist, PDO::PARAM_STR);
            
            // Set parameters
            $param_name = $name;
            $param_price = $price;
            $param_value = $stars;
            $param_latit = $latit;
            $param_longit = $longit;
            $param_dist = $dist;
            
            $index=1;
            while ($row = $stmt->fetch()) {
            echo "<tr>
                  <td><a href='info.php?id={$row['id']}'>{$row['p.name']}</a></td>
                  <td>{$row['p.address']}</td>
                  <td>{$row['p.fee']}$</td>
                  </tr>\n"; 
    $index++;
  }
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
<!-- live map to show above results -->
<div id="resultsMap" style="width:90%;height:450px;"></div>
    

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
