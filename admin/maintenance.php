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


<?php echo "<h1>Hello, <b>".$username.'</b></h1>';?>

<h3>All maintenance events:</h3>
<?php
$query = "select meventid, cost, prevevent, m.stationid, sownername from mEvents m join stations s on m.stationid = s.stationid";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Event ID</th>
    <th>Cost</th>
    <th>Previous Event</th>
    <th>Station ID</th>
    <th>Station Owner</th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
	<td>".$row['meventid']."</td>
	<td>".$row['cost']."</td>
	<td>".$row['prevevent']."</td>
	<td>".$row['stationid']."</td>
	<td>".$row['sownername']."</td>
  </tr>";
  }
} else {
echo $conn->error;
echo "<i>Something went wrong</i>"; }
?>
</table>
</body>
