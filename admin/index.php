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
 <!--  <link rel="stylesheet" href="../css/jquery-ui.css"> -->

  <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" media="all" rel="stylesheet" />
</head>
<body>
<!--
<a href="http://www.mozilla.org/" id="tabzilla">mozilla</a>
-->

<div id="wrapper">
    <a href='../functions/admin_logout.php' id='logout-button' class='right' style='margin-right: 10%;'>logout</a>
    <div id="logo">
        <img src="../images/mcs-logo.png" />
    </div>
    <h1 class='text-center'>MozillaSpaceMNL Visitors</h1>

    <div id='visitors' class="row">

    <div  id="filter" class="context">

          <div class="row">
              <div class="large-4 columns">
                  <input type="text" id="dateFrom" placeholder="Date From" />
              </div>

              <div class="large-4 columns">
                  <input type="text" id="dateTo" placeholder="Date To" />
              </div>


               <div class="large-4 columns">
                  <button id='loadVisitors' class="button tiny radius">Filter</button>
              </div>
            </div>





    </div>

      <table>
        <thead>
          <tr>
            <th colspan=2>Name</th>
            <th colspan=2>Organization</th>
            <th>Date / Time of Visit</th>
            <th>Date / Time of Checkin</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php if($users_count == 0) { ?>
          <tr>
            <td colspan=8 style='text-align: center;'>No Records Found</td>
          </tr>
        <?php } ?>
        <?php foreach($users as $user) { ?>
          <tr>
            <td colspan='2'>
            <a href="/visitmozilla/admin/user_profile.php?id=<?php echo $user['visitor_id']; ?>">
                <?php echo $user['salutation'].'. '.$user['first_name'].' '.$user['last_name']; ?>
              </a>
            </td>
            <td colspan=2><?php echo $user['organization']; ?></td>
            <td class='checked-in'>
            <?php
              echo date("M d,Y",strtotime($user['date_of_arrival']))."<br>";
              echo date("g:i a", strtotime($user['time_of_arrival']));
            ?>
            </td>
            <td>
              <?php
              $datetime_checked_in = $user['datetime_checked_in'];
              if($user['check_in_status'])
                echo date("M d, Y - g:i a", strtotime($datetime_checked_in));
              else
                echo '';
              ?>
            </td>
            <td style='text-align:center;'>
              <?php if($user['check_in_status'] == false){ ?>
                <button class='checkin tiny' data-id='<?php echo $user['appointment_id']; ?>'>
                  Checkin
                </button>
              <?php }else{ ?>
                <button class='checkin tiny success' data-id='<?php echo $user['appointment_id']; ?>'>
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
<script src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/foundation.min.js"></script>
<script>


$("#dateFrom").datepicker({ maxDate:new Date(), dateFormat: "yy-mm-dd"});
$("#dateTo").datepicker({ maxDate:new Date(), dateFormat: "yy-mm-dd"});

  $(document).on('click', '.checkin', function(){
    var that = $(this);
    var data = {
      id: $(this).attr('data-id')
    }
    $.ajax({
      url:'../functions/checkin.php',
      data: data,
      type:"POST",
      success: function(data){
        var resp = JSON.parse(data);
        if(resp.checked_in){
          that.css('background', '#43AC6A');
          that.text('checked-in');
          that.closest('td').prev('td').text(resp.check_in_date);
        }
        else{
          that.css('background', '#007095');
          that.text('checkin');
          that.closest('td').prev('td').text('');
        }
      }
    });
  });
</script>
<!-- END -->
</body>
</html>
