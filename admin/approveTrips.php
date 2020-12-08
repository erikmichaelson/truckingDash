<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$db = 'project3';


$conn = new mysqli($servername, $username, $password, $db);
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<style>
table, th, td {
  padding: 15px;
  border: 1px solid black;
	}

 body{
 	margin:30px;
}
</style>
<body>

<?php include("adminNav.php");?>


<?php echo "<h1>Hello, <b>".$username.'</b></h1>';?>

<h3>All trips awaiting approval:</h3>
<form method='post' action='addTrips.php'>
<?php
$query = "select * from trips_for_approval";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Date</th>
    <th>From City</th> 
    <th>Truck</th>
    <th>DriverID</th>
    <th><input type='submit' value='Approve'></th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
	$newtrip = [
		$row['date'],
		$row['fromCity'],
		$row['driverID']];
	echo var_dump($newtrip[2]);
 	echo "
  <tr>
    <td>".$row['date']."</td>
    <td>".$row['fromCity']."</td> 
    <td>".$row['truckID']."</td> 
    <td>".$row['driverID']."</td> 
	<td>
  	  <input type='checkbox' id='addTrip' name='addTrip' value='".$row['date'].'_'.$row['fromCity'].'_'.$row['truckID'].'_'.$row['driverID']."'>
	</td>
  </tr>";
  }
} else {
echo "<i>No trips awaiting approval</i>"; }
?>
</form>
</table>
<h3>Your recent trips:</h3>
<table style="width:80%">
  <tr>
    <th>Date</th>
    <th>From City</th> 
    <th>Dest Cities</th>
  </tr>
<?php
$query = "select * from trips";
$result = $conn->query($query);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['date']."</td>
    <td>".$row['fromCity']."</td> 
    <td>".$row['driverID']."</td> 
  </tr>";
  }
}
?>
</table>

<h3>Your trucks:</h3>
<table style="width:20%">
  <tr>
    <th>TruckID</th>
  </tr>
<?php
$query = "select truckID from drivers WHERE driverID = 'DID3'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['truckID']."</td>
  </tr>";
  }
}
?>
</table>
</body>
