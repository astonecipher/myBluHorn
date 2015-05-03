
jQuery(document).ready(function($) {
//$(document).ready(function() {
	jQuery.fn.exists = function(){return this.length>0;}
	if ($('.fancybox').exists()) {
		$('.fancybox').fancybox({
			padding: 0,
			margin: 0,
			closeBtn: true,
			maxHeight: 1000,
			helpers : {
			        overlay : {
			            css : {
			                'background' : 'rgba(0,0,0, 0.85)'
			            }
					}
			
			},
			afterLoad: function(current, previous) {
				$('#popup-01-btn').html("Calendar");
			}
		});
	}
	if ($('#carousel-01').exists()) {
		$('#carousel-01').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 29,
			move: 1
		});
	}
	if ($('#carousel-02').exists()) {
		$('#carousel-02').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 60,
			move: 1
		});
	}
	if ($('#carousel-03').exists()) {
		$('#carousel-03').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 42,
			move: 1
		});
	}
	if ($('#carousel-04').exists()) {
		$('#carousel-04').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 37,
			move: 1
		});
	}

	if ($('#datepicker-01').exists()) {
		$('#datepicker-01').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-02" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-02').exists()) {
		$('#datepicker-02').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-01" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-03').exists()) {
		$('#datepicker-03').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-04" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-04').exists()) {
		$('#datepicker-04').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-03" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-05').exists()) {
		$('#datepicker-05').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-06" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-06').exists()) {
		$('#datepicker-06').datepicker({
			onClose: function( selectedDate ) {
				$( "#datepicker-05" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	}
	if ($('#datepicker-07').exists()) {
		$('#datepicker-07').datepicker();
	}
//	jQuery.datepicker.regional['en-US'] = {
//		dateFormat: 'm/d/y',
//		dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
//		dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
//	}
//	jQuery.datepicker.setDefaults($.datepicker.regional['en-US']);
	if ($('#info-carousel-01').exists()) {
		$('#info-carousel-01').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 98,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		});
	}
	if ($('#info-carousel-02').exists()) {
		$('#info-carousel-02').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 140,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		});
	}

	if ($('#carousel-01').exists()) {
		$('#carousel-01').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 98,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		});
	}
	if ($('#carousel-02').exists()) {
		$('#carousel-02').flexslider({
			animation: "slide",
			slideshow: false,
			animationLoop: false,
			controlNav: false,
			itemWidth: 140,
			prevText: "view previous",
			nextText: "View more",
			move: 1
		});
	}
	
	if ($('.add-effect').exists()) {
//		$(".add-effect").effect('shake', {times:4, distance:2}, 1000);
	}

	if ($('.buzz-calendar .events, .scrollable-area').exists()){
//		customForm.lib.domReady(function(){
		customForm.lib.domReady(function(){
			customForm.customForms.replaceAll();
		});
	}
	
	//if ($('.info-section').exists()) {
	//	$('.info-section .scrollable-area').height($(window).height()- $('#header').outerHeight() - 20 - $('.events').height() - $('#footer').outerHeight());
	//	$(window).resize(function(){
	//		$('.info-section .scrollable-area-wrapper').height($(window).height()- $('#header').outerHeight() - 53 - $('.events').height() - $('#footer').outerHeight());
	//	})
	//}
//	if ($('.info-section-01').exists()) {
//		$('.info-section-01 .scrollable-area').height($(window).height()- $('#header').outerHeight() - 20 - $('.events').height() - $('#footer').outerHeight());
//		$(window).resize(function(){
//			$('.info-section-01 .scrollable-area-wrapper').height($(window).height()- $('#header').outerHeight() - 53 - $('.events').height() - $('#footer').outerHeight());
//		})
//	}
/*
	if ($('#view-all-results').exists()) {
		$('#view-all-results').click(function(){
			$.get( "ajax-large-eventpage-buzz.html", function( data ) {
				$( "#list-large-event" ).append( data );
			});
			return false;
		});
	}
	if ($('#list-large-event').exists()) {
		$('#list-large-event .more').click(function(){
			$.get( "ajax-large-eventpage-details.html", function( data ) {
				$('.info-section .scrollable-area-wrapper').fadeOut();
				$('#view-all-results').fadeOut();
				$('.event-detailed').fadeIn().html( data );
			});
			return false;
		});
	}
*/
});