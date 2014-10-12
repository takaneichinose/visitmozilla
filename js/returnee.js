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
      console.log("DATA", data);
			$('#thanks-ui').show().delay(1000).fadeOut("slow");
			$('#register-ui').show();
			$('#request-ui').hide();
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
