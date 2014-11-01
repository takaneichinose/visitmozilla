<?php
session_start();
class Session{

  public $user;
  
  public function __construct($user){
    $this->user = $user;
  }


  public function login($username, $password){
    if(!$this->user->is_admin($username)){
      return false;
    }

    $admin = $this->user->select_admin($username, $password);
    $_SESSION['admin'] = $admin['email'];

    return true;
  }

  public function logout(){
  }
}
?>
