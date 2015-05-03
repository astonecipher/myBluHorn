<?php /* Smarty version Smarty-3.1.13, created on 2013-12-06 00:47:25
         compiled from "db:cal_large_eventlist" */ ?>
<?php /*%%SmartyHeaderCode:140249200052a164ed160ef6-31009300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc806c118dad1af863839cab49e48dc89780e806' => 
    array (
      0 => 'db:cal_large_eventlist',
      1 => 1386318666,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '140249200052a164ed160ef6-31009300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'events' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a164ed1f02a5_66090573',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a164ed1f02a5_66090573')) {function content_52a164ed1f02a5_66090573($_smarty_tpl) {?>
						<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
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
									<p><a href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['website'])===null||$tmp==='' ? 'javascript:void();' : $tmp);?>
"><?php echo substr($_smarty_tpl->tpl_vars['event']->value['website'],0,20);?>
</a></p>
									<div class="email">
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
									<a href="#">Read More</a>
								</div><!-- end more -->
								<strong class="sponsored"><span>sponsored event ad</span></strong>
							</div><!-- end alignbottom -->
						</li>

						<?php } ?>
<?php }} ?>