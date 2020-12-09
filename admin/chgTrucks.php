<?php
session_start();
$server = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($server, $username, $password, $db);

$approve = $_POST['choice'];

if(strcmp($approve, 'Approve')) {

$truck = $_POST['change'];
$DID = $_POST['DriverID'];


$sql='UPDATE drivers SET truckID = "'.$truck.'" WHERE driverID= "'.$DID.'"';

echo $sql.'<br>';

$delete="delete from pendingtruckswitches where DriverID ='".$DID."'";

if($conn->query($sql)===TRUE) {
	$conn->query($delete);
	header("Location: approveTrips.php", TRUE, 301);
} else {
	echo $conn->error;
}
} else if(strcmp($approve, 'Reject')) {
$trip = $_POST['addTrip'];

$added = preg_split("/_/", $trip);

$delete="delete from pendingtruckswitches where DriverID ='".$DID."'";
echo $delete.'<br>';

	$conn->query($delete);
	header("Location: approveTrips.php", TRUE, 301);

}

exit();
?>
