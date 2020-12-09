<?php 
	session_start();
	$server = 'localhost';
	$user = $_SESSION['login'];
	$pass = $_SESSION['pass'];
	$db = 'project3';

	$conn = new mysqli($server, $user, $pass, $db);


?>
<!DOCTYPE html>
<html>
<title>Admin Dash</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><a href='../logout.php'>Logout</a></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <?php
	  echo '<span>Welcome, <strong>'.$user.'</strong></span>';?>
	  <br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-bullseye fa-fw"></i>  Overview</a>
    <a href="alltrips.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Trips</a>
    <a href="approveTrips.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Approve Trucks/ Trips</a>
    <a href="maintenance.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Maintenance</a>
    <a href="manage.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Manage Users</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-pencil w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
		  <?php
			$sql='select count(date) from trips_for_approval';
			$trucks='select count(driverid) from pendingtruckswitches';
			$result= $conn->query($sql);
			$trips = $result->fetch_assoc()['count(date)'];
			$result1= $conn->query($trucks);
			$trucks = $result->fetch_assoc()['count(date)'];
			$r = $trips+$trucks;
			echo $r;
		  ?></h3>
        </div>
        <div class="w3-clear"></div>
		<a href='approveTrips.php'>
		<span>
        <h4>Approvals Needed</h4>
		<i class="fa fa-arrow-right"></i></a>
		</span>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-map w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
		  <?php
			$sql='select count(date) from trips';
			$result= $conn->query($sql);
			echo $result->fetch_assoc()['count(date)'];
		  ?>
		  </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Trips</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
		  <?php
			$sql='select count(truckID) from trucks';
			$result= $conn->query($sql);
			echo $result->fetch_assoc()['count(truckID)'];
		  ?>
		  </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Trucks</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
		  <?php
			$sql='select count(driverID) from drivers';
			$result= $conn->query($sql);
			echo $result->fetch_assoc()['count(driverID)'];
		  ?>
		  </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Drivers</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Regions</h5>
        <img src="map.png" style="width:100%" alt="Google Regional Map">
      </div>
      <div class="w3-twothird">
        <h5>Total table accesses</h5>
        <table class="w3-table w3-striped w3-white">
		  <?php
			$sql = 'select table_name, rows_fetched from sys.schema_table_statistics limit 10';
			$result= $conn->query($sql);
			  if($result->num_rows > 0) {
				while($row=$result->fetch_assoc()) {
				 echo '
			  <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>'.$row['table_name'].'</td>
            <td><i>'.$row['rows_fetched'].'</i></td>
			  </tr>';
				} }
		  ?>
        </table>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <h5>Trips by origin</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
	  <?php
	  $query='select c.cityName, c.zipcode, count(t.date) as tot_trips FROM toCities t left join cities c on c.zipcode = t.fromCity GROUP BY fromCity ORDER BY tot_trips DESC';
	  $result=$conn->query($query);
	  if($result->num_rows > 0) {
	  	while($row=$result->fetch_assoc()) {
		 echo '
      <tr>
        <td>'.$row['cityName'].'</td>
        <td>'.$row['tot_trips'].'</td>
      </tr>';
	    } }
	  ?>
    </table><br>
    <button class="w3-button w3-dark-grey"><a href='trips.php'>More Analytics</a><i class="fa fa-arrow-right"></i></button>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Recent Drivers</h5>
    <ul class="w3-ul w3-card-4 w3-white">
	  <?php
	  $query='select d.dfname FROM drivers d left join trips t on t.driverid= d.driverid ORDER BY t.date LIMIT 6';
	  $result=$conn->query($query);
	  if($result->num_rows > 0) {
	  	while($row=$result->fetch_assoc()) {
		 echo '
      <li class="w3-padding-16">
        <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">'.$row['dfname'].'</span><br>
      </li> ';
	    } }
	  ?>
    </ul>
  </div>
  <hr>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>


