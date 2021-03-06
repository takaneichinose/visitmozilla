<?php
class User{

  public $conn;

  public function __construct($db){
    $this->conn = $db->connect();
  }

  
  # Check if user is user.
  #
  # paramaters: email_address(string)
  #
  # return boolean
  public function is_user($email_address){
    return $this->is_registered($email_address);
  }

  # Check if user is admin.
  #
  # paramaters: username(string)
  #
  # return boolean
  public function is_admin($username){
    $sql = "SELECT COUNT(username) FROM admins WHERE username = :username";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':username' => $username));
    $count = $statement->fetchColumn();

    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

  # Check if user is registered.
  #
  # paramaters: email address(string)
  #
  # return boolean
  public function is_registered($email_address){
    $sql = "SELECT COUNT(email_address) FROM visitors_info WHERE email_address = :email";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':email' => $email_address));
    $count = $statement->fetchColumn();

    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

  # Register new user.
  #
  # paramaters: personal_info(array)
  #
  # return none
  public function register($personal_info){
    $sql = "INSERT INTO visitors_info(salutation, first_name, last_name, email_address, twitter_handler, organization,
            position, mozillian_type, mobile_number, date_registered) VALUES(:salutation, :first_name, :last_name,
            :email_address, :twitter_handler, :organization, :position, :mozillian_type, :mobile_number, :date_registered)";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':salutation' => $personal_info['salutation'], ':first_name' => $personal_info['first_name'],
                           ':last_name' => $personal_info['last_name'], ':email_address' => $personal_info['email_address'],
                           ':twitter_handler' => $personal_info['twitter_handler'],
                           ':organization' => $personal_info['organization'],
                           ':position' => $personal_info['position'],
                           ':mozillian_type' => $personal_info['mozillian_type'],
                           ':mobile_number' => $personal_info['mobile_number'],
                           ':date_registered' => $personal_info['date_registered']));
  }

  # Add new appointment.
  #
  # paramaters: appointment_info(array)
  #
  # return none
  public function add_appointment($appointment_info){
    $sql = "INSERT INTO visitors_appointment(email_address, first_visit, date_of_arrival, time_of_arrival)
            VALUES(:email_address, :first_visit, :date_of_arrival, :time_of_arrival)";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':email_address' => $appointment_info['email_address'],
                              ':first_visit' => $appointment_info['first_visit'],
                              'date_of_arrival' => $appointment_info['visit_date'],
                              ':time_of_arrival' => $appointment_info['visit_time']));
  }

  # Get all appointments.
  #
  # return array
  public function all_appointments(){
    $sql = "SELECT visitors_info.visitor_id, visitors_info.first_name, visitors_info.last_name, visitors_info.email_address,
            visitors_info.organization, visitors_info.salutation, visitors_appointment.appointment_id,
            visitors_appointment.check_in_status, visitors_appointment.datetime_checked_in,
            visitors_appointment.date_of_arrival, visitors_appointment.time_of_arrival FROM visitors_appointment
            INNER JOIN visitors_info ON visitors_appointment.email_address=visitors_info.email_address
            ORDER BY visitors_appointment.date_of_arrival DESC, visitors_appointment.time_of_arrival DESC";
    $statement = $this->conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
  }

  # Get specific user by id.
  #
  # parameters: id(integer)
  #
  # return array
  public function find_by_id($id){
    $sql = "SELECT * FROM visitors_info WHERE visitor_id = :id";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':id' => $id));
    $result = $statement->fetch();

    return $result;
  }

  # Get specific user by email address.
  #
  # parameters: email address(string)
  #
  # return array
  public function find_by_email($email_address){
    $sql = "SELECT * FROM visitors_info WHERE email_address = :email_address";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':email_address' => $email_address));
    $result = $statement->fetch();

    return $result;
  }

  # Verify if admin exist.
  #
  # parameters: username(string), password(string)
  #
  # return boolean
  public function verify_admin($username, $password){
    $sql = "SELECT * FROM admins WHERE username = :username AND password = :password";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':username' => $username, ':password' => $password));
    $count = $statement->fetchColumn();

    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

  # Select specific appointment.
  #
  # parameters: id(integer)
  #
  # return array
  public function select_appointment($id){
    $sql = "SELECT * FROM visitors_appointment WHERE appointment_id = :id";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':id' => $id));
    $result = $statement->fetch();

    return $result;
  }

  # NOTE: Need to optimization. Set datetime of checkin to
  # 0000-00-00 00:00:00 if check_in_status is false else
  # set date to current time.
  #
  # Check in user.
  #
  # parameters: id(integer)
  #
  # return array
  public function check_in($id){
    $appointment = $this->select_appointment($id);

    if($appointment['check_in_status'] == true){
      $status = false;
    }
    else{
      $status = true;
    }

    $sql = "UPDATE visitors_appointment SET check_in_status = :status, datetime_checked_in = CONVERT_TZ(NOW(), '-02:00', '+12:00')
            WHERE appointment_id = :id";
    $statement = $this->conn->prepare($sql);
    $statement->execute(array(':status' => $status, ':id' => $id));

    return $this->select_appointment($id);
  }

}
?>
