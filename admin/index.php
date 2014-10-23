<?php
require_once '../functions/list_visitors.php';
require_once '../functions/admin_session.php';
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
        <?php if(mysqli_num_rows($execute_select_all_visitors_query) == 0) { ?>
          <tr>
            <td colspan=8 style='text-align: center;'>No Records Found</td>
          </tr>
        <?php } ?>
        <?php while($visitor = mysqli_fetch_array($execute_select_all_visitors_query)) { ?>
          <tr>
            <td colspan='2'>
            <a href="/visitmozilla/admin/visitor_profile.php?email=<?php echo $visitor['email_address']; ?>">
                <?php echo $visitor['salutation'].'. '.$visitor['first_name'].' '.$visitor['last_name']; ?>
              </a>
            </td>
            <td colspan=2><?php echo $visitor['organization']; ?></td>
            <td class='checked-in'>
            <?php
            echo date("M d,Y",strtotime($visitor['date_of_arrival']))."<br>";
            echo date("g:i a", strtotime($visitor['time_of_arrival']));
            ?>
            </td>
            <td>
              <?php

              $dt_chkin=$visitor['datetime_checked_in'];
              if(!empty($dt_chkin))
              echo date("M d, Y - g:i a", strtotime($dt_chkin));
              else
                echo '';

              ?>
            </td>
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
      url:'/visitmozilla/functions/checkin.php',
      data: data,
      type:"POST",
      success: function(data){
        var datetime_check_in = JSON.parse(data);
        console.log(datetime_check_in);
        if(datetime_check_in.success){
          that.css('background', '#43AC6A');
          that.text('checked-in');
          that.closest('td').prev('td').text(datetime_check_in.check_in_date);
        }
        else{
          that.css('background', '#007095');
          that.text('checkin');
          that.closest('td').prev('td').text(datetime_check_in.check_in_date);
        }
      }
    });
  });
</script>
<!-- END -->
</body>
</html>
