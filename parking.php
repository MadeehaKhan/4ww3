<!--parking.html-->
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
<!-- for icons used in ratings -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src="map.js"></script>
<title>Parking</title>
</head>
<body>

<ul class="navigation">
  <li><a href="index.php">Home</a></li>
  <li><a href="search.html">Search</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="submission.php">Submit</a></li>
  <li><a href="acct.php">My Account</a></li>
</ul>

<div class="header">
	<img src = "parking1.png"/>
	<h1>PARKY </h1>
  <?php
    require_once "access.php";
    $id = intval($_GET['id']);
    $sql="SELECT name FROM parkings WHERE id=$id";
    $stmt = $pdo->query($sql);
    echo "<h2>$stmt['name']</h2";
  ?>

</div>

<!-- details of parking area -->
<div class="details">
<h2> Address: </h2>
<p class="desc"> McMaster University Downtown Centre <br>
Lot N Westaway Rd <br>
Hamilton, ON <br>
L8N 1E9 </p>
</div>

<!--<div id="parkingMap" style="width:90%;height:450px;"></div>
<br>-->


<h2> Reviews: </h2>
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th>Rating</th> 
    <th>Comments</th>
  </tr>
  <tr>
    <td>Fred Die</td>
    <td>
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star_border</i> 
    	<i class="material-icons">star_border</i>
    </td> 
    <td>"I parked the Mystery Machine here. I was scared. Overall, pretty good."</td>
  </tr>
  <tr>
    <td>Shaggy Rogers</td>
    <td>
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i>
    </td> 
    <td>"i dont have a car"</td>
  </tr>
  <tr>
    <td>Scoobert Doobert</td>
    <td>
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star</i> 
    	<i class="material-icons">star_border</i> 
    	<i class="material-icons">star_border</i> 
    	<i class="material-icons">star_border</i>
    </td> 
    <td>"Ris is a rearry bad rarking rot rut it's rose to the rood"</td>
  </tr>
</table>

<footer>
  Posted by: Madeeha Khan<br>
  Contact information: <a href="mailto:khanm57@mcmaster.ca">
  khanm57@mcmaster.ca</a>.
</footer>

</body>
</html>
