<!DOCTYPE html> <html>
<head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="../css/reset.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.min.css" media="all" rel="stylesheet" />
	<link href="../css/normalize.css" media="all" rel="stylesheet" />
  <link href="../css/main.css" media="all" rel="stylesheet" />

  <!--
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  -->
 <!--  <link rel="stylesheet" href="../css/jquery-ui.css"> -->

  <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" media="all" rel="stylesheet" />
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

    <div id='visitors' class='context' style='width:500px;'>
      <form id="loginForm"> 
        <label for="username">Username</label> 
        <input class='reg-inputs' id="name" name="username" pattern=".{5,}" required title="5 characters minimum" tabindex="1" type="text"> 

        <label for="email">Password</label>
        <input class='reg-inputs' id="password" name="password" tabindex="2" type="password"> 

        <button class="button expand" name="submit" type="submit" id="login-button" tabindex="3">Login</button>   
      </form> 
  </div>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script>
  $('#loginForm').on('submit',function(e) {
    e.preventDefault();

    var formData = $('#loginForm').serialize();
    $.ajax({
    type: "POST",
    url: "/visitmozilla/functions/login.php",
    data: formData,
    success: function(data){
      var resp = JSON.parse(data);
      console.log(resp);
      if(!resp.success){
        $('#loginForm').trigger('reset');
      }
      else{
        window.location.href = 'index.php';
      }
    }
    });

  });
</script>

</body>
</html>
