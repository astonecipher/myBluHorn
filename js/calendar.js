

function calendarNext(range) {

	jQuery("#buzz-calendar-container").html('');

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/" + range +"/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
     jQuery('#view-all-results').html("Searching For Events...");
   jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');

   jQuery('#buzz-calendar-container').show();

//	jQuery("#list-large-event").html('');
}

function calendarNextMonth(size) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/nextMonth/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
      jQuery('#view-all-results').html("Searching For Events...");
  jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	jQuery("#list-large-event").html('');
}

function calendarThisMonth(size) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}
	
//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/thisMonth/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
      jQuery('#view-all-results').html("Searching For Events...");
  jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});
	

//	jQuery("#list-large-event").html('');
}

function calendarNextWeek(size) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}
	
//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/nextWeek/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
     jQuery('#view-all-results').html("Searching For Events...");
   jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});
//   jQuery('#buzz-calendar-container').show();

//	jQuery("#list-large-event").html('');
}

function calendarPrevious(size, fromDate, toDate) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').fadeOut("Loading...");
     jQuery('#view-all-results').html("Searching For Events...");
   jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	jQuery("#list-large-event").html('');
}

function calendarNext(size, fromDate, toDate) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert(jQuery('#buzz-search-form').serialize());
     jQuery('#view-all-results').html("Searching For Events...");
   var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	jQuery("#list-large-event").html('');
}

function calendarNextEvent(size, fromDate, toDate, eventID) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert(jQuery('#buzz-search-form').serialize());
     jQuery('#view-all-results').html("Searching For Events...");
   var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/event/" + eventID + "/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			})
   });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	jQuery("#list-large-event").html('');
}


function calendarPreviousEvent(size, fromDate, toDate, eventID) {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert(jQuery('#buzz-search-form').serialize());
     jQuery('#view-all-results').html("Searching For Events...");
   var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/event/" + eventID + "/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			})
   });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	jQuery("#list-large-event").html('');
}

function calendarLargeNextWeek() {

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/nextWeek/?" + jQuery('#buzz-search-form').serialize();
      jQuery('#view-all-results').html("Searching For Events...");
  jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
  });

//   jQuery('#buzz-calendar-container').show();

//	jQuery("#list-large-event").html('');
}



function calendarViewAllResults() {

    jQuery(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 1000);
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarFullViewAllResults() {

    jQuery(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 1000);
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarGoTo(day) {


   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
    // Animation complete.
//	jQuery("#buzz-calendar-container").html('');

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
      jQuery('#view-all-results').html("Searching For Events...");
  jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
  });
//	jQuery('#buzz-calendar-container').slideDown("slow");

//   jQuery('#buzz-calendar-container').show();



//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
	
}


function calendarFullGoTo(day) {


   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
    // Animation complete.
//	jQuery("#buzz-calendar-container").html('');

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/full/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
      jQuery('#view-all-results').html("Searching For Events...");
  jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
    });	
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
  });
//	jQuery('#buzz-calendar-container').slideDown("slow");

//   jQuery('#buzz-calendar-container').show();



//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
	
}

function calendarSmallNextMonth() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-result-section-01').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-result-section-01r').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallNextWeek() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextWeek/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextWeek/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}


function calendarSmallThisMonth() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/thisMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/thisMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallGoTo(day) {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		    var url = "http://www.filelogix.com/buzz/calendar/widget/small/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		    var url = "http://www.filelogix.com/buzz/calendar/widget/small/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}
}

function calendarSmallNext(size, fromDate, toDate) {


	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallPrevious(size, fromDate, toDate) {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		   var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

			var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}


function calendarGo(eventID) {

//   jQuery('#buzz-calendar-container-event').hide();
   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/go/?" + jQuery('#buzz-search-form').serialize();
   // jQuery('#buzz-calendar-container').html("Loading...");
    jQuery('#view-all-results').html("Searching For Events...");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			});
    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarFullGo(eventID) {

//   jQuery('#buzz-calendar-container-event').hide();
   jQuery('#buzz-calendar-container').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/full/go/?" + jQuery('#buzz-search-form').serialize();
   // jQuery('#buzz-calendar-container').html("Loading...");
//    jQuery('#view-all-results').html("Searching For Events...");
	jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarFullViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: 0px; top: 15px;'>Searching For Events...</a></div>");
    jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			});
    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}


function calendarSmallGoAlt(eventID) {

   jQuery('#info-carousel-01').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
//console.log(data);
          jQuery('#buzz-event-slides-01').html(data);
		jQuery('#info-carousel-01').flexslider( {
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 98,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		} );
		  jQuery('#info-carousel-01').slideDown();
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarSmallGo(eventID) {

 //  jQuery('#buzz-calendar-container-event').hide();
if(jQuery('#info-carousel-01').is(":visible")) {
   jQuery('#info-carousel-01').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
//console.log(data);
          jQuery('#buzz-result-section-01').html(data);
		  jQuery('#info-section-01').slideDown();
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');

}
else {
	calendarSmallGo2(eventID);
}


//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarSmallGo2(eventID) {

//   jQuery('#buzz-calendar-container-event').hide();
   jQuery('#info-section-01').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
//console.log(data);
          jQuery('#buzz-result-section-01').html(data);
		  jQuery('#info-section-01').slideDown();
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}


function calendarMediumGo2(eventID) {

//   jQuery('#buzz-calendar-container-event').hide();
    jQuery('#buzz-container-01').slideUp( "slow", function() {

//	alert(jQuery('#buzz-search-form').serialize());
    jQuery('#buzz-calendar-popup-add-event').hide();
    jQuery('#info-section-01').show();
    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/go/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
//console.log(data);
          jQuery('#buzz-result-section-01').html(data);
		  jQuery('#buzz-container-01').slideDown();
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}


function calendarMediumGo(eventID) {

 //  jQuery('#buzz-calendar-container-event').hide();
if(jQuery('#info-carousel-01').is(":visible")) {
   jQuery('#info-carousel-01').slideUp( "slow", function() {
		   jQuery('#buzz-calendar-popup-add-event').hide();

//	alert(jQuery('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/go/?" + jQuery('#buzz-search-form').serialize();
    jQuery('#buzz-calendar-container').html("Loading...");
    jQuery.get(url, function(data) {
//console.log(data);
          jQuery('#buzz-result-section-01').html(data);
		  jQuery('#info-section-01').slideDown();
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');

}
else {
	calendarMediumGo2(eventID);
}


//	jQuery("#list-large-event").html('');

//   jQuery('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarMediumNextMonth() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
		    jQuery('#buzz-calendar-popup-add-event').hide();
	 
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/nextMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-result-section-01').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		    jQuery('#buzz-calendar-popup-add-event').hide();
		    jQuery('#info-section-01').show();
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/nextMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-result-section-01r').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarMediumNextWeek() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
 	 	    jQuery('#buzz-calendar-popup-add-event').hide();
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/nextWeek/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {
 		    jQuery('#buzz-calendar-popup-add-event').hide();
 		    jQuery('#info-section-01').show();

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/nextWeek/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}


function calendarMediumThisMonth() {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
		    jQuery('#buzz-calendar-popup-add-event').hide();
		    jQuery('#info-section-01').show();
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/thisMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		    jQuery('#buzz-calendar-popup-add-event').hide();
		   	jQuery('#info-section-01').show();
		  	var url = "http://www.filelogix.com/buzz/calendar/widget/medium/thisMonth/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarMediumGoTo(day) {

	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
		   jQuery('#buzz-calendar-popup-add-event').hide();
	
		    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
	          jQuery('#buzz-result-section-01').html(data);
			  jQuery('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		jQuery('#buzz-container-01').slideUp( "slow", function() {
//		jQuery('#info-section-01').slideUp( "slow", function() {
		    jQuery('#buzz-calendar-popup-add-event').hide();
		    jQuery('#info-section-01').show();

		    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/day/" + day.replace(/\//g,"-") + "/?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
				jQuery('#buzz-result-section-01').html(data);
				jQuery('#buzz-container-01').slideDown();

			});
		});

	}
}


function calendarAddEvent() {

	jQuery("#list-large-event").html('');

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
	    var url = "http://www.filelogix.com/buzz/calendar/widget/addEvent" + "/?"+ jQuery('#buzz-calendar-add-event').serialize();;
		jQuery('#buzz-calendar-container').html("Loading...");
		jQuery.get(url, function(data) {
    	      jQuery('#buzz-calendar-container').html("<br>" + data);
			  jQuery('#buzz-calendar-container').slideDown( "slow", function() {
				  jQuery("#buzz-calendar-container .scrollable-area").animate({height:'100%'}, 1000);
				  showRecaptcha('recaptcha_div');
				  customForm.customForms.replaceAll();			
			  });

			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });	
		 });	
	});	 
			 

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}


function calendarSubmit() {

	jQuery("#list-large-event").html('');

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
	    var url = "http://www.filelogix.com/buzz/calendar/widget/large/add/event" + "/?"+ jQuery('#buzz-calendar-add-event').serialize();;
		jQuery('#buzz-calendar-container').html("Loading...");
		jQuery.get(url, function(data) {
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
//	      jQuery('.scrollable-area').animate({ scrollTop: jQuery(eventID).offsetHeight()*2 }, 1000);
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			});

			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
		});	
	});	 
			 

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}



function calendarTellAFriend() {

	jQuery("#list-large-event").html('');

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
	    var url = "http://www.filelogix.com/buzz/calendar/widget/large/tell-a-friend" + "/?"+ jQuery('#buzz-calendar-add-event').serialize();;
		jQuery('#buzz-calendar-container').html("Loading...");
		jQuery.get(url, function(data) {
    	      jQuery('#buzz-calendar-container').html("<br>" + data);
			  jQuery('#buzz-calendar-container').slideDown( "slow", function() {
				  jQuery("#buzz-calendar-container .scrollable-area").animate({height:'100%'}, 1000);
				  showRecaptcha('recaptcha_div');
				  customForm.customForms.replaceAll();			
			  });

			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });		 });	
	});	 
			 

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}


function calendarSignUp() {

	jQuery("#list-large-event").html('');

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
	    var url = "http://www.filelogix.com/buzz/calendar/widget/large/newsletter" + "/?"+ jQuery('#buzz-calendar-add-event').serialize();;
		jQuery('#buzz-calendar-container').html("Loading...");
		jQuery.get(url, function(data) {
    	      jQuery('#buzz-calendar-container').html("<br>" + data);
			  jQuery('#buzz-calendar-container').slideDown( "slow", function() {
				  jQuery("#buzz-calendar-container .scrollable-area").animate({height:'100%'}, 1000);
				  showRecaptcha('recaptcha_div');
				  customForm.customForms.replaceAll();			
			  });

			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });		 });	
	});	 
			 

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarMediumAddEvent() {

/*
		jQuery('#buzz-container-01').slideUp( "slow", function() {

			  //showRecaptcha('recaptcha_div');
	          jQuery('#buzz-calendar-popup-add-event').show();
	          jQuery('#info-section-01').hide();
	          jQuery('#lbl-07').focus();
			  jQuery('#buzz-container-01').slideDown();




			});
*/


	if(jQuery('#info-carousel-01').is(":visible")) {
	   jQuery('#info-carousel-01').slideUp( "slow", function() {
	
		    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/add?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
//	          jQuery('#buzz-scrollable-area-01').html(data);
	          jQuery('#buzz-container-01').html(data);
			  customForm.customForms.replaceAll();			
			  jQuery('#info-section-01').slideDown();
	
			});

//			showRecaptcha('recaptcha_div');

	
			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });		

	  });

 
	
	}
	else {

		jQuery('#info-section-01').slideUp( "slow", function() {

		    var url = "http://www.filelogix.com/buzz/calendar/widget/medium/add?" + jQuery('#buzz-search-form').serialize();
			jQuery('#buzz-calendar-container').html("Loading...");
			jQuery.get(url, function(data) {
//	          jQuery('#buzz-scrollable-area-01').html(data);
	          jQuery('#buzz-container-01').html(data);
			  jQuery('#info-section-01').slideDown();

			});

//			showRecaptcha('recaptcha_div');
			customForm.customForms.replaceAll();			

	
			  jQuery('#datepicker-05').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-05" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-06').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });
			  jQuery('#datepicker-07').datepicker({
				  onClose: function( selectedDate ) {
				  	jQuery( "#datepicker-07" ).datepicker( "option", "minDate", selectedDate );
				  }
			  });	
		});

	}
	
}

function calendarSubmitEvent() {

	jQuery("#list-large-event").html('');

   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
	    var url = "http://www.filelogix.com/buzz/calendar/verify";
		jQuery('#buzz-calendar-container').html("Loading...");
		jQuery.get(url, function(data) {
    	      jQuery('#buzz-calendar-container').html("<br>" + data);
			  jQuery('#buzz-calendar-container').slideDown( "slow", function() {
				  jQuery("#buzz-calendar-container .scrollable-area").animate({height:'100%'}, 1000);
				  showRecaptcha('recaptcha_div');
				  customForm.customForms.replaceAll();

			  });
		 });	
	});	 
			 

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarGoToEvent(eventID) {

//	jQuery("#list-large-event").html('');
//   jQuery('#buzz-calendar-container-event').hide();
   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
   jQuery('#buzz-calendar-container').hide();
    var url = "http://www.filelogix.com/buzz/calendar/widget/event/details/" + eventID + "?" + jQuery('#buzz-search-form').serialize();
//   jQuery('#buzz-calendar-container').html("Loading...");

 	jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'>Loading Event(" + eventID + ")</a></div>");

    jQuery.get(url, function(data) {
 		  jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'>Event Loaded</a></div>");
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
 		  jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'></a></div>");
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			});
	  });	
   });

//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 300);

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarFullGoToEvent(eventID) {

//	jQuery("#list-large-event").html('');
//   jQuery('#buzz-calendar-container-event').hide();
   jQuery('#buzz-calendar-container').slideUp( "slow", function() {
   jQuery('#buzz-calendar-container').hide();
    var url = "http://www.filelogix.com/buzz/calendar/widget/full/event/id/" + eventID  + "?" + jQuery('#buzz-search-form').serialize();
//   jQuery('#buzz-calendar-container').html("Loading...");

 	jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: 0px; top: 15px;'>Loading Event(" + eventID + ")</a></div>");

    jQuery.get(url, function(data) {
 		  jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: 0px; top: 15px;>Event Loaded</a></div>");
          jQuery('#buzz-calendar-container').html("<br>" + data);
		  jQuery('#buzz-calendar-container').slideDown("slow");
 		  jQuery('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: 0px; top: 15px;'></a></div>");
  		  createMap("map-canvas",30.33,-81.66,15);
			jQuery("#map-canvas").ready(function() {
			    centerMap();
			});
	  });	
   });

//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 300);

//   alert("View All Results.");
//   jQuery(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	jQuery("#list-large-event").html('');
	
}

function calendarBackToSearch(eventID) {

	calendarGo("#event-" + eventID);

}

function calendarFullBackToSearch(eventID) {

	calendarFullGo("#event-" + eventID);

}

function createMap(mapdiv,lat,lon,zoom) {
  google.maps.visualRefresh = true;
  if (!lat) {
	  lat = 30.33;
  }
  if (!lon) {
	  lon = -81.66;
  }
  if (!zoom) {
	  zoom=15;
  }
  var myLatlng = new google.maps.LatLng(lat,lon);
  var mapOptions = {
    zoom: zoom,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Location'
  });

}

function showRecaptcha(element) {
       Recaptcha.create("6LeEtusSAAAAABKoVJEavabdT5yABrbi9za1U95_", element, {
         theme: "white",
         callback: Recaptcha.focus_response_field});
}
