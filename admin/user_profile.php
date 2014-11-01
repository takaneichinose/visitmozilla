<?php
require("../functions/profile.php");
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
    <b>salutation:</b> <?php echo $user['salutation']; ?><br/>
    <b>first name:</b> <?php echo $user['first_name']; ?><br/>
    <b>last name:</b> <?php echo $user['last_name']; ?><br/>
    <b>email address:</b> <?php echo $user['email_address']; ?><br/>
    <b>twitter handle:</b> <?php echo $user['twitter_handler']; ?><br/>
    <b>mobile number:</b> <?php echo $user['mobile_number']; ?><br/>
    <b>organization:</b> <?php echo $user['organization']; ?><br/>
    <b>position:</b> <?php echo $user['position']; ?><br/>
    <b>mozillian type:</b> <?php echo $user['mozillian_type']; ?><br/>
    <b>date registered:</b> <?php echo date("M d, Y - g:i a", strtotime($user['date_registered'])); ?><br/>
    </div

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
