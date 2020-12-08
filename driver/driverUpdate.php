<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$DID = $_SESSION['DID'];

$conn = new mysqli($servername, $username, $password, $db);

if($conn->query($sql)===TRUE) {
	echo 'sucessfully added';
} else {
	echo $conn->error;
}

?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<html>
<body style='margin:30px'>

<?php include("nav.php");?>


<h1>New Trip:</h1>
	
	<h3>Your trips awaiting approval:</h3>
	<?php
	$query = "select * from trips_for_approval where driverid='".$_SESSION['DID']."'";
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
	  	echo '<i>All trips are approved!</i>';
  };
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
</html>
