<?php
require_once '../config/config.php';

$email = $_GET['email'];

$select_visitor_query="SELECT * FROM visitors_info WHERE email_address='$email'";
$execute_select_visitor_query=mysqli_query($db_connection, $select_visitor_query) or die(mysqli_error($db_connection));
$info = mysqli_fetch_assoc($execute_select_visitor_query);

header('location: ../admin/visitor_profile.php');
?>
