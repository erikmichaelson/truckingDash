<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

	if ($_SESSION['DID']) { 
		header('Location: ../index.php', TRUE, 301);
	}

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


<h1>Manage Entities:</h1>

<h3>Drivers:</h3>
<form method='post' action='manageDrivers.php'>
<?php
$query = "select * from drivers";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Driverid </th>
    <th>Name</th>
    <th>licNum</th>
    <th>email</th>
    <th><input type='submit' value='Remove Selected'></th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['driverid']."</td>
    <td>".$row['dfname']." ".$row['dlname']."</td>
    <td>".$row['licNum']."</td>
    <td>".$row['email']."</td>
    <td><input type='checkbox' name='deletes[]' value='".$row['driverid']."'></td>
	</td>
  </tr>";
  }
} else {
echo "<i>Something went wrong</i>"; }
?>
</form>
</table>


<h3>Trucks:</h3>
<form method='post' action='manageTrucks.php'>
<?php
$query = "select * from trucks";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Truck ID</th>
    <th>Model</th>
    <th>Added to fleet</th>
    <th>Owner ID</th>
    <th><input type='submit' value='Remove Selected'></th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['truckID']."</td>
    <td>".$row['model']." ".$row['dlname']."</td>
    <td>".$row['startTripDate']."</td>
    <td>".$row['ownerID']."</td>
    <td><input type='checkbox' name='deletes[]' value='".$row['truckID']."'></td>
	</td>
  </tr>";
  }
} else {
echo "<i>Something went wrong</i>"; }
?>
</form>
</table>


<h3>Stations:</h3>
<form method='post' action='manageStations.php'>
<?php
$query = "select * from stations";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Station NO </th>
    <th>Owner's Name</th>
    <th><input type='submit' value='Remove Selected'></th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['stationID']."</td>
    <td>".$row['sOwnerName']."</td>
    <td><input type='checkbox' name='deletes[]' value='".$row['stationID']."'></td>
	</td>
  </tr>";
  }
} else {
echo "<i>Something went wrong</i>"; }
?>
</form>
</table>
</body>
