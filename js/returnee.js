$('#visitDate').datepicker({ minDate:0, dateFormat: "yy-mm-dd"});
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
    success: function(data){
      var resp = JSON.parse(data);
      if (!resp.success){
        $('#thanks-ui').html("<h1>Sending Appointment Failed</h1><p>"+ resp.reason +"</p>");
      }
      $('#thanks-ui').show(0).delay(5000).fadeOut("slow");
      $('#request-ui').hide();
      $('#thanks-ui').show();
      $('#register-ui').show();
    }
  });
	this.reset();
	e.preventDefault();
	return false;
});
