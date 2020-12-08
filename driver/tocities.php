<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$DID = $_SESSION['DID'];

$conn = new mysqli($servername, $username, $password, $db);

$start = $_POST[startCity];
$truckID = $_POST[truck];
$sql='INSERT INTO trips_for_approval VALUES(CURDATE(),"'.$start.'","'.$truckID.'","'.$DID.'","'.$username.'")';

echo $sql.'<br>';

if($conn->query($sql)===TRUE) {
	echo 'sucessfully added';
} else {
	echo $conn->error;
}

?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<?php include("nav.php");?>


<?php echo "<h1>Hello, <b>".$username.'</b></h1>';?>

	
	<h3>Your trips awaiting approval:</h3>
	<?php
	$query = "select * from trips_for_approval where driverid='".$_SESSION['DID']."'";
	echo $query;
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
	  }};
	?>
	<h3>Add cities</h3>
	<form method='post' action="">
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
		  <td><input style="centered" type="checkbox" name='.$row['zipcode'].'" alt='.$row['cityname'].'></input></td>
		</tr>';
		   }
		 }
		?>
	  <br>
	  <input type='submit' value='submit'>
	</table>
	</form>

<?php $conn->close();?>

</body>
