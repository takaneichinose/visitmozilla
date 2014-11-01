<?php 
require('../class/session.class.php');
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);
$session = new Session($user);

$username = (isset($_POST['username']) ? $_POST['username'] : '');
$password = (isset($_POST['password']) ? $_POST['password'] : '');
$assertion = (isset($_POST['assertion']) ? $_POST['assertion'] : '');
# use this variable on prod
#$audience = 'http://visit.mozillaph.org/';
# use this variable on local testing
$audience = 'http://localhost/visitmozilla/';

if(!isset($_POST['assertion'])){
  $login = $session->admin_login($username, $password);
  
  if($login){
    $response = array('success' => true);
  }
  else{
    $response = array('success' => false, 'reason' => 'Incorrect admin credentials!');
  }
}
else{
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
echo json_encode($response);
?>
