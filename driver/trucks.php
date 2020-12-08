<?php
session_start();
$servername = 'localhost';
$username = $_SESSION['login'];
$password = $_SESSION['pass'];
$db = 'project3';

$conn = new mysqli($servername, $username, $password, $db);

$tID = $_POST['truckID'];
$DID = $_SESSION['DID'];

$sql = "SELECT * FROM pendingtruckswitches WHERE DriverID = '".$DID."'";
$result = $conn->query($sql);
if($result->num_rows > 0){
	$requested = $result->fetch_assoc()['newTruck'];
} else if($conn->error) { echo $conn->error ; }
?>
<?php include("nav.php");?>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<style>
table, th, td {
  padding: 15px;
  border: 1px solid black;
	}

 body{
 	margin:30px;
}
</style>
<body>

<?php echo "<h1>Hello, <b>".$_SESSION['login'].'</b></h1><br>

<h3>Info for truck '.$tID."</h3>";

$query = "select * from trucks where truckID='".$tID."'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo "
<table style='width:80%'>
  <tr>
    <th>Model</th>
    <th>Start Date</th> 
    <th>Owner</th>
  </tr>	";
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['model']."</td>
    <td>".$row['startTripDate']."</td> 
    <td>".$row['ownerID']."</td> 
  </tr>";
  }
} else {
echo "<i>No truck selected</i>"; }
?>
</table>
<h3>All service visits:</h3>
<?php
$query = "select e.meventid, e.cost, e.prevevent, e.stationid, s.sownername from mevents e inner join stations s on e.stationid = s.stationid where e.truckid ='".$tID."'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo '
<table style="width:80%">
  <tr>
    <th>MaintID</th>
    <th>Cost</th> 
    <th>Previous Event</th>
    <th>Station ID</th>
    <th>Contact</th>
  </tr>';
 while($row = $result->fetch_assoc()) {
 	echo "
  <tr>
    <td>".$row['meventid']."</td>
    <td>".$row['cost']."</td> 
    <td>".$row['prevevent']."</td> 
    <td>".$row['stationid']."</td> 
    <td>".$row['sownername']."</td> 
  </tr>";
  }
} else if($conn->error) {
	echo $conn->error;
} else {
	echo "<i>No recent service events</i>"; }
?>
</table>

<h3>Request truck switch</h3>
<?php 

if (strlen($requested) > 1 ) {
	echo '<i>You are already requesting a switch to '.$requested.'. Check back soon.</i>';
} else {
echo "<form method='post' action='switchHandler.php'>";
echo '<b>From: '.$tID.' to </b>
<select type="text" id="newtrk" name="newtrk">';

$query = 'SELECT truckid from trucks where NOT truckid ="'.$tID.'"';
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo 'here';
 while($row = $result->fetch_assoc()) {
   echo '<option value="'.$row['truckid'].'">'.$row['truckid']."</option>";
  }
} else {
 echo $conn->error;
}
echo "<input type='hidden' id='truckID' name='truckID' value='".$tID."'>";
echo '
<input type="submit" value="submit">
</select>
</form>';
}
?>

</body>
