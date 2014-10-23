currentUser = '';
navigator.id.watch({
  loggedInUser: currentUser,
  onlogin: function(assertion){
    $.ajax({
      method: "POST",
      url: 'junctions/login.php',
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

$('.login-button').on('click', function(e){
  e.preventDefault();
  console.log('login-button clicked!');
  navigator.id.request();
});
