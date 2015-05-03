<?php /* Smarty version Smarty-3.1.13, created on 2013-12-13 09:11:10
         compiled from "db:cal_widget_small_result_list" */ ?>
<?php /*%%SmartyHeaderCode:132431636152a8a3168854b6-07208972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9474c7308d9e5b9cc1c76f59811e0fc9274b0d8b' => 
    array (
      0 => 'db:cal_widget_small_result_list',
      1 => 1386961865,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '132431636152a8a3168854b6-07208972',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a8a3168eeb36_64195738',
  'variables' => 
  array (
    'events' => 0,
    'event' => 0,
    'fromDate' => 0,
    'toDate' => 0,
    'previousFrom' => 0,
    'previousTo' => 0,
    'nextFrom' => 0,
    'nextTo' => 0,
    'calDays' => 0,
    'calDay' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a8a3168eeb36_64195738')) {function content_52a8a3168eeb36_64195738($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.truncate.php';
?>			<?php if (!$_smarty_tpl->tpl_vars['events']->value){?>
				<p>No Events To Display.</p>
			<?php }?>				
				<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
					<li <?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?>class="sponsored-visible"<?php }?>>
						<div class="img">
							<a href="#"><img src=http://www.filelogix.com/buzz/images/categories/square/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
 width="77" height="73" alt="i<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
" /></a>
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
									<strong class="title"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
</strong>
									<p><?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</p>
								</div><!-- end section -->
								<!--<p>Ph: <?php echo $_smarty_tpl->tpl_vars['event']->value['phoneNumber'];?>
</p>-->
								<p><a href="<?php echo $_smarty_tpl->tpl_vars['event']->value['uWebsite'];?>
">WEBSITE</a></p>
								<div class="email">
									<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['event']->value['emailAddress'];?>
">EMAIL US</a>
								</div><!-- end email -->
							</div><!-- end box -->
							<div class="block">
								<div class="holder">
									<h2 style="height: auto; overflow: hidden;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sTitle'],12,'..',true);?>
</h2>
									<span class="category"><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</span>
									<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
									<p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['event']->value['sDescription'],95,'..',true);?>
</p>
									<div class="more">
										<a href='javascript:window.location.href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
&" + jQuery("#buzz-search-form").serialize();'>Read More</a>
									</div><!-- end more -->
								</div><!-- end holder -->
							</div><!-- end block -->
						</div><!-- end description -->
						<?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?><strong class="sponsored">sponsored event ad</strong><?php }?>					</li>
				<?php } ?>
	



	<script type="text/javascript">
		jQuery('#datepicker-01').val("<?php echo $_smarty_tpl->tpl_vars['fromDate']->value;?>
");
	</script>

	<script type="text/javascript">
		jQuery('#datepicker-02').val("<?php echo $_smarty_tpl->tpl_vars['toDate']->value;?>
");
	</script>

	<script type="text/javascript">
jQuery(".direction-nav").off();
	jQuery("#buzz-calendar-prev").attr("href", 'javascript:calendarSmallPrevious("small","<?php echo $_smarty_tpl->tpl_vars['previousFrom']->value;?>
","<?php echo $_smarty_tpl->tpl_vars['previousTo']->value;?>
");')
	jQuery("#buzz-calendar-next").attr("href", 'javascript:calendarSmallNext("small","<?php echo $_smarty_tpl->tpl_vars['nextFrom']->value;?>
","<?php echo $_smarty_tpl->tpl_vars['nextTo']->value;?>
");')
	</script>

<?php if ($_smarty_tpl->tpl_vars['calDays']->value){?>
	<script type="text/javascript">
	(function() {
	
		var listedDays = "";
		jQuery('#calendarDays').empty();;
		 <?php  $_smarty_tpl->tpl_vars['calDay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calDay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calDays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calDay']->key => $_smarty_tpl->tpl_vars['calDay']->value){
$_smarty_tpl->tpl_vars['calDay']->_loop = true;
?>		
			listedDays += "<li><a class='ie-fix' href='javascript:calendarGoTo(\"<?php echo $_smarty_tpl->tpl_vars['calDay']->value['dateYMD'];?>
\")'><span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayName'];?>
</span><?php echo $_smarty_tpl->tpl_vars['calDay']->value['dayNumber'];?>
</a></li>";
		 <?php } ?>
		jQuery('#calendarDays').html(listedDays);
		jQuery('#carousel-02').flexslider(0);
	});

</script>
<?php }?>

<?php }} ?>