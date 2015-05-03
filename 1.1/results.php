<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Buzz Calendar App</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/form.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" media="all" />
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/custom-form.js"></script>
	<script type="text/javascript" src="js/custom-form.select.js"></script>
	<script type="text/javascript" src="js/jquery.ui.core.js"></script>
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
				<strong class="logo"><a href="#">DUZZ</a></strong>
				<ul class="top-nav">
					<li><a href="#"><span>Next</span>Week</a></li>
					<li><a href="#"><span>This</span>Month</a></li>
					<li><a href="#"><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
			</div><!-- end top -->
			<div class="holder">
				<ul class="social">
					<li><a href="#" class="facebook">facebook</a></li>
					<li><a href="#" class="twitter">twitter</a></li>
					<li><a href="#" class="share">share</a></li>
					<li><a href="#" class="rss">rss</a></li>
				</ul><!-- end social -->
				<h1>Events Calendar</h1>
			</div><!-- end holder -->
			<div class="carousel">
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
			<div class="categories">
				<form action="#">
					<fieldset>
						<select>
							<option>All Catigoeries</option>
							<option>Music</option>
							<option>Sports &amp; Recreaion</option>
							<option>Theatre &amp; Performing Arts</option>
							<option>Museums, Galleries &amp; Exhibits</option>
							<option>Comedy</option>
							<option>Kids Events</option>
							<option>Special Event</option>
						</select>
						<div class="block">
							<label for="datepicker-01">from</label>
							<div class="text">
								<input type="text" value="8/30/13" id="datepicker-01" />
								<label for="datepicker-01" class="datepicker-lbl">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end block -->
						<div class="block alignright">
							<label for="datepicker-02">to</label>
							<div class="text">
								<input type="text" value="8/30/13" id="datepicker-02" />
								<label for="datepicker-02" class="datepicker-lbl">open datepicker</label>
							</div><!-- end text -->
						</div><!-- end block -->
						<input type="submit" class="submit" value="GO" />
					</fieldset>
				</form>
			</div><!-- end categories -->
		</header>
		<div id="main">
			<ul class="results">
				<li class="ie-fix">
					<div class="img">
						<img src="images/img-02.jpg" width="90" height="90" alt="image" />
					</div><!-- end img -->
					<div class="contacts">
						<h3>Venue Name</h3>
						<div class="box">
							<p>100 Address Road</p>
							<p>St. Augustine, FL</p>
							<p>32222</p>
						</div><!-- end box -->
						<div class="box">
							<p>Ph: 904-444-4444</p>
							<p><a href="#">www.website.com</a></p>
							<p><strong><a href="#">EMAIL US</a></strong></p>
						</div><!-- end box -->
					</div><!-- end contacts -->
					<div class="block">
						<h2>EVENT TITLE</h2>
						<strong class="category">category</strong>
						<em class="date">Date: August 8, 2013</em>
						<p>Details here. quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur</p>
						<a href="#" class="btn-details">GET DETAILS</a>
					</div><!-- end block -->
				</li>
				<li class="ie-fix">
					<div class="img">
						<img src="images/img-02.jpg" width="90" height="90" alt="image" />
					</div><!-- end img -->
					<div class="contacts">
						<h3>Venue Name</h3>
						<div class="box">
							<p>100 Address Road</p>
							<p>St. Augustine, FL</p>
							<p>32222</p>
						</div><!-- end box -->
						<div class="box">
							<p>Ph: 904-444-4444</p>
							<p><a href="#">www.website.com</a></p>
							<p><strong><a href="#">EMAIL US</a></strong></p>
						</div><!-- end box -->
					</div><!-- end contacts -->
					<div class="block">
						<h2>EVENT TITLE</h2>
						<strong class="category">category</strong>
						<em class="date">Date: August 8, 2013</em>
						<p>Details here. quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur</p>
						<a href="#" class="btn-details">GET DETAILS</a>
					</div><!-- end block -->
				</li>
				<li class="ie-fix">
					<div class="img">
						<img src="images/img-02.jpg" width="90" height="90" alt="image" />
					</div><!-- end img -->
					<div class="contacts">
						<h3>Venue Name</h3>
						<div class="box">
							<p>100 Address Road</p>
							<p>St. Augustine, FL</p>
							<p>32222</p>
						</div><!-- end box -->
						<div class="box">
							<p>Ph: 904-444-4444</p>
							<p><a href="#">www.website.com</a></p>
							<p><strong><a href="#">EMAIL US</a></strong></p>
						</div><!-- end box -->
					</div><!-- end contacts -->
					<div class="block">
						<h2>EVENT TITLE</h2>
						<strong class="category">category</strong>
						<em class="date">Date: August 8, 2013</em>
						<p>Details here. quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur</p>
						<a href="#" class="btn-details">GET DETAILS</a>
					</div><!-- end block -->
				</li>
				<li class="ie-fix">
					<div class="img">
						<img src="images/img-02.jpg" width="90" height="90" alt="image" />
					</div><!-- end img -->
					<div class="contacts">
						<h3>Venue Name</h3>
						<div class="box">
							<p>100 Address Road</p>
							<p>St. Augustine, FL</p>
							<p>32222</p>
						</div><!-- end box -->
						<div class="box">
							<p>Ph: 904-444-4444</p>
							<p><a href="#">www.website.com</a></p>
							<p><strong><a href="#">EMAIL US</a></strong></p>
						</div><!-- end box -->
					</div><!-- end contacts -->
					<div class="block">
						<h2>EVENT TITLE</h2>
						<strong class="category">category</strong>
						<em class="date">Date: August 8, 2013</em>
						<p>Details here. quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur</p>
						<a href="#" class="btn-details">GET DETAILS</a>
					</div><!-- end block -->
				</li>
			</ul><!-- end results -->
		</div><!-- end main -->
		<footer class="ie-fix">
			<a href="#" class="btn-signup">sign up for newsletter</a>
			<h4><a href="#">show more result</a></h4>
		</footer>
	</div><!-- end calendar-wrapp -->
</body>
</html>