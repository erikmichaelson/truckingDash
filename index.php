<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "project3";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

?>

<br>
<a href='driver/driverview.php'>driverview</a>
<a href='index1.php'>login page</a>
<br>

<table style="width:40%">
  <tr>
	<th>Zipcode</th>
	<th>Name</th>
	<th>Region</th>
  </tr>
<?php
$query = 'select * from cities';
$result = $conn->query($query);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["zipcode"]. "</td><td>" . $row["cityName"]. "</td><td>" . $row["regionID"]. "</td></tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</table>
