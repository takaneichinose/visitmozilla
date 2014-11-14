<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/class/user.class.php');
require(__ROOT__.'/class/database.class.php');
require(__ROOT__.'/class/session.class.php');

# Initialize classes
$db = new Database();
$user = new User($db);
$session = new Session($user);

# Redirect admin to login page if session
# is empty or is not an admin.
if(!$session->is_admin()){
  header('Location: login.php');
}

# list all the appointments
$users = $user->all_appointments();
# count appointments, need for iterating
# appointments.
$users_count = count($users);
?>
