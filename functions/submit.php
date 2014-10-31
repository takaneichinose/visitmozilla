<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);

$personal_info = array(
  'salutation' => $_POST['salutation'],
  'first_name' => $_POST['first_name'],
  'last_name' => $_POST['last_name'],
  'email_address' => $_POST['email_address'],
  'twitter_handler' => $_POST['twitter_handler'],
  'organization' => $_POST['organization'],
  'position' => $_POST['position'],
  'mozillian_type' => $_POST['mozillian_type'],
  'mobile_number' => $_POST['mobile_number'],
  'date_registered' => date('Y/m/d H:i:s'),
);

$appointment_info = array(
  'email_address' => $_POST['email_address'],
  'first_visit' => true,
  'visit_time' => date("H:i", strtotime($_POST['visit_time'])),
  'visit_date' => date("F d, Y", strtotime($_POST['visit_date'])),
);

if ($user->is_registered($personal_info['email_address'])){
  $response = array('success' => false, 'reason' => 'We detect that you have already an account. You can set schedule <a href="returnee.php">here</a> first.');
  echo json_encode($response);
  exit();
}
else{
  $user->register($personal_info);
  $user->add_appointment($appointment_info);
  $response = array('success' => true, 'reason' => 'Transaction successful.');
  echo json_encode($response);
}

$db->disconnect();


/* EMAIL */
// multiple recipients

//$to = $email_address;
//// subject
//$subject = '[Mozilla Space Manila] Visitor Registration Confirmed';
//
//$message = "
// <html>
//  <head>
//    <title>RSVP Confirmed</title>
//    <style>
//    *
//    {
//      font-family: 'Open Sans', sans-serif;
//    }
//	p
//	{
//		font-size:1em;
//	} </style>
//  </head>
//  <body>
//  <p>Hi there!
//This is to confirm that we have received your appointment request on $v_date $visit_time at the Mozilla Community Space Manila. Thank you for using our online appointment service! <br />We are excited to see you!</p>
//  <br />
//  <p>- Mozilla Community Space Manila Management</p>
//</body>
//</html>
//   ";
//
//
//// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//// Additional headers
//$headers .= 'To:' . $_POST['first_name'] . ' ' . $_POST['last_name'] . '<' . $_POST['email_address'] . '>' . "\r\n";
//$headers .= 'From: Mozilla Philippines <info@mozillaphilippines.org>' . "\r\n";
//// Mail it
//$retval = mail($to, $subject, $message, $headers);
//if( $retval == true )  
//   {
//      echo "Form has been submitted!";
//   }
//   else
//   {
//      echo "There is a problem with your application. Please navigate back.";
//   }
//
//
///* EMAIL END */
//
?>
