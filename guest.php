<!DOCTYPE html>
<head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="css/reset.css" media="all" rel="stylesheet" />
	<link href="css/foundation.css" media="all" rel="stylesheet" />
	<link href="css/foundation.min.css" media="all" rel="stylesheet" />
	<link href="css/normalize.css" media="all" rel="stylesheet" />
	<link href="css/main.css" media="all" rel="stylesheet" />
	<link href="css/jquery-ui.min.css" media="all" rel="stylesheet" />
	<link href="css/jquery-ui.structure.min.css" media="all" rel="stylesheet" />
	<link href="css/jquery-ui.theme.min.css" media="all" rel="stylesheet" />
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
</head>
<body>
<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>

<div id="wrapper">
    <div id="logo">
        <img src="images/mcs-logo.png" />
    </div>

    <div class="context" id="thanks-ui">
        <h1>Success!</h1>
        <p>You are now registered. See you soon!</p>
    </div>

    <div class="context" id="register-ui">
        <h1>Welcome to Mozilla Community Space Manila!</h1>
        <p>Please fill-out the following form</p>
        <form method="post" id="registration_form">
            <h4>Personal Information</h4>
            <select name="salutation" id="salutation" required>
                <option value="" selected>Title</option>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Ms.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Prof.">Prof.</option>
                <option value="Doc.">Doc.</option>
            </select>  
            <input type="text" id="fName" name="first_name" placeholder="First Name" required />
            <input type="text" id="lName" name="last_name" placeholder="Last Name" required />
            <input type="email" id="email" name="email_address" placeholder="Email Address" required />
			<input type="text" id="twitter" name="twitter_handler" placeholder="Twitter Handle" required />
            <input type="text" id="contact" name="mobile_number" placeholder="Mobile Number" required />
            <input type="text" id="organization" name="organization" placeholder="School/Company/Organization" required />
            <input type="text" name='position' id="position" placeholder="Position" required>
            <select id="isMozillian" name="is_mozillian" required>
                <option value="" selected>Are you a Mozillian?</option>
                <option value=1>Yes</option>
                <option value=0>No</option>
            </select>
            <!-- HIDDEN FORM IF SELECTED YES -->
             <select name="mozillian_type" id="mozillianType">
                <option value="" selected>What type of Mozillian are you?</option>
                <option value="fsa">Firefox Student Ambassador</option>
                <option value="mozillian">Vouched Mozillian</option>
            </select>
            <h4>Appointment Information</h4>
            <input type="text" id="visitDate" name="visit_date" placeholder="Date of Visit" required/>
            <input type="text" name="visit_time" placeholder="Time of Visit" id="visitTime" required />        
            <!-- END -->
            <input type="submit" id="submit" name="register" value="Register" />
			<a href='index.php' class='button small'>Take me back</a>
        </form>
    </div>
	
	<div class="context" id="request-ui">
		<h1>One moment, please.</h1>
		<p>Sending your request. This won't take much time.</p>
	</div>
</div>


<script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/timepicker.js"></script>
<script src="js/guest.js"></script>
</body>
</html>
