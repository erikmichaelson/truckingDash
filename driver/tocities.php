<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$DID = $_SESSION['DID'];

$conn = new mysqli($servername, $username, $password, $db);

$start = $_POST['startCity'];
$truckID = $_POST['truck'];
$cities = $_POST['toCity'];

echo var_dump($cities).'<br>';


foreach ($cities as $c) {

	$sql='INSERT INTO trips_for_approval VALUES(CURDATE(),"'.$start.'","'.$truckID.'","'.$DID.'","'.$username.'","'.$c.'")';

	echo $sql.'<br>';

	if($conn->query($sql)===TRUE) {
		echo 'sucessfully added '.$c;
	} else {
		echo $conn->error;
	}
	header('location: newtrip.php', 301, TRUE);
}

?>
