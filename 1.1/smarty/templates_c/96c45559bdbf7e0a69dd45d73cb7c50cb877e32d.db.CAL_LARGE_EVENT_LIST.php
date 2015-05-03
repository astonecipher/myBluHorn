<?php /* Smarty version Smarty-3.1.13, created on 2013-12-08 13:13:02
         compiled from "db:cal_large_event_list" */ ?>
<?php /*%%SmartyHeaderCode:73275835752a4b6ae8193e1-77036655%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96c45559bdbf7e0a69dd45d73cb7c50cb877e32d' => 
    array (
      0 => 'db:cal_large_event_list',
      1 => 1386544213,
      2 => 'db',
    ),
    '223b5378561cb1c91ac8253e72c7d8d0400638b9' => 
    array (
      0 => 'db:cal_large_wrapper',
      1 => 1386290388,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '73275835752a4b6ae8193e1-77036655',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a4b6ae8dd915_72449237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a4b6ae8dd915_72449237')) {function content_52a4b6ae8dd915_72449237($_smarty_tpl) {?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="http://www.filelogix.com/buzz/">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Buzz Calendar</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/form.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" media="all" />
	<script type="text/javascript" src="js/jquery-1-10-2-min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1-10-3.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/custom-form.js"></script>
	<script type="text/javascript" src="js/custom-form.select.js"></script>
	<script type="text/javascript" src="js/custom-form.scrollable.js"></script>
	<script type="text/javascript" src="js/clear-inputs.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen">
		<script type="text/javascript" src="js/html5.js"></script>
		<script type="text/javascript" src="js/PIE.js"></script>
	<![endif]-->
</head>
<body>
	<div class="buzz-calendar large-width">
		<div class="header ie-fix">
			<div class="container">
				<ul class="top-nav">
					<li><a class="ie-fix" href="#"><span>Next</span>Week</a></li>
					<li><a class="ie-fix" href="#"><span>This</span>Month</a></li>
					<li><a class="ie-fix" href="#"><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
				<div class="carousel" id="carousel-02">
					<ul class="slides">
						<li class="active"><a class="ie-fix" href="#"><span>Tue</span>9</a></li>
						<li><a class="ie-fix" href="#"><span>Wed</span>10</a></li>
						<li><a class="ie-fix" href="#"><span>Thu</span>11</a></li>
						<li><a class="ie-fix" href="#"><span>Fri</span>12</a></li>
						<li><a class="ie-fix" href="#"><span>Sat</span>13</a></li>
						<li><a class="ie-fix" href="#"><span>Sun</span>14</a></li>
						<li><a class="ie-fix" href="#"><span>Mon</span>15</a></li>
						<li><a class="ie-fix" href="#"><span>Tue</span>16</a></li>
						<li><a class="ie-fix" href="#"><span>Wed</span>17</a></li>
						<li><a class="ie-fix" href="#"><span>Thu</span>18</a></li>
						<li><a class="ie-fix" href="#"><span>Fri</span>19</a></li>
						<li><a class="ie-fix" href="#"><span>Sat</span>20</a></li>
						<li><a class="ie-fix" href="#"><span>Sun</span>21</a></li>
						<li><a class="ie-fix" href="#"><span>Mon</span>22</a></li>
					</ul><!-- end slides -->
				</div><!-- end carousel -->
			</div><!-- end container -->
		</div><!-- end header -->
		<div class="events">
			<form action="#">
				<fieldset>
					<div class="holder">
						<div class="block">
							<h2><label for="lbl-01">find <span>events</span></label></h2>
							<div class="sel">
								<select id="lbl-01" class="sel-02">
									<option>Category</option>
									<option>Music</option>
									<option>Sports &amp; Recreaion</option>
									<option>Theatre &amp; Performing Arts</option>
									<option>Museums, Galleries &amp; Exhibits</option>
									<option>Comedy</option>
									<option>Kids Events</option>
									<option>Special Event</option>
								</select>
							</div><!-- end sel -->
						</div><!-- end block -->
						<div class="box">
							<label for="datepicker-01">from</label>
							<div class="text">
								<input type="text" value="10/10/2013" id="datepicker-01" />
								<label for="datepicker-01">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end box -->
						<div class="box">
							<label for="datepicker-02">to</label>
							<div class="text">
								<input type="text" value="10/10/2013" id="datepicker-02" />
								<label for="datepicker-02">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end box -->
						<div class="sel sel-02">
							<select id="lbl-04" class="sel-02">
								<option>Area of Town</option>
								<option>Area of Town</option>
								<option>Area of Town</option>
							</select>
						</div><!-- end sel -->
						<input type="text" class="text" value="Keyword..." />
						<a href="#" class="btn-go ie-fix"><span>GO</span><i>&nbsp;</i></a>
					</div><!-- end holder -->
				</fieldset>
			</form>
		</div><!-- end events -->
		<div class="container">
			<div class="heading-block ie-fix">
				<h2>Showing events for OCTOBER 25, 2013</h2>
			</div><!-- end heading-block -->
			<div class="info-section">
				<div class="scrollable-area">
					<ul id="list-large-event">
						<li class="sponsored-visible">
							<div class="img">
								<a href="#"><img src="images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
										<strong class="title">Venue Name</strong>
										<p>100 Address Road</p>
										<p>St. Augustine, FL</p>
										<p>32222</p>
									</div><!-- end section -->
									<p>Ph: 904-444-4444</p>
									<p><a href="#">www.website.com</a></p>
									<div class="email">
										<a href="mailto:">EMAIL US</a>
									</div><!-- end email -->
								</div><!-- end box -->
								<div class="block">
									<h2>TITLE</h2>
									<span class="category">category</span>
									<em class="date">8/12/2013</em>
									<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
									<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="#">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>
						<li>
							<div class="img">
								<a href="#"><img src="images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
										<strong class="title">Venue Name</strong>
										<p>100 Address Road</p>
										<p>St. Augustine, FL</p>
										<p>32222</p>
									</div><!-- end section -->
									<p>Ph: 904-444-4444</p>
									<p><a href="#">www.website.com</a></p>
									<div class="email">
										<a href="mailto:">EMAIL US</a>
									</div><!-- end email -->
								</div><!-- end box -->
								<div class="block">
									<h2>TITLE</h2>
									<span class="category">category</span>
									<em class="date">8/12/2013</em>
									<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
									<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="#">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>
						<li>
							<div class="img">
								<a href="#"><img src="images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
										<strong class="title">Venue Name</strong>
										<p>100 Address Road</p>
										<p>St. Augustine, FL</p>
										<p>32222</p>
									</div><!-- end section -->
									<p>Ph: 904-444-4444</p>
									<p><a href="#">www.website.com</a></p>
									<div class="email">
										<a href="mailto:">EMAIL US</a>
									</div><!-- end email -->
								</div><!-- end box -->
								<div class="block">
									<h2>TITLE</h2>
									<span class="category">category</span>
									<em class="date">8/12/2013</em>
									<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
									<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="#">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>
						<li class="sponsored-visible">
							<div class="img">
								<a href="#"><img src="images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
										<strong class="title">Venue Name</strong>
										<p>100 Address Road</p>
										<p>St. Augustine, FL</p>
										<p>32222</p>
									</div><!-- end section -->
									<p>Ph: 904-444-4444</p>
									<p><a href="#">www.website.com</a></p>
									<div class="email">
										<a href="mailto:">EMAIL US</a>
									</div><!-- end email -->
								</div><!-- end box -->
								<div class="block">
									<h2>TITLE</h2>
									<span class="category">category</span>
									<em class="date">8/12/2013</em>
									<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
									<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="#">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>
					</ul>
				</div><!-- end scrollable-area -->
                <div class="event-detailed" style="display:none"></div>
				<ul class="direction-nav">
					<li><a href="#" class="prev add-effect">view previous</a></li>
					<li><a href="#" class="next add-effect">View more</a></li>
				</ul><!-- end direction-nav -->
			</div><!-- end info-section -->
		</div><!-- end container -->
		<div class="footer ie-fix">
			<div class="container">
				<div class="holder">
					<div class="all-results">
						<a href="#" class="opener" id="view-all-results">View all results<i>&nbsp;</i></a>
					</div><!-- end all-results -->
				</div><!-- end holder -->
			</div><!-- end container -->
			<div class="links ie-fix">
				<ul>
					<li><a href="#">add your events<i class="ico ico-01">ico</i></a></li>
					<li><a href="#">tell a friend<i class="ico ico-02">ico</i></a></li>
					<li><a href="#">newsletter sign-up<i class="ico ico-04">ico</i></a></li>
				</ul>
			</div><!-- end links -->
		</div><!-- end footer -->
	</div><!-- end buzz-calendar -->
</body>
</html><?php }} ?>