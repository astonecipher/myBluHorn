<?php /* Smarty version Smarty-3.1.13, created on 2013-10-02 23:22:41
         compiled from "db:cal_home" */ ?>
<?php /*%%SmartyHeaderCode:8843970805240362c3d0a06-36872884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57cd32a3566d2595806d439d209bca474df0d121' => 
    array (
      0 => 'db:cal_home',
      1 => 1380784959,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1380673290,
      2 => 'db',
    ),
    '0c3224fb63940ed4bf857414f14276ea96332c42' => 
    array (
      0 => 'db:events_table',
      1 => 1380666349,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '8843970805240362c3d0a06-36872884',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5240362c440c57_86664878',
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
<?php if ($_valid && !is_callable('content_5240362c440c57_86664878')) {function content_5240362c440c57_86664878($_smarty_tpl) {?><!DOCTYPE html>
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
	<link rel="stylesheet" href="/css/DT_bootstrap.css"/>


   


	<link rel="stylesheet" type="text/css" href="/css/DT_bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/TableTools.css">
 
       <script type="text/javascript" src="js/jquery.js"></script>
       <script type="text/javascript" src="js/bootstrap.min.js"/></script>



 <script type="text/javascript" src="/js/canvasjs.min.js"></script>

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


<h3>
Calendar: Master
</h3>
<div class="container span11" style="padding-bottom: 50px;">
<?php /*  Call merged included template "db:EVENTS_TABLE" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("db:EVENTS_TABLE", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '8843970805240362c3d0a06-36872884');
content_524ce30166a659_20001860($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "db:EVENTS_TABLE" */?>
</div>

<div class="container">
<div class="span5">
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
</div>
<div class="offset1 span5" >
<div id="chartContainer2" style="height: 300px;"></div>
</div>
</div>


    </div>


    <script type="text/javascript" src="/js/jquery-1.8.1.min.js"></script>

    <script type="text/javascript" src="/js/bootstrap.min.js"/></script>
 
    


<script>
$("#calendar").load("http://www.filelogix.com/cscmp/events");
</script>




	<script type="text/javascript" src="/js/lodash.min.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/release-datatables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="/js/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/js/TableTools.min.js"></script>

<script type="text/javascript" src="/js/datatables.responsive.js"></script>

<script type="text/javascript">

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
   "datetime-us-pre": function ( a ) {
       var b = a.match(/(\d{1,2})\/(\d{1,2})\/(\d{2,4}) (\d{1,2}):(\d{1,2}) (am|pm|AM|PM|Am|Pm)/),
           month = b[1],
           day = b[2],
           year = b[3],
           hour = b[4],
           min = b[5],
           ap = b[6];
 
       if(hour == '12') hour = '0';
       if(ap == 'pm') hour = parseInt(hour, 10)+12;
 
       if(year.length == 2){
           if(parseInt(year, 10)<70) year = '20'+year;
           else year = '19'+year;
       }
       if(month.length == 1) month = '0'+month;
       if(day.length == 1) day = '0'+day;
       if(hour.length == 1) hour = '0'+hour;
       if(min.length == 1) min = '0'+min;
 
       var tt = year+month+day+hour+min;
       return  tt;
   },
   "datetime-us-asc": function ( a, b ) {
       return a - b;
   },
 
   "datetime-us-desc": function ( a, b ) {
       return b - a;
   }
});
 
jQuery.fn.dataTableExt.aTypes.unshift(
   function ( sData )
   {
       if (sData !== null && sData.match(/\d{1,2}\/\d{1,2}\/\d{2,4} \d{1,2}:\d{1,2} (am|pm|AM|PM|Am|Pm)/))
       {
 
           return 'datetime-us';
       }
       return null;
   }
);



$(document).ready(function() {
	$('#events').dataTable( {
		"sDom": "T<'row'><'row'<'span3'l><'span11'f>r>t<'row'<'span11 small'i><'span11'p>>",
		"sPaginationType": "bootstrap",
		"bStateSave": true,
		
		"oTableTools": {
			"sSwfPath": "/swf/copy_csv_xls_pdf.swf", 			
			"aButtons": [ "copy", "csv", "xls", "pdf" ]
		},
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		},
		"aoColumns": [
			{ "bSortable": true },
			{ "bSortable": true },
			{ "bSortable": true },
			{ "bSortable": true },
			{ "bSortable": true,  "sType": "datetime-us" },
		]

	} );
	


} );

$('#events').show();


</script>


 <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer1",
    {

      title:{
      text: "Events Coming Up"
      },
       data: [
      {
        type: "line",

        dataPoints: [

	<?php  $_smarty_tpl->tpl_vars['left'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['left']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chartLeft']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['left']->key => $_smarty_tpl->tpl_vars['left']->value){
$_smarty_tpl->tpl_vars['left']->_loop = true;
?> 
        { x: new Date(<?php echo $_smarty_tpl->tpl_vars['left']->value['year'];?>
, <?php echo $_smarty_tpl->tpl_vars['left']->value['month']-1;?>
, <?php echo $_smarty_tpl->tpl_vars['left']->value['day'];?>
), y: <?php echo $_smarty_tpl->tpl_vars['left']->value['count'];?>
 },
 
        <?php } ?>
        ]
      }
      ]
    });

    chart.render();

   var chart2 = new CanvasJS.Chart("chartContainer2",
    {

      title:{
      text: "Events Viewed"
      },
       data: [
      {
        type: "area",

        dataPoints: [
	<?php $_smarty_tpl->tpl_vars['rightSum'] = new Smarty_variable(0, null, 0);?>
 	<?php  $_smarty_tpl->tpl_vars['right'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['right']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chartRight']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['right']->key => $_smarty_tpl->tpl_vars['right']->value){
$_smarty_tpl->tpl_vars['right']->_loop = true;
?> 
	<?php $_smarty_tpl->tpl_vars['rightSum'] = new Smarty_variable($_smarty_tpl->tpl_vars['rightSum']->value+$_smarty_tpl->tpl_vars['right']->value['count'], null, 0);?>
        { x: new Date(<?php echo $_smarty_tpl->tpl_vars['right']->value['year'];?>
, <?php echo $_smarty_tpl->tpl_vars['right']->value['month'];?>
, <?php echo $_smarty_tpl->tpl_vars['right']->value['day'];?>
), y: <?php echo $_smarty_tpl->tpl_vars['rightSum']->value;?>
 },
 
        <?php } ?>    
        ]
      }
      ]
    });

    chart2.render();
  }
  </script>





  </body>
</html>



<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2013-10-02 23:22:41
         compiled from "db:events_table" */ ?>
<?php if ($_valid && !is_callable('content_524ce30166a659_20001860')) {function content_524ce30166a659_20001860($_smarty_tpl) {?>					<h3>
						Upcoming Events
					</h3>
					<table class="table table-bordered table-striped hide" id="events">
						<thead>
							<tr>
								<th>
									Title
								</th>
								<th>
									Category
								</th>
								<th>
									Location
								</th>
								<th>
									Starts
								</th>
								<th>
									Ends
								</th>										
							</tr>
						</thead>
						<tbody>

							<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>

																			<tr>

								<td> 
									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
" class="">
									<?php echo $_smarty_tpl->tpl_vars['event']->value['title'];?>

									</a>
								</td>
								<td style="text-align: center;">									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
" class="view-link">
<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>

</a>
								</td>
								<td style="text-align: center;">									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
" class="view-link">
<?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>

</a>
								</td>
								<td>

									<?php echo $_smarty_tpl->tpl_vars['event']->value['tStartStr'];?>

								</td>
								<td>

									<?php echo $_smarty_tpl->tpl_vars['event']->value['tEndStr'];?>

								</td>
							</tr>

							<?php continue 1?>
							<?php } ?>
						</tbody>
				</table>



</div>


<?php }} ?>