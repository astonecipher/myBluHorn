<% for (var i = 0; i < events.length; i++) { %>
	<article class="article" data-date="<%= events[i].date %>" data-category="<%= events[i].category %>">
		<div class="img-holder">
			<img src="<%= events[i].image %>" width="90" height="90" alt="">
		</div>
		<div class="block">
			<header>
				<h2><a href="<%= events[i].detailsPage %>"><%= events[i].title %></a></h2>
				<span class="category"><a href="<%= events[i].categoryLink %>"><%= events[i].category %></a></span>
				<em class="date">Date: <%= jQuery.datepicker.formatDate('MM d, yy', jQuery.datepicker.parseDate('mm/dd/yy', events[i].date)) %></em>
			</header>
			<%= events[i].description %>
			<div class="link-holder">
				<a href="<%= events[i].detailsLink %>" class="btn-link">GET DETAILS</a>
			</div>
		</div>
		<aside class="aside">
			<span class="title"><%= events[i].venueName %></span>
			<address><%= events[i].venueAddress %></address>
			<dl>
				<dt>Ph:</dt>
				<dd><%= events[i].contact.phone %></dd>
			</dl>
			<p><a href="http://<%= events[i].contact.site %>"><%= events[i].contact.site %></a></p>
			<a href="mailto:<%= events[i].contact.email %>">EMAIL US</a>
		</aside>
	</article>
<% } %>