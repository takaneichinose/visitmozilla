<?php
require_once '../config/config.php';

$id = $_GET['id'];

$select_visitor_query="SELECT * FROM visitors_info WHERE visitor_id='$id'";
$execute_select_visitor_query=mysqli_query($db_connection, $select_visitor_query) or die(mysqli_error($db_connection));
$info = mysqli_fetch_assoc($execute_select_visitor_query);

header('location: ../admin/visitor_profile.php');
?>
