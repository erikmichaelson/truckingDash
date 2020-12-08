<?php
	$server = 'localhost';
	$db = 'project3';
   #if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
		$conn = new mysqli($server, $myusername, $mypassword, $db);
		session_start();
		$adquery = 'SHOW GRANTS';
		$result1 = $conn->query($adquery);
		$grants = $result1->fetch_assoc();
		$all = 'ALL PRIVILEGES';
		$perm = ($grants["Grants for ".$myusername."@localhost"]);
		echo $perm.'<br>';
		if (strpos($perm, $all) !== false) {
#			session_register("myusername");
			$_SESSION['login'] = $myusername;
			$_SESSION['pass'] = $mypassword;
			$_SESSION['DID'] = $DID;
			header('Location: admin/dashboard.php',TRUE,301);
			exit;
		} else {
			$sql = 'SELECT driverid FROM driverByUsername WHERE User = "'.$myusername.'"';
			$result = $conn->query($sql);
			echo $sql;
			$DID = $result->fetch_assoc()['driverid'];
			echo $DID;
			if($result->num_rows > 0) {
				echo 'second if';
		#		session_register("myusername");
				$_SESSION['login'] = $myusername;
				$_SESSION['pass'] = $mypassword;
				$_SESSION['DID'] = $DID;
				header('Location: driver/driverview.php',TRUE,301);
				exit;
			} else {
				echo 'else block';
				echo strpos($perm, $all);
		#		header('Location: index.php');
				exit;
			}
		}

