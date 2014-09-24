<?php
require_once '../config/config.php';
$select_all_visitors_query="SELECT * FROM visitors_log";
$execute_select_all_visitors_query=mysqli_query($db_connection,$select_all_visitors_query) or die(mysqli_error($db_connection));;
?>
