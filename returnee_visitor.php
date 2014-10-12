<?php
  require_once 'functions/session.php';
?>
<!DOCTYPE html>
<head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="css/reset.css" media="all" rel="stylesheet" />
	<link href="css/foundation.css" media="all" rel="stylesheet" />
	<link href="css/foundation.min.css" media="all" rel="stylesheet" />
	<link href="css/normalize.css" media="all" rel="stylesheet" />
	<link href="css/main.css" media="all" rel="stylesheet" />
  <link rel="stylesheet" href="css/jquery-ui.css">
  <!--
  NOTE: Uncomment after development
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  -->
</head>
<body>
<!--
NOTE: Uncomment after development
<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>
-->
<div id="wrapper">
    <?php if(!$is_logged_in) { ?>
      <button class='button tiny right' id='login-button' style='margin-right: 10%;'>login</button>
    <?php } else { ?>
      <div id='user-settings' class='right' style='margin-right: 10%;'>
      <a href='/visitmozilla/admin/visitor_profile.php?email=<?php echo $_SESSION['email']; ?>' id='email'><?php echo $_SESSION['email']; ?></a>
        | &nbsp;
        <a href='functions/logout.php' id='logout-button'>logout</a>
      </div>
    <?php } ?>
    <div id="logo">
        <img src="images/mcs-logo.png" />
    </div>

    <div class="context" id="thanks-ui">
        <h1>Success!</h1>
        <p>You are now registered. See you soon!</p>
    </div>


    <div class="context" id="register-ui">
        <h1>Welcome to Mozilla Community Space Manila!</h1>
        <p>Please fill-up our Visitor Registration System. Thank you!</p>

        <form method="post" id="visit_form">
            <input type="email" id="email" name="email_address" placeholder="Email Addres" required />
            <select id="isMozillian" name="is_mozillian" required>
                <option value="" selected>Are you a Mozillian?</option>
                <option value=1>Yes</option>
                <option value=0>No</option>
            </select>
            <input type="text" id="visitDate" name="visit_date" placeholder="Date of Visit" required/>
            <input type="text" name="visit_time" placeholder="Time of Visit" id="visitTime" required />
            <!-- END -->
            <input type="submit" id="submit" name="submit" value="Submit" />
        </form>
    </div>

	<div class="context" id="request-ui">
		<h1>One moment, please.</h1>
		<p>Just sending your request. This will just take a few seconds.</p>
	</div>
</div>

<!--
NOTE: Uncomment after development
<script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>
-->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/timepicker.js"></script>
<script src="js/returnee.js"></script>
<script>
$('#visitDate').datepicker({ minDate:0,maxDate:new Date(), dateFormat: "yy-mm-dd"});
$('#visitTime').timepicker({timeFormat: "hh:mm tt"});
$("#visit_form").submit(function(e) {
    $('#register-ui').hide();
    $('#request-ui').show();
    var t = $(this).serializeArray();
    var n = "functions/visit.php";
    $.ajax({
        url: n,
        type: "POST",
        data: t,
		success: function(data)
		{
      console.log("DATA", data);
			//$('#thanks-ui').show().delay(5000).fadeOut("slow");
			//$('#register-ui').show();
			//$('#request-ui').hide();
            $('#thanks-ui').html(data);
            $('#thanks-ui').show().delay(500);
            $('#register-ui').show().delay(2000);
		},
		fail: function(data)
		{
			alert("Registration failed. Please try again.");
			console.log(data);
		}
    });
	this.reset();
	e.preventDefault();
	$('#request-ui').hide();
	return false;
});
</script>
</body>
</html>
