<?php /* Smarty version Smarty-3.1.13, created on 2013-12-24 16:44:41
         compiled from "db:cal_widget_medium_addevent_body" */ ?>
<?php /*%%SmartyHeaderCode:90572162652b9ac8c0420e0-50339855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96b9720ab7b809a23c17e90ea156425a0a20fb69' => 
    array (
      0 => 'db:cal_widget_medium_addevent_body',
      1 => 1387939472,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '90572162652b9ac8c0420e0-50339855',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b9ac8c06cf71_71728850',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b9ac8c06cf71_71728850')) {function content_52b9ac8c06cf71_71728850($_smarty_tpl) {?>					<div class="title-block ie-fix">
						<h2>To submit your event for approval to be added to our event calendar please completly fill out the form below.</h2>
					</div><!-- end title-block -->
					<div class="add-event width-433">
						<div class="scrollable-area">
							<form action="#">
								<fieldset>
									<label for="lbl-07"><span>*</span>Event Title</label>
									<div class="row">
										<input type="text" class="text" value="Title" id="lbl-07" />
									</div><!-- end row -->
									<label for="lbl-08"><span>*</span>Event Summary</label>
									<p><span>Please enter a 1 to 2 sentence summary about your event. This will appear in the preview mode of our calendar.</span></p>
									<div class="row row-02">
										<textarea cols="30" rows="10" id="lbl-08"></textarea>
									</div><!-- end row -->
									<label for="lbl-09"><span>*</span>Event Description</label>
									<p>Please enter a full description about your event.</p>
									<div class="row row-02">
										<textarea cols="30" rows="10" id="lbl-09"></textarea>
									</div><!-- end row -->
									<div class="columns">
										<div class="column">
											<label for="lbl-10"><span>*</span>Category</label>
											<select id="lbl-10" class="sel-04">
												<option>Category</option>
												<option>Category</option>
												<option>Category</option>
											</select>
										</div><!-- end column -->
										<div class="column">
											<label for="lbl-11"><span>*</span>Area of Town</label>
											<select id="lbl-11" class="sel-04">
												<option>Category</option>
												<option>Category</option>
												<option>Category</option>
											</select>
										</div><!-- end column -->
									</div><!-- end columns -->
									<label for="lbl-12"><span>*</span>Event Location</label>
									<div class="row row-03">
										<input type="text" class="text" value="Location Name" id="lbl-12" />
									</div><!-- end row -->
									<div class="block">
										<label for="lbl-13"><span>*</span>Address</label>
										<div class="row">
											<input type="text" class="text" value="Street Address" id="lbl-13" />
										</div><!-- end row -->
										<label for="lbl-14"><span>*</span>City</label>
										<div class="row">
											<input type="text" class="text" value="City" id="lbl-14" />
										</div><!-- end row -->
										<label for="lbl-15"><span>*</span>State</label>
										<div class="row">
											<input type="text" class="text" value="State" id="lbl-15" />
										</div><!-- end row -->
										<label for="lbl-16"><span>*</span>Zip</label>
										<div class="row">
											<input type="text" class="text" value="Zip Code" id="lbl-16" />
										</div><!-- end row -->
									</div><!-- end block -->
									<label for="lbl-17">Event Website URL</label>
									<div class="row row-03">
										<input type="text" class="text" value="http://" id="lbl-17" />
									</div><!-- end row -->
									<label for="lbl-18">Event Twitter</label>
									<p>Please enter your twitter name only, for example our handles is @iwantaBUZZ we would submit iwantaBUZZ</p>
									<div class="row row-04">
										<input type="text" class="text" value="" id="lbl-18" />
									</div><!-- end row -->
									<label for="lbl-19">Event Facebook</label>
									<p>To find your Facebook ID simply login to your account and select your main photo you have loaded. Within the URL address there will be a stream of numbers titled fbid= we need the numbers behind the equals sign. For example fbid=654875984545014</p>
									<div class="row row-04">
										<input type="text" class="text" value="" id="lbl-19" />
									</div><!-- end row -->
									<label for="lbl-20">Event Contact Name</label>
									<div class="row row-04">
										<input type="text" class="text" value="Name" id="lbl-20" />
									</div><!-- end row -->
									<label for="lbl-21">Event Contact Email</label>
									<div class="row row-04">
										<input type="text" class="text" value="&#110;&#097;&#109;&#101;&#064;&#110;&#097;&#109;&#101;&#046;&#099;&#111;&#109;" id="lbl-21" />
									</div><!-- end row -->
									<label for="lbl-22"><span>*</span>Date / Time</label>
									<p>All Day Event?</p>
									<div class="check-block">
										<input type="checkbox" id="lbl-22" class="check" />
									</div><!-- end check-block -->
									<div class="date-block">
										<div class="date-row">
											<label for="datepicker-05">from</label>
											<div class="text">
												<input type="text" value="11/10/2013" id="datepicker-05" />
												<label for="datepicker-05">open datepicker</label>
											</div><!-- end text -->
											<label class="time-label" for="lbl-23">at</label>
											<div class="time">
												<input type="text" class="text" value="08:00 PM" id="lbl-23" />
												<i class="ico-clock">&nbsp;</i>
											</div><!-- end time -->
										</div><!-- end date-row -->
										<div class="date-row">
											<label for="datepicker-06">to</label>
											<div class="text">
												<input type="text" value="11/10/2013" id="datepicker-06" />
												<label for="datepicker-06">open datepicker</label>
											</div><!-- end text -->
											<label class="time-label" for="lbl-24">at</label>
											<div class="time">
												<input type="text" class="text" value="08:00 PM" id="lbl-24" />
												<i class="ico-clock">&nbsp;</i>
											</div><!-- end time -->
										</div><!-- end date-row -->
									</div><!-- end date-block -->
									<label for="lbl-25"><span>*</span>Repeat?</label>
									<div class="check-block">
										<input type="checkbox" id="lbl-25" class="check" />
									</div><!-- end check-block -->
									<div class="section">
										<label for="lbl-26"><span>*</span>How Often?</label>
										<div class="row row-04">
											<select id="lbl-26" class="sel-04">
												<option>Daily</option>
												<option>Daily</option>
												<option>Daily</option>
											</select>
										</div><!-- end row -->
										<label for="datepicker-07"><span>*</span>Stop Repeating?</label>
										<div class="date-row">
											<div class="text">
												<input type="text" value="11/10/2013" id="datepicker-07" />
												<label for="datepicker-07">open datepicker</label>
											</div><!-- end text -->
										</div><!-- end date-row -->
									</div><!-- end section -->
									<label for="lbl-27"><span>*</span>Ticketing</label>
									<div class="ticketing">
										<input type="checkbox" id="lbl-27" class="check" />
									</div><!-- end ticketing -->
									<div class="section">
										<label for="lbl-28"><span>*</span>Cost?</label>
										<div class="cost">
											<input type="text" class="text" value="0.00" id="lbl-28" />
											<i class="ico">&nbsp;</i>
										</div><!-- end cost -->
										<label for="lbl-29"><span>*</span>Website to buy Tickets?</label>
										<div class="row row-05">
											<input type="text" class="text text-02" value="http://" id="lbl-29" />
										</div><!-- end row -->
									</div><!-- end section -->
									<label for="lbl-30">Tags</label>
									<p>Separate each tag with a comme (,)</p>
									<div class="row row-06">
										<input type="text" class="text" value="tag one, tag two, tag three" id="lbl-30" />
									</div><!-- end row -->
						
									<input type="submit" class="submit ie-fix" value="Submit Event" />
								</fieldset>
							</form>
						</div><!-- end scrollable-area -->
					</div><!-- end add-event -->

<script type="text/javascript">

			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });	

			  customForm.customForms.replaceAll();			

</script><?php }} ?>