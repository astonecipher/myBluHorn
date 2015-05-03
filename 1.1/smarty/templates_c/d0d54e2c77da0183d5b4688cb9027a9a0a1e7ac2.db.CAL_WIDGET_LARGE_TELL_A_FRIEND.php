<?php /* Smarty version Smarty-3.1.13, created on 2014-01-02 00:47:45
         compiled from "db:cal_widget_large_tell_a_friend" */ ?>
<?php /*%%SmartyHeaderCode:7151333052c4fccaf178d7-44472631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0d54e2c77da0183d5b4688cb9027a9a0a1e7ac2' => 
    array (
      0 => 'db:cal_widget_large_tell_a_friend',
      1 => 1388641634,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '7151333052c4fccaf178d7-44472631',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52c4fccaf3da47_14716257',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c4fccaf3da47_14716257')) {function content_52c4fccaf3da47_14716257($_smarty_tpl) {?>			<div class="title-block title-block-02 ie-fix">
				<h2>Note: Tell a friend about this calendar by sharing their information below.</h2>
			</div><!-- end title-block -->
			<div class="add-event flexible-width" style="height: 500px;">
				<div class="scrollable-area" style="height: 500px;">
					<form  action="" onSubmit="javascript:calendarAddEvent(this);" name="buzz-calendar-add-event" id="buzz-calendar-add-event">
						<fieldset>

							<label for="lbl-20">Friend's Name</label>
							<div class="row row-04">
								<input type="text" class="text" value="" placeholder="" id="lbl-20" name="sContactName"  data-validation="length" data-validation-length="min4"/>
							</div><!-- end row -->
							<label for="lbl-21">Friend's Email</label>
							<div class="row row-04">
								<input type="text" class="text" value="" name="sContactEmail" id="lbl-21"  data-validation="email"/>
							</div><!-- end row -->
 			
							<input type="submit" class="submit ie-fix" value="Share!"/>
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