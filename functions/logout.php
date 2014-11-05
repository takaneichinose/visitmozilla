<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/class/user.class.php');
require(__ROOT__.'/class/database.class.php');
require(__ROOT__.'/class/session.class.php');

# Initialize classess
$db = new Database();
$user = new User($db);
$session = new Session($user);

# Check if admin or user logout then 
# redirect to specified page.
if($session->is_admin()){
  $session->logout();
  header('Locatiion: login.php');
}
else{
  $session->logout();
  header('Locatiion: index.php');
}
?>
