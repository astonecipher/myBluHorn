<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
	<base href="{$base|default:"/"}">
	<title>{block name="title"}Dashboard | BluHorn{/block}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="BluHorn - Media Buying Platform">
	<meta name="author" content="BluHorn (powered by FileLogix)">

	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

	<script type="text/javascript">

		var runCount = 0;

		window.onerror = function (errorMsg, url, lineNum, column, errorObj) {

		    if (errorMsg["namespace"].substring(0,2) === "bv") {
				return false;
		    }

		    else if (runCount < 1) {
			runCount++;

			console.log('Error: ' + errorMsg + ' Script: ' + url + ' Line: ' + lineNum + ' Column: ' + column + ' StackTrace: ' +  errorObj);

		   	 if(encodeURIComponent) {
				var error = 'e=' + encodeURIComponent(errorMsg) + '&u=' + encodeURIComponent(url) + '&l=' + encodeURIComponent(lineNum);

				var data = new FormData();
				data.append('errorMsg', errorMsg);
				data.append('url', url);
				data.append('lineNumber', lineNum);
				data.append('column', column);
				data.append('errorObj', errorObj);
	
				var xmlRequest = new XMLHttpRequest(); 
				xmlRequest.open("POST", "/support/ajax/report/error/", true);
				xmlRequest.onreadystatechange = function () {
				if (xmlRequest.readyState != 4 || xmlRequest.status != 200) return; 
					console.log(xmlRequest.responseText);
				};
				xmlRequest.send(data);
			   	alert( "An error has occurred while loading this page.\nSome features may not work correctly.\nA case has been logged." );
				return true;
			}
			alert("An error has occurred while loading this page.\nSome features may not work correctly.\nPlease contact support if you need further assistance.");
		     }
		}

	</script>

	<!-- CSS -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/lib/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/main.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/skins/darkblue.css" rel="stylesheet" type="text/css">

{*
	<!-- CSS for demo style switcher. you can remove this -->
	<link href="/demo-style-switcher/assets/css/style-switcher.css" rel="stylesheet" type="text/css">
*}

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/kingboard-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/kingboard-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/kingboard-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/ico/kingboard-favicon57x57.png">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	{if $hideSideBar}
		<style>
			.left-sidebar .sub-menu {
				display: none;
				overflow: hidden;
			}
		</style>
	{/if}

			

	{block name="header-css"}

	{/block}

	{block name="header-js"}



	{/block}

</head>

<body class="dashboard">

	<!-- WRAPPER -->
	{block name="body"}
<div id="mainBody">
	<div class="wrapper">

		<!-- TOP GENERAL ALERT -->
		<div class="alert alert-info top-general-alert">
			<span>The system has been upgraded to the new version. Click the <a href="#">release notes</a> to see the changes.</span>
			<a type="button" class="close">&times;</a>
		</div>
		<!-- END TOP GENERAL ALERT -->

		<!-- TOP BAR -->
		<div class="top-bar">
			<div class="container">
				<div class="row">
					<!-- logo -->
					<div class="col-md-2 col-lg-2 logo">
						<a href="/">
							<img src="/assets/img/kingboard-logo-white.png" alt="BluHorn - Dashboard" />
						</a>
						<h1 class="sr-only">BluHorn Dashboard</h1>
					</div>
					<!-- end logo -->
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-3 hidden-xs hidden-sm">
								<!-- search box -->
							<form method=get id="searchForm" class="form-horizontal label-left">
								<div id="tour-searchbox" class="input-group searchbox {if $userID != 1}hidden{/if}" style="width: 30em;">
										<input type="search" name="q" id="searchText" class="form-control input-lg" placeholder="enter keyword here..." onkeydown="if (event.keyCode == 13) { search(); return false; }">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" onclick="search();"><i class="fa fa-search"></i>
											</button>
										</span>
								</div>
							</form>
								<!-- end search box -->
							</div>
							<div class="col-md-3 hidden-md hidden-lg">
								&nbsp;
							</div>											<div class="col-md-9">
								<div class="top-bar-right">
									<!-- responsive menu bar icon -->
									<a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
									<!-- end responsive menu bar icon -->
									<button type="button" id="restart-tour" class="btn btn-link" disabled="disabled"><i class="fa fa-refresh"></i> Restart Tour</button> 
									<div class="notifications hide">
										<ul>

											<!-- notification: general -->
											<li class="notification-item general">
												<div class="btn-group">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="fa fa-bell"></i>
														<span class="count">8</span>
														<span class="circle"></span>
													</a>
													<ul class="dropdown-menu" role="menu">
														<li class="notification-header">
															<em>You have 8 notifications</em>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-comment green-font"></i>
																<span class="text">New comment on the blog post</span>
																<span class="timestamp">1 minute ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-user green-font"></i>
																<span class="text">New registered user</span>
																<span class="timestamp">12 minutes ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-comment green-font"></i>
																<span class="text">New comment on the blog post</span>
																<span class="timestamp">18 minutes ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-shopping-cart red-font"></i>
																<span class="text">4 new sales order</span>
																<span class="timestamp">4 hours ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-edit yellow-font"></i>
																<span class="text">3 product reviews awaiting moderation</span>
																<span class="timestamp">1 day ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-comment green-font"></i>
																<span class="text">New comment on the blog post</span>
																<span class="timestamp">3 days ago</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-comment green-font"></i>
																<span class="text">New comment on the blog post</span>
																<span class="timestamp">Oct 15</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-warning red-font"></i>
																<span class="text red-font">Low disk space!</span>
																<span class="timestamp">Oct 11</span>
															</a>
														</li>
														<li class="notification-footer">
															<a href="#">View All Notifications</a>
														</li>
													</ul>
												</div>
											</li>
											<!-- end notification: general -->
										</ul>
									</div>

									<!-- logged user and the menu -->
									<div class="logged-user">
										<div class="btn-group">
											<a href="/user/{$username}" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
												<img src="https://www.gravatar.com/avatar/{$gravatar|default:"20"}?s=20&r=pg&d=mm" />
												<span class="name">{$shortname}</span>
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu" role="menu">
												<li>
													<a href="/user/account/{$username}">
														<i class="fa fa-user"></i>
														<span class="text">Profile</span>
													</a>
												</li>
												<li>
													<a href="/user/settings/{$username}">
														<i class="fa fa-cog"></i>
														<span class="text">Settings</span>
													</a>
												</li>
												<li>
													<a href="/logout">
														<i class="fa fa-power-off"></i>
														<span class="text">Logout</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<!-- end logged user and the menu -->
								</div>
								<!-- /top-bar-right -->
							</div>
						</div>
						<!-- /row -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /top -->


		<!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
		<div class="bottom">
			<div class="container">
				<div class="row">
					<!-- left sidebar -->
					<div class="col-md-2 left-sidebar   {if $hideSideBar}minified{/if}">

						<!-- main-nav -->
						<nav class="main-nav">

							<ul class="main-menu">
								<li class="{$activeSideBar.dashboard}"><a href="home"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a>
								</li>
								<li class="{$activeSideBar.clients}"><a href="clients" class="js-sub-menu-toggle"><i class="fa fa-users fa-fw"></i><span class="text">Clients</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/clients/create">
												<span class="text">Add New Client</span>
											</a>
										</li>
										<li>
											<a href="/clients/all">
												<span class="text">Show All Clients</span>
											</a>
										</li>									</ul>
								</li>
								<li class="{$activeSideBar.campaigns}"><a href="campaigns" class="js-sub-menu-toggle"><i class="fa fa-rocket fw"></i><span class="text">Campaigns</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/campaigns/create">
												<span class="text">Create A New Campaign</span>
											</a>
										</li>
										<li>
											<a href="/campaigns/pending">
												<span class="text">Pending Campaigns</span>
											</a>
										</li>											<li>
											<a href="/campaigns/active">
												<span class="text">Active Campaigns</span>
											</a>
										</li>											<li>
											<a href="/campaigns/archived">
												<span class="text">Archived Campaigns</span>
											</a>
										</li>											<li>
											<a href="/campaigns/all">
												<span class="text">All Campaigns</span>
											</a>
										</li>									</ul>
								</li>
								<li class="{$activeSideBar.worksheets}"><a href="worksheets" class="js-sub-menu-toggle"><i class="fa fa-table fw"></i><span class="text">Worksheets</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
{*
										<li>
											<a href="/worksheets/create">
												<span class="text">Create A New Worksheet</span>
											</a>
										</li>
*}
										<li>
											<a href="/worksheets/pending">
												<span class="text">Pending Worksheets</span>
											</a>
										</li>											<li>
											<a href="/worksheets/active">
												<span class="text">Active Worksheets</span>
											</a>
										</li>											<li>
											<a href="/worksheets/archived">
												<span class="text">Archived Worksheets</span>
											</a>
										</li>											<li>
											<a href="/worksheets/all">
												<span class="text">All Worksheets</span>
											</a>
										</li>									</ul>
								</li>

								<li class="{$activeSideBar.orders}"><a href="orders" class="js-sub-menu-toggle"><i class="fa fa-gavel fw"></i><span class="text">Orders</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/orders/pending">
												<span class="text">Pending Orders</span>
											</a>
										</li>	
										<li>
											<a href="/orders/active">
												<span class="text">Active Orders</span>
											</a>
										</li>											<li>
											<a href="/orders/archived">
												<span class="text">Archived Orderss</span>
											</a>
										</li>											<li>
											<a href="/orders/cancelled">
												<span class="text">Cancelled Orderss</span>
											</a>
										</li>											<li>
											<a href="/orders/all">
												<span class="text">All Orders</span>
											</a>
										</li>									</ul>
								</li>
{if $user.useProjects}
								<li class="{$activeSideBar.projects}"><a href="projects" class="js-sub-menu-toggle"><i class="fa fa-tree fw"></i><span class="text">Projects</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/projects/create">
												<span class="text">New Project</span>
											</a>
										</li>
										<li>
											<a href="/projects/active">
												<span class="text">Active Projects</span>
											</a>
										</li>											<li>
											<a href="/projects/completed">
												<span class="text">Completed Projects</span>
											</a>
										</li>											<li>
											<a href="/projects/tasks/open">
												<span class="text">Open Tasks</span>
											</a>
										</li>											<li>
											<a href="/projects/all">
												<span class="text">All Projects</span>
											</a>
										</li>									</ul>
								</li>
{/if}
								<li class="{$activeSideBar.reports}"><a href="reports" class="js-sub-menu-toggle"><i class="fa fa-briefcase fw"></i><span class="text">Reports</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/reports/summary/tv">
												<span class="text">TV Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/tvcable">
												<span class="text">TV/Cable Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/radio">
												<span class="text">Radio Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/cable">
												<span class="text">Cable Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/print">
												<span class="text">Print Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/digital">
												<span class="text">Digital Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/summary/outdoor">
												<span class="text">Outdoor Summary</span>
											</a>
										</li>
										<li>
											<a href="/reports/tracking/billing">
												<span class="text">Billing Tracking</span>
											</a>
										</li>
										<li>
											<a href="/reports/tracking/ordered">
												<span class="text">Order Tracking</span>
											</a>
										</li>	
										<li>
											<a href="/reports/tracking/pending">
												<span class="text">Pending Tracking</span>
											</a>
										</li>	

										<li>
											<a href="/reports/planning/media">
												<span class="text">Media Planning</span>
											</a>
										</li>
								</ul>
								</li>
								<li class="{$activeSideBar.vendors}"><a href="vendors" class="js-sub-menu-toggle"><i class="fa fa-truck fw"></i><span class="text">Vendors</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/vendors/create">
												<span class="text">Add a New Vendor</span>
											</a>
										</li>
										<li>
											<a href="/vendors/all">
												<span class="text">Show All Vendors</span>
											</a>
										</li>									</ul>
								</li>
								<li class="{$activeSideBar.markets}"><a href="markets"><i class="fa fa-map-marker fa-fw"></i><span class="text">Markets</span></a>
								</li>
{if $user.useInventory}
								<li class="{$activeSideBar.inventory}"><a href="inventory" class="js-sub-menu-toggle"><i class="fa fa-cube fw"></i><span class="text">Inventory</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/inventory/imports">
												<span class="text">Imports</span>
											</a>
										</li>
										<li>
											<a href="/programs/create">
												<span class="text">Add New Program</span>
											</a>
										</li>											<li>
											<a href="/programs/all">
												<span class="text">Show All Programs</span>
											</a>
										</li>											<li>
											<a href="/publication/add">
												<span class="text">Add New Publication</span>
											</a>
										</li>											<li>
											<a href="/publications/all">
												<span class="text">Show All Publications</span>
											</a>
										</li>												<li>
											<a href="/inventory/all">
												<span class="text">Show All Inventory</span>
											</a>
										</li>									</ul>

{/if}

								</li>
								<li class="{$activeSideBar.agency}"><a href="agency"><i class="fa fa-building-o fa-fw"></i><span class="text">Agency</span></a>
								</li>			
								<li class="{$activeSideBar.documents}"><a href="cabinet" class="js-sub-menu-toggle"><i class="fa fa-archive fw"></i><span class="text">Documents</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/cabinet/invoices">
												<span class="text">Invoices</span>
											</a>
										</li>
										<li>
											<a href="/cabinet/buys">
												<span class="text">Buys</span>
											</a>
										</li>
									</ul>
								</li>
								<li class="{$activeSideBar.more}"><a href="cabinet" class="js-sub-menu-toggle"><i class="fa fa-life-ring fw"></i><span class="text">Support</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/support/kb">
												<span class="text">Knowledge Base</span>
											</a>
										</li>
										<li>
											<a href="/support/cases/create">
												<span class="text">Create A Case</span>
											</a>
										</li>
										<li>
											<a href="/support/cases">
												<span class="text">View Cases</span>
											</a>
										</li>									</ul>
								</li>
{if $userID==1 or $userID==3 or $userID==4 or $userID==150}
								<li class="{$activeSideBar.more}"><a href="#" class="js-sub-menu-toggle"><i class="fa fa-cogs fw"></i><span class="text">Admin</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">
										<li>
											<a href="/admin/users">
												<span class="text">Users</span>
											</a>
										</li>
										<li>
											<a href="/admin/inbox">
												<span class="text">Inbox</span>
											</a>
										</li>
										<li>
											<a href="/admin/agencies">
												<span class="text">Agencies</span>
											</a>
										</li>
										<li>
											<a href="/admin/subscriptions">
												<span class="text">Subscriptions</span>
											</a>
										</li>	
										<li>
											<a href="/admin/billing">
												<span class="text">Billing</span>
											</a>
										</li>	
										<li>
											<a href="/admin/logs">
												<span class="text">Logs</span>
											</a>
										</li>
								</ul>
								</li>
{/if}
							</ul>
						</nav>
						<!-- /main-nav -->

						<div class="sidebar-minified js-toggle-{if $hideSideBar}expanded{else}minified{/if}">
							<i class="fa fa-angle-left {if $hideSideBar}fa-angle-right{/if}" {block name="sidebar-clicked"}onclick="toggleSideBar(this);"{/block}></i>
						</div>

						<!-- sidebar content -->
						<div class="sidebar-content">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h5><i class="fa fa-lightbulb-o"></i> Tips</h5>
								</div>
								<div class="panel-body">
									<p>{$tip|default:"Want to request a new feature or enhance an existing one?<br>We want to hear from you, contact us at support@bluhorn.com"}</p>
								</div>
							</div>
{*
							<h5 class="label label-default"><i class="fa fa-info-circle"></i> Server Info</h5>
							<ul class="list-unstyled list-info-sidebar bottom-30px">
								<li class="data-row">
									<span class="data-name">Disk Space Usage</span>
									<span class="data-value">
										274.43 / 2 GB
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
												<span class="sr-only">10%</span>
											</div>
										</div>
									</span>
								</li>
								<li class="data-row">
									<span class="data-name">Monthly Bandwidth Transfer</span>
									<span class="data-value">
										230 / 500 GB
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 46%">
												<span class="sr-only">46%</span>
											</div>
										</div>
									</span>
								</li>
								<li class="data-row">
									<span class="data-name">Database Disk Space</span>
									<span class="data-value">219.45 MB</span>
								</li>
								<li class="data-row">
									<span class="data-name">Operating System</span>
									<span class="data-value">Linux</span>
								</li>
								<li class="data-row">
									<span class="data-name">Apache Version</span>
									<span class="data-value">2.4.6</span>
								</li>
								<li class="data-row">
									<span class="data-name">PHP Version</span>
									<span class="data-value">5.3.27</span>
								</li>
								<li class="data-row">
									<span class="data-name">MySQL Version</span>
									<span class="data-value">5.5.34-cll</span>
								</li>
								<li class="data-row">
									<span class="data-name">Architecture</span>
									<span class="data-value">x86_64</span>
								</li>
							</ul>
*}
						</div>
						<!-- end sidebar content -->
					</div>
					<!-- end left sidebar -->

					<!-- content-wrapper -->
					<div class="col-md-10 content-wrapper   {if $hideSideBar}expanded{/if}

">
						<div class="row">
							<div class="col-md-4">
								{block name="breadcrumb"}
								<ul class="breadcrumb">
									<li><i class="fa fa-home"></i><a href="#">Home</a>
									</li>
									<li class="active">Dashboard</li>
								</ul>
								{/block}
							</div>
							<div class="col-md-8">
								<div class="top-content">
									<ul class="list-inline mini-stat">
										<li>
											<h5>CAMPAIGNS
												<span class="stat-value stat-color-orange"><i class="fa fa-plus-circle"></i> {$chartCampaignsTotal|number_format:0:".":","|default:"0"}</span>
											</h5>
											<span id="mini-bar-chart-campaigns" class="mini-bar-chart"></span>
										</li>
										<li>
											<h5>BUYS
												<span class="stat-value stat-color-blue"><i class="fa fa-plus-circle"></i> {$chartBuysTotal|number_format:0:".":","|default:"0"}</span>
											</h5>
											<span id="mini-bar-chart-buys" class="mini-bar-chart"></span>
										</li>
										<li class="hide">
											<h5>ADS
												<span class="stat-value stat-color-seagreen"><i class="fa fa-plus-circle"></i> {$chartAdsTotal|number_format:0:".":","|default:"0"}</span>
											</h5>
											<span id="mini-bar-chart-ads" class="mini-bar-chart"></span>
										</li>
									</ul>
								</div>
							</div>
						</div>

	{block name="pdf"}
	{/block}

						<!-- main -->

						{block name="main"}

						<div class="content" >
							<div class="main-header">
								<h2>DASHBOARD</h2>
								<em>{$agency.name|default:"Overview"}</em>
							</div>

							<div class="main-content">
								<div class="row">
									<div class="col-md-12">
										<!-- WIDGET NO HEADER -->
										<div class="widget widget-hide-header">
											<div class="widget-header hide">
												<h3>Summary Info</h3>
											</div>
											<div class="widget-content">
												<div class="row">
													<div class="col-md-3">
														<div class="easy-pie-chart green" data-percent="{$TVCableRatio|default:'0'}">
															<span class="percent">{$TVCableRatio|default:"0"}</span>
														</div>
														<p class="text-center">TV/Cable %</p>
													</div>
													<div class="col-md-3">
														<div class="easy-pie-chart red" data-percent="{$RadioRatio|default:"0"}">
															<span class="percent">{$RadioRatio|default:"0"}</span>
														</div>
														<p class="text-center">Radio %</p>
													</div>
													<div class="col-md-3">
														<div class="easy-pie-chart yellow" data-percent="{$PrintDigitalRatio|default:"0"}">
															<span class="percent">{$PrintDigitallRatio|default:"0"}</span>
														</div>
														<p class="text-center">Print/Digital %</p>
													</div>
													<div class="col-md-3">
														<div class="easy-pie-chart red" data-percent="{$OutdoorRatio|default:"0"}">
															<span class="percent">{$OutdoorRatio|default:"0"}</span>
														</div>
														<p class="text-center">Outdoor %</p>
													</div>


												</div>
											</div>
										</div>
										<!-- WIDGET NO HEADER -->
									</div>
{*
									<div class="col-md-3">
										<!-- WIDGET REMINDER -->
										<div class="widget widget-hide-header widget-reminder">
											<div class="widget-header hide">
												<h3>Today's Reminder</h3>
											</div>
											<div class="widget-content">
												<div class="today-reminder">
													<h4 class="reminder-title">Project Meeting</h4>
													<p class="reminder-time"><i class="fa fa-clock-o"></i> 9:00 AM</p>
													<p class="reminder-place">War Room</p>
													<em class="reminder-notes">Bring weekly report summary</em>
													<i class="fa fa-bell"></i>
													<div class="btn-group btn-group-xs">
														<button type="button" class="btn btn-warning"><i class="fa fa-cloud-upload"></i> Sync</button>
														<div class="btn-group  btn-group-xs">
															<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Remind Me
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right">
																<li><a href="#">15 minutes later</a>
																</li>
																<li><a href="#">30 minutes later</a>
																</li>
																<li><a href="#">1 hour later</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>

										<!-- END WIDGET REMINDER -->
									</div>
*}

								</div>

								<!-- WIDGET MAIN CHART WITH TABBED CONTENT -->
								<div class="row">
									<div class="col-md-12 col-lg-6">
									
										<!-- WIDGET TABLE -->
										<div class="widget widget-table">
											<div class="widget-header">
												<h3><i class="fa fa-rocket"></i> Recent Campaigns</h3>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
												<div class="btn-group widget-header-toolbar">
											
												</div>
											</div>
											<div class="widget-content">
												<table id="recent-campaigns-table" class="table table-striped table-hover display_recent" cellpadding="0" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>Name</th>
															<th>Client</th>
															<th>Dates</th>
															<th>Job #</th>
														</tr>
													</thead>
													<tbody>
		{foreach $recentCampaigns as $campaign}
		<tr>
															<td><a href="/campaigns/edit/{$campaign.id}">{$campaign.name}</a></td>
															<td><a href="/campaigns/edit/{$campaign.id}">{$campaign.clientName}</a></td>
															<td><a href="/campaigns/edit/{$campaign.id}">{$campaign.flightStart} - {$campaign.flightEnd}</a></td>
															<td><a href="/campaigns/edit/{$campaign.id}">{$campaign.jobNumber}</a></td>
														</tr>
			
		{/foreach}																																	</tbody>
												</table>
											</div>
										</div>
										<!-- END WIDGET TABLE -->

								<div class="widget hidden">
									<div class="widget-header">
										<h3><i class="fa fa-bar-chart-o"></i> Sales Stat</h3>
										<em>- Sales - Media Buys</em>
										<button type="button" class="btn btn-link btn-help"><i class="fa fa-question-circle"></i>
										</button>
										<div class="btn-group widget-header-toolbar">
											<a href="#" id="tour-focus" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
											<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
											<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
										</div>
									</div>
									<div class="widget-content">
										<!-- chart tab nav -->
										<div class="chart-nav">
											<strong>Select period:</strong>
											<ul id="sales-stat-tab">
												<li class="active"><a href="#week">Weekly</a>
												</li>
												<li><a href="#month">Monthly</a>
												</li>
												<li><a href="#year">Annually</a>
												</li>
											</ul>
										</div>
										<!-- end chart tab nav -->

										<!-- chart placeholder-->
										<div class="chart-content">
											<div class="demo-flot-chart sales-chart"></div>
										</div>
										<!-- end chart placeholder-->

										<hr class="separator">

										<!-- secondary stat -->
										<div class="secondary-stat">
											<div class="row">
												<div class="col-lg-4">
													<div id="secondary-stat-item1" class="secondary-stat-item big-number-stat clearfix">
														<div class="data">
															<span class="col-left big-number">260</span>
															<span class="col-right">
																<em>New Orders</em>
																<em>3% <i class="fa fa-caret-down"></i>
																</em>
															</span>
														</div>
														<div id="spark-stat1" class="inlinesparkline">Loading...</div>
													</div>
												</div>

												<div class="col-lg-4 hidden">
													<div id="secondary-stat-item2" class="secondary-stat-item big-number-stat clearfix">
														<p class="data">
															<span class="col-left big-number">$23,000</span>
															<span class="col-right">
																<em>Revenue</em>
																<em>5% <i class="fa fa-caret-up"></i>
																</em>
															</span>
														</p>
														<div id="spark-stat2" class="inlinesparkline">Loading...</div>
													</div>
												</div>
												<div class="col-lg-4 hidden">
													<div id="secondary-stat-item3" class="secondary-stat-item big-number-stat clearfix">
														<p class="data">
															<span class="col-left big-number">$47,000</span>
															<span class="col-right">
																<em>Total Sales</em>
																<em>7% <i class="fa fa-caret-up"></i>
																</em>
															</span>
														</p>
														<div id="spark-stat3" class="inlinesparkline">Loading...</div>
													</div>
												</div>
											</div>
										</div>
										<!-- end secondary stat -->
									</div>
								</div>
								<!-- END WIDGET MAIN CHART WITH TABBED CONTENT -->



										<!-- WIDGET DONUT AND PIE CHART -->
										<div class="widget hidden">
											<div class="widget-header">
												<h3><i class="fa fa-truck"></i> Vendors</h3>
												<em>- Share of Campaign $</em>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<div class="widget-content">
												<div class="demo-flot-chart" id="demo-donut-chart"></div>
												<div class="panel panel-default panel-pie-chart">
													<div class="panel-heading">
														<h3 class="panel-title">Last Week Visits</h3>
													</div>
													<div class="panel-body">
														<ul class="list-inline">
															<li>
																<span id="mini-pie-chart1" class="mini-pie-chart"></span>
																<div>Mon</div>
															</li>
															<li>
																<span id="mini-pie-chart2" class="mini-pie-chart"></span>
																<div>Tue</div>
															</li>
															<li>
																<span id="mini-pie-chart3" class="mini-pie-chart"></span>
																<div>Wed</div>
															</li>
															<li>
																<span id="mini-pie-chart4" class="mini-pie-chart"></span>
																<div>Thu</div>
															</li>
															<li>
																<span id="mini-pie-chart5" class="mini-pie-chart"></span>
																<div>Fri</div>
															</li>
															<li>
																<span id="mini-pie-chart6" class="mini-pie-chart"></span>
																<div>Sat</div>
															</li>
															<li>
																<span id="mini-pie-chart7" class="mini-pie-chart"></span>
																<div>Sun</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<!-- END WIDGET DONUT AND PIE CHART -->
									</div>
										
									<div class="col-md-12 col-lg-6">


										<!-- WIDGET TABLE -->
										<div class="widget widget-table">
											<div class="widget-header">
												<h3><i class="fa fa-folder"></i> Recent Worksheets</h3>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
												<div class="btn-group widget-header-toolbar">
											
												</div>
											</div>
											<div class="widget-content">
												<table id="recent-worksheets-table" class="table table-sorting table-striped table-hover display_recent" cellpadding="0" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>Name</th>
															<th>Campaign</th>
															<th>Amount</th>
															<th>Spots</th>
														</tr>
													</thead>
													<tbody>
		{foreach $recentWorksheets as $worksheet}
		<tr>
															<td><a href="/{$worksheet.type|default:"worksheets"}/edit/{$worksheet.id}">{$worksheet.name}</a></td>
															<td><a href="/{$worksheet.type|default:"worksheets"}/edit/{$worksheet.id}">{$worksheet.campaignName}</a></td>
															<td><a href="/{$worksheet.type|default:"worksheets"}/edit/{$worksheet.id}">{$worksheet.totalSpend}</a></td>
															<td><a href="/{$worksheet.type|default:"worksheets"}/edit/{$worksheet.id}">{$worksheet.totalSpots}</a></td>
														</tr>
			
		{/foreach}																																																		</tbody>
												</table>
											</div>
											
										</div>
										<!-- END WIDGET TABLE -->
										
										<!-- WIDGET SALES MAP -->
										<div class="widget hidden">
											<div class="widget-header">
												<h3><i class="fa fa-globe"></i> Map</h3>
												<em>- Sales by location</em>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<div class="widget-content">
												<div class="map-custom-width data-us-map">
													<div class="map"></div>
													<div class="plotLegend"></div>
												</div>
											</div>
										</div>
										<!-- END WIDGET SALES MAP -->

										<!-- WIDGET INLINE SPARKLINE -->
										<div class="widget widget-sparkline hidden">
											<div class="widget-header">
												<h3><i class="fa fa-bar-chart-o"></i> Scoreboard</h3>
												<em>- Agency Data</em>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<div class="widget-content">
												<div class="row first">
													<div class="col-md-6">
														<div class="sparkline-stat-item">
															<div class="info">
																<span>Campaigns</span>
																<strong>1,363</strong>
															</div>
															<span id="sparkline1" class="inlinesparkline">Loading...</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="sparkline-stat-item">
															<div class="info">
																<span>Buys</span>
																<strong>1,221</strong>
															</div>
															<span id="sparkline2" class="inlinesparkline">Loading...</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="sparkline-stat-item last">
															<div class="info">
																<span>Ads</span>
																<strong>2,300</strong>
															</div>
															<span id="sparkline3" class="inlinesparkline">Loading...</span>
														</div>
													</div>

													<div class="col-md-6">
														<div class="sparkline-stat-item">
															<div class="info">
																<span>Ads/Campaign</span>
																<strong>1.19</strong>
															</div>
															<span id="sparkline4" class="inlinesparkline">Loading...</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="sparkline-stat-item">
															<div class="info">
																<span>Time Purchased</span>
																<strong>00:00:30</strong>
															</div>
															<span id="sparkline5" class="inlinesparkline">Loading...</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="sparkline-stat-item last">
															<div class="info">
																<span>% New Clients</span>
																<strong>28.35%</strong>
															</div>
															<span id="sparkline6" class="inlinesparkline">Loading...</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END WIDGET INLINE SPARKLINE -->
									</div>
								</div>
<!-- Calendar -->
								<!-- WIDGET MAIN CHART WITH TABBED CONTENT -->

										<!-- WIDGET TABLE -->
										<div class="widget widget-table">
											<div class="widget-header">
												<h3><i class="fa fa-rocket"></i> Calendar Placeholder</h3>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
												<div class="btn-group widget-header-toolbar">
											
												</div>
											</div>
											<div class="widget-content">
												<div id='calendar'></div>
											</div>
										</div>
										<!-- END WIDGET TABLE -->

<!-- END Calendar -->
								<div class="row">
									<div class="col-md-4">
										<!-- WIDGET TASKS -->
										<div class="widget hidden">
											<div class="widget-header">
												<h3><i class="fa fa-tasks"></i> My Tasks</h3>
												<em>- Summary of Tasks</em>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<div class="widget-content">
												<ul class="task-list">
													<li>
														<p>Pending Worksheets
															<span class="label label-danger">23%</span>
														</p>
														<div class="progress progress-xs">
															<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width:23%">
																<span class="sr-only">23% Complete</span>
															</div>
														</div>
													</li>
													<li>
														<p>New Invoices
															<span class="label label-success">80%</span>
														</p>
														<div class="progress progress-xs">
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
																<span class="sr-only">80% Complete</span>
															</div>
														</div>
													</li>
													<li>
														<p> Some Other Task
															<span class="label label-success">100%</span>
														</p>
														<div class="progress progress-xs">
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
																<span class="sr-only">Success</span>
															</div>
														</div>
													</li>
																								</ul>
											</div>
										</div>
										<!-- END WIDGET TASKS -->
									</div>
									<div class="col-md-8">
										<!-- WIDGET REAL-TIME CHART -->
										<div class="widget real-time-chart hidden">
											<div class="widget-header">
												<h3><i class="fa fa-cogs"></i> Active Campaigns</h3>
												<em>- Realtime media buys</em>
												<div class="btn-group widget-header-toolbar">
													<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
													<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
													<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<div class="widget-content">
												<div class="demo-flot-chart" id="demo-real-time-chart"></div>
											</div>
										</div>
										<!-- END WIDGET REAL-TIME CHART -->
									</div>
								</div>

								<!-- WIDGET TICKET TABLE -->
								<div class="widget widget-table">
									<div class="widget-header">
										<h3><i class="fa fa-group"></i> Support Tickets</h3>
										<em>- List of Support Tickets</em>
										<div class="btn-group widget-header-toolbar">
											<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
											<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
											<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
										</div>
										<div class="btn-group widget-header-toolbar hide">
											<div class="label label-danger"><i class="fa fa-warning"></i> 2 Critical Messages</div>
										</div>
									</div>
									<div class="widget-content">
										<table id="ticket-table" class="table table-sorting">
											<thead>
												<tr>
													<th>Number</th>
													<th>Date</th>
													<th>Category</th>
													<th>Name</th>
													<th>Title</th>
													<th>Priority</th>
												</tr>
											</thead>
											<tbody>

											
											</tbody>
										</table>
									</div>
								</div>
								<!-- END WIDGET TICKET TABLE -->

							</div>
							<!-- /main-content -->
						
						{/block}

						</div>
						<!-- /main -->
					</div>

					<!-- /content-wrapper -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- END BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
		<!-- FOOTER -->
		<footer class="footer">
			&copy; 2014 BluHorn (powered by FileLogix)
		</footer>
		<!-- END FOOTER -->

	</div>
	<!-- /wrapper -->
</div>

	<!-- STYLE SWITCHER -->
	<div class="del-style-switcher hide">
		<div class="del-switcher-toggle toggle-hide"></div>
		<form>
			<section class="del-section del-section-skin">
				<h5 class="del-switcher-header">Choose Skins:</h5>

				<ul>
					<li><a href="#" title="Slate Gray" class="switch-skin slategray" data-skin="assets/css/skins/slategray.css">Slate Gray</a></li>
					<li><a href="#" title="Dark Blue" class="switch-skin darkblue" data-skin="assets/css/skins/darkblue.css">Dark Blue</a></li>
					<li><a href="#" title="Dark Brown" class="switch-skin darkbrown" data-skin="assets/css/skins/darkbrown.css">Dark Brown</a></li>
					<li><a href="#" title="Light Green" class="switch-skin lightgreen" data-skin="assets/css/skins/lightgreen.css">Light Green</a></li>
					<li><a href="#" title="Orange" class="switch-skin orange" data-skin="assets/css/skins/orange.css">Orange</a></li>
					<li><a href="#" title="Red" class="switch-skin red" data-skin="assets/css/skins/red.css">Red</a></li>
					<li><a href="#" title="Teal" class="switch-skin teal" data-skin="assets/css/skins/teal.css">Teal</a></li>
					<li><a href="#" title="Yellow" class="switch-skin yellow" data-skin="assets/css/skins/yellow.css">Yellow</a></li>
				</ul>

				<button type="button" class="switch-skin-full fulldark" data-skin="assets/css/skins/fulldark.css">Full Dark</button>
				<button type="button" class="switch-skin-full fullbright" data-skin="assets/css/skins/fullbright.css">Full Bright</button>
			</section>

			<p><a href="#" title="Reset Style" class="del-reset-style">Reset Style</a></p>
		</form>
	</div>
	<!-- END STYLE SWITCHER -->

	<!-- Javascript -->

	<script type="text/javascript" src="/assets/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.sparkline.min.js"></script>

	{block name="scripts"}

	<script type="text/javascript" src="/assets/js/modernizr.js"></script>
	<script type="text/javascript" src="/assets/js/king-common.js"></script>
	
		<script type="text/javascript" src="/assets/js/bootstrap-tour.custom.js"></script>
	
	<script type="text/javascript" src="/assets/js/stat/jquery.easypiechart.min.js"></script>
	<script type="text/javascript" src="/assets/js/raphael-2.1.0.min.js"></script>
	<script type="text/javascript" src="/assets/js/stat/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="/assets/js/stat/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="/assets/js/stat/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="/assets/js/stat/flot/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="/assets/js/stat/flot/jquery.flot.tooltip.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.mapael.js"></script>
	<script type="text/javascript" src="/assets/js/maps/usa_states.js"></script>
	<script type="text/javascript" src="/assets/js/king-chart-stat.js"></script>
	<script type="text/javascript" src="/assets/js/king-table.js"></script>
	<script type="text/javascript" src="/assets/js/king-components.js"></script>

	{/block}

	{block name="datatables"}
		<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.bootstrap.js"></script>
	{/block}

	{block name="fullcalendar"}
		<script type="text/javascript" src="/assets/js/fullcalendar.js"></script>
		<script type="text/javascript" src="/assets/js/fullcalendar.min.js"></script>
	{/block}

        <script type="text/javascript" src="/lib/gravatar/jquery/md5.js"></script>
        <script type="text/javascript" src="/lib/gravatar/jquery/jquery.gravatar.js"></script>

	{block name="footer-js"}

	{/block}

	{/block}

	<script type="text/javascript">

	function search() {
		window.location.href="/search?" + $("#searchForm").serialize();
	}

	$(document).ready(function(){

		//*******************************************
		/*	MINI BAR CHART
		/********************************************/
			if( $('.mini-bar-chart').length > 0 ) {
			var params = {
				type: 'bar',
				barWidth: 5,
				height: 25
			}
	
			params.barColor = '#CE7B11';
			$('#mini-bar-chart-campaigns').sparkline([{$chartCampaigns|default:"0"}], params);
			params.barColor = '#1D92AF';
			$('#mini-bar-chart-buys').sparkline([{$chartBuys|default:"0"}], params);
			params.barColor = '#3F7577';
			$('#mini-bar-chart-ads').sparkline([{$chartAds|default:"0"}], params);
		}

		//*******************************************
		/*	EASY PIE CHART
		/********************************************/
		if( $('.easy-pie-chart').length > 0 ) {
	
			var cOptions = {
				animate: 3000,
				trackColor: "#ccc",
				scaleColor: "#ddd",
				lineCap: "square",
				lineWidth: 5,
				barColor: "#ef1e25",
				onStep: function(from, to, percent) {
					$(this.el).find('.percent').text(Math.round(percent));
				}
			}
	
			cOptions.barColor = "#3E9C1A"; // green
			$('.easy-pie-chart.green').easyPieChart(cOptions);
			cOptions.barColor = "#FFB800"; // yellow
			$('.easy-pie-chart.yellow').easyPieChart(cOptions);
			cOptions.barColor = "#E60404"; // red
			$('.easy-pie-chart.red').easyPieChart(cOptions);
		}

{literal}

	//*******************************************
	/*	MAPS
	/********************************************/

	var colors = ["#5DC8CD", "#34C6CD", "#01939A", "#1D7074", "#006064"];
	
	if( $('body').hasClass('demo-maps') ) {

		// basic map
		$(".basic-map").mapael({
			map: {
				name: "world_countries"
			}
		});

		// data visualization
		var data = {
			"areas" : {
				"US": {
					"value": 2200,
					"tooltip": {
						"content": "<span>United States</span><br />Sales: 2200"
					}
				},
				"CN": {
					"value": 1800,
					"tooltip": {
						"content": "<span>China</span><br />Sales: 1800"
					}
				},
				"JP": {
					"value": 1550,
					"tooltip": {
						"content": "<span>Japan</span><br />Sales: 1550"
					}
				},
				"IN": {
					"value": 1400,
					"tooltip": {
						"content": "<span>India</span><br />Sales: 1400"
					}
				},
				"DE": {
					"value": 1600,
					"tooltip": {
						"content": "<span>Germany</span><br />Sales: 1600"
					}
				},
				"RU": {
					"value": 900,
					"tooltip": {
						"content": "<span>Russia</span><br />Sales: 900"
					}
				},
				"GB": {
					"value": 1200,
					"tooltip": {
						"content": "<span>United Kingdom</span><br />Sales: 1200"
					}
				},
				"FR": {
					"value": 1100,
					"tooltip": {
						"content": "<span>France</span><br />Sales: 1100"
					}
				},
				"BR": {
					"value": 400,
					"tooltip": {
						"content": "<span>Brazil</span><br />Sales: 400"
					}
				},
				"IT": {
					"value": 700,
					"tooltip": {
						"content": "<span>Italy</span><br />Sales: 700"
					}
				},
				"MX": {
					"value": 1900,
					"tooltip": {
						"content": "<span>Mexico</span><br />Sales: 1900"
					}
				},
				"ES": {
					"value": 300,
					"tooltip": {
						"content": "<span>Spain</span><br />Sales: 300"
					}
				},
				"KR": {
					"value": 200,
					"tooltip": {
						"content": "<span>South Korea</span><br />Sales: 200"
					}
				},
				"CA": {
					"value": 2900,
					"tooltip": {
						"content": "<span>Canada</span><br />Sales: 2900"
					}
				},
				"ID": {
					"value": 1200,
					"tooltip": {
						"content": "<span>Indonesia</span><br />Sales: 1300"
					}
				},
				"TR": {
					"value": 90,
					"tooltip": {
						"content": "<span>Turkey</span><br />Sales: 90"
					}
				},
				"IR": {
					"value": 80,
					"tooltip": {
						"content": "<span>Iran</span><br />Sales: 80"
					}
				},
				"AU": {
					"value": 900,
					"tooltip": {
						"content": "<span>Australia</span><br />Sales: 1400"
					}
				},
				"ZA": {
					"value": 50,
					"tooltip": {
						"content": "<span>South Africa</span><br />Sales: 50"
					}
				},
				"EG": {
					"value": 20,
					"tooltip": {
						"content": "<span>Egypt</span><br />Sales: 20"
					}
				},
				"PK": {
					"value": 1300,
					"tooltip": {
						"content": "<span>Pakistan</span><br />Sales: 1300"
					}
				},
				"SG": {
					"value": 100,
					"tooltip": {
						"content": "<span>Singapore</span><br />Sales: 100"
					}
				},
			}
		} // end data

		// map with sales data visualization
		$('.data-visualization-map').mapael({
			map: {
				name: "world_countries",
				defaultArea: {
					attrs : {
						stroke : "#fff", 
						"stroke-width" : 1,
						fill: "#c4c4c4"
					}
				}
			},
			legend: {
				area: {
					display: true,
					title: "Sales",
					slices: [
						{
							max: 100,
							attrs: {
								fill: colors[0]
							},
							label: "Less than 100"
						},
						{
							min: 100,
							max: 500,
							attrs: {
								fill: colors[1]
							},
							label: "Between 100 and 500"
						},
						{
							min: 500,
							max: 1000,
							attrs: {
								fill: colors[2]
							},
							label: "Between 500 and 1000"
						},
						{
							min: 1000,
							max: 1500,
							attrs: {
								fill: colors[3]
							},
							label: "Between 1000 and 1500"
						},
						{
							min: 1500,
							attrs: {
								fill: colors[4]
							},
							label: "More than 1500"
						}
					]
				}
			},
			areas: data['areas']

		}); // end data visualization map

		// map with zoom features
		$mapZoom = $(".zoom-map");
		$mapZoom.mapael({
			map : {
				name: "france_departments",
				zoom: {
					enabled: true,
					maxLevel : 10
				}, 
				defaultPlot: {
					attrs: {
						opacity : 0.6
					}
				}
			},
			areas: {
				"department-56" : {
					text : {content : "56"}, 
					tooltip: {content : "Morbihan (56)"}
				}
			},
			plots : {
				'paris' : {
					latitude : 48.86, 
					longitude: 2.3444
				},
				'lyon' : {
					type: "circle",
					size:50,
					latitude :45.758888888889, 
					longitude: 4.8413888888889, 
					value : 700000, 
					href : "http://fr.wikipedia.org/wiki/Lyon",
					tooltip: {content : "<span style=\"font-weight:bold;\">City :</span> Lyon"},
					text : {content : "Lyon"}
				},
				'rennes' : {
					type :"square",
					size :20,
					latitude : 48.114166666667, 
					longitude: -1.6808333333333, 
					tooltip: {content : "<span style=\"font-weight:bold;\">City :</span> Rennes"},
					text : {content : "Rennes"},
					href : "http://fr.wikipedia.org/wiki/Rennes"
				}
			}
		});

		// Zoom on mousewheel with mousewheel jQuery plugin
		$mapZoom.on("mousewheel", function(e) {
			if (e.deltaY > 0)
				$mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") + 1);
			else
				$mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") - 1);
				
			return false;
		});

		// focus to paris
		$('#focus-paris').on('click', function() {
			// Translate latitude,longitude of Paris to x,y coordinates
			var coords = $.fn.mapael.maps["france_departments"].getCoords(48.114167, 2.3444);
			$mapZoom.trigger('zoom', [10, coords.x, coords.y]);
		});

		$('#focus-lyon').on('click', function() {
			// Translate latitude,longitude of Lyon to x,y coordinates
			var coords = $.fn.mapael.maps["france_departments"].getCoords(45.758888888889, 4.8413888888889);
			$mapZoom.trigger('zoom', [5, coords.x, coords.y]);
		});

		$('#map-clear-zoom').on('click', function() {
			$mapZoom.trigger('zoom', [0]);
		});
	} // end map page demo

	if( $('.data-us-map').length > 0 ) {
		
		// map with circle plot
		$('.data-us-map').mapael({
			map: {
				name: "usa_states",
				defaultPlot: {
					size: 10
				},
				defaultArea: {
					attrs: {
						stroke: "#fafafa", 
						"stroke-width": 1,
						fill: "#c4c4c4"
					}
				}
			},
			legend: {
				plot: {
					display: true,
					title: "US Sales Map",
					hideElemsOnClick: {
						opacity : 0
					},
					slices: [ 
						{
							size: 10,
							type: "circle",
							max: 500,
							attrs: { fill: colors[1] },
							label: "Less than 500 sales"
						},
						{
							size: 20,
							type: "circle",
							min: 500,
							max: 750,
							attrs: { fill: colors[1] },
							label: "Between 500 and 750 sales"
						},
						{
							size: 30,
							type: "circle",
							min: 750,
							max: 1000,
							attrs: { fill: colors[1] },
							label: "Between 750 and 1000 sales"
						},
						{
							size: 40,
							type: "circle",
							min: 1000,
							max: 1250,
							attrs: { fill: colors[1] },
							label: "Between 1000 and 1250 sales"
						},
						{
							size: 50,
							type: "circle",
							min: 1250,
							max: 1500,
							attrs: { fill: colors[1] },
							label: "Between 1250 and 1500 sales"
						}
					]
				}
			},
			plots: {
				"ny": {
					value: 1450,
					latitude: 40.717079,
					longitude: -74.00116,
					tooltip: { content: "<span>New York</span><br />Sales: 1450" }
				},
				'an': {
					value: 900,
					latitude: 61.2108398, 
					longitude: -149.9019557,
					tooltip: { content : "<span>Anchorage</span><br />Sales: 900"}
				},
				'sf': {
					value: 1200,
					latitude: 37.792032,
					longitude: -122.394613,
					tooltip: { content : "<span>San Francisco</span><br />Sales: 1200"}
				},
				'pa': {
					value: 400,
					latitude: 19.493204,
					longitude: -154.8199569,
					tooltip: { content : "<span>Pahoa</span><br />Sales: 400"}
				},
				'nm': {
					value: 850,
					latitude: 35.101934,
					longitude: -106.633301,
					tooltip: { content : "<span>Albuquerque</span><br />Sales: 850"}
				},
				'nj': {
					value: 30,
					latitude: 38.934385,
					longitude: -74.908028,
					tooltip: { content : "<span>Cape May</span><br />Sales: 30"}
				},
				'il': {
					value: 1100,
					latitude: 41.879786,
					longitude: -87.62352,
					tooltip: { content : "<span>Chicago</span><br />Sales: 1100"}
				},
				'or': {
					value: 70,
					latitude: 19.493204,
					longitude: -154.8199569,
					tooltip: { content : "<span>Portland</span><br />Sales: 70"}
				}
			}
		}); // end map with circle plot
	}

{/literal}
	});

	$('.js-toggle-expanded').clickToggle(
			   
			function() {
console.log("expanding");

				$('.left-sidebar').removeClass('minified');
				$('.content-wrapper').removeClass('expanded');
				$('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
			},
			function() {
console.log("minimizing");
				$('.left-sidebar').addClass('minified');
				$('.content-wrapper').addClass('expanded');
	
				$('.left-sidebar .sub-menu')
				.css('display', 'none')
				.css('overflow', 'hidden'); 
				
				$('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
			}
	);


	function toggleSideBar(e) {

//		console.log(e);

		if ($(e).hasClass("fa-angle-right")) {
			updateSideBar("open");
		}
		else {
			updateSideBar("close");
		}

	}

	function updateSideBar(status) {

			$.post( "/home/ajax/sidebar/"+status+"?PHPSESSID={$sessionID}", function() {
				$("#worksheet-footer").html("");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
				}
				else {
				}
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed!");
				$("#saveWorksheetLines").attr("disabled", false);
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
				$("#saveWorksheetLines").attr("disabled", false);
			})
	}

	</script>
</body>

</html>