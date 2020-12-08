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

<?php include("nav.php");?>

<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$db = 'project3';


$conn = new mysqli($servernme, $username, $password, $db);
?>

<?php echo "<h1>Hello, <b>".$username.'</b></h1>';?>

<h3>Your trips awaiting approval:</h3>
<?php
$query = "select * from trips_for_approval where driver='DID1'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Date</th>
    <th>From City</th> 
    <th>Dest Cities</th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['date']."</td>
    <td>".$row['fromCity']."</td> 
    <td>".$row['driverID']."</td> 
  </tr>";
  }
} else {
echo "<i>No trips awaiting approval</i>"; }
?>
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

<h3>Your current email:</h3>
<?php
$query = "select email from drivers WHERE driverID = 'DID3'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['email']."</td>
  </tr>";
  }
}
?>
<form method='post' action='setEmail.php'>
	<label for='email' value='enter email'>change email:</label>
	<input type='text' id='email' name='email'>
	<input type='submit' value="submit">
</form>

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
