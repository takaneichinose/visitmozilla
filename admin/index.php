<?php
require_once '../functions/list_visitors.php';
?>
<!DOCTYPE html>
<html> <head>
	<title>Mozilla Philippines Community - Visit Mozilla Community Space Manila</title>
	<meta name="viewport" content="width=device-width,user-scalable:no, initial-scale:1">
	<link href="../css/reset.css" media="all" rel="stylesheet" />
	<link href="../css/main.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.css" media="all" rel="stylesheet" />
	<link href="../css/foundation.min.css" media="all" rel="stylesheet" />
	<link href="../css/normalize.css" media="all" rel="stylesheet" />
	<link href="../css/main.css" media="all" rel="stylesheet" />
  <!--
	<link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Fira+Sans|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  -->
  <link rel="stylesheet" href="../css/jquery-ui.css">
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
    <div id='visitors'>
      <table>
        <thead>
          <tr>
            <th colspan=2>Name</th>
            <th colspan=2>Organization</th>
            <th>Time of Visit</th>
            <th colspan=2>ID Presented</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($execute_select_all_visitors_query) == 0) { ?> 
          <tr>
            <td colspan=8 style='text-align: center;'>No Records Found</td>
          </tr> 
        <?php } ?>
        <?php while($visitor = mysqli_fetch_array($execute_select_all_visitors_query)) { ?>
          <tr>
            <td colspan='2'>
              <a href='#'>
                <?php echo $visitor['salutation'].'. '.$visitor['firstName'].' '.$visitor['lastName']; ?>
              </a>
            </td>
            <td colspan=2><?php echo $visitor['organization']; ?></td>
            <td>12:00 PM</td>
            <td colspan=2 style='text-align:center'>
              <select>
                <option value=''></option>
                <option value='School ID'>School ID</option>
                <option value='SSS ID'>SSS ID</option>
              </select>
            </td>
            <td style='text-align:center;'>
              <?php if($visitor['checkInStatus'] == false){ ?>
                <button class='checkin tiny' data-id='<?php echo $visitor['visitor_id']; ?>'>
                  Checkin
                </button>
              <?php }else{ ?>
                <button class='checkin tiny success' data-id='<?php echo $visitor['visitor_id']; ?>'>
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
<script type="text/javascript" src="../js/vendor/jquery.js"></script>
<script type="text/javascript" src="../js/foundation.min.js"></script>
<script>
  $(document).on('click', '.checkin', function(){
    if ($(this).text().trim() == 'checked-in') {
      $(this).css('background', '#007095');
      $(this).text('checkin');
    }
    else{
      $(this).css('background', '#43AC6A');
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
