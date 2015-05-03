<?php /* Smarty version Smarty-3.1.13, created on 2014-01-06 14:29:27
         compiled from "db:cal_js_widget2" */ ?>
<?php /*%%SmartyHeaderCode:42096202752c4f60bb26bb3-24052808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d6abcbfcd02b8296f591fdae5536dc18b9b5a9f' => 
    array (
      0 => 'db:cal_js_widget2',
      1 => 1389036524,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '42096202752c4f60bb26bb3-24052808',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52c4f60bbba9c4_46255421',
  'variables' => 
  array (
    'calendarView' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c4f60bbba9c4_46255421')) {function content_52c4f60bbba9c4_46255421($_smarty_tpl) {?>(function() {

// Localize jQuery variable
var jQuery;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.10.2') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "http://www.filelogix.com/buzz/js/jquery-1-10-2-min.js");


  
 
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else {
      script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);

} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
  main();
}

/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
  //$.noConflict();
     //jQuery = window.jQuery.noConflict(true);
    // Call our main function
//  jQuery.noConflict();
	    main(); 
}



function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

/******** Our main function ********/
function main() { 

   var script_tag_js_ui = document.createElement('script');
    script_tag_js_ui.setAttribute("type","text/javascript");
    script_tag_js_ui.setAttribute("src",
        "http://www.filelogix.com/buzz/js/jquery-ui-1-10-3.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag_js_ui);

    var script_tag_js_custom_form = document.createElement('script');
    script_tag_js_custom_form.setAttribute("type","text/javascript");
    script_tag_js_custom_form.setAttribute("src",
        "http://www.filelogix.com/buzz/js/custom-form.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag_js_custom_form);
    
    var script_tag_js_fancybox = document.createElement('script');
    script_tag_js_fancybox.setAttribute("type","text/javascript");
    script_tag_js_fancybox.setAttribute("src",
        "http://www.filelogix.com/buzz/js/jquery.fancybox.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag_js_fancybox);
    
    var script_tag_js_flexslider = document.createElement('script');
    script_tag_js_flexslider.setAttribute("type","text/javascript");
    script_tag_js_flexslider.setAttribute("src",
        "http://www.filelogix.com/buzz/js/jquery.flexslider-min.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag_js_flexslider);
    
    var script_tag_js_ajax_old = document.createElement('script');
    script_tag_js_ajax_old.setAttribute("type","text/javascript");
    script_tag_js_ajax_old.setAttribute("src",
        "http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag_js_ajax_old);
  
    var script_tag_js_custom_form_select = document.createElement('script');
    script_tag_js_custom_form_select.setAttribute("type","text/javascript");
    script_tag_js_custom_form_select.setAttribute("src",
        "http://www.filelogix.com/buzz/js/custom-form.select.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] ||document.documentElement).appendChild(script_tag_js_custom_form_select);
    
     var script_tag_js_custom_form_checkbox= document.createElement('script');
    script_tag_js_custom_form_checkbox.setAttribute("type","text/javascript");
    script_tag_js_custom_form_checkbox.setAttribute("src",
        "http://www.filelogix.com/buzz/js/custom-form.checkbox.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] ||document.documentElement).appendChild(script_tag_js_custom_form_checkbox);

      var script_tag_js_custom_form_scrollable= document.createElement('script');
    script_tag_js_custom_form_scrollable.setAttribute("type","text/javascript");
    script_tag_js_custom_form_scrollable.setAttribute("src",
        "http://www.filelogix.com/buzz/js/custom-form.scrollable.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] ||document.documentElement).appendChild(script_tag_js_custom_form_scrollable);

      var script_tag_js_validator= document.createElement('script');
    script_tag_js_validator.setAttribute("type","text/javascript");
    script_tag_js_validator.setAttribute("src",
        "http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.27/jquery.form-validator.min.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] ||document.documentElement).appendChild(script_tag_js_validator);

/*
       var script_tag_scripts= document.createElement('script');
    script_tag_scripts.setAttribute("type","text/javascript");
    script_tag_scripts.setAttribute("src",
        "http://www.filelogix.com/buzz/js/scripts.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] ||document.documentElement).appendChild(script_tag_scripts);
*/

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
	   customForm.customForms.replaceAll();

           $('#buzz-calendar').html("<center><img src='http://www.filelogix.com/buzz/images/ajax-loader.gif'/></center>");
      $.get(url, function(data) {
        $('#buzz-calendar').html(data);
       });

    });
}

})(); // We call our anonymous function immediately<?php }} ?>