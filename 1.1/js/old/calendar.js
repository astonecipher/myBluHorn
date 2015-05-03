function calendarNext(range) {

   $('#buzz-calendar-container-event').hide();
	$("#buzz-calendar-container").html('');

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/" + range +"/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
    });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');

   $('#buzz-calendar-container').show();

//	$("#list-large-event").html('');
}

function calendarNextMonth(size) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/nextMonth/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	$("#list-large-event").html('');
}

function calendarThisMonth(size) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}
	
//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/thisMonth/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});
	

//	$("#list-large-event").html('');
}

function calendarNextWeek(size) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}
	
//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/nextWeek/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});
//   $('#buzz-calendar-container').show();

//	$("#list-large-event").html('');
}

function calendarPrevious(size, fromDate, toDate) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').fadeOut("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	$("#list-large-event").html('');
}

function calendarNext(size, fromDate, toDate) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

	if (!size) {
		size = "large";
	}

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
   });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
	});

//	$("#list-large-event").html('');
}

function calendarLargeNextWeek() {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/nextWeek/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
    });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
  });

//   $('#buzz-calendar-container').show();

//	$("#list-large-event").html('');
}



function calendarViewAllResults() {

    $(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 1000);
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	$("#list-large-event").html('');
	
}

function calendarGoTo(day) {


   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {
    // Animation complete.
//	$("#buzz-calendar-container").html('');

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/day/" + day.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown("slow");
    });	
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');
  });
//	$('#buzz-calendar-container').slideDown("slow");

//   $('#buzz-calendar-container').show();



//	$("#list-large-event").html('');

//   $('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
	
}

function calendarSmallNextMonth() {

	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextMonth/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextMonth/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallNextWeek() {

	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextWeek/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/nextWeek/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}

	
}


function calendarSmallThisMonth() {

	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/thisMonth/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

		   	var url = "http://www.filelogix.com/buzz/calendar/widget/small/thisMonth/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallGoTo(day) {

	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
		    var url = "http://www.filelogix.com/buzz/calendar/widget/small/day/" + day.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

		    var url = "http://www.filelogix.com/buzz/calendar/widget/small/day/" + day.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}
}

function calendarSmallNext(size, fromDate, toDate) {


	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

    var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/next/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}

	
}

function calendarSmallPrevious(size, fromDate, toDate) {

	if($('#info-carousel-01').is(":visible")) {
	   $('#info-carousel-01').slideUp( "slow", function() {
	
		   var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
	          $('#buzz-result-section-01').html(data);
			  $('#info-section-01').slideDown();
	
			});
	    });
	
	}
	else {

		$('#info-section-01').slideUp( "slow", function() {

			var url = "http://www.filelogix.com/buzz/calendar/widget/" + size + "/previous/" + fromDate.replace(/\//g,"-") + "/" + toDate.replace(/\//g,"-") + "/?" + $('#buzz-search-form').serialize();
			$('#buzz-calendar-container').html("Loading...");
			$.get(url, function(data) {
				$('#buzz-result-section-01').html(data);
				$('#info-section-01').slideDown();

			});
		});

	}

	
}


function calendarGo(eventID) {

   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/large/go/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown();
	      $('.scrollable-area').animate({ scrollTop: $(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	$("#list-large-event").html('');

//   $('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarSmallGoAlt(eventID) {

   $('#buzz-calendar-container-event').hide();
   $('#info-carousel-01').slideUp( "slow", function() {

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
//console.log(data);
          $('#buzz-event-slides-01').html(data);
		$('#info-carousel-01').flexslider( {
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 98,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		} );
		  $('#info-carousel-01').slideDown();
//	      $('.scrollable-area').animate({ scrollTop: $(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	$("#list-large-event").html('');

//   $('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarSmallGo(eventID) {

 //  $('#buzz-calendar-container-event').hide();
if($('#info-carousel-01').is(":visible")) {
   $('#info-carousel-01').slideUp( "slow", function() {

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
//console.log(data);
          $('#buzz-result-section-01').html(data);
		  $('#info-section-01').slideDown();
//	      $('.scrollable-area').animate({ scrollTop: $(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');

}
else {
	calendarSmallGo2(eventID);
}


//	$("#list-large-event").html('');

//   $('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarSmallGo2(eventID) {

//   $('#buzz-calendar-container-event').hide();
   $('#info-section-01').slideUp( "slow", function() {

//	alert($('#buzz-search-form').serialize());
    var url = "http://www.filelogix.com/buzz/calendar/widget/small/go/?" + $('#buzz-search-form').serialize();
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
//console.log(data);
          $('#buzz-result-section-01').html(data);
		  $('#info-section-01').slideDown();
//	      $('.scrollable-area').animate({ scrollTop: $(eventID).offsetHeight()*2 }, 1000);

    });
    });
//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');




//	$("#list-large-event").html('');

//   $('#view-all-results').html("View all results (60 more)<i>&nbsp;</i>");
	
}

function calendarAddEvent() {

	$("#list-large-event").html('');

    var url = "http://www.filelogix.com/buzz/calendar/widget/addEvent";
    $('#buzz-calendar-container').html("Loading...");
    $.get(url, function(data) {
          $('#buzz-calendar-container').html("<br>" + data);
    });	

   $(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 300);

//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	$("#list-large-event").html('');
	
}

function calendarGoToEvent(eventID) {

   createMap();
	
//	$("#list-large-event").html('');
//   $('#buzz-calendar-container-event').hide();
   $('#buzz-calendar-container').slideUp( "slow", function() {
   $('#buzz-calendar-container').hide();
    var url = "http://www.filelogix.com/buzz/calendar/widget/event/details/" + eventID;
//   $('#buzz-calendar-container').html("Loading...");

 	$('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'>Loading Event(" + eventID + ")</a></div>");

    $.get(url, function(data) {
 		  $('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'>Event Loaded</a></div>");
          $('#buzz-calendar-container').html("<br>" + data);
		  $('#buzz-calendar-container').slideDown("slow");
 		  $('#more-results').html("<div class='all-results'><a href='javascript:calendarViewAllResults(this);' class='opener' id='view-all-results' style='margin-left: -80px;'></a></div>");

    });	
   });

//   $(".buzz-calendar.large-width .info-section .scrollable-area").animate({height:'100%'}, 300);

//   alert("View All Results.");
//   $(".buzz-calendar.large-width .info-section .scrollable-area").height('100%');


//	$("#list-large-event").html('');
	
}

function calendarBackToSearch(eventID) {

	calendarGo("#event-" + eventID);

}

function createMap() {
/*
        GMaps.geocode({
          address: $.trim('Jacksonville, FL 32202'),
          callback: function(results, status){
            if(status=='OK'){
              var latlng = results[0].geometry.location;
              map.setCenter(latlng.lat(), latlng.lng());
              map.addMarker({
                lat: latlng.lat(),
                lng: latlng.lng()
              });
            }
          }
        });
*/
}