<?php
	$server = 'localhost';
	$db = 'project3';
   #if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
		$conn = new mysqli($server, $myusername, $mypassword, $db);
		session_start();
		$sql = 'SELECT driverid FROM driverByUsername WHERE User = "'.$myusername.'"';
		$result = $conn->query($sql);
		$DID = $result->fetch_assoc()['driverid'];
		if($result->num_rows > 0) {
#			session_register("myusername");
			$_SESSION['login'] = $myusername;
			$_SESSION['pass'] = $mypassword;
			$_SESSION['DID'] = $DID;
			echo 'transfering';
			header('Location: driver/driverview.php',TRUE,301);
			exit;
		} else {
			header('Location: login.php');
			exit;
		}
#	 }

