{extends file="db:kingboard-framework"}

	{block name="footer-js"}
<script type='text/javascript' src='http://fullcalendar.io/js/fullcalendar-2.1.1/gcal.js'></script>
<script>
$( function() {


});

</script>
<script>
$( function() {

	$('#calendar').fullCalendar({

		googleCalendarApiKey: 'AIzaSyCcgTPl2yomvIUwxwYjpju2Gbpch5gMDw4',
		
		events: {
			googleCalendarId: 'en.usa#holiday@group.v.calendar.google.com'
		}
	});
});

</script>
<style>
#calendar {
		margin: 0 auto;
	}
</style>

	{/block}
	
	
	<!--  With Calendar Functionality -->
	
<!-- <!-- 	{extends file="db:kingboard-framework"} --> -->

<!-- <!-- 	{block name="footer-js"} --> -->
<!-- <!-- <script type='text/javascript' src='http://fullcalendar.io/js/fullcalendar-2.1.1/gcal.js'></script> --> -->
<!-- <!-- <script> --> -->
// $( function() {


// });

<!-- <!-- </script> --> -->
<!-- <!-- <script> --> -->
// $( function() {

// 	$('#calendar').fullCalendar({

 	    eventSources: [

         // your event source
         {
             url: '/calendar/ajax/"+status+"?PHPSESSID={$sessionID}"',
             type: 'POST',
             data: {},

             error: function() {
                 alert('there was an error while fetching events!');
             },
             color: 'yellow',   // a non-ajax option
             textColor: 'black' // a non-ajax option
         }

         // any other sources...
    ]
 	});
 });

 </script> --> -->
 <style> --> -->
 #calendar { */
 		margin: 0 auto; */
 	} */
</style> --> -->

{/block}
	