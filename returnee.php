<?php
  require_once 'functions/profile.php';
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
	<link href="css/jquery-ui.min.css" media="all" rel="stylesheet" />
	<link href="css/jquery-ui.structure.min.css" media="all" rel="stylesheet" />
	<link href="css/jquery-ui.theme.min.css" media="all" rel="stylesheet" />
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
</head> <body>
<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>

<div id="wrapper">
	 <div id="logo">
        <img src="images/mcs-logo.png" />
    </div>
    <?php if(!$is_logged_in) { ?>
      <button class='button tiny right' id='login-button' style='margin-right: 10%;'>login</button>
    <?php } else { ?>
      <div id='user-settings' class='right' style='margin-right: 10%;'>
      <a href='<?php echo dirname('__FILE__');?>/admin/user_profile.php?id=<?php echo $user['visitor_id']; ?>' id='email'><?php echo $_SESSION['user']; ?></a>
        | &nbsp;
        <a href='functions/logout.php' id='logout-button'>logout</a>
      </div>
    <?php } ?>

    <div class="context" id="thanks-ui">
        <h1>Success!</h1>
        <p>Your appointment has been set. See you!</p>
    </div>


    <div class="context" id="register-ui">
        <h1>It's nice to see you back.</h1>
        <p>Please fill-out the following form</p>

        <form method="post" id="visit_form">
        <input type="email" <?php echo ($is_logged_in) ? 'disabled' : '';?> id="email" value="<?php echo ($is_logged_in) ? $_SESSION['user'] : ''; ?>" name="email_address" placeholder="Email Addres" required />
        <input type="text" id="visitDate" name="visit_date" placeholder="Date of Visit" required/>
        <input type="text" name="visit_time" placeholder="Time of Visit" id="visitTime" required />
        <!-- END -->
        <input type="submit" id="submit" name="returnee" value="Submit" />
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
<script src="js/returnee.js"></script>
<script src='https://login.persona.org/include.js'></script>
<script>
$(document).ready(function(){
  navigator.id.watch({
    onlogin: function(assertion){
      $.ajax({
        method: "POST",
        url: 'functions/login.php',
        data: {assertion: assertion},
        success: function(data){
          var resp = JSON.parse(data);
          if(resp.success){
            location.reload();
          }
          else{
            alert(resp.reason);
          }
        }
      });
    },
  });

  $('#login-button').on('click', function(e){
    e.preventDefault();
    console.log('login-button clicked!');
    navigator.id.request();
  });

});
</script>
</body>
</html>
