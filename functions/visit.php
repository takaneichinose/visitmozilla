<?php
require("../class/user.class.php");
require("../class/database.class.php");

$db = new Database();
$user = new User($db);

$appointment_info = array(
  'email_address' => $_POST['email_address'],
  'first_visit' => false,
  'visit_time' => date("H:i", strtotime($_POST['visit_time'])),
  'visit_date' => date("F d, Y", strtotime($_POST['visit_date'])),
);

if (!$user->is_registered($appointment_info['email_address'])){
  $response = array('success' => false, 'reason' => 'We detect that you dont have an account yet. Please register <a href="guest.php">here</a> first.');
  echo json_encode($response);
  exit();
}
else{
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
//	}
//    </style>
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
//$headers .= 'To:' . $info['first_name'] . ' ' . $info['last_name'] . '<' . $_REQUEST['email_address'] . '>' . "\r\n";
//$headers .= 'From: Mozilla Philippines <info@mozillaphilippines.org>' . "\r\n";
//// Mail it
//$retval = mail($to, $subject, $message, $headers);
//if( $retval == true )
//   {
//      $response = array('success' => true, 'reason' => 'Appoinment has been sent!');
//      echo json_encode($response);
//   }
//   else
//   {
//      $response = array('success' => true, 'reason' => 'Some problem with internet connection!');
//      echo json_encode($response);
//   }
//
//
///* EMAIL END */
//
//mysqli_close($db_connection);
//}
//else
//{
//	echo "Who lives in a pineapple under the sea?";
//}
?>
