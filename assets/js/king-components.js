 $(document).ready(function(){

	if( $('body').hasClass('comp-wizard') ) {

		//*******************************************
		/*	FORM WIZARD
		/********************************************/

		$('#demo-wizard').on('change', function(e, data) {
			// validation
			if( $('#form'+data.step).length > 0 ) {
				$('#form'+data.step).parsley('validate');
				if( !$('#form'+data.step).parsley('isValid') )
					return false;
				}

			// last step button
			$btnNext = $(this).parents('.wizard-wrapper').find('.btn-next');
			
			if(data.step === 3 && data.direction == 'next') {
				$btnNext.text(' Create My Account')
				.prepend('<i class="fa fa-check-circle"></i>')
				.removeClass('btn-primary').addClass('btn-success');
			}else{
				$btnNext.text('Next ').
				append('<i class="fa fa-arrow-right"></i>')
				.removeClass('btn-success').addClass('btn-primary');
			}
				
		}).on('finished', function(){
			alert('Your account has been created.');
		});

		$('.wizard-wrapper .btn-next').click( function(){
			$('#demo-wizard').wizard('next');
		});

		$('.wizard-wrapper .btn-prev').click( function(){
			$('#demo-wizard').wizard('previous');
		});
	}
	

	//*******************************************
	/*	CALENDAR PAGE
	/********************************************/
	if( $('body').hasClass('fullcalendar') ) {

		// init the external events
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});

		// init the calendar

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('.calendar').fullCalendar({
			header: {
				left: 'month, agendaWeek, agendaDay',
				center: 'title',
				right: 'prev, next, today'
			},
			editable: true,
			droppable: true,
			drop: function(date, allDay) {
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('.calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
			},
				events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d+5),
					end: new Date(y, m, d+7)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Visit Other Theme',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'https://wrapbootstrap.com/theme/cvilized-timeline-style-cv-resume-WB057FN0R'
				}
			],
		});

 		$colorPicker = $('select[name="colorpicker-picker-longlist"]');
 		$colorPicker.simplecolorpicker({
			picker: false, 
			theme: 'fontawesome'
		});

		$('#btn-quick-event').click( function() {
			
			var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
			var eventTitle = 'Untitled Event';

			if( $('#quick-event-name').val() != '' ) {
				eventTitle = $('#quick-event-name').val();
			}

			copiedEventObject.title = eventTitle;
			copiedEventObject.start = date; // today
			copiedEventObject.color = $colorPicker.val();
				
			$('.calendar').fullCalendar('renderEvent', copiedEventObject, true);
		});

	} // end calendar page demo

 }); // end ready function