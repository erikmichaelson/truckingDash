<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($servername, $username, $password, $db);

$tID = $_POST['truckID'];
$newreq = $_POST['newtrk'];
$DID = $_SESSION['DID'];
echo $newreq.' '.$tID.'<br>';
$update = "insert into pendingtruckswitches VALUES('".$tID."','".$newreq."','".$DID."')";
echo $update;
if($conn->query($update)===TRUE) {
	echo 'it worked';
	header('Location: trucks.php', TRUE, 301);
} else {
echo $conn->error; }
?>
