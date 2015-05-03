<?php /* Smarty version Smarty-3.1.13, created on 2013-12-08 13:41:51
         compiled from "db:cal_widget_large_event_details" */ ?>
<?php /*%%SmartyHeaderCode:26117352152a4b94f9cc641-58896510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f194ace8218f488960cf34f3e47445e90bab93fb' => 
    array (
      0 => 'db:cal_widget_large_event_details',
      1 => 1386546094,
      2 => 'db',
    ),
    '6ea38b8bc40f696f0d798650f5ba443e2a32d3b0' => 
    array (
      0 => 'db:cal_widget_large_wrapper',
      1 => 1386545259,
      2 => 'db',
    ),
    '5caa6c57b1b956588e9f41cd92c098953b8624df' => 
    array (
      0 => 'db:cal_widget_large_event_list',
      1 => 1386545530,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '26117352152a4b94f9cc641-58896510',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a4b94fa5c007_03015643',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'eventID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a4b94fa5c007_03015643')) {function content_52a4b94fa5c007_03015643($_smarty_tpl) {?>

	<div class="buzz-calendar large-width">
		<div class="header ie-fix">
			<div class="container">
				<ul class="top-nav">
					<li><a class="ie-fix" href="javascript:calendarNextWeek(this);"><span>Next</span>Week</a></li>
					<li><a class="ie-fix" href="javascript:calendarThisMonth(this);"><span>This</span>Month</a></li>
					<li><a class="ie-fix" href="javascript:calendarNextMonth(this);"><span>Next</span>Month</a></li>
				</ul><!-- end top-nav -->
				<div class="carousel" id="carousel-02">
					<ul class="slides">
						<li class="active"><a class="ie-fix" href="#"><span>Tue</span>9</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Wed</span>10</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Thu</span>11</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Fri</span>12</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Sat</span>13</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Sun</span>14</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Mon</span>15</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Tue</span>16</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Wed</span>17</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Thu</span>18</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Fri</span>19</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Sat</span>20</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Sun</span>21</a></li>
						<li><a class="ie-fix" href="javascript:calendarGoTo(this);"><span>Mon</span>22</a></li>
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
									<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
										<option><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
									<?php } ?>
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
						<a href="javascript:calendarGo(this);" class="btn-go ie-fix"><span>GO</span><i>&nbsp;</i></a>
					</div><!-- end holder -->
				</fieldset>
			</form>
		</div><!-- end events -->
		<div class="container <?php if ($_smarty_tpl->tpl_vars['eventID']->value<=0){?> hide <?php }?>" id="buzz-calendar-container-event"></div>

		

<div class="hide" id="address" style="display: none; visibility: hidden;">Jacksonville, FL 32205</div>
			<div class="heading-block ie-fix">
				<a href="javascript:calendarBackToSearch(this);" class="link-back">Back to search</a>
			</div><!-- end heading-block -->
			<div class="info-section">
				<div class="event-detailed">
					<div class="holder">
						<div class="img">
							<img src="http://www.filelogix.com/buzz/images/categories/Blue_COMMUNITY.png" width="170" height="161" alt="image" />
						</div><!-- end img -->
						<div class="description">
							<div class="box">
								<div class="social">
									<ul>
										<li><a href="#" class="facebook">facebook</a></li>
										<li><a href="#" class="twitter">twitter</a></li>
									</ul>
								</div><!-- end social -->
								<div class="frame">
									<div id="map" style="height: 250px; width: 250px; float: right; padding-left: 10px; margin-left: 10px;">										<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Jacksonville,+FL&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=Jacksonville,+Duval,+Florida&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=near&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Jacksonville,+FL&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=Jacksonville,+Duval,+Florida&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>
									</div><!-- end map -->

									<div class="desc">
										<div class="section">
											<strong class="title" style="padding: 0px;">Venue Name</strong>
											<p>100 Address Road</p>
											<p>St. Augustine, FL</p>
											<p>32222</p>
										</div><!-- end section -->
										<p>Ph: 904-444-4444</p>
										<p><a href="#">www.website.com</a></p>
										<div class="email">
											<a href="mailto:">EMAIL US</a>
										</div><!-- end email -->
									</div><!-- end desc -->
								</div><!-- end frame -->
							</div><!-- end box -->
							<div class="block">
								<h1>TITLE</h1>
								<span class="category">category</span>
								<em class="date">8/12/2013 - 8/30/2013</em>
								<em class="time">8:30am-5pm</em>
								<dl>
									<dt>Cost:</dt><dd>$10.00</dd>
								</dl>
								<a href="#" class="btn-buy ie-fix">Buy Tickets</a>
								<a href="#" class="btn-contact ie-fix">Contact Venue<i>&nbsp;</i></a>
							</div><!-- end block -->
						</div><!-- end description -->
					</div><!-- end holder -->
					<div class="txt">
						<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
						<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
						<p>sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
						<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr</p>
						<p>wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr wrw wenwkle ejn sdjkjdfnkn wejn uewr uiwer iwer ewkjn kwenr wkjn kwenr dfkjn dfsjknwqkjn sd sdkfjn jkfewi  sdfs ewrw wenwkle ejn</p>
					</div><!-- end txt -->
				</div><!-- end event-detailed -->
				<ul class="direction-nav direction-nav2">
					<li><a href="#" class="prev">view previous</a></li>
					<li><a href="#" class="next">View more</a></li>
				</ul><!-- end direction-nav -->
			</div><!-- end info-section -->



		<div class="container <?php if ($_smarty_tpl->tpl_vars['eventID']->value>0){?> hide <?php }?>" id="buzz-calendar-container">

		

<?php /*  Call merged included template "db:CAL_WIDGET_LARGE_EVENT_LIST" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("db:CAL_WIDGET_LARGE_EVENT_LIST", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '26117352152a4b94f9cc641-58896510');
content_52a4bd6f6e47a1_79368648($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "db:CAL_WIDGET_LARGE_EVENT_LIST" */?>



		</div><!-- end container -->
		<div class="footer ie-fix">
			<div class="container">
				<div class="holder">
					<div class="all-results">
						<a href="javascript:calendarViewAllResults(this);" class="opener" id="view-all-results">View all results<i>&nbsp;</i></a>
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


	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/jquery-1-10-2-min.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/jquery-ui-1-10-3.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/custom-form.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/custom-form.select.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/custom-form.scrollable.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/clear-inputs.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/scripts.js"></script>
	<script type="text/javascript" src="http://www.filelogix.com/buzz/js/calendar.js"></script>





 
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2013-12-08 13:41:51
         compiled from "db:cal_widget_large_event_list" */ ?>
<?php if ($_valid && !is_callable('content_52a4bd6f6e47a1_79368648')) {function content_52a4bd6f6e47a1_79368648($_smarty_tpl) {?>
			<div class="info-section">
				<div class="scrollable-area">
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
								<a href="#"><img src="http://www.filelogix.com/buzz/images/categories/Blue_COMMUNITY.png" width="176" height="167" alt="image" /></a>
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
										<strong class="title"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['locationName'])===null||$tmp==='' ? 'Location TBD' : $tmp);?>
</strong>
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['address'])===null||$tmp==='' ? 'No Address' : $tmp);?>
</p>
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['city'])===null||$tmp==='' ? '' : $tmp);?>
 <?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['state'])===null||$tmp==='' ? '' : $tmp);?>
</p>
										<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['zipcode'])===null||$tmp==='' ? '' : $tmp);?>
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
									<span class="category"><?php echo substr($_smarty_tpl->tpl_vars['event']->value['category'],0,75);?>
</span>
									<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
									<p><?php echo $_smarty_tpl->tpl_vars['event']->value['description'];?>
</p>
								</div><!-- end block -->
							</div><!-- end description -->
							<div class="alignbottom">
								<div class="more">
									<a href="javascript:calendarGoToEvent(123);">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>

						<?php } ?>
						<li>
							<div class="img">
								<a href="#"><img src="http://www.filelogix.com/buzz/images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
								<a href="#"><img src="http://www.filelogix.com/buzz/images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
								<a href="#"><img src="http://www.filelogix.com/buzz/images/img-03.jpg" width="176" height="167" alt="image" /></a>
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
<?php }} ?>