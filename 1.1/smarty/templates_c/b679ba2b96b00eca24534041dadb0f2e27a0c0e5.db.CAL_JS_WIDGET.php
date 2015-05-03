<?php /* Smarty version Smarty-3.1.13, created on 2013-12-24 07:37:52
         compiled from "db:cal_js_widget" */ ?>
<?php /*%%SmartyHeaderCode:113585395752a0ce504e9869-29414244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b679ba2b96b00eca24534041dadb0f2e27a0c0e5' => 
    array (
      0 => 'db:cal_js_widget',
      1 => 1387906668,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '113585395752a0ce504e9869-29414244',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a0ce5062b582_55887840',
  'variables' => 
  array (
    'calendarView' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a0ce5062b582_55887840')) {function content_52a0ce5062b582_55887840($_smarty_tpl) {?>(function() {



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
        var css_link = $("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/styles.css" 
        });
        css_link.appendTo('head');          

        var css_link = $("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/datepicker.css" 
        });
        css_link.appendTo('head');  


        var css_link = $("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "http://www.filelogix.com/buzz/css/form.css" 
        });
        css_link.appendTo('head');  

        var css_link = $("<link>", { 
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
 //          $('#buzz-calendar').html("Loading...");
           $('#buzz-calendar').html("<center><img src='http://www.filelogix.com/buzz/images/ajax-loader.gif'/></center>");
      $.get(url, function(data) {
        $('#buzz-calendar').html(data);
       });

    });
}

})(); // We call our anonymous function immediately<?php }} ?>