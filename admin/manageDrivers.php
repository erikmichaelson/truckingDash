<?php
session_start();
$server = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($server, $username, $password, $db);


$deletes = $_POST['deletes'];


if($deletes > 0) {
	foreach ($deletes as $d) {
		echo $d;
		
		$sql='DELETE FROM drivers WHERE driverID = "'.$d.'"';

#echo $sql.'<br>';

	if($conn->query($sql) ===TRUE) {
		header("Location: manage.php", TRUE, 301);
	} else {
		echo $conn->error;
	}
}} else {
	header("Location: manage.php", TRUE, 301);
}

exit();
?>
