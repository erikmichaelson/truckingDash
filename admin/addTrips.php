<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$db = 'project3';

#$conn = new mysqli($server, $username, $password, $db);

echo $conn;


$trip = $_POST['addTrip'];
echo $trip.'<br>';
$added = preg_split("/_/", $trip);


$sql='INSERT INTO trips VALUES("'.$added[0].'","'.$added[1].'","'.$added[2].'","'.$added[3].'")';

echo $sql.'<br>';

echo $conn;

if($conn->query($sql)===TRUE) {
	echo 'sucessfully added';
} else {
	echo $conn->error;
}

// index.php
header("Location: /approveTrips.php", TRUE, 301);
exit();
?>
