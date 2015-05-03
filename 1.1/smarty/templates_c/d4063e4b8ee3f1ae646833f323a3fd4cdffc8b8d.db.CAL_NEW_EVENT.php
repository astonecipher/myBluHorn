<?php /* Smarty version Smarty-3.1.13, created on 2013-10-16 17:48:31
         compiled from "db:cal_new_event" */ ?>
<?php /*%%SmartyHeaderCode:19265182515240362f358ee0-09860665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4063e4b8ee3f1ae646833f323a3fd4cdffc8b8d' => 
    array (
      0 => 'db:cal_new_event',
      1 => 1381974508,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1380673290,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '19265182515240362f358ee0-09860665',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5240362f3de6e8_83623654',
  'variables' => 
  array (
    'navHomeActive' => 0,
    'navCreateActive' => 0,
    'navManageActive' => 0,
    'navShareActive' => 0,
    'navSupportActive' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5240362f3de6e8_83623654')) {function content_5240362f3de6e8_83623654($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/buzz/">
    <meta charset="utf-8">
    <title>BUZZ Calendar Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<meta http-equiv="cache-control" content="no-cache"> 
<meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/> 
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

    <!-- Le styles -->
    <link href="/buzz/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/buzz/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/buzz/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/buzz/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/buzz/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/buzz/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/buzz/=/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/buzz/assets/ico/favicon.png">

   
	<link media="all" rel="stylesheet" type="text/css" href="/buzz/css/bootstrap-datetimepicker.min.css" />
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-switch.css" />


   


  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="calendar/home">BUZZ Calendar</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/home">Home</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navCreateActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/add">Create</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navManageActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/manage">Manage</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navShareActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/share">Share</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navSupportActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/support">Support</a></li>
              <li><a href="/buzz/calendar/logout">Logout</a></li>
            </ul>
          </div>



        </div>
      </div>
    </div>

    <div class="container">


<form method="post" name="eventAdd" action="calendar/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['formAction']->value)===null||$tmp==='' ? "add" : $tmp);?>
">
<div class="container">
  <div class="row">
	<div class="span12">
		<div class="row">
			<?php if ($_smarty_tpl->tpl_vars['alertSuccess']->value){?><div class="span8 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['successMsg']->value;?>
</div><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['alertInfo']->value){?><div class="span8 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['infoMsg']->value;?>
</div><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['alertWarning']->value){?><div class="span8 alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['warningMsg']->value;?>
</div><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?><div class="span8 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div><?php }?>
		</div>
		<div class="row">
			<div class="span4">
				<label>Title</label>
				<input type="text" class="span4" placeholder="1 Event Title" name="eventTitle" value="<?php echo $_smarty_tpl->tpl_vars['eventTitle']->value;?>
">
			</div>		  
			<div class="span4">
			    	<label>Category</label>
				<select id="category" name="category" class="span4">
					<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
					<?php } ?>
				</select>			
			</div>
		</div>
		<div class="row">
			<div class="span3">
	 			<label>Starts?</label>
				<div id="datetimepicker-from"  class="input-append" style="">
				    <input class="span2" data-format="yyyy-MM-dd HH:mm PP" type="text" name="startDateTime" value="<?php echo $_smarty_tpl->tpl_vars['startDateTime']->value;?>
"></input>
				    <span class="add-on ">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>
			</div>
	
			<div class="span3">
 				<label>Ends?</label>
				<div id="datetimepicker-to" class="input-append">
				    <input class="span2" data-format="yyyy-MM-dd HH:mm PP" type="text" name="endDateTime" value="<?php echo $_smarty_tpl->tpl_vars['endDateTime']->value;?>
"></input>
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>
			</div>

			<div class="span2">
				<label>Repeats?</label>
				<div id="recurring-switch" class="make-switch" data-on-label="Yes" data-off-label="No" style="margin-bottom: 10px;" data-on="success">
				    <input type="checkbox" id="repeatCheckbox" onChange="javascript:toggleRecurring(this);" name="eventRepeats" value="yes" <?php if ($_smarty_tpl->tpl_vars['eventRepeats']->value){?>checked<?php }?>>
				</div>
			</div>

		</div>

		<div class="row">
		<br>
			<div class="well span7 hide" id="recurring">
	
				<div class="span2">
					<label>How Often?</label>
					<select name="repeatFreq" class="span2" id="repeatFreq">
						<option value="D">Daily</option>
						<option value="W">Weekly</option>
						<option value="M">Monthly</option>
					 </select>
				</div>

				<div class="span2 hide" id="daily">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenDaily">
						<option value="E">Every Day</option>
						<option value="O">Every Other Day</option>
					 </select>
				</div>

				<div class="span2 hide" id="weekly">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenWeekly">
						<option value="E">Every Week</option>
						<option value="O">Every Other Week</option>
						<option value="EW">Every Weekend</option>
						<option value="EOW">Every  Other Weekend</option>
					 </select>
				</div>

				<div class="span2 hide" id="monthly">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenMonthly">
						<option value="1">1st</option>
						<option value="2">2nd</option>
						<option value="3">3rd</option>
						<option value="4">4th</option>
						<option value="L">Last</option>
					 </select>
					<label>Day</label>
					<select name="repeatDay" class="span2" id="repeatDayMonthly" >
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
					 </select>
				</div>
				<div class="span2">
					<label>Stop Repeating?</label>
					<div id="datetimepicker-stop" class="input-append">
						    <input class="span2" data-format="yyyy/MM/dd" type="text" name="stopRepeating" value="<?php echo $_smarty_tpl->tpl_vars['stopRepeating']->value;?>
"></input>
						    <span class="add-on">
						      		<i data-time-icon="icon-time" data-date-icon="icon-calendar">
							        </i>
						    </span>
					 </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div id="locationBox" class="span4">
				<label>Location</label>
				<select id="location" name="eventLocation" class="span4">
					<option value="new">New Location</option>
					<?php  $_smarty_tpl->tpl_vars['location'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['location']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['locations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['location']->key => $_smarty_tpl->tpl_vars['location']->value){
$_smarty_tpl->tpl_vars['location']->_loop = true;
?> 
						<option value="<?php echo $_smarty_tpl->tpl_vars['location']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['location']->value['sName'];?>
</option>
					<?php } ?>
				</select>	
				<textarea name="newLocation" id="newLocation" class="input-xlarge span4" rows="7" placeholder="Enter New Location Here" <?php echo $_smarty_tpl->tpl_vars['locationDisabled']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['locationReadOnly']->value;?>
><?php echo $_smarty_tpl->tpl_vars['newLocation']->value;?>
</textarea>
				<input type="hidden" name="prevLocation" value="<?php echo $_smarty_tpl->tpl_vars['newLocation']->value;?>
">
			</div>
				
			<div class="span4">

				<label>Brief Description</label>
				<textarea name="eventDescription" id="description" class="input-xxlarge span4" style="resize: none;" rows="7"><?php echo $_smarty_tpl->tpl_vars['eventDescription']->value;?>
</textarea>

			</div>
			<div id="ticketed-switch" class="make-switch  span4" data-on-label="Ticketed" data-off-label="Free / No Charge" data-on="success" data-off="primary" >
				    <input type="checkbox" name="eventTicketed"  id="eventTicketed" onChange="javascript:toggleTicketed(this);" value="yes" <?php if ($_smarty_tpl->tpl_vars['eventTicketed']->value){?>checked<?php }?>>
			</div>
		</div>
		<div class="row">&nbsp;
		</div>
		<div class="row">

		       <div class="well span7 hide" id="ticketed">
					<div class="span2">
					<label>Cost?</label>
					 <input type="text" class="money span1" name="eventCost" placeholder="0.00" value="<?php echo $_smarty_tpl->tpl_vars['eventCost']->value;?>
">
					</div>
					<div class=span3">
					<label>Ticketing Website:</label>
					 <input type="text" class="span4" name="ticketURL" placeholder="http://" value="<?php echo $_smarty_tpl->tpl_vars['ticketURL']->value;?>
">
					</div>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<label>Event Details</label>
				<textarea name="eventDetails" id="message" class="input-xlarge span8" rows="7" name="eventDetails"><?php echo $_smarty_tpl->tpl_vars['eventDetails']->value;?>
</textarea>
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<label>Link to the Event:<label><input type="text" class="input-xlarge span8" name="eventLink" placeholder="http://" value="<?php echo $_smarty_tpl->tpl_vars['eventLink']->value;?>
">
			</div>
		</div>
		<div class="row">

			<div class="span8 centered">
				<p class="btn-toolbar pull-right">
					<input type="hidden" name="locationDisabled" value="<?php echo $_smarty_tpl->tpl_vars['locationDisabled']->value;?>
">
					<input type="hidden" name="locationReadOnly" value="<?php echo $_smarty_tpl->tpl_vars['locationReadOnly']->value;?>
">
					<input type="hidden" name="returnURL" value="<?php echo $_smarty_tpl->tpl_vars['returnURL']->value;?>
">
					<input type="hidden" name="categoryID" value="<?php echo $_smarty_tpl->tpl_vars['categoryID']->value;?>
">
					<input type="hidden" name="locationID" value="<?php echo $_smarty_tpl->tpl_vars['locationID']->value;?>
">
					<input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
					<input type="hidden" name="formAction" value="<?php echo $_smarty_tpl->tpl_vars['formAction']->value;?>
">
					<input type="hidden" name="eventID" value="<?php echo $_smarty_tpl->tpl_vars['eventID']->value;?>
">
					<input type="submit" class="btn btn-primary" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
					<button class="btn" onClick="window.location.href='<?php echo $_smarty_tpl->tpl_vars['returnURL']->value;?>
';">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</div>

</form>


    </div>


    <script type="text/javascript" src="/js/jquery-1.8.1.min.js"></script>

    <script type="text/javascript" src="/js/bootstrap.min.js"/></script>
 
    



<script type="text/javascript" src="/buzz/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/buzz/js/jquery.bootstrap-money-field.js"></script>
<script type="text/javascript" src="/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-transition.js"></script>


<script type="text/javascript">

  var options = {
     width: 80 // The css width to be applied to the textfield
  };
  $('.money').money_field(options); 


  var startDate = new Date(Date.UTC(2013, 08,27, 15,50));
  var maxDate = new Date(Date.UTC(1998, 10, 11, 4, 30));

  $(function() {
    $('#datetimepicker-from').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
    });
  });
  $(function() {
    $('#datetimepicker-to').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
      startDate: new Date(2013, 7, 20),
      endDate: new Date(2014, 12, 31)
    });
  });
    $(function() {
    $('#datetimepicker-stop').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
      pickTime: false,
      startDate: new Date(2013, 10, 01),
      endDate: new Date(2014, 12, 31)
    });
  });

$('#datetimepicker-from').on('changeDate', function(e) {
  console.log(e.date.toString());
  console.log(e.localDate.toString());
  setToStartDate(new Date(2013,7,29));

});


  function setToStartDate(startDate) {
     console.log("setToStartDate");
     $('#datetimepicker-to').datetimepicker({
      startDate: this.startDate
   });
  }

</script>

<script>
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioState');
    });
    // or
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioStateAllowUncheck');
    });
    // or
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioStateAllowUncheck', false);
    });
</script>



<script type="text/javascript">
	$("#category").val("<?php echo $_smarty_tpl->tpl_vars['categoryID']->value;?>
");
	$("#location").val("<?php echo $_smarty_tpl->tpl_vars['locationID']->value;?>
");

	toggleRecurring(getElementById('repeatCheckbox'));
	toggleTicketed(getElementById('eventTicketed'));

	function toggleRecurring(checkbox) {
	

		if (checkbox.checked) {
			$('#recurring').slideDown();
		}
		else {
			$('#recurring').slideUp();
		}
	}

	function toggleTicketed(checkbox) {
	

		if (checkbox.checked) {
			$('#ticketed').slideDown();
		}
		else {
			$('#ticketed').slideUp();
		}
	}

</script>

  </body>
</html>



<?php }} ?>