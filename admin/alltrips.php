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


<h1>All trips, ever:</h1>

<?php
$query = "select c.date, c.fromCity, t.driverID, c.tocity , t.truckid from tocities c left join trips t on t.date = c.date AND c.fromCity=t.fromCity";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Date</th>
    <th>From City</th> 
    <th>Truck</th>
    <th>To City</th> 
    <th>DriverID</th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
  echo "
  <tr>
    <td>".$row['date']."</td>
    <td>".$row['fromCity']."</td> 
    <td>".$row['truckid']."</td> 
    <td>".$row['tocity']."</td> 
    <td>".$row['driverID']."</td> 
  </tr>";
  }
} else {
echo "<i>Something went wrong</i>"; }
?>
</table>

</body>
