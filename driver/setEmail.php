<body>
<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$db = 'project3';


$conn = new mysqli($servername, $username, $password, $db);

$email = $_POST[email];
$DID = 'DID1';
$sql='UPDATE drivers SET email = "'.$email.'" WHERE driverID = "'.$DID.'"';

echo $sql.'<br>';

if($conn->query($sql)===TRUE) {
	echo 'email sucessfully updated';
} else {
	echo $conn->error;
}

?>

<?php $conn->close();?>

</body>
