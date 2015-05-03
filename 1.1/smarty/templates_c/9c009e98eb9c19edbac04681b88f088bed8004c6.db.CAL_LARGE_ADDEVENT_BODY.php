<?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 14:57:07
         compiled from "db:cal_large_addevent_body" */ ?>
<?php /*%%SmartyHeaderCode:147182551352a1eeb56631e5-01203134%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c009e98eb9c19edbac04681b88f088bed8004c6' => 
    array (
      0 => 'db:cal_large_addevent_body',
      1 => 1389209909,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '147182551352a1eeb56631e5-01203134',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a1eeb5690116_30984567',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'areas' => 0,
    'area' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a1eeb5690116_30984567')) {function content_52a1eeb5690116_30984567($_smarty_tpl) {?>

			<div class="title-block title-block-02 ie-fix">
				<h2>Note: To submit your event for approval to be added to our event calendar please completly fill out the form below.</h2>
			</div><!-- end title-block -->
			<div class="add-event flexible-width">
				<div class="scrollable-area">
					<form  action="" onSubmit="javascript:calendarAddEvent(this);" name="buzz-calendar-add-event" id="buzz-calendar-add-event">
						<fieldset>
							<label for="lbl-07"><span>*</span>Event Title</label>
							<div class="row">
								<input type="text" class="text" name="sTitle" value="" id="lbl-07" placeholder="Title" data-validation="length" data-validation-length="min4"/>
							</div><!-- end row -->
							<label for="lbl-08"><span>*</span>Event Summary</label>
							<p><span>Please enter a 1 to 2 sentence summary about your event. This will appear in the preview mode of our calendar.</span></p>
							<div class="row row-02">
								<textarea cols="30" rows="10" id="lbl-08" name="zDetail"  data-validation="length" data-validation-length="min10"></textarea>
							</div><!-- end row -->
							<label for="lbl-09"><span>*</span>Event Description</label>
							<p>Please enter a full description about your event.</p>
							<div class="row row-02">
								<textarea cols="30" rows="10" id="lbl-09" name="zDescription"  data-validation="length" data-validation-length="min10"></textarea>
							</div><!-- end row -->
							<div class="columns">
								<div class="column">
									<label for="lbl-10"><span>*</span>Category</label>
									<select id="lbl-10" class="sel-02" name="kCategoryID">
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
								</div><!-- end column -->
								<div class="column">
									<label for="lbl-11"><span>*</span>Area of Town</label>
									<select id="lbl-11" class="sel-02" name="kAreaID">
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
								</div><!-- end column -->
							</div><!-- end columns -->
							<label for="lbl-12"><span>*</span>Event Location</label>
							<div class="row row-03">
								<input type="text" class="text" value="Location Name" id="lbl-12" name="kLocationName"  data-validation="length" data-validation-length="min2" />
							</div><!-- end row -->
							<div class="block">
								<label for="lbl-13"><span>*</span>Address</label>
								<div class="row">
									<input type="text" class="text" value="Street Address" id="lbl-13" name="sStreet"   data-validation="length" data-validation-length="min4"/>
								</div><!-- end row -->
								<label for="lbl-14"><span>*</span>City</label>
								<div class="row">
									<input type="text" class="text" value="City" id="lbl-14" name="sCity"  data-validation="length" data-validation-length="min4"/>
								</div><!-- end row -->
								<label for="lbl-15"><span>*</span>State</label>
								<div class="row">
									<input type="text" class="text" value="State" id="lbl-15" name="sState"  data-validation="length" data-validation-length="min2"/>
								</div><!-- end row -->
								<label for="lbl-16"><span>*</span>Zip</label>
								<div class="row">
									<input type="text" class="text" value="Zip Code" id="lbl-16" name="sZipcode"  data-validation="length" data-validation-length="min5"/>
								</div><!-- end row -->
							</div><!-- end block -->
							<label for="lbl-17">Event Website URL</label>
							<div class="row row-03">
								<input type="text" class="text" value="http://" id="lbl-17" name="uWebsite"  data-validation="url"/>
							</div><!-- end row -->
							<label for="lbl-18">Event Twitter</label>
							<p>Please enter your twitter name only, for example our handles is @iwantaBUZZ we would submit iwantaBUZZ</p>
							<div class="row row-04">
								<input type="text" class="text" value="" id="lbl-18" name="sTwitter"/>
							</div><!-- end row -->
							<label for="lbl-19">Event Facebook</label>
							<p>To find your Facebook ID simply login to your account and select your main photo you have loaded. Within the URL address there will be a stream of numbers titled fbid= we need the numbers behind the equals sign. For example fbid=654875984545014</p>
							<div class="row row-04">
								<input type="text" class="text" value="" id="lbl-19" name="sFacebook" />
							</div><!-- end row -->
							<label for="lbl-20">Event Contact Name</label>
							<div class="row row-04">
								<input type="text" class="text" value="" placeholder="" id="lbl-20" name="sContactName"  data-validation="length" data-validation-length="min4"/>
							</div><!-- end row -->
							<label for="lbl-21">Event Contact Email</label>
							<div class="row row-04">
								<input type="text" class="text" value="" name="sContactEmail" id="lbl-21"  data-validation="email"/>
							</div><!-- end row -->
							<label for="lbl-22"><span>*</span>Date / Time</label>
							<p>All Day Event?</p>
							<div class="check-block">
								<input type="checkbox" id="lbl-22" class="check" name="bAllDay" value="1"/>
							</div><!-- end check-block -->
							<div class="date-block">
								<div class="date-row">
									<label for="datepicker-05">from</label>
									<div class="text">
										<input type="text" value="" id="datepicker-05"  name="dStartDate"/>
										<label for="datepicker-05">open datepicker</label>
									</div><!-- end text -->
									<label class="time-label" for="lbl-23">at</label>
									<div class="time">
										<input type="text" class="text" value="" id="lbl-23" name="tStartTime" />
										<i class="ico-clock">&nbsp;</i>
									</div><!-- end time -->
								</div><!-- end date-row -->
								<div class="date-row">
									<label for="datepicker-06">to</label>
									<div class="text">
										<input type="text" value="" id="datepicker-06"  name="dEndDate"/>
										<label for="datepicker-06">open datepicker</label>
									</div><!-- end text -->
									<label class="time-label" for="lbl-24">at</label>
									<div class="time">
										<input type="text" class="text" value="" id="lbl-24"  name="dEndTime"/>
										<i class="ico-clock">&nbsp;</i>
									</div><!-- end time -->
								</div><!-- end date-row -->
							</div><!-- end date-block -->
							<label for="lbl-25"><span>*</span>Repeat?</label>
							<div class="check-block">
								<input type="checkbox" id="lbl-25" class="check"  name="bRepeat" value="1"/>
							</div><!-- end check-block -->
							<div class="section">
								<label for="lbl-26"><span>*</span>How Often?</label>
								<div class="row row-04">
									<select id="lbl-26" class="sel-04" name="eFrequency">
										<option>Daily</option>
										<option>Every Other Day</option>
										<option>Weekly</option>
										<option>Every Other Week</option>
									</select>
								</div><!-- end row -->
								<label for="datepicker-07"><span>*</span>Stop Repeating?</label>
								<div class="date-row">
									<div class="text">
										<input type="text" value="" id="datepicker-07"  name="dStopDate"/>
										<label for="datepicker-07">open datepicker</label>
									</div><!-- end text -->
								</div><!-- end date-row -->
							</div><!-- end section -->
							<label for="lbl-27"><span>*</span>Ticketing</label>
							<div class="ticketing">
								<input type="checkbox" id="lbl-27" class="check" name="bTicketed" value="1"/>
							</div><!-- end ticketing -->
							<div class="section">
								<label for="lbl-28"><span>*</span>Cost?</label>
								<div class="cost">
									<input type="text" class="text" value="0.00" id="lbl-28"  name="fCost"/>
									<i class="ico">&nbsp;</i>
								</div><!-- end cost -->
								<label for="lbl-29"><span>*</span>Website to buy Tickets?</label>
								<div class="row row-05">
									<input type="text" class="text text-02" value="" id="lbl-29" name="uTickets"data-validation="url" placeholder="http://"/>
								</div><!-- end row -->
							</div><!-- end section -->
							<label for="lbl-30">Tags</label>
							<p>Separate each tag with a comma (,)</p>
							<div class="row row-06">
								<input type="text" class="text" value="" id="lbl-30" name="zTags"/>
							</div><!-- end row -->
							      <div id="recaptcha_div" style="height: 200px;"></div>
 			
							<input type="submit" class="submit ie-fix" value="Submit Event"/>
						</fieldset>
					</form>
				</div><!-- end scrollable-area -->
			</div><!-- end add-event -->

			<script type="text/javascript"> 
					jQuery.validate({
    						validateOnBlur : true, // disable validation when input looses focus
    						errorMessagePosition : 'element', // Instead of 'element' which is default
    						scrollToTopOnError : true, // Set this property to true if you have a long form
						onSuccess : function() {
							calendarGo(this);
							return false;
					         }
 					 });
			</script>

<?php }} ?>