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

<?php include "header.php" ?>
  <?php
    require_once "access.php";
    $id = intval($_GET['id']);
    $sql="SELECT name FROM parkings WHERE id=$id";
    $stmt = $pdo->query($sql);
    $result= $stmt->fetch();
    echo "<h2>{$result['name']}</h2>";
  ?>

</div>

<!-- details of parking area -->
<div class="details">
<h2> Address: </h2>
<?php
     require_once "access.php";
    $id = intval($_GET['id']);
    $sql="SELECT address FROM parkings WHERE id=$id";
    $stmt = $pdo->query($sql);
    $result= $stmt->fetch();
    echo "<p class='desc'>{$result['address']}</p>";
?>
</div>

<!--<div id="parkingMap" style="width:90%;height:450px;"></div>
<br>-->

<button><a href='submiterview.php?id=<?php $_GET['id'] ?>'></a></button>

<?php include 'end.php' ?>

</body>
</html>
