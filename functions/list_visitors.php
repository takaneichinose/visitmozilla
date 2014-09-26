<?php
require_once '../config/config.php';
$select_all_visitors_query="SELECT visitors_log.check_in_status, visitors_log.id_presented, visitors_log.time_of_arrival, visitors_log.log_id, visitors_info.visitor_id, visitors_info.first_name, visitors_info.last_name, visitors_info.salutation, visitors_info.email_address, visitors_info.organization FROM visitors_log INNER JOIN visitors_info ON visitors_log.email_address=visitors_info.email_address";
$execute_select_all_visitors_query=mysqli_query($db_connection,$select_all_visitors_query) or die(mysqli_error($db_connection));;
?>
