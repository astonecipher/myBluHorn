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