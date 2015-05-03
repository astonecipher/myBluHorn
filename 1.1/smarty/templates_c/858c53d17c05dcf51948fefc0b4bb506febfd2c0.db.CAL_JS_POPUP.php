<?php /* Smarty version Smarty-3.1.13, created on 2013-12-24 08:31:43
         compiled from "db:cal_js_popup" */ ?>
<?php /*%%SmartyHeaderCode:42493446252b9837d422a07-04285529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '858c53d17c05dcf51948fefc0b4bb506febfd2c0' => 
    array (
      0 => 'db:cal_js_popup',
      1 => 1387909896,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '42493446252b9837d422a07-04285529',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b9837d46b833_12181348',
  'variables' => 
  array (
    'calendarView' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b9837d46b833_12181348')) {function content_52b9837d46b833_12181348($_smarty_tpl) {?>(function() {


jQuery.fancybox.showLoading();
main(); 


function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

/******** Our main function ********/
function main() { 
var jQuery;
jQuery = window.jQuery.noConflict();
jQuery.noConflict();

jQuery(document).ready(function($) {


      /******* Load CSS *******/
        var css_link = jQuery("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/styles.css" 
        });
        css_link.appendTo('head');          

        var css_link = jQuery("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/datepicker.css" 
        });
        css_link.appendTo('head');  


        var css_link = jQuery("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/form.css" 
        });
        css_link.appendTo('head');  

        var css_link = jQuery("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/jquery.fancybox.css" 
        });
        css_link.appendTo('head');  



        /******* Load HTML *******/
        if (getUrlVar('eventID') > 0) {
	        var url = "http://www.filelogix.com/buzz/calendar/widget/<?php echo $_smarty_tpl->tpl_vars['calendarView']->value;?>
/event/id/" + getUrlVar('eventID') + '?' + window.location.search.substring(1);;
	}
	else {
	        var url = "http://www.filelogix.com/buzz/calendar/widget/<?php echo $_smarty_tpl->tpl_vars['calendarView']->value;?>
";
	}
  //        jQuery('#buzz-calendar').html("Loading...");
           jQuery('#buzz-calendar').html("<br><center><img src='http://www.filelogix.com/buzz/images/ajax-loader.gif'/></center><br>");

      jQuery.get(url, function(data) {
        jQuery('#buzz-calendar').html(data);
	jQuery.fancybox.update();
	jQuery.fancybox.reposition();
       });

    });
}

})(); // We call our anonymous function immediately<?php }} ?>