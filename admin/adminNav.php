<?php
	session_start();
?>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.topnav {
  overflow: hidden;
  background-color: #555;
  position: relative;
}

/* Hide the links inside the navigation menu (except for logo/home) */
.topnav #myLinks {
  display: none;
}

/* Style navigation menu links */
.topnav a {
  color: white;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  display: block;
}

/* Style the hamburger menu */
.topnav a.icon {
  background: black;
  display: block;
  position: absolute;
  right: 0;
  top: 0;
}

/* Add a grey background color on mouse-over */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active link (or home/logo) */
.active {
  background-color: #432e9b;
  color: white;
}

.nav {
}
.nav-item {

}
</style>

<!-- Top Navigation Menu -->
<div class="topnav">
  <?php
  echo '
  <a href="dashboard.php" class="active">Hello, <b>'.$_SESSION['login'].'</b></a>';
  ?>
  <!-- Navigation links (hidden by default) -->
  <div id="myLinks">
    <a href="dashboard.php">Home</a>
    <a href="trips.php">All trips</a>
    <a href="approvetrips.php">Approve trips</a>
    <a href="approvetrucks.php">Approve trucks</a>
    <a href="../logout.php">LOGOUT</a>
  </div>
  <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
  <a href="javascript:void(0);" class="icon" onclick="openNav()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<!--
<div class="nav">
	<div class='nav-item'>
		<a href="driverview.php">View</a>
	</div>
	<div class='nav-item'>
		<a href="newtrip.php">New trip</a>
	</div>
	<div class='nav-item'>
		<a href="drivUpdate.php">Update trucks</a>
	</div>
</div>
-->

</html>

<script>
function openNav() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
