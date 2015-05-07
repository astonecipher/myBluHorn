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
			<li><a href="/clients/">Clients</a></li>
			<li class="active" id="breadcrumb-client-name">{$client.name}</li>
			</ul>
{/block}

{block name="main"}

							<div class="main-header">
								<h2>Clients</h2>
								<em>Information & Campaigns</em>
							</div>
<div class="col-lg-6">
	<div class="widget">
		<div class="widget-header">
				<h3>Client Information</h3>

				<div class="btn-group widget-header-toolbar">
					<div class="control-inline toolbar-item-group">
																		<span class="control-title"><i class="fa fa-users"></i>Active?</span>
								
						<input type="checkbox" id="clientActive" name="isActive" {if $client.isActive}checked{/if} class="switch-demo switch-mini" data-on="success" data-off="default" data-on-label="Yes" data-off-label="No" >					</div>
																</div>					


		</div>
		<div class="widget-content">
{if $alert.success}
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Yay!</strong> {$alert.success}
</div>
{/if}	
		<form id="client-form" class="form-horizontal label-left" role="form">
			<input type="hidden" name="clientID" value="{$client.id}">
			<input type="hidden" name="agencyID" value="{$client.agencyID}">
			<input type="hidden" id="client-active" name="isActive" value="{$client.isActive}">

					<div class="form-group" id="client-name">
																		<label for="text-input" class="col-sm-4 control-label">Client Name</label>
																		<div class="col-sm-8">
								<input type="text" name="clientName" id="client-name-input" class="form-control"  value="{$client.name}" required>
								<span id="client-name-help" class="help-block text-danger" style="display: none;">Client Name Already Exists!</span>						</div>
					</div>

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Contact Name</label>
																		<div class="col-sm-8">
								<input type="text" name="contactName" class="form-control"  value="{$client.contactName}" required>
						</div>
																	</div>

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Email Address</label>
																		<div class="col-sm-8">
								<input type="text" name="emailAddress" id="text-input" class="form-control"  value="{$client.emailAddress}" required>
						</div>
																	</div>

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Address</label>
																		<div class="col-sm-8">
								<textarea class="form-control" name="address" rows="5" cols="30" style="resize: none;">{$client.address}</textarea>
						</div>
																	</div>
																	<div class="form-group">
																		<label for="phone" class="col-sm-4 control-label">Phone Number
																		<br>
																		<small>(999) 999-9999</small>
																		</label>
																		<div class="col-sm-4 pull-left">
																			<input type="text" name="phoneNumber" id="phone" value="{$client.phoneNumber}"  class="form-control">
																		</div>
																	</div>

					<div class="form-group">
																		<label for="fax" class="col-sm-4 control-label">Fax Number
																		<br>
																		<small>(999) 999-9999</small>
																		</label>
																		<div class="col-sm-4 pull-left">
																			<input type="text" id="fax"  name="faxNumber" value="{$client.faxNumber}" class="form-control">
																		</div>
																	</div>

					<div class="form-group">
						<label for="website" class="col-sm-4 control-label">Website
																		</label>
																		<div class="col-sm-8 pull-left">
																			<input type="text" id="website" value="{$client.website}" name="website" class="form-control">
																		</div>	
					</div>

					<div class="form-group">
						<label for="bgColor" class="col-sm-4 control-label">Primary Color
																		</label>
																		<div class="col-sm-8 pull-left">
																			
																			<select id="bgColor" value="{$client.bgColor}" name="bgColor" class="simplecolorpicker icon" style="display: none;">
																				  <option value="#fff">#fff</option>
																				  <option value="#ac725e">#ac725e</option>
																				  <option value="#d06b64">#d06b64</option>
																				  <option value="#f83a22">#f83a22</option>
																				  <option value="#fa573c">#fa573c</option>
																				  <option value="#ff7537">#ff7537</option>
																				  <option value="#ffad46">#ffad46</option>
																				  <option value="#42d692">#42d692</option>
																				  <option value="#16a765">#16a765</option>
																				  <option value="#7bd148">#7bd148</option>
																				  <option value="#b3dc6c">#b3dc6c</option>
																				  <option value="#fbe983">#fbe983</option>
																				  <option value="#fad165">#fad165</option>
																				  <option value="#92e1c0">#92e1c0</option>
																				  <option value="#9fe1e7">#9fe1e7</option>
																				  <option value="#9fc6e7">#9fc6e7</option>
																				  <option value="#4986e7">#4986e7</option>
																				  <option value="#9a9cff">#9a9cff</option>
																				  <option value="#b99aff">#b99aff</option>
																				  <option value="#c2c2c2">#c2c2c2</option>
																				  <option value="#cabdbf">#cabdbf</option>
																				  <option value="#cca6ac">#cca6ac</option>
																				  <option value="#f691b2">#f691b2</option>
																				  <option value="#cd74e6">#cd74e6</option>
																				  <option value="#a47ae2">#a47ae2</option>
																			</select>
																		</div>	
					</div>

					<div class="form-group">
						<label for="fontColor" class="col-sm-4 control-label">Secondary Color
																		</label>
																		<div class="col-sm-8 pull-left">
																		
																			<select  id="fontColor" value="{$client.fontColor}" name="fontColor" class="simplecolorpicker icon" style="display: none;">
																				  <option value="#fff">#fff</option>	
																				  <option value="#000">#000</option>
																			</select>
																		</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<p>Notes</p>
							<textarea id="textarea" class="form-control" name="notes" rows="6" cols="30" maxlength="99" style="resize: none;">{$client.notes}</textarea>							<p class="textarea-msg"></p>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<p class="pull-right">
								<button type="button" class="btn btn-success" onclick="saveClient();">Save</button>
								<button type="button" class="btn btn-danger" onclick="deleteClient();">Delete</button>
							</p>
						</div>
					</div>		
															</form>

		</div>

		<div id="client-footer" class="widget-footer">
			Not Saved
		</div>

	</div>


								<div class="widget widget-table">
									<div class="widget-header">
										<h3><i class="fa fa-users"></i> Offices</h3>
										<div class="btn-group widget-header-toolbar">												<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										</div>
									</div>
									<div class="widget-content">
										<table class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Name</th>
													<th>Department</th>
													<th>City/State</th>
													<th>Contact Name</th>
													<th>Phone Number</th>
												</tr>
											</thead>
											<tbody>
{foreach $offices as $office}
												<tr>
													<td>{$office.name}</td>
													<td>{$office.dept}</td>
													<td>{$office.city}{if $office.city},{/if} {$office.state}</td>
													<td>{$office.contactName}</td>
													<td>{$office.phoneNumber}</td>
												</tr>
{/foreach}
												</tbody>
										</table>
									</div>
								</div>


</div>

<div class="col-lg-6">

								<div class="widget widget-table">
									<div class="widget-header">
										<h3><i class="fa fa-rocket"></i> Campaigns</h3>
										<em>- <a href="campaigns/create">Add A New Campaign</a> or Search Existing</em>
									</div>
									<div class="widget-content">
										<table class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%">
											<thead>
												<tr>
												
	<th>#</th>

	<th>Name</th>
													<th>Job Number</th>
													<th>Start</th>
													<th>End</th>
													<th>Total ($)</th>
												</tr>
											</thead>
											<tbody>
{foreach $campaigns as $campaign}
												<tr>
													<td>{$campaign.id}</td>
													<td><a href="/campaigns/edit/{$campaign.id}">{$campaign.name}</a></td>
													<td>{$campaign.jobNumber}</td>
													<td nowrap>{$campaign.flightStart}</td>

	<td nowrap>{$campaign.flightEnd}</td>
													<td nowrap style="min-width: 50px;">{$campaign.totalSpend|default:""}</td>
												</tr>
{/foreach}
											</tbody>
										</table>
									</div>
								</div>

<!-- Calendar -->
{include file="db:full-calendar"}

<!-- END Calendar -->
</div>

</div>

{/block}

{block name="footer-js"}

	<script type="text/javascript" src="/assets/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.masked-input.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="/assets/js/parsley.min.js"></script>
	<script type="text/javascript" src="/lib/bootbox/bootbox-4.2.0/bootbox.min.js"></script>

	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.bootstrap.js"></script>
    <script type='text/javascript' src='http://fullcalendar.io/js/fullcalendar-2.1.1/gcal.js'></script>

    <script>
    $( function() {
    
    	$('#calendar').fullCalendar({
    
        eventSources: [
    
            // your event source
            {
    		url: '/calendar/ajax/clients/edit/{$client.id}',
            }
    
        ]
    
    	});

    });
    


    </script>
	<script type="text/javascript" src="/assets/js/jquery.simplecolorpicker.js"></script>
	<script>

		$(document).ready(function(){
	
			$('#phone').mask('(999) 999-9999');
			$('#fax').mask('(999) 999-9999');
			$('#clientActive').bootstrapSwitch();

			$("#client-form").change(function () {
			    resetFooter(); 
			}); 

			$("#clientActive").change(function () {
			    resetFooter();
			    clientActive(); 
			}); 

			$('select[name="bgColor"]').simplecolorpicker( { 
				picker: true, theme: 'glyphicons',
			});
		    $('select[name="bgColor"]').simplecolorpicker('selectColor', '{$client.bgColor}');
			$('select[name="fontColor"]').simplecolorpicker( { 
				picker: true, theme: 'glyphicons',
			});

			$('select[name="bgColor"]').change( function() {
			     $(".fc-event-inner").css("background-color", $('select[name="bgColor"]').val());
			});

			$('select[name="fontColor"]').change( function() {
			     $(".fc-event-inner").css("color", $('select[name="fontColor"]').val());
			});
		});

	</script>

	<script type="text/javascript">

		function resetFooter() {
				$("#client-footer").html("Not Saved");
		}

		function clientActive() {

			if ($("#clientActive").is(":checked")) {
				$("#client-active").val("1");
			}
			else {
				$("#client-active").val("0");
			}
		}

	 	 function createClient() {
	  
	  		alert("saving client");
			  		 		  
	  	}

		function saveClient() {
			
			$("#client-footer").html("Saving.");

			clientActive();

			$.post( "/clients/ajax/save/{$client.id}", $( "#client-form" ).serialize(), function() {
				$("#client-footer").html("Saving...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#client-footer").html(response.message);
				if (response.error) {
					$("#"+response.field).addClass("has-error error");
					$("#client-name-help").show();

				}
				else {
					$("#client-name").removeClass("has-error error");
					$("#client-name-help").hide();
				}
				$("#breadcrumb-client-name").html($("#client-name-input").val());

			})
			.fail(function(data) {
				$("#client-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#client-footer").html("Error!");
			})
		}
	  
	  	function deleteClient() {
			  
		  	bootbox.confirm('Are you sure?', function(result) { 

				if (result) {

					$("#client-footer").html("Deleting..");

					$.post( "/clients/ajax/delete/{$client.id}", $( "#client-form" ).serialize(), function() {
						$("#client-footer").html("Deleting...");
					})
 					.done(function(data) {
					        var response = jQuery.parseJSON(data);
						$("#client-footer").html(response.message);
						if (response.error) {
						}
						else {
							window.location.href="/clients/all";
						}
					})
					.fail(function(data) {
						$("#client-footer").html("Connection Failed! Not Saved.");
					})
					.error(function(data) {
						$("#client-footer").html("Error!");
					})
				}
	 	 	});
  		}

	</script>

{/block}