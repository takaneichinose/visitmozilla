<?php 
require('../class/session.class.php');
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);
$session = new Session($user);
$username = $_POST['username'];
$password = $_POST['password'];
$assertion = (isset($_POST['assertion']) ? $_POST['assertion'] : '');

if(!isset($_POST['assertion'])){
  $login = $session->login($username, $password);
  
  if($login){
    $response = array('success' => true);
  }
  else{
    $response = array('success' => false, 'reason' => 'Admin doesnt exist!');
  }
  echo json_encode($response);
}
//if($user->is_register)
//else{
//  $session->persona_login($assertion)
//  #redirect somewhere
//}

//$assertion = $_POST['assertion'];
//$audience = 'http://visit.mozillaph.org/';
//if (isset($assertion)){
//  function verifyAssertion($assertion, $audience){
//    $postdata='assertion=' . urlencode($assertion) . '&audience=' . urlencode($audience);
//
//   $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "https://verifier.login.persona.org/verify");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//    $response = curl_exec($ch);
//    curl_close($ch);
//    $json_resp = json_decode($response);
//    return $json_resp;
//  } 
//  $valid_visitor = verifyAssertion($assertion, $audience);
//  $email = $valid_visitor->{'email'};
//  $status = $valid_visitor->{'status'};
//  $success = false;
//
//  if ($status != 'okay'){
//    $response = array('success' => $success, 'reason' => 'persona connection failed.');
//  }
//
//  if ($status == 'okay'){
//    $select_visitor_query = "SELECT email_address FROM visitors_info WHERE email_address='$email'";
//    $execute_select_visitor_query = mysqli_query($db_connection, $select_visitor_query) or die(mysqli_error($db_connection));
//
//    if (mysqli_num_rows($execute_select_visitor_query) == 1) {
//      $_SESSION['email'] = $email;
//      $success = true;
//      $response = array('success' => $success, 'email' => $email);
//    }
//    else{
//      $response = array('success' => $success, 'reason' => 'user is not registered.');
//    }
//  }
//  echo json_encode($response);
//}
?>
