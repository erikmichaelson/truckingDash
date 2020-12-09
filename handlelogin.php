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
		if ( $result1->num_rows == 0 ) {
			header('Location: index.php', TRUE, 301);
		}
		$grants = $result1->fetch_assoc();
		$all = 'ALL PRIVILEGES';
		$perm = ($grants["Grants for ".$myusername."@localhost"]);
#		echo $perm.'<br>';
		if (strpos($perm, $all) !== false) {
			$_SESSION['login'] = $myusername;
			$_SESSION['pass'] = $mypassword;
			header('Location: admin/dashboard.php',TRUE,301);
			exit;
		} else {
			$sql = 'SELECT driverid FROM driverByUsername WHERE User = "'.$myusername.'"';
			$result = $conn->query($sql);
			echo $sql;
			if($result->num_rows > 0) {
				$DID = $result->fetch_assoc()['driverid'];
				echo 'second if';
		#		session_register("myusername");
				$_SESSION['login'] = $myusername;
				$_SESSION['pass'] = $mypassword;
				$_SESSION['DID'] = $DID;
				header('Location: driver/driverview.php',TRUE,301);
				exit;
			} else {
				echo 'HERE';
				header('Location: index.php', TRUE, 301);
				exit;
			}
		}

