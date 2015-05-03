<?php /* Smarty version Smarty-3.1.13, created on 2014-01-07 16:27:48
         compiled from "db:cal_widget_large_newsletter_signup" */ ?>
<?php /*%%SmartyHeaderCode:92555712752c4fcdfea5ac2-94759104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '974a89c78054210990d90bb85ae4b922cd5ee0d9' => 
    array (
      0 => 'db:cal_widget_large_newsletter_signup',
      1 => 1388641650,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '92555712752c4fcdfea5ac2-94759104',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52c4fcdfef8ff2_83302472',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c4fcdfef8ff2_83302472')) {function content_52c4fcdfef8ff2_83302472($_smarty_tpl) {?>			<div class="title-block title-block-02 ie-fix">
				<h2>Note: Sign up for the BUZZ Newsletter by sharing your contact information below:</h2>
			</div><!-- end title-block -->
			<div class="add-event flexible-width" style="height: 500px;">
				<div class="scrollable-area" style="height: 500px;">
					<form  action="" onSubmit="javascript:calendarAddEvent(this);" name="buzz-calendar-add-event" id="buzz-calendar-add-event">
						<fieldset>

							<label for="lbl-20">Your Name</label>
							<div class="row row-04">
								<input type="text" class="text" value="" placeholder="" id="lbl-20" name="sContactName"  data-validation="length" data-validation-length="min4"/>
							</div><!-- end row -->
							<label for="lbl-21">Your Email</label>
							<div class="row row-04">
								<input type="text" class="text" value="" name="sContactEmail" id="lbl-21"  data-validation="email"/>
							</div><!-- end row -->
 			
							<input type="submit" class="submit ie-fix" value="Sign Up!"/>
						</fieldset>
					</form>
					<br><br><br>
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