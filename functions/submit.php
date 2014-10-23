<?php
include("../config/config.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{

// Visitors Info.
$salutation = $_POST['salutation'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$twitter_handler = $_POST['twitter_handler'];
$organization = $_POST['organization'];
$position = $_POST['position'];
$mozillian_type = $_POST['mozillian_type'];
$mobile_number = $_POST['mobile_number'];
$date_registered = date('Y/m/d H:i:s'); // insert time stamp here


//Visitors Log
$first_visit = true;
$is_mozillian = $_POST['is_mozillian'];
//Convert string to datetime
$visit_date = $_POST['visit_date'];
$visit_time = date("H:i:s", strtotime($_POST['visit_time']));
echo $visit_date;
echo strtotime($_POST['visit_time']);
echo '<br/>';
echo $visit_time;

$select_visitor_query="SELECT * FROM visitors_info WHERE email_address='$email_address'";
$execute_select_visitor_query=mysqli_query($db_connection, $select_visitor_query) or die(mysqli_error($db_connection));

if (mysqli_num_rows($execute_select_visitor_query) > 0){
  echo 'We detect that you have already an account. You can set schedule here.';
  exit();
}

$insert_visitor_info_query = "INSERT INTO visitors_info(salutation, first_name, last_name, email_address, twitter_handler, organization, position, mozillian_type, mobile_number, date_registered) VALUES('$salutation','$first_name','$last_name','$email_address','$twitter_handler','$organization','$position','$mozillian_type','$mobile_number','$date_registered')";
$execute_insert_query = mysqli_query($db_connection, $insert_visitor_info_query) or die(mysqli_error($db_connection));


$insert_visitors_log_query = "INSERT INTO visitors_log(email_address, first_visit, date_of_arrival, time_of_arrival, is_mozillian) VALUES('$email_address','$first_visit','$visit_date','$visit_time','$is_mozillian')";
$execute_insert_visitors_log_query = mysqli_query($db_connection, $insert_visitors_log_query) or die(mysqli_error($db_connection));
echo $insert_visitors_log_query;

/* EMAIL */
// multiple recipients

$to = $email_address;
// subject
$subject = '[Mozilla Space Manila] Visitor Registration Confirmed';

$message = "
 <html>
  <head>
    <title>RSVP Confirmed</title>
    <style>
    *
    {
      font-family: 'Open Sans', sans-serif;
    }
	p
	{
		font-size:1em;
	}
    </style>
  </head>
  <body>
  <p>Hi there!
This is to confirm that we have received your appointment request on .'$visit_date'.' '.'$visit_time'. at the Mozilla Community Space Manila. Thank you for using our online appointment service! <br />We are excited to see you!</p>
  <br />
  <p>- Mozilla Community Space Manila Management</p>
</body>
</html>
   ";


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To:' . $_POST['first_name'] . ' ' . $_POST['last_name'] . '<' . $_POST['email_address'] . '>' . "\r\n";
$headers .= 'From: Mozilla Philippines <info@mozillaphilippines.org>' . "\r\n";
// Mail it
$retval = mail($to, $subject, $message, $headers);
if( $retval == true )  
   {
      echo "Form has been submitted!";
   }
   else
   {
      echo "There is a problem with your application. Please navigate back.";
   }


/* EMAIL END */

mysqli_close($db_connection);
}
else
{
	echo "Who lives in a pineapple under the sea?";
}
?>
