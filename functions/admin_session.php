<?php
session_start();
$is_logged_in = true;
if(!isset($_SESSION['admin'])){
  header('Location: login.php');
}
?>
