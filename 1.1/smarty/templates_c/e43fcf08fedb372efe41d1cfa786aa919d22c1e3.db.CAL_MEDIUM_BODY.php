<?php /* Smarty version Smarty-3.1.13, created on 2013-12-24 16:35:11
         compiled from "db:cal_medium_body" */ ?>
<?php /*%%SmartyHeaderCode:92525929652b991a4d4b8c4-06805969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e43fcf08fedb372efe41d1cfa786aa919d22c1e3' => 
    array (
      0 => 'db:cal_medium_body',
      1 => 1387938907,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '92525929652b991a4d4b8c4-06805969',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b991a4e221d1_93842658',
  'variables' => 
  array (
    'calDays' => 0,
    'calDay' => 0,
    'categories' => 0,
    'category' => 0,
    'fromDate' => 0,
    'toDate' => 0,
    'events' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b991a4e221d1_93842658')) {function content_52b991a4e221d1_93842658($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.truncate.php';
?>	<div class="buzz-calendar width-433">
		<div class="header ie-fix">
			<div class="holder">
				<strong class="logo"><a href="#">BUZZ</a></strong>
				<ul class="top-nav">
					<li><a class="ie-fix" href="javascript:calendarMediumNextWeek();"><span>Next</span>Week</a></li>
					<li><a class="ie-fix" href="javascript:calendarMediumThisMonth();"><span>This</span>Month</a></li>
					<li><a class="ie-fix" href="javascript:calendarMediumNextMonth();"><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
			</div><!-- end holder -->
			<div class="frame">
				<ul class="social">
					<li><a href="#" class="facebook">facebook</a></li>
					<li><a href="#" class="twitter">twitter</a></li>
					<li><a href="#" class="rss">rss</a></li>
				</ul><!-- end social -->
				<h1>Events Calendar</h1>
			</div><!-- end frame -->
			<div class="carousel" id="carousel-03">
				<ul class="slides">
					 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
						<li><a class='ie-fix' href='javascript:calendarMediumGoTo("<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
")'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>
					 <?php } ?>
				</ul><!-- end slides -->
			</div><!-- end carousel -->
		</div><!-- end header -->
		<div class="events">
			<form action="#" id="buzz-search-form">
				<fieldset>
					<div class="top">
						<div class="block">
							<h2><label for="lbl-01">find <span>events</span></label></h2>
							<div class="sel">
								<select id="lbl-01" name="category">
									<option value="99">Category</option>
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
" id="datepicker-02" name="to" />
								<label for="datepicker-02">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end box -->
					</div><!-- end top -->
					<strong class="title" style="padding-bottom: 2px;"><label for="lbl-04">or</label></strong>
					<div class="bottom">
						<div class="sel">
							<select id="lbl-04" name="area">
								<option value="">Area of Town</option>
							</select>
						</div><!-- end sel -->
						<input type="text" class="text" name="keywords"  placeholder="Keywords..."/>
						<a href='javascript:calendarMediumGo(this);' class="btn-go ie-fix"><span>GO</span><i>&nbsp;</i></a>
					</div><!-- end bottom -->
				</fieldset>
			</form>
		</div><!-- end events -->
<div id="buzz-container-01">
		<div class="info-section" id="info-section-01" >
			<div class="scrollable-area" id="buzz-scrollable-area-01">
				<ul id="buzz-result-section-01">
				<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
					<li <?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?>class="sponsored-visible"<?php }?>>
						<div class="img">
							<a href="#"><img src=http://www.filelogix.com/buzz/images/categories/square/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
 width="77" height="73" alt="i<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
" /></a>
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
									<strong class="title"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
</strong>
									<p><?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</p>
								</div><!-- end section -->
								<!--<p>Ph: <?php echo $_smarty_tpl->tpl_vars['event']->value['phoneNumber'];?>
</p>-->
								<p><a href="<?php echo $_smarty_tpl->tpl_vars['event']->value['uWebsite'];?>
">WEBSITE</a></p>
								<div class="email">
									<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['event']->value['emailAddress'];?>
">EMAIL US</a>
								</div><!-- end email -->
							</div><!-- end box -->
							<div class="block" style="width: 250px;">
								<div class="holder">
									<a href='javascript:window.location.href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
&" + jQuery("#buzz-search-form").serialize();' style="text-decoration:none;"><h2 style="height: auto; overflow: hidden;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sTitle'],35,'..',true);?>
</h2></a>
									<span class="category"><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</span>
									<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
									<p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sDescription'],200,'..',true);?>
</p>
									<div class="more" style="display: inline;">
										<a href='javascript:window.location.href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
&" + jQuery("#buzz-search-form").serialize();' style="padding: 2px 0 0 8px;">Read More</a>
									</div><!-- end more -->
								</div><!-- end holder -->
							</div><!-- end block -->
						</div><!-- end description -->
						<?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?><strong class="sponsored">sponsored event ad</strong><?php }?>					</li>
				<?php } ?>

				</ul>
			</div><!-- end scrollable-area -->
</div>
					<div id="buzz-calendar-popup-add-event">

			</div>
</div>

		<div class="footer ie-fix" >
			<div class="holder">
				<a href="#" class="btn-newsletter ie-fix">Newsletter<i>&nbsp;</i></a>
			</div><!-- end holder -->
						<ul class="links ie-fix" style="font-size:12px/14px;">
							<li style="font:12px/14px 'MyriadProBold', sans-serif;"><a href="javascript:calendarMediumAddEvent()" style="font:12px/14px 'MyriadProBold', sans-serif;">add your events<i class="ico ico-01">ico</i></a></li>
							<li style="font:12px/14px 'MyriadProBold', sans-serif;"><a href="javascript:calendarMediumTellAFriend()">tell a friend<i class="ico ico-02">ico</i></a></li>
							<li style="font:12px/14px 'MyriadProBold', sans-serif;"><a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar">view all events on iwantaBUZZ.com<i class="ico ico-03">ico</i></a></li>
						</ul><!-- end links -->
		</div><!-- end footer -->
	</div><!-- end buzz-calendar -->


	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/scripts.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/calendar.js"></script>


	<script type="text/javascript">
		//jQuery("#buzz-calendar-popup-add-event").hide();

	</script>

 
<?php }} ?>