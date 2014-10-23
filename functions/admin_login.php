<?php 
require_once '../config/config.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username)){
  $find_admin_query = "SELECT * FROM admins WHERE username = '$username'";
  $execute_find_admin_query = mysqli_query($db_connection, $find_admin_query) or die(mysqli_error($db_connection));
  $num_admin = mysqli_num_rows($execute_find_admin_query);
  $found_admin = mysqli_fetch_assoc($execute_find_admin_query);
  $found_admin_email = $found_admin['email'];
  if($num_admin > 0){
    $_SESSION['admin'] = $found_admin_email;
    $response = array('success' => true);
  }
  else{
    $response = array('success' => false, 'reason' => 'admin not found.');
  }
  echo json_encode($response);
}
?>
