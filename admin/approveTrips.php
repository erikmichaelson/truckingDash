<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
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


<h1>Things to approve:</h1>

<h3>Trips awaiting approval:</h3>
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
    <th>Dest City</th>
    <th><input type='submit' name='choice' value='Reject'><input type='submit' name='choice' value='Approve'></th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['date']."</td>
    <td>".$row['fromCity']."</td> 
    <td>".$row['truckID']."</td> 
    <td>".$row['driverID']."</td> 
    <td>".$row['tocity']."</td> 
	<td>
  	  <input type='checkbox' id='addTrip' name='addTrip' value='".$row['date'].'_'.$row['fromCity'].'_'.$row['truckID'].'_'.$row['driverID'].'_'.$row['tocity']."'>
	</td>
  </tr>";
  }
} else {
echo "<i>No trips awaiting approval</i>"; }
?>
</form>
</table>



<h3>Trucks changes awaiting approval:</h3>
<form method='post' action='chgTrucks.php'>
<?php
$query = "select * from pendingtruckswitches";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>From Truck</th>
    <th>To Truck</th>
    <th>DriverID</th>
    <th>Approve</th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
	echo $row;
 	echo "
  <tr>
	<td>".$row['truckID']."</td>
	<td>".$row['newTruck']."</td>
	<td>".$row['DriverID']."</td>
	<td>
<input type='submit' name='choice' value='Reject'><input type='submit' name='choice' value='Approve'>
  	  <input type='hidden' name='change' value='".$row['newTruck']."'>
  	  <input type='hidden' name='DriverID' value='".$row['DriverID']."'>
	</td>
  </tr>";
  }
} else {
echo "<i>No truck changes awaiting approval</i>"; }
?>
</form>
</table>


</body>
