<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);
$id=$_POST['id'];
$appointment =  $user->select_appointment($id);

if($appointment['check_in_status'] == true){
  $status = false;
  $datetime_checked_in = null;
}
else{
  $status = true;
  $datetime_checked_in = date("M d, Y - g:i a");
}
$user->check_in($id, $status, $datetime_checked_in);
$response = array('success' => true, 'check_in_date' => $datetime_checked_in, 'checked_in' => $status);
echo json_encode($response);
?>



