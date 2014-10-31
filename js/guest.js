$('#visitDate').datepicker({ minDate:0, dateFormat: "yy-mm-dd"});

$('#visitTime').timepicker({timeFormat: "hh:mm tt"});

// Hide/Show the Mozillian Type depends on the selection
$("#isMozillian").change(function(){
  if($("#isMozillian option:selected").text() == "Yes"){
    $("#mozillianType").show();
  }
  else
  {
    $("#mozillianType").hide();
  }
});

// automatically adds a "@" value when clicked
$('#twitter').on('focus', function()
{
	$('#twitter').val("@");
});

// This is where the magic comes in when sending forms to DB
$("#registration_form").submit(function(e) {
  $('#register-ui').hide();
  $('#request-ui').show();
  var t = $(this).serializeArray();
  var n = "functions/submit.php";
  $.ajax({ url: n,
    type: "POST",
    data: t,
    success: function(data){
      var resp = JSON.parse(data);
      if (!resp.success){
        $('#thanks-ui').html("<h1>Registration Failed</h1><p>"+ resp.reason +"</p>");
      }
      $('#thanks-ui').show(0).delay(5000).fadeOut("slow");
      $('#register-ui').show();
      $('#request-ui').hide();
    }
  });
	this.reset();
	e.preventDefault();
	$('#request-ui').hide();
	return false;
})
