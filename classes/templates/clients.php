{extends file="db:kingboard-framework"}

{block name="header-js"}


{/block}

{block name="header-css"}

{/block}

{block name="sidebar-clicked"} {/block}

{block name="breadcrumb"}
		<ul class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="home">Home</a>
			</li>
			<li class="active">Clients</li>
			</ul>
{/block}

{block name="main"}

							<div class="main-header">
								<h2>Clients</h2>
								<em>Listing of All Clients</em>
							</div>

								<div class="widget widget-table">
									<div class="widget-header">
										<h3><i class="fa fa-users"></i> Clients</h3>
										<em>- <a href="clients/create">Add A New Client</a> or Search Existing</em>
									</div>
									<div class="widget-content">
										<table class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Name</th>
													<th>Contact</th>
													<th>Phone Number</th>
													<th>Email Address</th>
													<th>Total Spend</th>

	<th></th>
												</tr>
											</thead>
											<tbody>

{foreach $clients as $client}
												<tr>
													<td><a href="clients/edit/{$client.id}">{$client.name}</a></td>
													<td>{$client.contactName}</td>
													<td>{$client.phoneNumber}</td>
													<td>{$client.emailAddress}</td>
													<td>{$client.totalSpend|default:"$0.00"|number_format:2:".":""}</td>

	<td><center><a href="clients/edit/{$client.id}"><i class="fa fa-pencil fa-lg" ></i></a></center></td>
	
												</tr>
{/foreach}
												</tbody>
										</table>
									</div>
								</div>

{/block}

{block name="footer-js"}

<script type='text/javascript' src='http://fullcalendar.io/js/fullcalendar-2.1.1/gcal.js'></script>
<script>
$( function() {

	$('#calendar').fullCalendar({

    eventSources: [

        // your event source
        {
		url: '/calendar/ajax/campaigns{$url}',
        }

    ]

	});
});

</script>
	

	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.bootstrap.js"></script>



{/block}