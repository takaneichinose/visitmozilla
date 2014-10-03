<?php
require_once '../functions/list_visitors.php';
?>
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
            <a href="/visitmozilla/admin/visitor_profile.php?id=<?php echo $visitor['visitor_id']; ?>">
                <?php echo $visitor['salutation'].'. '.$visitor['first_name'].' '.$visitor['last_name']; ?>
              </a>
            </td>
            <td colspan=2><?php echo $visitor['organization']; ?></td>
            <td><?php echo date("g:i a", strtotime($visitor['time_of_arrival'])); ?></td>
            <td style='text-align:center;'>
              <?php if($visitor['check_in_status'] == false){ ?>
                <button class='checkin tiny' data-id='<?php echo $visitor['log_id']; ?>'>
                  Checkin
                </button>
              <?php }else{ ?>
                <button class='checkin tiny success' data-id='<?php echo $visitor['log_id']; ?>'>
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
    var that = $(this);
    var data = {
      id: $(this).attr('data-id')
    }

    $.ajax({
      url:'/visitmozilla/functions/checkin.php',
      data: data,
      type:"POST",
      success: function(data){
        if (that.text().trim() == 'checked-in') {
          that.css('background', '#007095');
          that.text('checkin');
        }
        else{
          that.css('background', '#43AC6A');
          that.text('checked-in');
        }
      }
    });
  });
</script>
<!-- END -->
</body>
</html>
