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
	<form>
	  <label for="fname">Start City</label><br>
	  <input type="text" id="fname" name="fname"><br>
	  <label for="lname">End cities</label><br>
	  <input type="text" id="lname" name="lname">
	</form>
</div>
</body>
