<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="style.css">

<tile> Database info </title>
<script>
function refreshReview(id) {
	request = new XMLHttpRequest();
	if (request == null) return;
	request.onload = function() {
		if (this.status == 200) { 
			document.getElementById(id).innerHTML = this.response;
		} else { 
			//alert("HTTP error: " + this.response); 
			document.getElementById(id).innerHTML = "Can't load!";
		}
	};
	request.open("POST", "echo.php");
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.send("id=" + id);
	return false;	
}
</script>
<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
td {
	padding:2px;
}
</style>

</HEAD>
<BODY>
<p>Parking locations:</p>
<table>
<tr>
  <td></td>
  <td>Name</td>
  <td>Address</td>
  <td>Parking rate</td>
  <td>Date</td>
  <td>User rating</td>
  <td></td>
  <td></td>
</tr>
<?php
try{
        $dbh = new PDO('mysql:host=localhost;dbname=comp4ww3', 'khanm57', 'test');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->query("SELECT * FROM parkings");        
	$index=1;
        while ($row = $stmt->fetch()) {
		echo "<tr><td>$index</td><td>{$row['name']}</td><td>{$row['address']}</td><td>$ {$row['fee']}</td><td>{$row['date']}</td><td id=\"{$row['id']}\"><a href=\"#\" onclick=\"refreshReview({$row['id']})\">Load!</a></td><td><a href='info.php?id={$row['id']}'>See detail</a></td><td><a href='delete.php?id={$row['id']}'>Delete</a></td></tr>\n"; 
		$index++;
	}
} catch(PDOException $ex) {
        echo "An Error occured!"; //user friendly message
        echo $ex->getMessage();
}
?>
</table>
<a href="get-parking-info.php">Add a new parking spot.</a>
</BODY>
</HTML>
