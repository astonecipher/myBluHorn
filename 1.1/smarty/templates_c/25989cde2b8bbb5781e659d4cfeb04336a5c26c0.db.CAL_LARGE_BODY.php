<?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 14:46:03
         compiled from "db:cal_large_body" */ ?>
<?php /*%%SmartyHeaderCode:193891983652a0d9d02a9ef4-19807412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25989cde2b8bbb5781e659d4cfeb04336a5c26c0' => 
    array (
      0 => 'db:cal_large_body',
      1 => 1389210260,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '193891983652a0d9d02a9ef4-19807412',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a0d9d02da265_77455130',
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
    'events' => 0,
    'event' => 0,
    'previousFrom' => 0,
    'previousTo' => 0,
    'nextFrom' => 0,
    'nextTo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a0d9d02da265_77455130')) {function content_52a0d9d02da265_77455130($_smarty_tpl) {?>


	<div class="buzz-calendar large-width" >
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
								<option value="%">All Areas</option>
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
		<div class="container hide" id="buzz-calendar-container-event"></div>
		<div class="container" id="buzz-calendar-container" >


			<div class="info-section" >
				<div class="scrollable-area" >
					<ul id="list-large-event">

			<div class="heading-block ie-fix" style="display: none; visibility: hidden;">
				<h2>Showing events for OCTOBER 25, 2013</h2>
			</div><!-- end heading-block -->
			
						<br>

						<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
						<li class="sponsored-visible">
							<div class="img">
								<a href="#"><img src="http://www.filelogix.com/buzz/images/categories/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="176" height="167" alt="image" /></a>
							</div><!-- end img -->
							<div class="description">
								<div class="box">
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
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['sCity'])===null||$tmp==='' ? '' : $tmp);?>
, <?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['sState'])===null||$tmp==='' ? '' : $tmp);?>
</p>
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['sZipcode'])===null||$tmp==='' ? '' : $tmp);?>
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
								<div class="block">
									<h2><?php echo substr($_smarty_tpl->tpl_vars['event']->value['title'],0,75);?>
</h2>
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
								<strong class="sponsored"><span>sponsored event ad</span></strong>
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
		</div><!-- end container -->
		<div class="footer ie-fix">
			<div class="container">
				<div class="holder" id="more-results">
					<div class="all-results">
						<a href="javascript:calendarViewAllResults(this);" class="opener" id="view-all-results" style="margin-left: -80px;">Found <?php echo count($_smarty_tpl->tpl_vars['events']->value);?>
 Results</a>
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




 
<?php }} ?>