<?php
require("../class/user.class.php");
require("../class/database.class.php");
require("../class/session.class.php");

$db = new Database();
$user = new User($db);
$session = new Session($user);

if(!$session->is_admin()){
  header('Location: login.php');
}

$users = $user->all_appointments();
$users_count = count($users);
?>
