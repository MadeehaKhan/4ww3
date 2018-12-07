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
<?php include "header.php" ?>

<!-- php code to add the parking space to the database -->
<?php

//use access file
require_once "access.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  //prepare variables
  $name = trim($_POST["name"]);
  $descr = trim($_POST["descr"]);
  $fee = trim($_POST["fee"]);
  $longitude=trim($_POST["longitude"]);
  $latitude=trim($_POST["latitude"]);
  $image=trim($_POST["image"]);
  $address=trim($_POST["address"]);

        
  // Prepare an insert statement
  $sql = "INSERT INTO parkings (name, descr, fee, longitude, latitude, image, address) VALUES (:name, :descr, :fee, :longitude, :latitude, :image, :address)";
         
  if($stmt = $pdo->prepare($sql)){
       // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
      $stmt->bindParam(":descr", $param_descr, PDO::PARAM_STR);
      $stmt->bindParam(":fee", $param_fee, PDO::PARAM_STR);
      $stmt->bindParam(":longitude", $param_longitude, PDO::PARAM_STR);
      $stmt->bindParam(":latitude", $param_latitude, PDO::PARAM_STR);
      $stmt->bindParam(":image", $param_image, PDO::PARAM_STR);
      $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            
      // Set parameters
      $param_name = $name;
      $param_descr = $descr; 
      $param_fee = $fee; 
      $param_longitude = $longitude; 
      $param_latitude = $latitude; 
      $param_image = $image;
      $param_address = $address;
            
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

<!-- php code to send images to the S3 bucket khanm57bucket -->
<?php

  if(isset($_FILES['image'])){
    $file_name = $_FILES['image']['name'];   
    $temp_file_location = $_FILES['image']['tmp_name']; 

    require 'vendor/autoload.php';

    $s3 = new Aws\S3\S3Client([
      'region'  => 'ca-central-1',
      'version' => 'latest',
      'credentials' => [
          'key'    => "",
          'secret' => "",
  ]
    ]);   

    $result = $s3->putObject([
      'Bucket' => 'khanm57bucket',
      'Key'    => $file_name,
      'SourceFile' => $temp_file_location     
    ]);

    var_dump($result);
  }

?>
    

<p>Enter the required details below: <br> The name and address of the spot, a description, the hourly rate you want to charge, and the location as a pair of latitude, longitude coordinates. <br> Optionally, you can also add an image of the parking spot </p>

<!-- name of the spot, a description, and its location as a pair  of  latitude-longitude  coordinates.The  form  should  also  allow owners to upload an image for the parking service -->
<form onsubmit="return validateS(this);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
  <br>
  <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required>
  <br>
  <input type="text" name="descr" class="descr" placeholder="Description" value="<?php echo $descr; ?>" required>
  <br>
  <!-- added fee that the owner would want to charge -->
   <input type="text" name="fee" class="fee" placeholder="Rate /hour" value="<?php echo $fee; ?>" required>
  <br>
  <input type="text" name="latitude" placeholder="Latitude (up to 7 decimals)" pattern="[0-9]{3,}\.[0-9]+\" value="<?php echo $latitude; ?>" required>
  
  <br>
  <input type="text" name="longitude" placeholder="Longitude (up to 7 decimals)" pattern="[0-9]{3,}\.[0-9]+\" value="<?php echo $longitude; ?>" required> 
  <br>
  <input type="file" name="image" accept="image/*" value="<?php echo $image; ?>">
  <br>
  <input type="submit" value="Submit">
</form>

<?php include "end.php" ?>
</body>
</html>
