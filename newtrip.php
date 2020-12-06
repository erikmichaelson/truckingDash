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
<div>
	<h3>New trip</h3>
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
	  <input type='submit' value='submit'>
	</form>

</div>

<?php $conn->close();?>

</body>
