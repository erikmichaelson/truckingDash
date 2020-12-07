<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<?php include("nav.php");?>

<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$db = 'project3';


$conn = new mysqli($servernme, $username, $password, $db);

$start = $_POST[startCity];
$truckID = $_POST[truck];
$sql='INSERT INTO trips VALUES(CURDATE(),"'.$start.'","'.$truckID.'","DID1")';

echo $sql.'<br>';

if($conn->query($sql)===TRUE) {
	echo 'sucessfully added';
} else {
	echo $conn->error;
}

?>

<?php echo "<h1>Hello, <b>".$username.'</b></h1>';?>
<div>
	<h3>Add cities</h3>
</div>

<?php $conn->close();?>

</body>
