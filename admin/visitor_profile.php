<?php
require_once '../config/config.php';

$id = $_GET['id'];

$select_visitor_query="SELECT * FROM visitors_info WHERE visitor_id='$id'";
$execute_select_visitor_query=mysqli_query($db_connection, $select_visitor_query) or die(mysqli_error($db_connection));
$info = mysqli_fetch_assoc($execute_select_visitor_query);
?>
<!DOCTYPE html>
<html> 
<head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="../css/reset.css" media="all" rel="stylesheet" />
	<link href="../css/main.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.min.css" media="all" rel="stylesheet" />
	<link href="../css/normalize.css" media="all" rel="stylesheet" />
	<link href="../css/main.css" media="all" rel="stylesheet" />
  <!--
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  -->
  <link rel="stylesheet" href="../css/jquery-ui.css">
</head>
<body>
<!--
<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>
-->

<div id="wrapper">
    <div id="logo">
        <img src="../images/mcs-logo.png" />
    </div>
    <h1 class='text-center'>MozillaSpaceMNL Visitors</h1>
    </div>
    <div id='visitor-info' style='background:#fff; width: 500px; margin:auto; padding: 10px;'>
    <b>salutation:</b> <?php echo $info['salutation']; ?><br/>
    <b>first name:</b> <?php echo $info['first_name']; ?><br/>
    <b>last name:</b> <?php echo $info['last_name']; ?><br/>
    <b>email address:</b> <?php echo $info['email_address']; ?><br/>
    <b>twitter handler:</b> <?php echo $info['twitter_handler']; ?><br/>
    <b>mobile number:</b> <?php echo $info['mobile_number']; ?><br/>
    <b>organization:</b> <?php echo $info['organization']; ?><br/>
    <b>position:</b> <?php echo $info['position']; ?><br/>
    <b>mozillian type:</b> <?php echo $info['mozillian_type']; ?><br/>
    <b>date registered:</b> <?php echo $info['date_registered']; ?><br/>
    </div>

</div>

<!-- JS  -->
<!--
<script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>
-->
<script type="text/javascript" src="../js/vendor/jquery.js"></script>
<script type="text/javascript" src="../js/foundation.min.js"></script>
<!-- END -->
</body>
</html>
