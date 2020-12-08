<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($servername, $username, $password, $db);

$DID = $_SESSION['DID'];
?>
<?php include("nav.php");?>


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

<div style='display: grid; grid-auto-columns: 47vw;'>
	<div style='grid-column: 1;'>

<h1>Your trip overview:</h1>
<h3>Your trips awaiting approval:</h3>
<?php
$query = "select * from trips_for_approval where driverid='".$DID."';";
echo $query;
$result = $conn->query($query);
if( $conn->error ) {
	echo $conn->error;
} else if ($result->num_rows > 0) {
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
	echo '<i>All your trips are approved!</i>'; }
?>
</div>
<div style='grid-column: 2;'>
<h2>New trip</h2>
	<form method='post' action="tocities.php">
	  <label for="startCity">Start City</label>
	  <select type="text" id="startCity" name="startCity">
	  <?php
		  $query="select zipcode from cities";
		  $result = $conn->query($query);
		  if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
			  echo '<option value="'.$row['zipcode'].'">'.$row['zipcode'].'</option>';
		   }
		 }
		?>
	  </select><br>
	  <label for="truck">Truck used</label>
	  <select type="text" id="truck" name="truck">
	  <?php
		  $query="select truckID from trucks";
		  $result = $conn->query($query);
		  if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
			  echo '<option value="'.$row['truckID'].'">'.$row['truckID'].'</option>';
		   }
		 }
		?>
	  </select><br>
	<h4>To cities</h4>
	<table>
		<tr>
			<th>City</th>
			<th>Zip</th>
			<th>Visited?</th>
		</tr>
		<?php
		  $query="select zipcode , cityname from cities";
		  $result = $conn->query($query);
		  if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
			  echo '
		<tr>
	  	<label for="'.$row['zipcode'].'"><td>'.$row['cityname'].'</td><td>'.$row['zipcode'].'</td></label>
		  <td><input type="checkbox" name="toCity[]" value='.$row['zipcode'].'></input></td>
		</tr>';
		   }
		 }
		?>
	  <br>
	</table>
	  <input type='submit' value='submit' style='margin:10px'>
	</form>
	</div>

</div>

<?php $conn->close();?>

</body>
