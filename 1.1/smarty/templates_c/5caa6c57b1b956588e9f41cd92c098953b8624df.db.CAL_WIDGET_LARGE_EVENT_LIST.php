<?php /* Smarty version Smarty-3.1.13, created on 2014-01-02 09:36:54
         compiled from "db:cal_widget_large_event_list" */ ?>
<?php /*%%SmartyHeaderCode:148704192452a4c7a0a888d5-95727947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5caa6c57b1b956588e9f41cd92c098953b8624df' => 
    array (
      0 => 'db:cal_widget_large_event_list',
      1 => 1388673372,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '148704192452a4c7a0a888d5-95727947',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a4c7a0b32527_46095047',
  'variables' => 
  array (
    'events' => 0,
    'event' => 0,
    'previousFrom' => 0,
    'previousTo' => 0,
    'nextFrom' => 0,
    'nextTo' => 0,
    'calDays' => 0,
    'calDay' => 0,
    'fromDate' => 0,
    'toDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a4c7a0b32527_46095047')) {function content_52a4c7a0b32527_46095047($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.truncate.php';
?>
			<?php if (!$_smarty_tpl->tpl_vars['events']->value){?>
				<br>
				<div class="heading-block ie-fix" >
					<h2>No Events To Display.</h2>
				</div>
			<?php }?>	
			<div class="info-section">
			<div class="scrollable-area">

					<ul id="list-large-event">

<!--
			<div class="heading-block ie-fix" style="display: none; visibility: hidden;">
				<h2>Showing events for OCTOBER 25, 2013</h2>
			</div>
-->			
<!-- end heading-block -->
						<br>



						<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
						<li <?php if ($_smarty_tpl->tpl_vars['event']->value['isSponsored']){?>class="sponsored-visible"<?php }?> >
						
							<div class="img">
								<a href="#"><img src="http://www.filelogix.com/buzz/images/categories/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="176" height="167" alt="image" /></a>
							</div><!-- end img -->
							<div class="description">
								<div class="box">
									<br><br>
									<div class="social">
										<ul>
											<li><a href="#" class="facebook">facebook</a></li>
											<li><a href="#" class="twitter">twitter</a></li>
										</ul>
									</div><!-- end social -->
									<div class="section">
										<strong class="title" style="letter-spacing: 0px;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['locationName'])===null||$tmp==='' ? 'Location TBD' : $tmp);?>
</strong>
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['zAddress'])===null||$tmp==='' ? 'No Address' : $tmp);?>
</p>
										<p><?php echo $_smarty_tpl->tpl_vars['event']->value['sCity'];?>
, <?php echo $_smarty_tpl->tpl_vars['event']->value['sState'];?>
  <?php echo $_smarty_tpl->tpl_vars['event']->value['sZipcode'];?>
</p>
									</div><!-- end section -->
									<p>Ph: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['phoneNumber'])===null||$tmp==='' ? '' : $tmp);?>
</p>
									<div class="email">
										<p><a href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['website'])===null||$tmp==='' ? 'javascript:void();' : $tmp);?>
">VISIT WEBSITE</a></p>
										<a href="mailto:<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['emailAddress'])===null||$tmp==='' ? 'void(0);' : $tmp);?>
">EMAIL US</a>
									</div><!-- end email -->
								</div><!-- end box -->
								<h2  style="overflow: visible; overflow-y: visible; padding-top: 10px;" id="event-<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['title'],42,"...",true);?>
</h2>
								<div class="block">
									<!--<h2  id="event-<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['event']->value['title'],0,250);?>
</h2>-->
									<span class="category"><?php echo substr($_smarty_tpl->tpl_vars['event']->value['categoryName'],0,75);?>
</span>
									<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
									<p><?php echo $_smarty_tpl->tpl_vars['event']->value['description'];?>
</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="javascript:calendarGoToEvent(<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
);">Read More</a>
								</div><!-- end more -->
								<?php if ($_smarty_tpl->tpl_vars['event']->value['isSponsored']){?><strong class="sponsored"><span>sponsored event ad</span></strong><?php }?>
							</div><!-- end alignbottom -->
						</li>



						<?php } ?>

					</ul>
				</div><!-- end scrollable-area -->
               			 <div class="event-detailed" style="display:none"></div>
				 <ul class="direction-nav">
					<li><a href='javascript:calendarPrevious("large","<?php echo $_smarty_tpl->tpl_vars['previousFrom']->value;?>
","<?php echo $_smarty_tpl->tpl_vars['previousTo']->value;?>
");' class="prev">view previous</a></li>
					<li><a href='javascript:calendarNext("large","<?php echo $_smarty_tpl->tpl_vars['nextFrom']->value;?>
","<?php echo $_smarty_tpl->tpl_vars['nextTo']->value;?>
");' class="next">View more</a></li>
				 </ul><!-- end direction-nav -->
			</div><!-- end info-section -->

<?php if ($_smarty_tpl->tpl_vars['calDays']->value){?>
	<script type="text/javascript">
		var listedDays = "";
		jQuery('#calendarDays').empty();;
		 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
			listedDays += "<li><a class='ie-fix' href='javascript:calendarGoTo(\"<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
\")'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>";
		 <?php } ?>
		jQuery('#calendarDays').html(listedDays);
		jQuery('#carousel-02').flexslider(0);


</script>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['fromDate']->value){?>
	<script type="text/javascript">
		jQuery('#datepicker-01').val("<?php echo $_smarty_tpl->tpl_vars['fromDate']->value;?>
");
	</script>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['toDate']->value){?>
	<script type="text/javascript">
		jQuery('#datepicker-02').val("<?php echo $_smarty_tpl->tpl_vars['toDate']->value;?>
");
	</script>
<?php }?>

<script type="text/javascript">
	jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'>Found <?php echo count($_smarty_tpl->tpl_vars['events']->value);?>
 Results</a></div>");

</script>
<?php }} ?>