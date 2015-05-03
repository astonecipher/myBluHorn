<?php /* Smarty version Smarty-3.1.13, created on 2013-10-03 09:50:10
         compiled from "db:cal_results" */ ?>
<?php /*%%SmartyHeaderCode:682683843524920e07aca77-15772385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39402e0a6e60e684fbecc6cefb064d42cc188162' => 
    array (
      0 => 'db:cal_results',
      1 => 1380822608,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '682683843524920e07aca77-15772385',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524920e07ca3f6_97991717',
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
    'categoryID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524920e07ca3f6_97991717')) {function content_524920e07ca3f6_97991717($_smarty_tpl) {?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="/buzz/">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Buzz Calendar</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/form.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" media="all" />
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/custom-form.js"></script>
	<script type="text/javascript" src="js/custom-form.select.js"></script>
	<script type="text/javascript" src="js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/datepicker.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen">
		<script type="text/javascript" src="js/PIE.js"></script>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="calendar-wrapp">
		<header class="ie-fix">
			<div class="top">
				<strong class="logo"><a href="http://www.iwantabuzz.com">BUZZ</a></strong>
				<ul class="top-nav">
					<li><a href="calendar/search/next-week"><span>Next</span>Week</a></li>
					<li><a href="calendar/search/this-month"><span>This</span>Month</a></li>
					<li><a href="calendar/search/next-month"><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
			</div><!-- end top -->
			<div class="holder">
				<ul class="social">
					<li><a href="http://facebook.com" class="facebook">facebook</a></li>
					<li><a href="http://twitter.com" class="twitter">twitter</a></li>
					<li><a href="calendar/share" class="share">share</a></li>
					<li><a href="calendar/rss" class="rss">rss</a></li>
				</ul><!-- end social -->
				<a href="calendar/search/"><h1>Events Calendar</h1></a>
			</div><!-- end holder -->
			<div class="carousel">
				<ul class="slides">
				<?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>
					<li><a class="ie-fix" href="calendar/search/day/<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>
				<?php } ?>
				</ul><!-- end slides -->
			</div><!-- end carousel -->
			<div class="categories">
				<form action="calendar/results" method="post" name="calResults" id="calResults">
					<fieldset>
						<select name="category" id="category">
							<option value="%" selected>All Categories</option>
							<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
							<?php } ?>										</select>
						<div class="block">
							<label for="datepicker-01">from</label>
							<div class="text">
								<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['fromDate']->value;?>
" id="datepicker-01" name="fromDate"/>
								<label for="datepicker-01" class="datepicker-lbl">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end block -->
						<div class="block alignright">
							<label for="datepicker-02">to</label>
							<div class="text">
								<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['toDate']->value;?>
" id="datepicker-02" name="toDate" />
								<label for="datepicker-02" class="datepicker-lbl">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end block -->
						<input type="hidden" class="limit" value="5" />
						<input type="submit" class="submit" value="GO" />
					</fieldset>
				</form>
			</div><!-- end categories -->
		</header>
		<div id="main">
			<ul class="results">
<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>

				<li class="ie-fix"  id="event<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
"  _onmouseover="javascript:$('#event<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
').effect( 'scale', { percent: 120, direction: 'both' }, 500 );" >
					<div class="img" >
						<img src="images/img-02.jpg" width="90" height="90" alt="image" />
					</div><!-- end img -->
					<div class="contacts">
						<h3><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
</h3>
						<div class="box">
							<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['address'])===null||$tmp==='' ? 'Location TBD' : $tmp);?>
</p>
							<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['city'])===null||$tmp==='' ? 'City' : $tmp);?>
, <?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['state'])===null||$tmp==='' ? 'State' : $tmp);?>
</p>
							<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['zip'])===null||$tmp==='' ? 'Zip' : $tmp);?>
</p>
						</div><!-- end box -->
						<div class="box">
							<p>Ph: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['phone'])===null||$tmp==='' ? '(###) ###-###' : $tmp);?>
</p>
							<p><a href="<?php echo $_smarty_tpl->tpl_vars['event']->value['website'];?>
">Website</a></p>
							<p><strong><a href="<?php echo $_smarty_tpl->tpl_vars['event']->value['email'];?>
">EMAIL US</a></strong></p>
						</div><!-- end box -->
					</div><!-- end contacts -->
					<div class="block">
						<h2 style="font-size: 20px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['title'];?>
</h2>
						<strong class="category" style="font-size: 15px;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['categoryName'])===null||$tmp==='' ? 'All' : $tmp);?>
</strong>
						<em class="date">Date: <?php echo $_smarty_tpl->tpl_vars['event']->value['tStartStr'];?>
</em>
						<p style="font-size: 11px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['description'];?>
</p>
						<a href="<?php echo $_smarty_tpl->tpl_vars['event']->value['website'];?>
" class="btn-details" id="details<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
"  onmouseover="javascript:$('#details<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
').effect('shake',{ distance: 10 }, 'slow');" >GET DETAILS</a>
					</div><!-- end block -->
				</li>

<?php } ?>

			</ul><!-- end results -->
		</div><!-- end main -->
		<footer class="ie-fix">
			<a href="http://iwantabuzz.com" class="btn-signup">sign up for newsletter</a>
			<h4><a href="calendar/">show more results</a></h4>
		</footer>
	</div><!-- end calendar-wrapp -->

	<script type="text/javascript">
		$('#category').val("<?php echo $_smarty_tpl->tpl_vars['categoryID']->value;?>
");
	</script>

</body>
</html><?php }} ?>