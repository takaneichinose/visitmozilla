<!DOCTYPE html>
<head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<meta http-equiv='X-UA-Compatible' content='IE=Edge'>
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
    <div id="logo">
        <img src="images/mcs-logo.png" />
    </div>

    <div class="context" id="register-ui">
        <h1>Welcome to Mozilla Community Space Manila!</h1>
        <!--ADD AWESOME TEXT FOR BUTTONS-->
        <a href='visit.html' class='button large expand'>First time to visit Mozilla Community Space Manila?</a>
        <a href='returnee_visitor.html' class='button large expand'>Been here before?</a>

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
<script src="js/visit.js"></script>
<script src='https://login.persona.org/include.js'></script>
<script>
$(document).ready(function(){
  navigator.id.watch({
    onlogin: function(assertion){
      $.ajax({
        method: "POST",
        url: 'functions/login.php',
        data: {assertion: assertion},
        success: function(resp){
          var json_resp = JSON.parse(resp);
          if(json_resp.success){
            location.reload();
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
