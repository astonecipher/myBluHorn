<?php /* Smarty version Smarty-3.1.13, created on 2013-10-01 18:52:02
         compiled from "db:cal_results_new" */ ?>
<?php /*%%SmartyHeaderCode:72555431752495e65d15635-31632992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '868baabf525ee62aa78aed71198508892d3a3088' => 
    array (
      0 => 'db:cal_results_new',
      1 => 1380682320,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '72555431752495e65d15635-31632992',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52495e65d29d77_98893956',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52495e65d29d77_98893956')) {function content_52495e65d29d77_98893956($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<base href="/buzz/">
	<meta charset="utf-8">
	<title>Buzz Events Calendar</title>
	<link media="all" rel="stylesheet" href="css/cal-all.css">
	<meta name="viewport" content="width=563" >
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/cal-jquery.main.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/cal-ie.js"></script><![endif]-->
</head>
<body>
	<div class="wrapper">
		<header id="header">
			<strong class="logo"><a href="http://iwantabuzz.com">BUZZ</a></strong>
		</header>
		<div id="main">
			<div class="main-holder">
				<div class="holder">
					<div class="heading">
						<h1>Events Calendar</h1>
					</div>
					<ul class="social-networks">
						<li class="facebook"><a href="http://www.facebook.com">facebook</a></li>
						<li class="twitter"><a href="http"//twitter.com">twitter</a></li>
						<li class="sharethis"><a href="#">sharethis</a></li>
						<li class="rss"><a href="#">rss</a></li>
					</ul>
				</div>
				<div id="carousel-days" class="carousel-days">
					<div class="mask">
						<div class="slideset"></div>
					</div>
					<a class="btn-prev" href="#">Previous</a>
					<a class="btn-next" href="#">Next</a>
				</div>
				<form action="json/calendar/search" class="filter-form" id="filter-form">
					<fieldset>
						<select id="select-category" name="category">
							<option value="*">All Categories</option>
							<option value="music">Music</option>
							<option value="sports">Sports &amp; Recreaion</option>
							<option value="theatre">Theatre &amp; Performing Arts</option>
							<option value="museums">Museums, Galleries &amp; Exhibits</option>
							<option value="comedy">Comedy</option>
							<option value="kids">Kids Events</option>
							<option value="special">Special Event</option>
						</select>
						<label for="date-from">from</label>
						<div class="row">
							<input type="text" class="date-from" name="fromDate" id="date-from" value="" readonly="readonly">
							<a href="#">choose a date</a>
						</div>
						<div class="datepicker">
							<!-- datepicker will be here -->
						</div>
						<label for="date-to" class="size01">to</label>
						<div class="row">
							<input type="text" class="date-to" name="toDate" id="date-to" value="" readonly="readonly">
							<a href="#">choose a date</a>
						</div>
						<input type="submit" value="GO" >
					</fieldset>
				</form>
			</div>
			<ul class="events-tabset">
				<li><a id="next-week" href="calendar/nextweek">Next Week</a></li>
				<li><a id="this-month" href="calendar/thismonth">This Month</a></li>
				<li><a id="next-month" href="calendar/nextmonth">Next Month</a></li>
			</ul>
			<div id="events-content" class="events-content" data-template="/buzz/inc/template-events.tpl" data-part="4"></div>
		</div>
		<footer id="footer">
			<a href="#" id="show-more-result" class="more">SHOW MORE RESULT</a>
			<a href="http://www.iwantabuzz.com" class="btn-link">sign up for newsletter</a>
		</footer>
	</div>
</body>
</html><?php }} ?>