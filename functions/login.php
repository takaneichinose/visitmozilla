<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/class/user.class.php');
require(__ROOT__.'/class/database.class.php');
require(__ROOT__.'/class/session.class.php');

# Initialize classes
$db = new Database();
$user = new User($db);
$session = new Session($user);

$username = (isset($_POST['username']) ? $_POST['username'] : '');
$password = (isset($_POST['password']) ? $_POST['password'] : '');
$assertion = (isset($_POST['assertion']) ? $_POST['assertion'] : '');
# use this variable for prod
#$audience = 'http://visit.mozillaph.org/';
# use this variable for local testing
$audience = 'http://localhost/visitmozilla/';

if(!isset($_POST['assertion'])){
  # This is for Admin login
  $login = $session->admin_login($username, $password);
  
  if($login){
    $response = array('success' => true);
  }
  else{
    $response = array('success' => false, 'reason' => 'Incorrect admin credentials!');
  }
}
else{
  # This is for user login using persona
  $verified = $session->verify_assertion($assertion, $audience);

  if($verified->{'status'} != 'okay'){
    $response = array('success' => false, 'reason' => 'Persona connection failed.');
  }
  else{
    $login = $session->user_login($verified->{'email'});

    if($login){
      $response = array('success' => true);
    }
    else{
      $response = array('success' => false, 'reason' => 'User doesnt exist!');
    }
  }
}

# format response as json.
echo json_encode($response);
?>
