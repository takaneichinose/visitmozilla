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
		success: function(data)
		{
      console.log(data);
      var resp = JSON.parse(data);
      console.log("DATA", resp);
      if (resp.success){
        $('#thanks-ui').show(0).delay(5000).fadeOut("slow");
        $('#thanks-ui').html('<p>' + resp.reason + '</p>');
        $('#thanks-ui').show();
        $('#register-ui').show();
      }
		},
		fail: function(data)
		{
			alert("Registration failed. Please try again.");
			console.log(data);
		}
    });
	this.reset();
	e.preventDefault();
	return false;
});
