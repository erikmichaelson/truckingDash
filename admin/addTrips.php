<?php
session_start();
$server = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($server, $username, $password, $db);



$approve = $_POST['change'];

if(strcmp($approve, 'Approve')) {

$trip = $_POST['addTrip'];

$added = preg_split("/_/", $trip);


$sql='INSERT INTO trips VALUES("'.$added[0].'","'.$added[1].'","'.$added[2].'","'.$added[3].'")';

$tocities='INSERT INTO tocities VALUES("'.$added[0].'","'.$added[1].'","'.$added[2].'","'.$added[3].'","'.$added[4].'")';

echo $sql.'<br>';

$delete='DELETE FROM trips_for_approval WHERE date="'.$added[0].'"  AND driverid="'.$added[3].'" AND tocity="'.$added[4].'"';
echo $delete.'<br>';

if($conn->query($sql)===true) {
	$em_query = 'select email from drivers where driverid="'.$added[3].'"';
	$email = $conn->query($em_query)->fetch_assoc()['email'];
	$msg = 'Your trip on '.$added[0].' was approved my an admin.';
	$headers='From noreply @ company . com ';
	mail($email,'your trip was approved!',$msg,[$headers],[$parameters]);
	$conn->query($delete);
	echo 'sucessfully added';
	header("Location: approveTrips.php", TRUE, 301);
} else {
	header("Location: approveTrips.php", TRUE, 301);
}
}
else if(strcmp($approve, 'Reject')) {
$trip = $_POST['addTrip'];

$added = preg_split("/_/", $trip);

$delete='DELETE FROM trips_for_approval WHERE date="'.$added[0].'"  AND driverid="'.$added[3].'" AND tocity="'.$added[4].'"';
echo $delete.'<br>';

	$em_query = 'select email from drivers where driverid="'.$added[3].'"';
	$email = $conn->query($em_query)->fetch_assoc()['email'];
	$msg = 'Your trip on '.$added[0].' was approved my an admin.';
	$headers='From noreply @ company . com ';
	mail($email,'your trip was rejected',$msg,[$headers],[$parameters]);
	$conn->query($delete);
	header("Location: approveTrips.php", TRUE, 301);

}

// index.php
exit();
?>
