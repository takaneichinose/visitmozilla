<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/class/user.class.php');
require(__ROOT__.'/class/database.class.php');

# Initialize classes.
$db = new Database();
$user = new User($db);

# Checkin user
$id=$_POST['id'];
$checked_in = $user->check_in($id);

# configure response to more readable format
$status = ($checked_in['check_in_status']) ? true : false;
$checked_in_format = date("M d, Y - g:i a", strtotime($checked_in['datetime_checked_in']));
$response = array('check_in_date' => $checked_in_format, 'checked_in' => $status);

# format response as json.
echo json_encode($response);
?>



