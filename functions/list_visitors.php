<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);

$users = $user->all_appointments();
$users_count = count($users);
?>
