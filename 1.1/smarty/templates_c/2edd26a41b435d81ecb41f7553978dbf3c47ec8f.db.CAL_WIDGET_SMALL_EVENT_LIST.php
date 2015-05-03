<?php /* Smarty version Smarty-3.1.13, created on 2013-12-11 10:08:37
         compiled from "db:cal_widget_small_event_list" */ ?>
<?php /*%%SmartyHeaderCode:159066963952a87c4b3da119-52525039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2edd26a41b435d81ecb41f7553978dbf3c47ec8f' => 
    array (
      0 => 'db:cal_widget_small_event_list',
      1 => 1386792497,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '159066963952a87c4b3da119-52525039',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a87c4b471bf5_27628227',
  'variables' => 
  array (
    'events' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a87c4b471bf5_27628227')) {function content_52a87c4b471bf5_27628227($_smarty_tpl) {?>
				<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
				<li <?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?>class="sponsored-visible"<?php }?>>
					<a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
">
						<span class="img">
							<img src="http://www.filelogix.com/buzz/images/categories/rect/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['rectImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="95" height="44" alt="<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
" />
						</span><!-- end img -->
						<span class="box">
							<strong class="title"><?php echo $_smarty_tpl->tpl_vars['event']->value['title'];?>
</strong>
							<i><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</i>
							<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['dateStr'];?>
</em>
							<span class="alignbottom">
								<span class="more">
									<em>Read More</em>
								</span><!-- end more -->
								<strong class="sponsored">sponsored event ad</strong>
							</span><!-- end alignbottom -->
							<?php if ($_smarty_tpl->tpl_vars['event']->value['bSponsored']){?><strong class="sponsored">sponsored event ad</strong><?php }?>
						</span><!-- end box -->
					</a>
				</li>
				<?php } ?>
<?php }} ?>