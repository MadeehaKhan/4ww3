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


<h2> Reviews: </h2>
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th>Rating</th> 
    <th>Comments</th>
  </tr>
<?php
    require_once "access.php";
    $id = intval($_GET['id']);
    $sql="SELECT name, value,review FROM reviews WHERE p_id=$id";
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['value']}</td>
        <td> {$row['review']}</td>
        </tr>\n"; 
    }
?>
</table>
<br>

<p>Submit your own review below!</p>

<?php

if (isset($_SESSION['id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.php");
}
?>


<?php
//use access file
require_once "access.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //prepare the variables
    $name = trim($_POST["name"]);
    $review = trim($_POST["review"]);
    $value = $_POST["Rating"];
    $id=$_GET['id'];

    //prepare sql statement
  if (!($review="")) {
    $sql = "INSERT INTO reviews (p_id, value, review, name) VALUES ($id, :value, :review, :name)";
  }
  else {
    $sql = "INSERT INTO reviews (p_id, value, review, name) VALUES ($id, :value,  :name)";
  }

    if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":review", $param_review, PDO::PARAM_STR);
            $stmt->bindParam(":value", $param_value, PDO::PARAM_INT);

            // Set parameters
            $param_name = $name;
            $param_review = $review;
            $param_value = $value;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect back to submission
                header("location: parking.php?id=$id");
            } 
            else {
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
    <input type="text" class="desc" name="review" value="<?php echo $review; ?>" placeholder="Review">
    <br>
    <select name="Rating" required>
      <option value=1>1 star</option>
      <option value=2>2 stars</option>
      <option value=3>3 stars</option>
      <option value=4>4 stars</option>
      <option value=5>5 stars</option> 
    </select>
     <br>
  <input type="submit"  value="Submit">
  </form>

<?php include "end.php" ?>

</body>
</html>
