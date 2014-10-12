<?php
session_start();
$is_logged_in = true;
if(!isset($_SESSION['email'])){
  $is_logged_in = false;
}
?>
