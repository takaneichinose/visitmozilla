<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);
$id=$_POST['id'];
$checked_in = $user->check_in($id);
$status = ($checked_in['check_in_status']) ? true : false;
$checked_in_format = date("M d, Y - g:i a", strtotime($checked_in['datetime_checked_in']));
$response = array('check_in_date' => $checked_in_format, 'checked_in' => $status);
echo json_encode($response);
?>



