<?php
include("config/config.php");
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	// allow access....
$con =  mysql_connect(LH, HOST, PW);
mysql_select_db(DB, $con);
date_default_timezone_set('Asia/Manila');

$firstTime = $_POST['firstTime'];
$visitDate = $_POST['visitDate'];
$visitTime = $_POST['visitTime'];
$timeOfArrival = NULL;
$salutation = $_POST['salutation'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$twitter = $_POST['twitter'];
$contact = $_POST['contact'];
$organization = $_POST['organization'];
$position = $_POST['position'];
$isMozillian = $_POST['isMozillian'];
$mozillianType = $_POST['mozillianType'];
$legalId = $_POST['legalID'];
$checkin = "false";
$regTime = date('Y/m/d H:i:s'); // insert time stamp here

mysql_query("INSERT INTO visitors_log(firstTimeVisitor,DateOfArrival,expectedTimeOfArrival,timeOfArrival,salutation,firstName,lastName,emailAddress,twitterUsername,mobileNumber,organization,position,isMozillian,mozillianType,idPresented,checkInStatus,registrationTime) VALUES('$firstTime','$visitDate','$visitTime','$timeOfArrival','$salutation','$fName','$lName','$email','$twitter','$contact','$organization','$position','$isMozillian','$mozillianType','$legalId','$checkin','$regTime')");
echo 'true';


/* EMAIL */
// multiple recipients
$to = '$email';
// subject
$subject = '[Mozilla Space Manila] RSVP Confirmed';

$message .= '
 <html>
  <head>
    <title>RSVP Confirmed</title>
    <style>
    *
    {
      font-family: "Open Sans", sans-serif;
    }
	h1
	{
		font-size:1.3em;
		color: #C13832;
	}
	p
	{
		font-size:1em;
	}
    </style>
  </head>
  <body>
  <h1>We are excited to see you!</h1>
  <p>Hi there!<br /> This is to confirm that we have received your request for RSVP. Thank you for using our online RSVP service!</p>
  <br />
  <p>- Mozilla Community Space Manila Management</p>
</body>
</html>
   ';


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To:' . $_POST['fName'] . ' ' . $_POST['lName'] . '<' . $_POST['email'] . '>' . "\r\n";
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


mysql_close();
}
else
{
	echo "Who lives in a pineapple under the sea?";
}
?>