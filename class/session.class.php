<?php
session_start();
class Session{

  public $user;
  
  public function __construct($user){
    $this->user = $user;
  }

  # Check if admin is in session
  #
  # return boolean
  public function is_admin(){
    if(!isset($_SESSION['admin'])){
      return false;
    }

    return true;
  }

  # Check if user is in session
  #
  # return boolean
  public function is_user(){
    if(!isset($_SESSION['user'])){
      return false;
    }

    return true;
  }

  # destroy current session
  public function logout(){
    session_unset();
    session_destroy();
  }

  # Login admin user to admin page.
  #
  # paramaters: username(string), password(string)
  #
  # return boolean
  public function admin_login($username, $password){
    if(!$this->user->is_admin($username)){
      return false;
    }

    $verified_admin = $this->user->verify_admin($username, $password);
    if(!$verified_admin){
      return false;
    }

    $_SESSION['admin'] = $username;

    return true;
  }

  # Login user to user page.
  #
  # paramaters: email address(string)
  #
  # return boolean
  public function user_login($email_address){
    if(!$this->user->is_registered($email_address)){
      return false;
    }

    $_SESSION['user'] = $email_address;

    return true;
  }

  # verify email address using persona,
  # uses CURL to send request.
  #
  # paramaters: assertion(string), $audience(string)
  #
  # return object
  public function verify_assertion($assertion, $audience){
    $postdata='assertion=' . urlencode($assertion) . '&audience=' . urlencode($audience);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://verifier.login.persona.org/verify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $response = curl_exec($ch);
    curl_close($ch);
    $resp = json_decode($response);

    return $resp;
  }
}
?>
