<?php
require_once '../functions/list_visitors.php';
?>
<!DOCTYPE html>
<html> <head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="../css/reset.css" media="all" rel="stylesheet" />
	<link href="../css/main.css" media="all" rel="stylesheet" />
  <!--
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  -->
  <link rel="stylesheet" href="../css/jquery-ui.css">
</head>
<body>
<!--<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>-->

<div id="wrapper">
    <div id="logo">
        <img src="../images/mcs-logo.png" />
    </div>
    <div id='visitors'>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>Organization</th>
            <th>Time of Visit</th>
            <th>Date of Visit</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($execute_select_all_visitors_query) == 0) { ?> 
          <tr>
            <td colspan=5 style='text-align: center;'>No Records Found</td>
          </tr> 
        <?php } ?>
        <?php while($visitor = mysqli_fetch_array($execute_select_all_visitors_query)) { ?>
          <tr>
            <td>
              <a href='#'>
                <?php echo $visitor['salutation'].'. '.$visitor['firstName'].' '.$visitor['lastName']; ?>
              </a>
            </td>
            <td><?php echo $visitor['emailAddress']; ?></td>
            <td><?php echo $visitor['organization']; ?></td>
            <td><?php echo $visitor['timeOfArrival']; ?></td>
            <td><?php echo $visitor['DateOfArrival']; ?></td>
            <td>
              <?php if($visitor['checkInStatus'] == false){ ?>
                <button class='checkin' data-id='<?php echo $visitor['visitor_id']; ?>'>
                  Checkin
                </button>
              <?php }else{ ?>
                <button class='checkin' data-id='<?php echo $visitor['visitor_id']; ?>'>
                  checked-in
                </button>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

</div>

<!-- JS  -->
<!--
<script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>
-->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/timepicker.js"></script>
<script src="../js/script.js"></script>
<script>
  $(document).on('click', '.checkin', function(){
    if ($(this).text().trim() == 'Incomplete') {
      $(this).css('background', '#0AA80A');
      $(this).text('checkin');
    }
    else{
      $(this).css('background', '#4b8df9');
      $(this).text('checked-in');
    }

    $.ajax({
      url:'/visitmozilla/functions/checkin.php',
      data:{id: $(this).attr('data-id') },
      type:"POST"
    });
  });
</script>
<!-- END -->
</body>
</html>
