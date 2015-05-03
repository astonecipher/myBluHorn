(function() {

// Localize jQuery variable
var jQuery;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.10.2') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers
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
    jQuery = window.jQuery.noConflict(true);
    // Call our main function
    main(); 
}



function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

/******** Our main function ********/
function main() { 
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


        /******* Load HTML *******/
        if (getUrlVar('eventID') > 0) {
	        var url = "http://www.filelogix.com/buzz/calendar/widget/{$calendarView}/event/id/" + getUrlVar('eventID');
	}
	else {
	        var url = "http://www.filelogix.com/buzz/calendar/widget/{$calendarView}";
	}
           $('#buzz-calendar').html("Loading...");
       $.get(url, function(data) {
          $('#buzz-calendar').html(data);
        });
    });
}

})(); // We call our anonymous function immediately