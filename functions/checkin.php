<?php
//Connect to the database
require_once '../config/config.php';

$id=$_POST['id'];

//Select record in walkin_attendees using email
$select_visitor_query="SELECT * FROM visitors_log WHERE visitor_id = '$id'";
$execute_select_visitor_query=mysqli_query($db_connection,$select_visitor_query) or die(mysqli_error($db_connection));
$result = mysqli_fetch_assoc($execute_select_visitor_query);
$status = $result['checkInStatus'];
$email = $result['email'];
$value='';

if($status == true){
  $value = false;
}
else{
  $value = true;
}

$checkin_query="UPDATE visitors_log SET checkInStatus='$value' WHERE visitor_id = '$id'";
$execute_checkin_query=mysqli_query($db_connection, $checkin_query) or die(mysqli_error($db_connection));
?>



