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

