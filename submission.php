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

<!-- php code to add the parking space to the database -->
<?php
//use access file
require_once "access.php";

// Define variables and initialize with empty values
/*$username = $password = $confirm_password = "";
$confirm_password_err = "";
 */
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    
        // Prepare a select statement
        /*$sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{*/
                    $name = trim($_POST["name"]);
                /*}
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }*/
         
        // Close statement
      /*  unset($stmt);
    
    
    // Validate password
     if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{*/
        $descr = trim($_POST["descr"]);
        $fee = trim($_POST["fee"]);
        $longitude=trim($_POST["longitude"]);
        $latitude=trim($_POST["latitude"]);
        $image=trim($_POST["image"]);
    /*}*/
    
   /* // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }*/
    
    // Check input errors before inserting in database
   /* if(empty($confirm_password_err)){*/
        
        // Prepare an insert statement
        $sql = "INSERT INTO parkings (name, descr, fee, longitude, latitude, image) VALUES (:name, :descr, :fee, :longitude, :latitude, :image)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":descr", $param_descr, PDO::PARAM_STR);
            $stmt->bindParam(":fee", $param_fee, PDO::PARAM_STR);
            $stmt->bindParam(":longitude", $param_longitude, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $param_latitude, PDO::PARAM_STR);
            $stmt->bindParam(":image", $param_image, PDO::PARAM_STR);
            
            // Set parameters
            $param_name = $name;
            $param_desc = $desc; 
            $param_desc = $fee; 
            $param_desc = $longitude; 
            $param_desc = $latitude; 
            $param_desc = $image;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: submission.php");
            } else{
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
          'key'    => "key",
          'secret' => "secret",
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
    

<p>Enter the required details below: <br> The name of the spot, a description, the location as a pair of latitude, longitude coordinates. <br> Optionally, you can also add an image of the parking spot </p>

<!-- name of the spot, a description, and its location as a pair  of  latitude-longitude  coordinates.The  form  should  also  allow ownersto upload an image for the parking service -->
<form onsubmit="return validateS(this);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
  <br>
  <input type="text" name="descr" class="descr" placeholder="Description" value="<?php echo $descr; ?>" required>
  <br>
   <input type="text" name="fee" class="fee" placeholder="Rate /hour" value="<?php echo $fee; ?>" required>
  <br>
  <input type="text" name="longitude" placeholder="Longitude (up to 7 decimals)" pattern="[0-9]{3,}\.[0-9]+\" value="<?php echo $longitude; ?>" required>
  <br>
    <input type="text" name="latitude" placeholder="Latitude (up to 7 decimals)" pattern="[0-9]{3,}\.[0-9]+\" value="<?php echo $latitude; ?>" required>
  <br>
  <input type="file" name="image" accept="image/*" value="<?php echo $image; ?>">
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
