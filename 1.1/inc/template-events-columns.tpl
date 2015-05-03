<% for (var i = 0; i < events.length; i++) { %>
	<article class="column" data-date="<%= events[i].date %>" data-category="<%= events[i].category %>">
		<img src="images/img01.png" width="141" height="77" alt="">
		<div class="container">
			<h2><a href="<%= events[i].detailsPage %>"><%= events[i].title %></a></h2>
			<span class="category"><a href="<%= events[i].categoryLink %>"><%= events[i].category %></a></span>
			<em class="date"><%= jQuery.datepicker.formatDate('MM d, yy', jQuery.datepicker.parseDate('m/d/yy', events[i].date)) %></em>
			<a href="<%= events[i].detailsLink %>" class="more">FIND OUT MORE</a>
		</div>
	</article>
<% } %>