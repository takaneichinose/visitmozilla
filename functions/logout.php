<?php
require('../class/session.class.php');
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);
$session = new Session($user);

if($session->is_admin()){
  $session->logout();
  #redirect somewhere;
}
else{
  $session->logout();
  #redirect somewhere;
}
?>
