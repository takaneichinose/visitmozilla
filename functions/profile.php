<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$users = new User($db);

$id = $_REQUEST['id'];
$user = $users->select_user($id);

?>
