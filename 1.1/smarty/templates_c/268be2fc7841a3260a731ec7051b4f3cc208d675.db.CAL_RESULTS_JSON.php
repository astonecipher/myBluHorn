<?php /* Smarty version Smarty-3.1.13, created on 2013-10-01 18:46:34
         compiled from "db:cal_results_json" */ ?>
<?php /*%%SmartyHeaderCode:279913055249612e072557-46639457%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '268be2fc7841a3260a731ec7051b4f3cc208d675' => 
    array (
      0 => 'db:cal_results_json',
      1 => 1380681986,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '279913055249612e072557-46639457',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5249612e0cc5b7_51122061',
  'variables' => 
  array (
    'events' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5249612e0cc5b7_51122061')) {function content_5249612e0cc5b7_51122061($_smarty_tpl) {?>{
	"events": [
<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['event']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['event']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
 $_smarty_tpl->tpl_vars['event']->iteration++;
 $_smarty_tpl->tpl_vars['event']->last = $_smarty_tpl->tpl_vars['event']->iteration === $_smarty_tpl->tpl_vars['event']->total;
?>

		{
			"date": "<?php echo $_smarty_tpl->tpl_vars['event']->value['stdDateStr'];?>
",
			"category": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['category'])===null||$tmp==='' ? '' : $tmp);?>
",
			"categoryLink": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['categoryLink'])===null||$tmp==='' ? "#" : $tmp);?>
",
			"title": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['title'])===null||$tmp==='' ? "No Title" : $tmp);?>
",
			"image": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['previewImg'])===null||$tmp==='' ? "images/img01.png" : $tmp);?>
",
			"description": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['description1'])===null||$tmp==='' ? "desc" : $tmp);?>
",
			"venueName": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['locationName'])===null||$tmp==='' ? "location" : $tmp);?>
",
			"venueAddress": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['address'])===null||$tmp==='' ? "address" : $tmp);?>
",
			"contact": {
				"phone": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['phoneNumber'])===null||$tmp==='' ? "904-555-1212" : $tmp);?>
",
				"site": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['website'])===null||$tmp==='' ? "http://" : $tmp);?>
",
				"email": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['emailAddress'])===null||$tmp==='' ? "email" : $tmp);?>
"
			},
			"detailsLink": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['website'])===null||$tmp==='' ? "#" : $tmp);?>
"
		}   <?php if (!$_smarty_tpl->tpl_vars['event']->last){?> , <?php }?>
<?php } ?>


	]
}<?php }} ?>