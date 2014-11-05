<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/class/user.class.php');
require(__ROOT__.'/class/database.class.php');
require(__ROOT__.'/class/session.class.php');

$db = new Database();
$users = new User($db);
$session = new Session($users);


$is_logged_in = false;
if($session->is_user()){
  $is_logged_in = true;
  $current_user = $users->find_by_email($_SESSION['user']);
  $user = $users->find_by_id($current_user['visitor_id']);
}

if($session->is_admin()){
  $id = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
  $user = $users->find_by_id($id);
}

?>
