<?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 15:24:34
         compiled from "db:cal_small_body" */ ?>
<?php /*%%SmartyHeaderCode:71030831952a1de08078df0-73978562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e52ecb53f9c7b01ea5f6061d6c7910da352b2ec' => 
    array (
      0 => 'db:cal_small_body',
      1 => 1389209979,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '71030831952a1de08078df0-73978562',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a1de0809bb25_34624606',
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
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a1de0809bb25_34624606')) {function content_52a1de0809bb25_34624606($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.truncate.php';
?>
	<div class="buzz-calendar">
		<div class="header ie-fix">
			<div class="holder">
				<strong class="logo"><a href="http://www.iwantabuzz.com/">BUZZ</a></strong>
				<ul class="top-nav">
					<li><a class="ie-fix" href='javascript:calendarSmallNextWeek();'><span>Next</span>Week</a></li>
					<li><a class="ie-fix" href='javascript:calendarSmallThisMonth();'><span>This</span>Month</a></li>
					<li><a class="ie-fix" href='javascript:calendarSmallNextMonth();'><span>Next</span>Month</a></li>
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
			<div class="carousel" id="carousel-01">
			<ul class="slides" id="buzz-slides-01">
					 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
						<li><a class='ie-fix' href='javascript:calendarSmallGoTo("<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
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
								<option value="%">Area of Town</option>
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
						<input type="text" class="text" name="keywords"  placeholder="Keywords..."/>
						<a href='javascript:calendarSmallGo(this);' class="btn-go ie-fix"><span>GO</span><i>&nbsp;</i></a>
					</div><!-- end bottom -->
				</fieldset>
			</form>
		</div><!-- end events -->

		<div class="info-section" id="info-section-01" >
			<div class="scrollable-area">
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
							<div class="block">
								<div class="holder">
									<h2 style="height: auto; overflow: hidden;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sTitle'],12,'..',true);?>
</h2>
									<span class="category"><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</span>
									<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
									<p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sDescription'],100,'..',true);?>
</p>
									<div class="more">
										<a href='javascript:window.location.href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
&" + jQuery("#buzz-search-form").serialize();'>Read More</a>
									</div><!-- end more -->
								</div><!-- end holder -->
							</div><!-- end block -->
						</div><!-- end description -->
						<?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?><strong class="sponsored">sponsored event ad</strong><?php }?>					</li>
				<?php } ?>

				</ul>
			</div><!-- end scrollable-area -->
			<ul class="direction-nav">
					<li><a href="#" class="prev" id="buzz-calendar-prev">view previous</a></li>
					<li><a href="#" class="next" id="buzz-calendar-next">View more</a></li>
			</ul><!-- end direction-nav -->
		</div><!-- end info-section -->

		<div class="info-carousel" id="info-carousel-01">
			<ul class="slides" id="buzz-event-slides-01">
				<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
				<li <?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?>class="sponsored-visible"<?php }?>>
					<a href='javascript:window.location.href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
&" + jQuery("#buzz-search-form").serialize();'>
						<span class="img">
							<img src="http://www.filelogix.com/buzz/images/categories/rect/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['rectImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="95" height="44" alt="<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
" />
						</span><!-- end img -->
						<span class="box">
							<strong class="title"><?php echo $_smarty_tpl->tpl_vars['event']->value['title'];?>
</strong>
							<i><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</i>
							<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
							<span class="alignbottom">
								<span class="more">
									<em>Read More</em>
								</span><!-- end more -->
								<strong class="sponsored">sponsored event ad</strong>
							</span><!-- end alignbottom -->
							<?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?><strong class="sponsored">sponsored event ad</strong><?php }?>
						</span><!-- end box -->
					</a>
				</li>
				<?php } ?>

			</ul><!-- end slides -->
		</div><!-- end info-carousel -->
		<div class="footer ie-fix">
			<div class="holder">
				<a href="javascript:calendarSignUp(this);" class="btn-newsletter ie-fix">Newsletter<i>&nbsp;</i></a>
			</div><!-- end holder -->
		</div><!-- end footer -->
	</div><!-- end buzz-calendar -->


	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/scripts.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/calendar.js"></script>



	<script type="text/javascript">
		jQuery('#info-carousel-01').slideUp();
	</script>


<?php }} ?>