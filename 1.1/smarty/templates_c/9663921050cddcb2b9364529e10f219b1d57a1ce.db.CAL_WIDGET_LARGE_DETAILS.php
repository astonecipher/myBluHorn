<?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 14:47:47
         compiled from "db:cal_widget_large_details" */ ?>
<?php /*%%SmartyHeaderCode:102380057152a4bf9643ea97-52914378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9663921050cddcb2b9364529e10f219b1d57a1ce' => 
    array (
      0 => 'db:cal_widget_large_details',
      1 => 1386782451,
      2 => 'db',
    ),
    '6ea38b8bc40f696f0d798650f5ba443e2a32d3b0' => 
    array (
      0 => 'db:cal_widget_large_wrapper',
      1 => 1389210456,
      2 => 'db',
    ),
    'f194ace8218f488960cf34f3e47445e90bab93fb' => 
    array (
      0 => 'db:cal_widget_large_event_details',
      1 => 1388672321,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '102380057152a4bf9643ea97-52914378',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a4bf965372f2_82900556',
  'variables' => 
  array (
    'calDays' => 0,
    'calDay' => 0,
    'categories' => 0,
    'category' => 0,
    'fromDate' => 0,
    'toDate' => 0,
    'areas' => 0,
    'area' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a4bf965372f2_82900556')) {function content_52a4bf965372f2_82900556($_smarty_tpl) {?>

	<div class="buzz-calendar large-width">
		<div class="header ie-fix">
			<div class="container">
				<ul class="top-nav">
					<li><a class="ie-fix" href='javascript:calendarNextWeek("large");'><span>Next</span>Week</a></li>
					<li><a class="ie-fix" href='javascript:calendarThisMonth("large");'><span>This</span>Month</a></li>
					<li><a class="ie-fix" href='javascript:calendarNextMonth("large");'><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
				<div class="carousel" id="carousel-02">
					<ul class="slides" id="calendarDays">
					 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
						<li><a class='ie-fix' href='javascript:calendarGoTo("<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
")'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>
					 <?php } ?>
					</ul><!-- end slides -->
				</div><!-- end carousel -->
			</div><!-- end container -->
		</div><!-- end header -->
		<div class="events">
			<form action="#" id="buzz-search-form">
				<fieldset>
					<div class="holder">
						<div class="block">
							<h2><label for="lbl-01">find <span>events</span></label></h2>
							<div class="sel">
								<select id="lbl-01" class="sel-02" name="category">
									<option value="%">Category</option>
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
							</div><!-- end sel -->
						</div><!-- end block -->
						<div class="box">
							<label for="datepicker-01">from</label>
							<div class="text">
								<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['fromDate']->value;?>
" id="datepicker-01"  name="from"/>
								<label for="datepicker-01">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end box -->
						<div class="box">
							<label for="datepicker-02">to</label>
							<div class="text">
								<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['toDate']->value;?>
" id="datepicker-02" name="to"/>
								<label for="datepicker-02">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end box -->
						<div class="sel sel-02">
							<select id="lbl-04" class="sel-02" name="area">
								<option>All Areas</option>
									<?php  $_smarty_tpl->tpl_vars['area'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['area']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['areas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['area']->key => $_smarty_tpl->tpl_vars['area']->value){
$_smarty_tpl->tpl_vars['area']->_loop = true;
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['area']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['area']->value['name'];?>
</option>
									<?php } ?>
							</select>
						</div><!-- end sel -->
						<input type="text" class="text" value="" name="keywords" placeholder="Keywords..."/>
						<a href="javascript:calendarGo(this);" class="btn-go ie-fix"><span>GO</span><i>&nbsp;</i></a>
					</div><!-- end holder -->
				</fieldset>
			</form>
		</div><!-- end events -->

		<div class="container" id="buzz-calendar-container">

		


<?php /*  Call merged included template "db:CAL_WIDGET_LARGE_EVENT_DETAILS" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("db:CAL_WIDGET_LARGE_EVENT_DETAILS", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '102380057152a4bf9643ea97-52914378');
content_52cdab630d64b6_08813261($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "db:CAL_WIDGET_LARGE_EVENT_DETAILS" */?>




		</div><!-- end container -->
		<div class="footer ie-fix">
	<script type="text/javascript">

	(function() {
		$('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'></a></div>");
	});
	</script>

<?php if ($_smarty_tpl->tpl_vars['calDays']->value){?>
	<script type="text/javascript">
	(function() {
	
		var listedDays = "";
		$('#calendarDays').empty();;
//		$('#calendarDays').remove();
		 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
			listedDays += "<li><a class='ie-fix' href='javascript:calendarGoTo(\"<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
\")'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>";
//			$("carousel-02").addSlide("<li><a class='ie-fix' href='javascript:calendarGoTo(this);'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>");
		 <?php } ?>
		$('#calendarDays').html(listedDays);
		$('#carousel-02').flexslider(0);
	});

</script>
<?php }?>


	<script type="text/javascript">
	(function() {
		$('#datepicker-01').val("<?php echo $_smarty_tpl->tpl_vars['fromDate']->value;?>
");
	});
	</script>

	<script type="text/javascript">
	(function() {
		$('#datepicker-02').val("<?php echo $_smarty_tpl->tpl_vars['toDate']->value;?>
");
	});
	</script>
			<div class="container">
				<div class="holder" id="more-results">
					<div class="all-results">
						<a href="javascript:calendarViewAllResults(this);" class="opener" id="view-all-results" style="margin-left: -80px;"></a>
					</div><!-- end all-results -->
				</div><!-- end holder -->
			</div><!-- end container -->
			<div class="links ie-fix">
				<ul>
					<li><a href="javascript:calendarAddEvent(this);">add your events<i class="ico ico-01">ico</i></a></li>
					<li><a href="javascript:calendarTellAFriend(this);">tell a friend<i class="ico ico-02">ico</i></a></li>
					<li><a href="javascript:calendarSignUp(this);">newsletter sign-up<i class="ico ico-04">ico</i></a></li>
				</ul>
			</div><!-- end links -->
		</div><!-- end footer -->
	</div><!-- end buzz-calendar -->


	

	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/scripts.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/calendar.js"></script>

	 







<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 14:47:47
         compiled from "db:cal_widget_large_event_details" */ ?>
<?php if ($_valid && !is_callable('content_52cdab630d64b6_08813261')) {function content_52cdab630d64b6_08813261($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.replace.php';
?>			<br>
<div class="hide" id="address" style="display: none; visibility: hidden;"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
 <?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</div>
			<div class="heading-block ie-fix">
				<a href='javascript:calendarBackToSearch("<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
");' class="link-back">Back to search</a>
			</div><!-- end heading-block -->
			<div class="info-section">
				<div class="event-detailed">
					<div class="holder">
						<div class="img">
							<img src="http://www.filelogix.com/buzz/images/categories/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="170" height="161" alt="image" />
						</div><!-- end img -->
								<h1 style="width: 400px; display: inline; position: relative; top: 10px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['sTitle'];?>
</h1>
						<div class="description">
							<div class="box" style="width:405px;">
								<div class="social">
									<ul>
										<li><a href="#" class="facebook">facebook</a></li>
										<li><a href="#" class="twitter">twitter</a></li>
									</ul>
								</div><!-- end social -->
								<div class="frame">
									<div id="map" style="height: 250px; width: 250px; float: right; padding-left: 10px; margin-left: 10px;">
<?php if ($_smarty_tpl->tpl_vars['bGeocoded']->value){?>
										<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=near&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=<?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['lon']->value;?>
&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small><p>Location Gecoded</p>

<?php }else{ ?>
<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=near&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small><p>Location Not Geocoded</p>



<?php }?>
									</div><!-- end map -->

									<div class="desc">
										<div class="section">
											<strong class="title" style="padding: 0px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
</strong>
											<p><?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</p>
											<p><?php echo $_smarty_tpl->tpl_vars['event']->value['sCity'];?>
, <?php echo $_smarty_tpl->tpl_vars['event']->value['sState'];?>
  <?php echo $_smarty_tpl->tpl_vars['event']->value['sZipcode'];?>
</p>
										</div><!-- end section -->
										<p><?php echo $_smarty_tpl->tpl_vars['events']->value['phoneNumber'];?>
</p>
										<p><a href="http://<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['event']->value['uWebsite'],'http://','');?>
">Website</a></p>
										<div class="email">
											<a href="mailto:">EMAIL US</a>
										</div><!-- end email -->
									</div><!-- end desc -->
								</div><!-- end frame -->
							</div><!-- end box -->
							<div class="block">
								<span class="category" style="padding-left: 3px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</span>
								<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartDate'];?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tEndDate'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp1==$_tmp2){?> 
								<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['tDateStr'];?>
</em>
								<?php }else{ ?>
								<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartDate'];?>
 - <?php echo $_smarty_tpl->tpl_vars['event']->value['tEndDate'];?>
</em>
								<?php }?>
								<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tEndTime'];?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp3==$_tmp4){?> 
								<em class="time">Starts at <?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
</em>
								<?php }else{ ?>
								<em class="time"><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
 - <?php echo $_smarty_tpl->tpl_vars['event']->value['tEndTime'];?>
</em>
								<?php }?>
								<dl>
									<dt>Cost:</dt><dd><?php if ($_smarty_tpl->tpl_vars['event']->value['bFree']){?>FREE!<?php }else{ ?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['cost'])===null||$tmp==='' ? "TBA" : $tmp);?>
<?php }?></dd>
								</dl>
								<a href="#" class="btn-buy ie-fix">Buy Tickets</a>
								<a href="#" class="btn-contact ie-fix">Contact Venue<i>&nbsp;</i></a>
							</div><!-- end block -->
						</div><!-- end description -->
					</div><!-- end holder -->
					<div class="txt">
						<p style="font-size:18px/22px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['sDetails'];?>
</p>
					</div><!-- end txt -->
				</div><!-- end event-detailed -->
				<ul class="direction-nav direction-nav2">
					<li><a href="#" class="prev">view previous</a></li>
					<li><a href="#" class="next">View more</a></li>
				</ul><!-- end direction-nav -->
			</div><!-- end info-section -->


<?php }} ?>