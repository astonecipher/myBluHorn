<?php /* Smarty version Smarty-3.1.13, created on 2015-05-01 23:28:12
         compiled from "db:worksheet-tv-alt-simple" */ ?>
<?php /*%%SmartyHeaderCode:12247155045544444cd43d72-59641210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bb71514dc3cbc450ea702838648a7b09547238d' => 
    array (
      0 => 'db:worksheet-tv-alt-simple',
      1 => 1426784439,
      2 => 'db',
    ),
    '667edc434c4263a0fb1a6a35e42d287396c2c344' => 
    array (
      0 => 'db:kingboard-framework',
      1 => 1430518050,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '12247155045544444cd43d72-59641210',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base' => 0,
    'hideSideBar' => 0,
    'userID' => 0,
    'username' => 0,
    'gravatar' => 0,
    'shortname' => 0,
    'activeSideBar' => 0,
    'user' => 0,
    'tip' => 0,
    'chartCampaignsTotal' => 0,
    'chartBuysTotal' => 0,
    'chartAdsTotal' => 0,
    'agency' => 0,
    'TVCableRatio' => 0,
    'RadioRatio' => 0,
    'PrintDigitalRatio' => 0,
    'PrintDigitallRatio' => 0,
    'OutdoorRatio' => 0,
    'recentCampaigns' => 0,
    'campaign' => 0,
    'recentWorksheets' => 0,
    'worksheet' => 0,
    'chartCampaigns' => 0,
    'chartBuys' => 0,
    'chartAds' => 0,
    'sessionID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5544444ead4a85_48489916',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5544444ead4a85_48489916')) {function content_5544444ead4a85_48489916($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/mnt/stor9-wc1-dfw1/649984/dev.filelogix.com/lib/Smarty-3.1.13/libs/plugins/function.counter.php';
if (!is_callable('smarty_modifier_replace')) include '/mnt/stor9-wc1-dfw1/649984/dev.filelogix.com/lib/Smarty-3.1.13/libs/plugins/modifier.replace.php';
?><!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
	<base href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['base']->value)===null||$tmp==='' ? "/" : $tmp);?>
">
	<title>Campaign Worksheet-TV | BluHorn</title>
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



	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/kingboard-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/kingboard-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/kingboard-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/ico/kingboard-favicon57x57.png">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>
		<style>
			.left-sidebar .sub-menu {
				display: none;
				overflow: hidden;
			}
		</style>
	<?php }?>

			

	

<style>
html, body {
    max-width: 100%;
    overflow-x: hidden;
}

	.dropdown-menu {
		border: 1px solid #555;
		padding-bottom: 10px;
	}

th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

.form input, form textarea, form select {
    font-size: 8px;
}
.form .input-sm {
	height: 20px;
	padding: 2px 5px;
	font-size: 12px;
	line-height: 1.2;
}

.table td:nth-last-child(n-5)
{

 text-align:center !important;
}

.table td:first-child
{
width: 75px;
 text-align:center !important;
}


.DTFC_LeftBodyLiner thead {
	display: none;
}

.DTFC_LeftBodyWrapper {
	margin-bottom: 20px;
}

.DTFC_LeftFootWrapper tfoot {
	background-color: #efefef;
}


.DTFC_LeftBodyWrapper {
	top: 20px;
	background-color: #ececec;
}

.line-number { 
	width: 30px;
}

</style>





	

	<link href="/lib/select2/select2.css" rel="stylesheet"/>

	<link rel="stylesheet" media="screen" href="/lib/handsontable/jquery.handsontable.full.css">




</head>

<body class="dashboard">

	<!-- WRAPPER -->
	
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
								<div id="tour-searchbox" class="input-group searchbox <?php if ($_smarty_tpl->tpl_vars['userID']->value!=1){?>hidden<?php }?>" style="width: 30em;">
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
											<a href="/user/<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
												<img src="https://www.gravatar.com/avatar/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['gravatar']->value)===null||$tmp==='' ? "20" : $tmp);?>
?s=20&r=pg&d=mm" />
												<span class="name"><?php echo $_smarty_tpl->tpl_vars['shortname']->value;?>
</span>
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu" role="menu">
												<li>
													<a href="/user/account/<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">
														<i class="fa fa-user"></i>
														<span class="text">Profile</span>
													</a>
												</li>
												<li>
													<a href="/user/settings/<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">
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
					<div class="col-md-2 left-sidebar   <?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>minified<?php }?>">

						<!-- main-nav -->
						<nav class="main-nav">

							<ul class="main-menu">
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['dashboard'];?>
"><a href="home"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a>
								</li>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['clients'];?>
"><a href="clients" class="js-sub-menu-toggle"><i class="fa fa-users fa-fw"></i><span class="text">Clients</span>
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
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['campaigns'];?>
"><a href="campaigns" class="js-sub-menu-toggle"><i class="fa fa-rocket fw"></i><span class="text">Campaigns</span>
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
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['worksheets'];?>
"><a href="worksheets" class="js-sub-menu-toggle"><i class="fa fa-table fw"></i><span class="text">Worksheets</span>
									<i class="toggle-icon fa fa-angle-left"></i></a>
									<ul class="sub-menu ">

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

								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['orders'];?>
"><a href="orders" class="js-sub-menu-toggle"><i class="fa fa-gavel fw"></i><span class="text">Orders</span>
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
<?php if ($_smarty_tpl->tpl_vars['user']->value['useProjects']){?>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['projects'];?>
"><a href="projects" class="js-sub-menu-toggle"><i class="fa fa-tree fw"></i><span class="text">Projects</span>
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
<?php }?>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['reports'];?>
"><a href="reports" class="js-sub-menu-toggle"><i class="fa fa-briefcase fw"></i><span class="text">Reports</span>
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
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['vendors'];?>
"><a href="vendors" class="js-sub-menu-toggle"><i class="fa fa-truck fw"></i><span class="text">Vendors</span>
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
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['markets'];?>
"><a href="markets"><i class="fa fa-map-marker fa-fw"></i><span class="text">Markets</span></a>
								</li>
<?php if ($_smarty_tpl->tpl_vars['user']->value['useInventory']){?>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['inventory'];?>
"><a href="inventory" class="js-sub-menu-toggle"><i class="fa fa-cube fw"></i><span class="text">Inventory</span>
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

<?php }?>

								</li>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['agency'];?>
"><a href="agency"><i class="fa fa-building-o fa-fw"></i><span class="text">Agency</span></a>
								</li>			
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['documents'];?>
"><a href="cabinet" class="js-sub-menu-toggle"><i class="fa fa-archive fw"></i><span class="text">Documents</span>
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
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['more'];?>
"><a href="cabinet" class="js-sub-menu-toggle"><i class="fa fa-life-ring fw"></i><span class="text">Support</span>
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
<?php if ($_smarty_tpl->tpl_vars['userID']->value==1||$_smarty_tpl->tpl_vars['userID']->value==3||$_smarty_tpl->tpl_vars['userID']->value==4||$_smarty_tpl->tpl_vars['userID']->value==150){?>
								<li class="<?php echo $_smarty_tpl->tpl_vars['activeSideBar']->value['more'];?>
"><a href="#" class="js-sub-menu-toggle"><i class="fa fa-cogs fw"></i><span class="text">Admin</span>
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
<?php }?>
							</ul>
						</nav>
						<!-- /main-nav -->

						<div class="sidebar-minified js-toggle-<?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>expanded<?php }else{ ?>minified<?php }?>">
							<i class="fa fa-angle-left <?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>fa-angle-right<?php }?>" onclick="toggleSideBar(this);"></i>
						</div>

						<!-- sidebar content -->
						<div class="sidebar-content">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h5><i class="fa fa-lightbulb-o"></i> Tips</h5>
								</div>
								<div class="panel-body">
									<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tip']->value)===null||$tmp==='' ? "Want to request a new feature or enhance an existing one?<br>We want to hear from you, contact us at support@bluhorn.com" : $tmp);?>
</p>
								</div>
							</div>

						</div>
						<!-- end sidebar content -->
					</div>
					<!-- end left sidebar -->

					<!-- content-wrapper -->
					<div class="col-md-10 content-wrapper   <?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>expanded<?php }?>

">
						<div class="row">
							<div class="col-md-4">
								
		<ul class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="home">Home</a>
			</li>
			<li><a href="campaigns/edit/<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['campaign']->value['name'];?>
</a></li>
			<li class="active">Worksheet: Broadcast TV</li>
			</ul>

							</div>
							<div class="col-md-8">
								<div class="top-content">
									<ul class="list-inline mini-stat">
										<li>
											<h5>CAMPAIGNS
												<span class="stat-value stat-color-orange"><i class="fa fa-plus-circle"></i> <?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['chartCampaignsTotal']->value,0,".",","))===null||$tmp==='' ? "0" : $tmp);?>
</span>
											</h5>
											<span id="mini-bar-chart-campaigns" class="mini-bar-chart"></span>
										</li>
										<li>
											<h5>BUYS
												<span class="stat-value stat-color-blue"><i class="fa fa-plus-circle"></i> <?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['chartBuysTotal']->value,0,".",","))===null||$tmp==='' ? "0" : $tmp);?>
</span>
											</h5>
											<span id="mini-bar-chart-buys" class="mini-bar-chart"></span>
										</li>
										<li class="hide">
											<h5>ADS
												<span class="stat-value stat-color-seagreen"><i class="fa fa-plus-circle"></i> <?php echo (($tmp = @number_format($_smarty_tpl->tpl_vars['chartAdsTotal']->value,0,".",","))===null||$tmp==='' ? "0" : $tmp);?>
</span>
											</h5>
											<span id="mini-bar-chart-ads" class="mini-bar-chart"></span>
										</li>
									</ul>
								</div>
							</div>
						</div>

	
	

						<!-- main -->

						

						<div class="content">
							<div class="main-header">
								<h2>Worksheet (Broadcast TV)</h2>
								<em>Media Buying Summary</em>
							</div>
							<div class="col-md-12">





								<div class="widget">
											<div class="widget-header">
												<h3><i class="fa fa-windows"></i> Pre-Buy Worksheet </h3>
				
																		<em></em>


												<div class="btn-group widget-header-toolbar hidden-xs">
<div class="control-inline toolbar-item-group ">

																	<span class="control-title"><i class="fa fa-magic"></i>Auto-Update?</span>
			
						<input type="hidden" id="autoUpdate" name="autoUpdate" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['isAutoCalc'];?>
">
	
						<input type="checkbox" id="autoCalc" name="isAutoCalc" <?php if ($_smarty_tpl->tpl_vars['worksheet']->value['isAutoCalc']){?>checked<?php }?> class="switch-mini" data-on="success" data-off="default" data-on-label="Yes" data-off-label="No" >	<!--<input type="checkbox" id="scrolling" name="isScrolling" <?php if ($_smarty_tpl->tpl_vars['worksheet']->value['isScrolling']){?>checked<?php }?> class="switch-mini" data-on="success" data-off="default" data-on-label="Scroll" data-off-label="Full" >-->					</div>											 	     <a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
												     <a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>												  												</div>
											</div>
											<div class="widget-content" style="display: block;">
											   	<div class="col-md-8 col-lg-5">
												<div style="width:100%;"><strong>Name:</strong> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['worksheet']->value['name'])===null||$tmp==='' ? 'none' : $tmp);?>
 </div>
												<div style="width:100%;"><strong>Advertiser:</strong> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['client']->value['name'])===null||$tmp==='' ? 'none' : $tmp);?>
 </div>
												<div style-"width: 100%;"><strong>Campaign:</strong> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['campaign']->value['name'])===null||$tmp==='' ? 'none' : $tmp);?>
 </div>
												<div style="width: 100%;"><strong>Flight Dates:</strong> <?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightStart'];?>
 to <?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightEnd'];?>
</div>
												<div style="width: 100%;"><strong>Market:</strong> <?php echo $_smarty_tpl->tpl_vars['marketName']->value;?>
 </div>
												<div style="width: 100%;"><strong>Vendor(s):</strong> <?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
?> <a href="/vendors/edit/<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
</a><?php } ?></div>
												<div style="width: 100%;"><strong>Demo(s):</strong> <?php  $_smarty_tpl->tpl_vars['demo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['demo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['demographics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['demo']->key => $_smarty_tpl->tpl_vars['demo']->value){
$_smarty_tpl->tpl_vars['demo']->_loop = true;
?> <?php echo $_smarty_tpl->tpl_vars['demo']->value['description'];?>
 <?php }
if (!$_smarty_tpl->tpl_vars['demo']->_loop) {
?>none<?php } ?> </div>
												<div class="hidden" style="width: 100%;"><strong>Sorting:</strong><?php  $_smarty_tpl->tpl_vars['sorting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sorting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worksheet']->value['sorting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sorting']->key => $_smarty_tpl->tpl_vars['sorting']->value){
$_smarty_tpl->tpl_vars['sorting']->_loop = true;
?> <?php echo $_smarty_tpl->tpl_vars['sorting']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['sorting']->value['direction'];?>
 <?php } ?></div>
												 <div style="width: 100%; padding-bottom: 30px;"><strong>Contract #:</strong> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['orderInfo']->value['contractNumber'])===null||$tmp==='' ? 'none' : $tmp);?>
</div>
												</div>
												<div class="col-md-12 col-lg-7 hidden-xs hidden-sm" style="padding-bottom: 50px;">
												   <div class="pull-right">
												    <div class="btn-group">
												         <button type="button" class="btn btn-primary" id="editWorksheet" onclick="editWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Edit Worksheet</button>
												    </div>
												    <div class="btn-group">
												         <button type="button" class="btn btn-warning" id="toggleSummary" onclick="toggleSummary();">Hide Summary</button>
												    </div>
												    <div class="btn-group">												         <button type="button" class="btn btn-default" id="saveWorksheetLines" onclick="saveWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" disabled>Save Worksheet</button>												   </div>
												   <div class="btn-group ">
												         <button type="button" class="btn btn-success" id="createOrderButton" onclick="createOrder('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Create Order</button>
  <button type="button" class="btn btn-success dropdown-toggle" id="createOrderButtonDropDown" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="javascript:createOrder('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Create Order</a></li>
    <li><a href="javascript:viewSchedule('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
',11, 'pdf');">Show Schedule</a></li>
    <li><a href="javascript:viewPrograms('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
', 21, 'pdf');">View Programming</a></li>
    <li><a href="javascript:exportWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
', 14, 'csv');">Export to CSV</a></li>
    <li><a class="" href="javascript:sendOrder('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Send Order</a></li>
    <li><a href="javascript:previewOrder('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Preview Order</a></li>
    <li class="divider"></li>
    <li <?php if (!$_smarty_tpl->tpl_vars['worksheet']->value['isOrdered']){?>class="disabled"<?php }?>><a class="" href="javascript:cancelBox('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" >Cancel Order</a></li>
  </ul>
												   </div>
											 	 </div>
												</div>

												  <div class="col-xs-12 col-sm-12 hidden-md hidden-lg" style="padding-bottom: 50px;">
												   <div class="pull-right">
												    <div class="btn-group">
												         <button type="button" class="btn btn-primary" id="editWorksheetSmall" onclick="editWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" >Edit</button>
												    </div>
												    <div class="btn-group">
												         <button type="button" class="btn btn-warning" id="toggleSummarySmall" onclick="toggleSummary();">Hide</button>
												    </div>
												    <div class="btn-group">												         <button type="button" class="btn btn-default" id="saveWorksheetLinesSmall" onclick="saveWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" disabled>Save</button>												   </div>
												   <div class="btn-group ">
												         <button type="button" class="btn btn-success" id="createOrderButtonSmall" onclick="createOrder('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');">Create</button>
												   </div>
											 	 </div>
												</div>

												<div class="row" style="overflow; hidden;">
												    <div class="col-lg-12" style="margin-top: 20px; overflow-x: hidden; overflow-y: hidden;">
												           <div id="summaryTable"></div>
												    </div>
												</div>
												<div class="hidden">
												     <form id="report-form">
												          <input type="hidden" name="campaigns[]" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
">
												          <input type="hidden" name="worksheets[]" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
">
												          <input type="hidden" name="clients[]" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
">
												          <input type="hidden" name="agencyID" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['agencyID'];?>
">
												          <input type="hidden" id="reportFormat" name="format" value="pdf">
												          <input type="hidden" name="category" value="schedule">
												          <input type="hidden" id="templateID" name="templateID" value="11">
												     </form>
												     <form id="report-form-programs">
												          <input type="hidden" name="campaigns[]" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
">
												          <input type="hidden" name="worksheets[]" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
">
												          <input type="hidden" name="clients[]" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
">
												          <input type="hidden" name="agencyID" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['agencyID'];?>
">
												          <input type="hidden" id="reportFormat" name="format" value="pdf">
												          <input type="hidden" name="category" value="programs">
												          <input type="hidden" id="templateID" name="templateID" value="21">
												     </form>
												</div>

											</div>
									<div class="widget-footer" id="worksheet-footer">
									&nbsp;
									</div>
								</div>

								<div id="worksheet-status">



								<div id="isCancelled" class="widget" style="border-color: #c92929; <?php if (!$_smarty_tpl->tpl_vars['worksheet']->value['isCancelled']){?>display: none;<?php }?>">
											<div class="widget-header" style="background-color: #c92929; border-bottom-color: #c92929;; border-color: #c92929;">
												<h3><i class="fa fa-trash-o"></i> Cancelled!</h3> 
												<div class="btn-group widget-header-toolbar" style="background-color: #c92929; border-left-color: #c92929; float: right;'">
												    <h3 id="cancelledStamp" class=""><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['orderCancelled'];?>
</h3>
												    <a href="" title="Expand/Collapse" class="btn-borderless btn-toggle-collapse"  ><i class="fa fa-chevron-down"></i></a>
												</div>
											</div>
											<div class="widget-content" style="display: none;">
												<br/>
											</div>								</div>



								<div id="isOrdered" class="widget"  style="border-color: #4ba84b; <?php if (!$_smarty_tpl->tpl_vars['worksheet']->value['isOrdered']){?>display: none;<?php }?>">
											<div class="widget-header" style="background-color: #4ba84b; border-bottom-color: #4ba84b; border-color: #4ba84b;">
												<h3><i class="fa fa-gavel"></i> Ordered!</h3> 
												<div class="btn-group widget-header-toolbar" style="border-left-color: #4ba84b; float: right;">
												    <h3 id="orderedStamp"><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['orderCreated'];?>
</h3>
												    <a href="" title="Expand/Collapse" class="btn-borderless btn-toggle-collapse"  ><i class="fa fa-chevron-down"></i></a>
												</div>
											</div>
											<div class="widget-content" style="display: none;">
			
											</div>
								</div>

								<div id="isDelivered" class="widget"  style="border-color: #d19804; <?php if (!$_smarty_tpl->tpl_vars['worksheet']->value['isDelivered']){?>display: none;<?php }?>">
											<div class="widget-header" style="background-color: #d19804; border-bottom-color: #d19804; border-color: #d19804;">
												<h3><i class="fa fa-bolt"></i> Sent!</h3> 
												<div class="btn-group widget-header-toolbar" style="border-left-color: #d19804; float: right;">
												    <h3 id="orderedStamp"><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['orderSent'];?>
</h3>
												    <a href="" title="Expand/Collapse" class="btn-borderless btn-toggle-collapse"  ><i class="fa fa-chevron-down"></i></a>
												</div>
											</div>
											<div class="widget-content" style="display: none;">
			
											</div>
								</div>

								<div class="widget">
											<div class="widget-header">
												<h3><i class="fa fa-truck"></i> Station Order</h3> 
												<div class="btn-group widget-header-toolbar">
												    <a href="" title="Expand/Collapse" class="btn-borderless btn-toggle-collapse"  ><i class="fa fa-chevron-down"></i></a>
												</div>
											</div>
											<div class="widget-content" style="display: none;">
												<form name="order" class="form" id="orderForm" method="post" action="">
												<input type="hidden" name="agencyID" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['agencyID'];?>
">
												<input type="hidden" name="campaignID" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['campaignID'];?>
">
												<input type="hidden" name="worksheetID" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
">
												<input type="hidden" name="sessionID" value="<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
">
												<input type="hidden" name="orderID" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
">
												<input type="hidden" name="orderType" value="TV">
												<div class="row">
											   	<div class="col-lg-12">
												   <div style="width: 100%;"><strong>Vendor(s):</strong></div>
												      <div class="col-lg-12 form-group">
												        <?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
?>
												        <div class="col-lg-3"><label><input type="checkbox" name="vendor[]" value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
</label></div>
												        <?php }
if (!$_smarty_tpl->tpl_vars['vendor']->_loop) {
?>
												        <label>Order will contain all vendors on Worksheet.</label>
											                <?php } ?>
												      </div>
												   <div style="width: 100%;"><strong>Please choose fields to be printed on the Station Order:</strong></div>
												      <div class="col-lg-3 form-group">
												        <label><input type="checkbox" name="printSpotsPerStation" value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printSpotsStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Spots/Station</label><br>
												        <label><input type="checkbox" name="printCPPStation"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printCPPStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> CPP/Station</label><br>
												        <label><input type="checkbox" name="printCallLetters" value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printCallLetters']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Station Call Letters</label><br>
												      </div>
							
												      <div class="col-lg-3 form-group">
												        <label><input type="checkbox" name="printCPPLine"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printCPPLine']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> CPP/Line</label><br>
												        <label><input type="checkbox" name="printCPMStation"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printCPMStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> CPM/Station</label><br>
												        <label><input type="checkbox" name="printCPMLine"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printCPMLine']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> CPM/Line</label><br>
												      </div>

												      <div class="col-lg-3 form-group ">
												        <label><input type="checkbox" name="printNetDollarsStation"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printNetDollarsStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Net Dollars/Station</label><br>
												        <label><input type="checkbox" name="printGrossDollarsStation"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printGrossDollarsStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Gross Dollars/Station</label><br>
												        <label><input type="checkbox" name="printRatingLine"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printRatingLine']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Rating/Line</label><br>
												      </div>

												      <div class="col-lg-3 form-group">
												        <label><input type="checkbox" name="printGRPStation"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printGRPStation']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> GRP/Station</label><br>
												        <label><input type="checkbox" name="printGRPWeek"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printGRPWeek']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> GRP/Week</label><br>
												        <label><input type="checkbox" name="printSummary"  value="1" <?php if ($_smarty_tpl->tpl_vars['order']->value['printSummary']){?>checked<?php }elseif(!$_smarty_tpl->tpl_vars['order']->value['id']){?>checked<?php }?>> Show Summary</label><br>
												      </div>

												</div>
												</div>

												<div class="row">
											   	<div class="col-lg-12">

												   <div style="width: 100%;"><strong>Show/Hide Columns?</strong><em> (<a href="javascript:showAllColumns(20);">Show All Columns</a>)</em></div>
												      <div class="col-lg-12 form-group">
												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="1" id="col-1" name="showLineNumber" data-name="lineNumber" value="1"> Worksheet Line #</label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="2" id="col-2" name="showDaypart" data-name="daypart" value="1" checked> Daypart </label>
												        </div>												        <div class="col-lg-3">
											                 <label><input type="checkbox" class="toggle-col" data-column="3" id="col-3" name="showVendor" data-name="vendor" value="1" checked> Vendor </label>
												         </div>												        <div class="col-lg-3">												        <label><input type="checkbox" class="toggle-col" data-column="4" id="col-4" name="showStation" data-name="station" value="1" checked> Station </label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="5" id="col-5" name="showTimePeriod" data-name="timePeriod" value="1" checked> Time Period</label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="6" id="col-7" name="showProgramName"  data-name="program" value="1" checked> Program Name</label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="14" id="col-14" name="showLength"  data-name="seconds" value="1" checked> Length</label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="15" id="col-15" name="showRate"  data-name="rate" value="1" checked> Rate</label>
												         </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="16" id="col-16" name="showAQH"  data-name="aqh" value="1" checked> Rating</label>
												        </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="17" id="col-17" name="showCPP" data-name="cpp" value="1" checked> CPP</label>
											                </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="18" id="col-18" name="showImpact"  data-name="impact" value="1" checked> Impact</label>
											                </div>												        <div class="col-lg-3">
												        <label><input type="checkbox" class="toggle-col" data-column="19" id="col-19" name="showCPM"  data-name="cpm" value="1" checked> CPM</label>
												        </div>
												      </div>
												      <?php echo smarty_function_counter(array('name'=>"colCounter",'start'=>20,'skip'=>1,'assign'=>"colCounter",'print'=>false),$_smarty_tpl);?>

												      <?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['weekNames']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_counter(array('name'=>"totalWeeks",'start'=>20,'skip'=>$_tmp1,'assign'=>"totalWeeks",'print'=>false),$_smarty_tpl);?>

												      <?php echo smarty_function_counter(array('name'=>"weekCounter",'start'=>1,'skip'=>1,'assign'=>"weekCounter",'print'=>false),$_smarty_tpl);?>

												    </div>
											         </div>
												<div class="row">
											   	<div class="col-lg-12">
												   <?php echo smarty_function_counter(array('name'=>"totalWeeks"),$_smarty_tpl);?>

												   <div style="width: 100%;"><strong>Show/Hide Weeks?</strong><em> (<a href="javascript:showAllWeeks(20,<?php echo $_smarty_tpl->tpl_vars['totalWeeks']->value;?>
);">Show All Weeks</a> | <a href="javascript:hideAllWeeks(20,<?php echo $_smarty_tpl->tpl_vars['totalWeeks']->value;?>
);">Hide All Weeks</a>)</em></div>
												      <div class="col-lg-12 form-group">
												           <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
?>
												              <div class="col-lg-3">												                 <label><input type="checkbox" class="toggle-col" data-column="<?php echo $_smarty_tpl->tpl_vars['colCounter']->value;?>
" id="col-<?php echo $_smarty_tpl->tpl_vars['colCounter']->value;?>
" name="showWeek-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
"  value="1" checked> <?php echo $_smarty_tpl->tpl_vars['weekName']->value;?>
</label>
											                         <?php echo smarty_function_counter(array('name'=>"colCounter"),$_smarty_tpl);?>

											                         <?php echo smarty_function_counter(array('name'=>"weekCounter"),$_smarty_tpl);?>

												              </div>
												           <?php } ?>
												      </div>

												</div>

												<div class="col-lg-6">

												</div>
												</div>
												<div class="row" style="overflow; hidden;">
												    <div class="col-lg-12" style="overflow; hidden;">
												             <label for="revision"><strong>Revision #</strong>
												                   <input type="text" name="revision" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['orderInfo']->value['revision'])===null||$tmp==='' ? "1" : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" class="form-control input input-sm" id="revisionNumber" width=10></input>
												             </label>
											  	    </div>												    <div class="col-lg-4" style="overflow; hidden;">
												             <label for="comments"><strong>Comments</strong>												             <textarea class="form-control col-lg-5" rows="4" cols="50" name="comments"><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['comments'];?>
</textarea>
									                                     </label>
												    </div>
												    <div class="col-lg-4" style="overflow; hidden;">
												             <label for="traffic"><strong>Traffic</strong>
												             <textarea class="form-control col-lg-5" rows="4" cols="50" name="traffic"><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['traffic'];?>
</textarea>
											                     </label>
											    	   </div>	
												    <div class="col-lg-3" style="overflow; hidden;">
<div class="panel panel-default">
  <div class="panel-heading">
    <strong>Order Settings</strong>
  </div>
  <div class="panel-body">
  </div>
</div>
												</div>
											</div>											</form>
											</div>
									
								</div>

							</div>
							<div class="col-md-12 col-lg-2 col-sm-12 col-xs-12"  id="widget-summary">
										<div class="widget">
											<div class="widget-header">
												<h3>Summary</h3>
												<div class="pull-right" style="margin-top: 5px;">
												    <div class="btn-group btn-group-xs" data-toggle="buttons">
												    <label class="btn btn-default active">
   												        <input type="radio" name="summary-switch" value="daypart" id="summary-switch-daypart" onchange="javascript:summarySwitch();" checked> D
											  	    </label>
												    <label class="btn btn-default">
												       <input type="radio" name="summary-switch" value="station" id="summary-switch-station" onchange="javascript:summarySwitch();"> S
	 											    </label>
												    <label class="btn btn-default">
												       <input type="radio" name="summary-switch" value="full" id="summary-switch-full" onchange="javascript:summarySwitch();"> F
												    </label>
												   </div>
											       </div>
											</div>
											<div class="widget-content" class="col-lg-2 col-md-4 col-sm-6 col-xs-12" id="widget-content-summary" style="width: 100%;">
												<table style="border: 0px; margin: 0 auto;">
												     <tr><td style="width: 60%;"><strong>Total Spots: </strong></td><td style="text-align: right;"><div id="totalSpots">0</div></td></tr>
												     <tr><td style="width: 60%;"><strong>Total $$: </strong></td><td style="width: 50%; text-align: right;"><div id="totalSpend">$0.00</div></td></tr>
												      <?php if ($_smarty_tpl->tpl_vars['worksheet']->value['grpGoal']){?> <tr><td style="width: 60%;"><strong> GRP Goal: </strong></td><td style="text-align: right;"> <?php echo $_smarty_tpl->tpl_vars['worksheet']->value['grpGoal'];?>
</td></tr><?php }?>												     <tr><td style="width: 60%;"><strong>Total GRPs: </strong></td><td style="text-align: right;"><div id="totalGRPs">0.0</div></td></tr>
												     <tr><td style="width: 60%;"><strong>Overall CPP: </strong></td><td style="text-align: right;"><div id="overallCPP">$0.00</div></td></tr>
												     <tr><td style="width: 60%;"><strong>CPM: </strong></td><td style="text-align: right;"><div id="totalCPM">$0.00</div></td></tr>
												     <tr><td style="width: 60%;"><strong>Reach: </strong></td><td style="text-align: right;"><div id="totalReach">0.00%</div></td></tr>
												     <tr><td style="width: 60%;"><strong>Freq: </strong></td><td style="text-align: right;"><div id="totalFreq">0.00</div></td></tr>
												</table>	
												<hr>
												<div class="daypart-summary-widget" id="widget-station-summary">

												    <?php  $_smarty_tpl->tpl_vars['daypartName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daypartName']->_loop = false;
 $_smarty_tpl->tpl_vars['daypart'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dayparts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['daypartName']->key => $_smarty_tpl->tpl_vars['daypartName']->value){
$_smarty_tpl->tpl_vars['daypartName']->_loop = true;
 $_smarty_tpl->tpl_vars['daypart']->value = $_smarty_tpl->tpl_vars['daypartName']->key;
?> <?php if ($_smarty_tpl->tpl_vars['daypart']->value!="none"){?>
												    <div class="summary-daypartName" id="summary-daypart-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">
												       <center><h5><?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
</h5></center>
												       <table style="border: 0px; margin: 0 auto; ">
												         <tr><td style="width: 60%;"><strong>Total Spots: </strong></td><td style="text-align: right;"><div id="daypart-totalSpots-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">0</div></td></tr>
												         <tr><td style="width: 60%;"><strong>Total $$: </strong></td><td style="width: 50%; text-align: right;"><div id="daypart-totalSpend-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">$0.00</div></td></tr>
												         <tr><td style="width: 60%;"><strong>Total GRPs: </strong></td><td style="text-align: right;"><div id="daypart-totalGRPs-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">0.0</div></td></tr>
												         <tr><td style="width: 60%;"><strong>CPP: </strong></td><td style="text-align: right;"><div id="daypart-overallCPP-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">$0.00</div></td></tr>
												         <tr><td style="width: 60%;"><strong>CPM: </strong></td><td style="text-align: right;"><div id="daypart-totalCPM-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">$0.00</div></td></tr>
												         <tr><td style="width: 60%;"><strong>% of GRP: </strong></td><td style="text-align: right;"><div id="daypart-percentOfTotalGRP-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">0.0</div></td></tr>
												         <tr><td style="width: 60%;"><strong>Reach: </strong></td><td style="text-align: right;"><div id="daypart-reach-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">0.00%</div></td></tr>
												         <tr><td style="width: 60%;"><strong>Freq: </strong></td><td style="text-align: right;"><div id="daypart-freq-<?php echo $_smarty_tpl->tpl_vars['daypartName']->value;?>
">0.00</div></td></tr>
												      </table>
												    </div>

												    <?php }?> <?php } ?>

												</div>
											
												<div class="station-summary-widget" id="station-summary-widget" style="display: none; with: 95%; overflow: none;"></div>

										        </div>
											<div class="widget-footer">
												<?php echo $_smarty_tpl->tpl_vars['status']->value;?>

											</div>
										</div>	
							</div>
							<div class="col-md-12 col-lg-10" id="worksheet-div" >

<div class="form" id="worksheet-form">

<table id="worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
" class="table table-sorting table-striped table-hover" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width: none;">
        <thead>
            <tr>
                <th style="width: 30px;">Line</th>
                <th>Line #</th>
                <th data-index="daypart">DP</th>
                <th data-index="vendorID">Vendor</th>
                <th data-index="station">Station</th>
                <th data-index="timePeriod">Time Period</th>
                <th data-index="programName">Program Name</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>R</th>
                <th>F</th>
                <th>Sa</th>
                <th>Su</th>
                <th data-index="seconds">Len</th>
                <th data-index="rate">Rate</th>
                <th style="text-align: center;" data-index="aqhRating"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['demographic']->value)===null||$tmp==='' ? "Rating" : $tmp);?>
</th>
                <th data-index="cpp">CPP</th>
                <th data-index="impact">000</th>
                <th data-index="cpm">CPM</th>
<?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
?>
		<th><?php echo $_smarty_tpl->tpl_vars['weekName']->value;?>
</th>
<?php } ?>

                <th class="hidden-sm hidden-xs">Comments</th>
                <th style="text-align: center;">Copy</th>
                <th style="text-align: center;">Bold</th>
                <th style="text-align: center;">Trade</th>
                <th style="text-align: center;">Skip</th>
                <th style="text-align: center;">Delete</th>

            </tr>
        </thead>
 	<tbody id="worksheet-body">
	<?php echo smarty_function_counter(array('name'=>"rowCounter",'start'=>0,'skip'=>1,'print'=>false,'assign'=>"rowCounter"),$_smarty_tpl);?>

	<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wsLines']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['line']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
$_smarty_tpl->tpl_vars['line']->_loop = true;
 $_smarty_tpl->tpl_vars['line']->iteration++;
?>

<?php if ($_smarty_tpl->tpl_vars['isInlineForm']->value){?>
            <tr >
		<td style="width: 30px;"></td>
                <td><span class="col-lg-1"><?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
</span><input type="hidden" class="worksheet-field" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" name="worksheetLine[]"></td>
                <td><select class="form-control input-sm worksheet-field" id="field-daypart-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" name="daypart[]" data-index="daypart" data-name="daypart" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"><option value=""></option><?php  $_smarty_tpl->tpl_vars['daypart'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daypart']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dayparts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['daypart']->key => $_smarty_tpl->tpl_vars['daypart']->value){
$_smarty_tpl->tpl_vars['daypart']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['line']->value['daypart']==$_smarty_tpl->tpl_vars['daypart']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
</option><?php } ?></select></td>
                <td><select class="form-control input-sm worksheet-field" id="field-vendorID-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
"  name="vendorID[]" data-index="vendorID" data-name="vendorID" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"><option value=""></option><?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['line']->value['vendorID']==$_smarty_tpl->tpl_vars['vendor']->value['id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
</option><?php } ?></select></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['station'];?>
</label><input type=text class="form-control input-sm worksheet-field" id="field-station-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['station'];?>
" name="station[]" data-index="station" data-name="station" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['fromTime'];?>
<?php echo $_smarty_tpl->tpl_vars['line']->value['endTime'];?>
</label><div class="form-group"><input type=text class="form-control input-sm" worksheet-field" placeholder="####A/P-####A/P"  id="field-timeOfDay-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['timePeriod'];?>
" name="timeOfDay[]" data-index="timeOfDay" data-name="timeOfDay" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></div></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['programName'];?>
</label><input type=text class="form-control input-sm" id="field-program-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['programName'];?>
" name="program[]" data-index="program" data-name="program" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></td>
                <td><input type=checkbox name="isMonday[]" class="" id="field-mon-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="mon" data-name="mon" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  <?php if ($_smarty_tpl->tpl_vars['line']->value['isMonday']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-tue-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="tue" data-name="tue" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isTuesday[]" class=""  <?php if ($_smarty_tpl->tpl_vars['line']->value['isTuesday']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox data-index="wed" id="field-wed-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-name="wed" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isWednesday[]" class="" <?php if ($_smarty_tpl->tpl_vars['line']->value['isWednesday']){?> value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-thu-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="thu" data-name="thu" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isThursday[]" class=""  <?php if ($_smarty_tpl->tpl_vars['line']->value['isThursday']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-fri-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="fri" data-name="fri" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isFriday[]" class=""  <?php if ($_smarty_tpl->tpl_vars['line']->value['isFriday']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-sat-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="sat" data-name="sat" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isSaturday[]" class="" <?php if ($_smarty_tpl->tpl_vars['line']->value['isSaturday']){?>value="1"  checked<?php }?> onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-sun-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="sun" data-name="sun" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isSunday[]" class="" <?php if ($_smarty_tpl->tpl_vars['line']->value['isSunday']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td><div class="form-group"><input type=text class="form-control input-sm" id="field-length-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['seconds'];?>
" size="3" name="length[]"  data-index="length" data-name="length" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></div></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['rate'];?>
</label><div class="form-group"><input type=text class="form-control input-sm" id="field-rate-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="rate" data-name="rate" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['rate'];?>
" size="5" name="rate[]" onchange="updateField(this);"></div></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['aqhRating'];?>
</label><div class="form-group"><input type=text class="form-control input-sm" id="field-aqh-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['aqhRating'];?>
" size="4" name="aqh[]" data-index="aqhRating" data-name="aqh" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['cpp'];?>
</label><input type=text class="form-control input-sm" id="field-cpp-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['cpp'];?>
" size="4" name="cpp[]" tabindex="-1"  data-name="cpp" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="cpp" readonly></div></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['impact'];?>
</label><div class="form-group"><input type=text class="form-control input-sm id="field-impact-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
"" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['impact'];?>
" size="4" name="impact[]" data-index="impact" data-name="impact" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" onchange="updateField(this);"></div></td>
                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['line']->value['cpm'];?>
</label><input type=text class="form-control input-sm" id="field-cpm-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['line']->value['cpm'];?>
" id="field-cpm-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" size="4"  data-index="cpm" data-name="cpm" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" name="cpm[]" tabindex="-1" readonly></td>
<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'assign'=>"weekCounter"),$_smarty_tpl);?>

<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

                <td><label class="sr-only"><?php echo $_smarty_tpl->tpl_vars['weekValue']->value;?>
</label><input type=text class="form-control input-sm" id="field-week-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" value="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['wsWeeks']->value[$_smarty_tpl->tpl_vars['line']->value['worksheetLine']][$_tmp2];?>
" name="week[<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
][<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]" size="3" data-index="field-week-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" data-name="week" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
" data-week="<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" onchange="updateField(this);"></td>
<?php } ?>
                <td class="hidden-sm hidden-xs"><input type=text class="form-control input  input-sm" id="field-comments-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" size=40 value="<?php echo $_smarty_tpl->tpl_vars['line']->value['comments'];?>
" name="comments[]" data-index="comments" data-name="comments" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  onchange="updateField(this);"></td>
                <td style="text-align: center;"><input type=checkbox class="centered" id="field-copy-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="copy" data-name="copy" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isCopy[]" <?php if ($_smarty_tpl->tpl_vars['line']->value['isCopy']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td style="text-align: center;"><input type=checkbox class="centered" id="field-bold-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="bold" data-name="bold" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isBold[]" <?php if ($_smarty_tpl->tpl_vars['line']->value['isBold']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
		<td style="text-align: center;"><input type=checkbox class="centered" id="field-trade-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="trade" data-name="trade" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isTrade[]" <?php if ($_smarty_tpl->tpl_vars['line']->value['isTrade']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td style="text-align: center;"><input type=checkbox class="centered" id="field-skip-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="skip" data-name="skip" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isSkipped[]" <?php if ($_smarty_tpl->tpl_vars['line']->value['isSkipped']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
                <td style="text-align: center;"><input type=checkbox class="centered" id="field-delete-<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-index="delete" data-name="delete" data-line="<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
" data-row="<?php echo $_smarty_tpl->tpl_vars['line']->iteration;?>
" data-counter="<?php echo $_smarty_tpl->tpl_vars['rowCounter']->value;?>
"  name="isDeleted[]" <?php if ($_smarty_tpl->tpl_vars['line']->value['isDeleted']){?>value="1" checked<?php }?> onchange="updateField(this);"></td>
            </tr>

<?php }elseif($_smarty_tpl->tpl_vars['isInlineText']->value){?>

            <tr >
		<td></td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['daypart'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['vendorID'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['station'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['timePeriod'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['programName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isMonday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isTuesday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isWednesday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isThursday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isFriday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isSaturday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['isSunday'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['seconds'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['rate'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['aqhRating'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['cpp'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['impact'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['cpm'];?>
</td>
                                
<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'assign'=>"weekCounter"),$_smarty_tpl);?>

<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

                <td><?php echo $_smarty_tpl->tpl_vars['weekValue']->value;?>
</td>
<?php } ?>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['comments'];?>
</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

<?php }?>
	    <?php echo smarty_function_counter(array('name'=>"rowCounter"),$_smarty_tpl);?>

  	<?php } ?>
	</tbody>
	<tfoot>
            <tr id="worksheet-line-new" >
		<td><button class="btn btn-xs btn-primary" onclick="addNewLine(); return false;">Add Line</button></td>
                <td><input type="hidden" class="worksheet-field" value="new" name="worksheetLine[]"></td>
                <td><select class="form-control input-sm worksheet-field" id="field-daypart-new" name="daypart[]" data-index="daypart" data-name="daypart" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"><option value=""></option><?php  $_smarty_tpl->tpl_vars['daypart'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daypart']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dayparts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['daypart']->key => $_smarty_tpl->tpl_vars['daypart']->value){
$_smarty_tpl->tpl_vars['daypart']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
</option><?php } ?></select></td>
                <td><select class="form-control input-sm worksheet-field" id="field-vendorID-new"  name="vendorID[]" data-index="vendorID" data-name="vendorID" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"><option value="" selected></option><?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
</option><?php } ?></select></td>
                <td><input type=text class="form-control input-sm worksheet-field" id="field-station-new"  name="station[]" data-index="station" data-name="station" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></td>
                <td><div class="form-group"><input type=text class="form-control input-sm worksheet-field" id="field-timeOfDay-new" value="" placeholder="####A/P-####A/P" name="timeOfDay[]" data-index="timeOfDay" data-name="timeOfDay" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></div></td>
                <td><input type=text class="form-control input-sm" id="field-program-new" value="" name="program[]" data-index="program" data-name="program" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></td>
                <td><input type=checkbox name="isMonday[]" class="" id="field-mon-new" data-index="mon" data-name="mon" data-line="new" data-row="new" data-counter="new"  onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-tue-new" data-index="tue" data-name="tue" data-line="new" data-row="new" data-counter="new"  name="isTuesday[]" class=""  onchange="updateField(this);"></td>
                <td><input type=checkbox data-index="wed" id="field-wed-new" data-name="wed" data-line="new" data-row="new" data-counter="new"  name="isWednesday[]" class="" onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-thu-new" data-index="thu" data-name="thu" data-line="new" data-row="new" data-counter="new"  name="isThursday[]" class=""  onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-fri-new" data-index="fri" data-name="fri" data-line="new" data-row="new" data-counter="new"  name="isFriday[]" class=""  onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-sat-new}" data-index="sat" data-name="sat" data-line="new" data-row="new" data-counter="new"  name="isSaturday[]" class="" onchange="updateField(this);"></td>
                <td><input type=checkbox id="field-sun-new" data-index="sun" data-name="sun" data-line="new" data-row="new" data-counter="new"  name="isSunday[]" class="" onchange="updateField(this);"></td>
                <td><div class="form-group"><input type=text class="form-control input-sm" id="field-length-new" value="" size="3" name="length[]"  data-index="length" data-name="length" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></div></td>
                <td><div class="form-group"><input type=text class="form-control input-sm" id="field-rate-new" data-index="rate" data-name="rate" data-line="new" data-row="new" data-counter="new" value="" size="5" name="rate[]" onchange="updateField(this);"></div></td>
                <td><div class="form-group"><input type=text class="form-control input-sm" id="field-aqh-new" value="" size="4" name="aqh[]" data-index="aqhRating" data-name="aqh" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></td>
                <td><input type=text class="form-control input-sm" id="field-cpp-new" value="" size="4" name="cpp[]" tabindex="-1"  data-name="cpp" data-line="new" data-index="cpp" readonly></div></td>
                <td><div class="form-group"><input type=text class="form-control input-sm id="field-impact-new"" value="" size="4" name="impact[]" data-index="impact" data-name="impact" data-line="new" data-row="new" data-counter="new" onchange="updateField(this);"></div></td>
                <td><input type=text class="form-control input-sm" id="field-cpm-new" value="" id="field-cpm-new" size="4"  data-index="cpm" data-name="cpm" data-line="new" data-row="new" data-counter="new" name="cpm[]" tabindex="-1" readonly></td>
<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'assign'=>"weekCounter"),$_smarty_tpl);?>

<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

                <td><input type=text class="form-control input-sm" id="field-week-new-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
"  name="week-new[<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]" size="3" data-index="field-week-new-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" data-name="week" data-line="new" data-row="new" data-counter="new" data-week="<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" onchange="updateField(this);"></td>
<?php } ?>
                <td class="hidden-sm hidden-xs"><input type=text class="form-control input  input-sm" id="field-comments-new" size=40  name="comments[]" data-index="comments" data-name="comments" data-line="new" data-row="new" data-counter="new"  onchange="updateField(this);"></td>

                <td colspan="5"><button class="btn btn-xs btn-primary" onclick="addNewLine(); return false;">Add Line</button>  <button class="btn btn-xs btn-danger" onclick="clearNewLine(this);">Clear Line</button></td>
            </tr>

            <tr style="text-align: center;">
                <th>Line</th>
                <th>Line #</th>
                <th>DP</th>
                <th>Vendor</th>
                <th>Station</th>
                <th>Time Period</th>
                <th>Program Name</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>R</th>
                <th>F</th>
                <th>Sa</th>
                <th>Su</th>
                <th>Len</th>
                <th>Rate</th>
                <th style="text-align: center;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['demographic']->value)===null||$tmp==='' ? "Rating" : $tmp);?>
</th>
                <th>CPP</th>
                <th>000</th>
                <th>CPM</th>
<?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
?>
		<th><?php echo $_smarty_tpl->tpl_vars['weekName']->value;?>
</th>
<?php } ?>
                <th class="hidden-sm hidden-xs">Comments</th>
                <th style="text-align: center;">Copy</th>
                <th style="text-align: center;">Bold</th>
                <th style="text-align: center;">Trade</th>
                <th style="text-align: center;">Skip</th>
                <th style="text-align: center;">Delete</th>
            </tr>
        </tfoot>
    </table>

</div>		
							</div>
							<div class="col-md-12 col-lg-12" >
									<div class="pull-right" style="padding-top: 10px;">
 								        <button class="btn btn-default saveWorksheetLines" id="saveWorksheetLinesBottom" onclick="saveWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" disabled>Save Worksheet</button>
									<button class="btn btn-warning" id="copyWorksheet" onclick="copyBox('<?php echo $_smarty_tpl->tpl_vars['worksheetID']->value;?>
');">Copy Worksheet</button>
									<button class="btn btn-danger" id="deleteWorksheet" onclick="deleteWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheetID']->value;?>
');">Delete Worksheet</button>
									<br><br>
							</div>	
							<!-- /main-content -->
						</div>


<div class="modal fade" id="reportWait">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Please Wait</h4>
      </div>
      <div class="modal-body">
		<div class="progress progress-striped active">
		  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		  </div>
		</div>
		<span class="reportStatus">Creating Report...</span>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




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

	
		<script type="text/javascript" src="/assets/js/king-common.js"></script>
		<script type="text/javascript" src="/assets/js/bootstrap-tour.custom.js"></script>

		<script type="text/javascript" src="/assets/js/modernizr.js"></script>


	

	
		<script type="text/javascript" src="/lib/datatables/1.10.2/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/lib/datatables/1.10.2/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>

		<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/505bef35b56/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/f2c75b7247b/sorting/numeric-comma.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/f2c75b7247b/sorting/time.js"></script>
	

	
		<script type="text/javascript" src="/assets/js/fullcalendar.js"></script>
		<script type="text/javascript" src="/assets/js/fullcalendar.min.js"></script>
	

        <script type="text/javascript" src="/lib/gravatar/jquery/md5.js"></script>
        <script type="text/javascript" src="/lib/gravatar/jquery/jquery.gravatar.js"></script>

	

	<script type="text/javascript" src="/assets/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap-multiselect.js"></script>
    	<script type="text/javascript" src="/lib/select2/select2.js"></script>
	<script src="/lib/handsontable/jquery.handsontable.full.js"></script>
	<script type="text/javascript" src="/lib/bootbox/bootbox-4.2.0/bootbox.min.js"></script>
	<script src="/js/bluhorn-alt.js"></script>


	<script>

	var lastCursor = 0;
        var data;
	var pageNumber = 0;
	var remember = false;

(function($, undefined) {  
    $.fn.getCursorPosition = function() {  
        var el = $(this).get(0);  
        var pos = 0;  
        if ('selectionStart' in el) {  
            pos = el.selectionStart;  
        } else if ('selection' in document) {  
            el.focus();  
            var Sel = document.selection.createRange();  
            var SelLength = document.selection.createRange().text.length;  
            Sel.moveStart('character', -el.value.length);  
            pos = Sel.text.length - SelLength;  
        }  
        return pos;  
    }  
})(jQuery); 


$(document).ready(function() {



  $(window).keydown(function(event){
    //console.log(event.keyCode);
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

function bindKeyEvents() {

$('input').keyup(function(e){
  var cursor = 0;
  var maxCursor = 0;
  if ($(":focus").attr("type")=="text") {
	  cursor = $(":focus").getCursorPosition();
	  maxCursor = $(":focus").val().length;
  }
  if(e.which==39) {
    if (cursor >= maxCursor ) {
	if (lastCursor == cursor) {
		lastCursor = -1;
	   	$(this).closest('td').next().find('input').focus();
		if ($(":focus").attr("tabindex") < 0) {
		   	$(":focus").closest('td').next().find('input').focus();
		}
	}
	else {
		lastCursor = cursor;
	}
   }
   lastCursor = cursor;
  }
  else if(e.which==37) {
    if (cursor < 1) {
	if (lastCursor == cursor) {
	    lastCursor = -1;
	    $(this).closest('td').prev().find('input').focus();
	    if ($(":focus").attr("tabindex") < 0) {
	   	$(":focus").closest('td').prev().find('input').focus();
	    }
	}
	else {
	    lastCursor = cursor;
	}
    }
    lastCursor = cursor;
  }
  else if(e.which==40) {
console.log("key down");
console.log($(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')'));
   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
  }
  else if(e.which==38) {
   $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
  }
  else if(e.which==13) {
   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();  
   if ($(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').length==0) {
	  updateField($(this));
   }
  }
});


}

$(document).ready(function(){
	bindKeyEvents();
});


		$(document).ready(function() {

		   $('#autoCalc').bootstrapSwitch();
	
		});

	</script>

	<script>



		$(document).ready(function() {

			 var table =  $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable( {
					  "stateSave": true,
					  "scrollX": true,
<?php if ($_smarty_tpl->tpl_vars['worksheet']->value['freezeCols']>0){?>
					"scrollY": "100%",
				        "scrollCollapse": true,
<?php }?>
//      					  "order": [<?php  $_smarty_tpl->tpl_vars['sorting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sorting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worksheet']->value['sorting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['sorting']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['sorting']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['sorting']->key => $_smarty_tpl->tpl_vars['sorting']->value){
$_smarty_tpl->tpl_vars['sorting']->_loop = true;
 $_smarty_tpl->tpl_vars['sorting']->iteration++;
 $_smarty_tpl->tpl_vars['sorting']->last = $_smarty_tpl->tpl_vars['sorting']->iteration === $_smarty_tpl->tpl_vars['sorting']->total;
?> [<?php echo $_smarty_tpl->tpl_vars['sorting']->value['column'];?>
,"<?php echo $_smarty_tpl->tpl_vars['sorting']->value['direction'];?>
"]<?php if (!$_smarty_tpl->tpl_vars['sorting']->last){?>,<?php }?><?php }
if (!$_smarty_tpl->tpl_vars['sorting']->_loop) {
?> [ 1, "asc" ] <?php } ?>],
     					  "order": [ [ 1, "asc" ] ],
<?php if ($_smarty_tpl->tpl_vars['isInlineForm']->value){?>
"columns": [
     { width: "120px", sortable: false },
     { width: "120px", sortable: false, visible: false },
     { width: "120px","orderDataType": "dom-select"},
     { width: "120px","orderDataType": "dom-select","searchable":false},
     { width: "120px","orderDataType": "dom-text", "type": "text"},
     { width: "300px","orderDataType": "dom-text", "type": "numeric" },
     { width: "100px","orderDataType": "dom-text", "type": "text"},
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric"},
     { width: "20px", sortable: false },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
     { width: "20px", sortable: false },
<?php } ?>
     { width: "200px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false }
],

<?php }elseif($_smarty_tpl->tpl_vars['isInlineText']->value){?>

"columns": [
     { width: "120px", sortable: false },
     { width: "120px", sortable: false, visible: false },
     { width: "120px"},
     { width: "120px", "searchable":false},
     { width: "120px"},
     { width: "300px"},
     { width: "100px"},
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "50px", sortable: false },
     { width: "20px" },
     { width: "20px" },
     { width: "20px", sortable: false },
     { width: "20px" },
     { width: "20px" },
     { width: "20px" },
<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
     { width: "20px", sortable: false },
<?php } ?>
     { width: "200px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false }
],

<?php }elseif($_smarty_tpl->tpl_vars['isAjaxSource']->value){?>

        "ajax": "/tv/ajax/worksheet/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
",
"columns": [
     { "data" : null, width: "120px", sortable: false },
     { "data": "worksheetLine", width: "120px", sortable: false, visible: false },
     { "data": "daypart", width: "120px","orderDataType": "dom-select" },
     { "data": "vendor", width: "120px","orderDataType": "dom-select", "searchable":false},
     { "data": "station", width: "120px","orderDataType": "dom-text", "type": "numeric"},
     { "data": "timeOfDay", width: "120px", "type":"numeric"},
     { "data": "program", width: "160px", "orderDataType": "dom-text", "type": "numeric" },
     { "data": "isMonday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isTuesday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isWednesday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isThursday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isFriday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isSaturday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "isSunday", width: "50px", sortable: false, "orderDataType": "dom-select" },
     { "data": "length", width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { "data": "rate", width: "20px","orderDataType": "dom-text", "type": "numeric"},
     { "data": "aqhRating", width: "20px", sortable: false },
     { "data": "cpp", width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { "data": "impact", width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { "data": "cpm", width: "20px","orderDataType": "dom-text", "type": "numeric" },
<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
     { "data": "week.<?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
", width: "20px", sortable: false },
<?php } ?>
     { "data": "comments", width: "200px", sortable: false },
     { "data": "copy",  width: "20px", sortable: false },
     { "data": "bold", width: "20px", sortable: false },
     { "data": "trade", width: "20px", sortable: false },
     { "data": "skip", width: "20px", sortable: false },
     { "data": "delete", width: "20px", sortable: false }
],

<?php }else{ ?>
"columns": [
     { width: "120px", sortable: false },
     { width: "120px", sortable: false, visible: false },
     { width: "120px","orderDataType": "dom-select"},
     { width: "120px","orderDataType": "dom-select","searchable":false},
     { width: "120px","orderDataType": "dom-text", "type": "text" },
     { width: "300px", "orderDataType": "dom-text", "type": "time" },
     { width: "100px","orderDataType": "dom-text", "type": "text"},
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "50px", sortable: false, "orderDataType": "dom-select" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric"},
     { width: "20px", sortable: false },
     { width: "20px","orderDataType": "dom-text", "type": "numeric-comma" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
     { width: "20px","orderDataType": "dom-text", "type": "numeric" },
<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
     { width: "20px", sortable: false },
<?php } ?>
     { width: "200px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false },
     { width: "20px", sortable: false }
],

<?php }?>
					  "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
//					  "autoWidth": false,			
					  "displayLength": 10,
					  //"deferRender": true,
					  "processing": true,
					  "paginate": true,
					  "drawCallback": function( settings ) {
						 console.log("redraw");
					         bindKeyEvents();
					   },
//					  "initComplete": function() { mapDataAttributes(); $("#worksheet-loading").hide(); $("#worksheet-form").show(); reSort(); bindKeyEvents();  },
//					  "initComplete": function() { loadWorksheetData(); $("#worksheet-loading").hide(); $("#worksheet-form").show(); reSort(); bindKeyEvents(); updateSelectValues();  },
					  "initComplete": function() { $("#worksheet-loading").hide(); $("#worksheet-form").show(); },
					  "dom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
					  "language": {
						"lengthMenu": "_MENU_ lines per page"
					  },

		"fnDrawCallback": function ( oSettings ) {
	        		 bindKeyEvents();
			/* Need to redo the counters if filtered or sorted */
			if ( oSettings.bSorted || oSettings.bFiltered )
			{
				for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
				{
					$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
				}
			}

		}


			  } );

    $('.toggle-col').change( function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );


 
//			   new $.fn.dataTable.FixedColumns( table );


<?php if ($_smarty_tpl->tpl_vars['isInline']->value){?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['worksheet']->value['freezeCols']>0){?>

new $.fn.dataTable.FixedColumns( table, {
        leftColumns: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['worksheet']->value['freezeCols'])===null||$tmp==='' ? '7' : $tmp);?>

});

<?php }?>



/* Create an array with the values of all the input boxes in a column */
$.fn.dataTable.ext.order['dom-text'] = function  ( settings, col )
{
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
        return $('input', td).val();
    } );
}
 
/* Create an array with the values of all the input boxes in a column, parsed as numbers */
$.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
{
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
        return $('input', td).val() * 1;
    } );
}
 
/* Create an array with the values of all the select options in a column */
$.fn.dataTable.ext.order['dom-select'] = function  ( settings, col )
{
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
        return $('select', td).val();
    } );
}
 
/* Create an array with the values of all the checkboxes in a column */
$.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
{
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
        return $('input', td).prop('checked') ? '1' : '0';
    } );
}




/*

   table.on( 'order.dt search.dt', function () {
        table.column(0, { search:'applied', order:'applied' }).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(false);
*/


		//reSort();

			$('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').on( 'order.dt',  function () { 
				  console.log("sort"); fGetSortInfo(); } );
			});


		function fGetSortInfo() {
	  	  // Returns a value of [5, "desc", 0] every time.
		  console.log("sort");
	  	  var sortInfo = $("#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
").dataTable().fnSettings().aaSorting;
		  console.log(sortInfo);
	  	  updateSort(sortInfo);
		}

		
	</script>


	<script>

	  var counter=1;

	  var savesCounter = 0;

	  var vendors = {};

	  var summaryGRPs = 0;
	  var summarySpots = 0;

// ####A/P-####A/P

	  var nielsen_time_validator_regex = /(([0-9])|([0-9][0-9])|([0-9][0-9][0-9][0-9]))[(a|A)|(p|P)|(z|Z)]-(([0-9])|([0-9][0-9])|([0-9][0-9][0-9][0-9]))[(a|A)|(p|P)|(z|Z)]/;

	  var nielsen_time_validator_fn = function (value, callback) {
			if (nielsen_time_validator_regex.test(value)) {
				callback(true);
			}
			else {
				callback(false);
			}
	  };

	var copyButtonRenderer = function (instance, td, row, col, prop, value, cellProperties) {
	  var escaped = Handsontable.helper.stringify(value);
	  var jsStr = 'onkeyup="wsCheckBox('+"'"+cellProperties.prop+"'"+','+cellProperties.row+', this.checked'+');" onmouseup="wsCheckBoxMouseUp('+"'"+cellProperties.prop+"'"+','+cellProperties.row+', this.checked'+');" ';
	  if (value) {
		var checkedStr = 'checked';
	  }
	  escaped = '<input type=checkbox ' + jsStr + ' ' + checkedStr +'>'; 
	  td.innerHTML = escaped;
	  return td;
	};

	  var weeks = { <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?><?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
: "<?php echo $_smarty_tpl->tpl_vars['weekName']->value;?>
"<?php if (!$_smarty_tpl->tpl_vars['weekName']->last){?>, <?php }?><?php } ?>  };

<?php echo smarty_function_counter(array('name'=>"monthCounter",'start'=>0,'skip'=>1,'print'=>false),$_smarty_tpl);?>


	  var months = [
			<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?> { month: <?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
, name: "<?php echo $_smarty_tpl->tpl_vars['month']->value['name'];?>
", weeks: { <?php  $_smarty_tpl->tpl_vars['monthWeek'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['monthWeek']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['month']->value['weeks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['monthWeek']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['monthWeek']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['monthWeek']->key => $_smarty_tpl->tpl_vars['monthWeek']->value){
$_smarty_tpl->tpl_vars['monthWeek']->_loop = true;
 $_smarty_tpl->tpl_vars['monthWeek']->iteration++;
 $_smarty_tpl->tpl_vars['monthWeek']->last = $_smarty_tpl->tpl_vars['monthWeek']->iteration === $_smarty_tpl->tpl_vars['monthWeek']->total;
?><?php echo smarty_function_counter(array('name'=>"monthCounter"),$_smarty_tpl);?>
:"<?php echo $_smarty_tpl->tpl_vars['monthWeek']->value;?>
" <?php if (!$_smarty_tpl->tpl_vars['monthWeek']->last){?>, <?php }?><?php } ?> }} <?php if (!$_smarty_tpl->tpl_vars['month']->last){?>, <?php }?> <?php } ?>
			 ];


          var stations = [];

	  var maxLineNumber = <?php echo $_smarty_tpl->tpl_vars['maxLineNumber']->value;?>
;

	  var vendorNames = [ 
		<?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vendor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['vendor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
 $_smarty_tpl->tpl_vars['vendor']->iteration++;
 $_smarty_tpl->tpl_vars['vendor']->last = $_smarty_tpl->tpl_vars['vendor']->iteration === $_smarty_tpl->tpl_vars['vendor']->total;
?> "<?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
" <?php if (!$_smarty_tpl->tpl_vars['vendor']->last){?>,<?php }?><?php } ?>
	 ];


          <?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vendor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['vendor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
 $_smarty_tpl->tpl_vars['vendor']->iteration++;
 $_smarty_tpl->tpl_vars['vendor']->last = $_smarty_tpl->tpl_vars['vendor']->iteration === $_smarty_tpl->tpl_vars['vendor']->total;
?> 
	   	vendors[ "<?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
" ]="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
";
 	   <?php } ?>


	function calculateLines() {
			var row=0;
			$.each(data, function( index, src ) {
					data[index]["cpp"] =  (data[index]["rate"] / data[index]["aqh"]).toFixed(3); 
					data[index]["cpm"] =   ((data[index]["rate"]) / (data[index]["impact"] / 1000)).toFixed(3); 
					row++;
			});
	}

	<?php if (count($_smarty_tpl->tpl_vars['wsLines']->value)>0){?>
	data = {};	
		<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wsLines']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
$_smarty_tpl->tpl_vars['line']->_loop = true;
?>
	  		<?php if ($_smarty_tpl->tpl_vars['line']->value['worksheetLine']>0){?> 
	 		 data['<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
'] = 
				{ lineNumber: "<?php echo $_smarty_tpl->tpl_vars['line']->value['worksheetLine'];?>
", daypart: "<?php echo $_smarty_tpl->tpl_vars['line']->value['daypart'];?>
", vendor: "<?php echo $_smarty_tpl->tpl_vars['line']->value['vendorName'];?>
", vendorID: "<?php echo $_smarty_tpl->tpl_vars['line']->value['vendorID'];?>
", timeOfDay: "<?php echo $_smarty_tpl->tpl_vars['line']->value['timePeriod'];?>
", timeOfDayStd: "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['line']->value['timePeriodStd'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['line']->value['timePeriod'] : $tmp);?>
", station: "<?php echo strtr($_smarty_tpl->tpl_vars['line']->value['station'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",  program: "<?php echo strtr($_smarty_tpl->tpl_vars['line']->value['programName'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
", mon: <?php if ($_smarty_tpl->tpl_vars['line']->value['isMonday']){?>true<?php }else{ ?>false<?php }?>, tue: <?php if ($_smarty_tpl->tpl_vars['line']->value['isTuesday']){?>true<?php }else{ ?>false<?php }?>, wed: <?php if ($_smarty_tpl->tpl_vars['line']->value['isWednesday']){?>true<?php }else{ ?>false<?php }?>, thu: <?php if ($_smarty_tpl->tpl_vars['line']->value['isThursday']){?>true<?php }else{ ?>false<?php }?>, fri: <?php if ($_smarty_tpl->tpl_vars['line']->value['isFriday']){?>true<?php }else{ ?>false<?php }?>, sat: <?php if ($_smarty_tpl->tpl_vars['line']->value['isSaturday']){?>true<?php }else{ ?>false<?php }?>, sun: <?php if ($_smarty_tpl->tpl_vars['line']->value['isSunday']){?>true<?php }else{ ?>false<?php }?>, length: "<?php echo $_smarty_tpl->tpl_vars['line']->value['seconds'];?>
", rate: "<?php echo $_smarty_tpl->tpl_vars['line']->value['rate'];?>
", week: { <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?><?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
:<?php echo (($tmp = @$_smarty_tpl->tpl_vars['wsWeeks']->value[$_smarty_tpl->tpl_vars['line']->value['worksheetLine']][$_smarty_tpl->tpl_vars['week']->iteration])===null||$tmp==='' ? "0" : $tmp);?>
<?php if (!$_smarty_tpl->tpl_vars['week']->last){?> , <?php }?><?php } ?> }, aqh: "<?php echo $_smarty_tpl->tpl_vars['line']->value['aqhRating'];?>
", cpp: null, cpm: null, impact: "<?php echo $_smarty_tpl->tpl_vars['line']->value['impact'];?>
", lineSpendTotal: 0.00, lineAQHTotal: 0.0, lineCPPTotal: 0.00, lineCPMTotal: 0.00, comments: "<?php echo strtr($_smarty_tpl->tpl_vars['line']->value['comments'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
", copy: <?php if ($_smarty_tpl->tpl_vars['line']->value['isCopy']){?>true<?php }else{ ?>false<?php }?>, bold: <?php if ($_smarty_tpl->tpl_vars['line']->value['isBold']){?>true<?php }else{ ?>false<?php }?>, skip: <?php if ($_smarty_tpl->tpl_vars['line']->value['isSkipped']){?>true<?php }else{ ?>false<?php }?>, trade: <?php if ($_smarty_tpl->tpl_vars['line']->value['isTrade']){?>true<?php }else{ ?>false<?php }?>,delete: <?php if ($_smarty_tpl->tpl_vars['line']->value['isDeleted']){?>true<?php }else{ ?>false<?php }?> };
			<?php }?>
		<?php } ?>
	
	<?php }else{ ?>
		data['1'] = { lineNumber: 0, daypart: null, vendorID: "", vendor: null, timeOfDay: null,  timeOfDayStd: null, station: null,  program: null, mon: false, tue: false, wed: false, thu: false, fri: false, sat: false, sun: false, length: 0, rate: null, week: { <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?><?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
:null<?php if (!$_smarty_tpl->tpl_vars['week']->last){?>,<?php }?><?php } ?> }, aqh: null, cpp: null, cpm: null, impact: null, lineSpendTotal: 0.00, lineAQHTotal: 0.0, lineCPPTotal: 0.00, lineCPMTotal: 0.00, comments: null, copy: false, bold: false, skip: false, trade: false, delete: false };

	<?php }?>

//	console.log(data);

	var maxRow = <?php echo $_smarty_tpl->tpl_vars['maxLineNumber']->value;?>
;

		data['<?php echo $_smarty_tpl->tpl_vars['maxLineNumber']->value;?>
'] = { lineNumber: 0, daypart: "", vendorID: "", vendor: "", timeOfDay: "",  timeOfDayStd: "", station: "",  program: "", mon: false, tue: false, wed: false, thu: false, fri: false, sat: false, sun: false, length: 0, rate: 0, week: { <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?><?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['week']->last){?>,<?php }?><?php } ?> }, aqh: 0, cpp: 0, cpm: 0, impact: 0, lineSpendTotal: 0.00, lineAQHTotal: 0.0, lineCPPTotal: 0.00, lineCPMTotal: 0.00, comments: "", copy: false, bold: false, skip: false, trade: false, delete: false };

	console.log("Max Row: " + maxRow);

	  <?php if (count($_smarty_tpl->tpl_vars['wsLines']->value)>0){?>
		calculateLines();
	  <?php }?>

	  var summary = [ 
						{ weekly: "Total Spots", <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?> monthly: "Total Spots", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?>  },
						{ weekly: "Total $$",  <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "Total $$", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> },
						{ weekly: "Total GRPs",  <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "Total GRPs", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> },
						{ weekly: "CPP", <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "CPP", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> },
						{ weekly: "CPM", <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "CPM", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> },
						{ weekly: "Reach", <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "Reach (beta)", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> },
						{ weekly: "Frequency", <?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>week<?php echo $_smarty_tpl->tpl_vars['weekName']->iteration;?>
:0,<?php } ?>  monthly: "Frequency (beta)", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>,<?php }?><?php } ?> }
	   ];

	function mapDataAttributes() {

		$.each(data, function( index, src ) {
			var timeOfDayStd = src.timeOfDay;

			$("#field-program-"+src.lineNumber).closest("td").attr("data-order",src.program);
			$("#field-timeOfDay-"+src.lineNumber).closest("td").attr("data-order", timeOfDayStd);
		});
	}


	function loadWorksheetData() {

		$.each(data, function( index, src ) {
			if (src.lineNumber>0) {

				<?php if ($_smarty_tpl->tpl_vars['filter']->value==1){?>
					if (data[src.lineNumber]["lineSpendTotal"] > 0) {
						addRow(src.lineNumber);	

						console.log("Added " + src.lineNumber + " = " + data[src.lineNumber]["lineSpendTotal"]);

						$("#worksheet-footer").html("Line " + src.lineNumber + " added!");
					}
					else {
						console.log("Skipped " + src.lineNumber);
					}

				<?php }elseif($_smarty_tpl->tpl_vars['filter']->value=="station"){?>
					if (data[src.lineNumber]["station"] == "<?php echo $_smarty_tpl->tpl_vars['extra']->value;?>
") {
						addRow(src.lineNumber);	

						console.log("Added " + src.lineNumber + " = " + data[src.lineNumber]["station"]);

						$("#worksheet-footer").html("Line (station) " + src.lineNumber + " added!");
					}
					else {
						console.log("Skipped " + src.lineNumber);
					}

				<?php }else{ ?>

						addRow(src.lineNumber);
						
						$("#worksheet-footer").html("Line " + src.lineNumber + " added!");
		
				<?php }?>
			}
		});


		var dt = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
		dt.draw();

//		console.log("Datatable loaded");
/*
		$.each(data, function( index, src ) {
			if (src.lineNumber>0) {
				$('#field-vendorID-'+src.lineNumber).val(data[src.lineNumber]["vendorID"]);
				$('#field-daypart-'+src.lineNumber).val(data[src.lineNumber]["daypart"]);

				}
		});

*/
	}


	function updateSelectValues() {

		$.each(data, function( index, src ) {
			if (src.lineNumber>0) {
				$('#field-vendorID-'+src.lineNumber).val(data[src.lineNumber]["vendorID"]);
				$('#field-daypart-'+src.lineNumber).val(data[src.lineNumber]["daypart"]);
			}
		});
	}

	$( document ).ready(function() {

	  $("#summaryTable").handsontable({
	    data: summary,
	    colHeaders: ["<strong>Weekly</strong>", 
				<?php  $_smarty_tpl->tpl_vars['weekName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['weekName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['weekName']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['weekName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['weekName']->key => $_smarty_tpl->tpl_vars['weekName']->value){
$_smarty_tpl->tpl_vars['weekName']->_loop = true;
 $_smarty_tpl->tpl_vars['weekName']->iteration++;
 $_smarty_tpl->tpl_vars['weekName']->last = $_smarty_tpl->tpl_vars['weekName']->iteration === $_smarty_tpl->tpl_vars['weekName']->total;
?>"<?php echo $_smarty_tpl->tpl_vars['weekName']->value;?>
"<?php if (!$_smarty_tpl->tpl_vars['weekName']->last){?>, <?php }?><?php } ?>,
				"<strong>Monthly</strong>", <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>"<?php echo $_smarty_tpl->tpl_vars['month']->value['name'];?>
"<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>, <?php }?><?php } ?>],
	    rowHeaders: false,
	    minSpareRows: 0,
	    maxCols: 70,
	    manualColumnResize: false,
	    colWidths: [150,<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?> 70, <?php } ?> 150,<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?> 90<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>, <?php }?> <?php } ?>],
//	    stretchH: 'hybrid',
	    fillHandle: false,
	    columns: [
	  	  { data: "weekly",  readOnly: true}, // weekly
		<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
	  	  { data: "week<?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
", readOnly: true}, // week <?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>

		<?php } ?>
	  	  { data: "monthly", readOnly: true}, // monthly
		<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['month']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['month']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['month']->iteration++;
 $_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration === $_smarty_tpl->tpl_vars['month']->total;
?>
	  	  { data: "month<?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>
", readOnly: true}<?php if (!$_smarty_tpl->tpl_vars['month']->last){?>, <?php }?> // month <?php echo $_smarty_tpl->tpl_vars['month']->iteration;?>

		<?php } ?>
	    ]
	  });



	updateSummary();

});

			$(document).ready(function(){

		$(data).each(function() {
			$("#field-mon-"+this.lineNumber).prop("checked",this.mon);
			$("#field-tue-"+this.lineNumber).prop("checked",this.tue);
			$("#field-wed-"+this.lineNumber).prop("checked",this.wed);
			$("#field-thu-"+this.lineNumber).prop("checked",this.thu);
			$("#field-fri-"+this.lineNumber).prop("checked",this.fri);
			$("#field-sat-"+this.lineNumber).prop("checked",this.sat);
			$("#field-sun-"+this.lineNumber).prop("checked",this.sun);

		});
			$("#field-mon-new").prop("checked",false);
			$("#field-tue-new").prop("checked",false);
			$("#field-wed-new").prop("checked",false);
			$("#field-thu-new").prop("checked",false);
			$("#field-fri-new").prop("checked",false);
			$("#field-sat-new").prop("checked",false);
			$("#field-sun-new").prop("checked",false);



/*
				$('#multiselect4-filter').multiselect({
					enableFiltering: true,
					enableCaseInsensitiveFiltering: true,
					numberDisplayed: 5,
					buttonWidth: '100%',
      					includeSelectAllOption: true,
				        includeSelectAllIfMoreThan: 10
				});		
*/	
				$("#multiselect4-filter").select2({
				    placeholder: "Search Vendors",
				    allowClear: true
				});

			});

	function logData() {
//		console.log("Log:");
//		console.log(data);
	}


	function saveChanges(changes) {
	   if ($("#autoCalc").is(":checked")) {
		if(typeof changes !== 'undefined') {
		  if (changes[0][0] != null) {

			savesCounter++;

			$("#saveWorksheetLines").html("Saving... (1/" + savesCounter.toString() +")");
			$("#saveWorksheetLinesBottom").html("Saving...(1/" + savesCounter.toString() +")");
			$("#worksheet-footer").html("Not Saved!");

			$.post( "/tv/ajax/cell/update/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", { "changes": changes,  "data" : data, "vendors" : vendors }, function() {
				$("#worksheet-footer").html("Not Saved!");
			})
 			.done(function(results) {
				//console.log("Save Changes Response");
				//console.log(results);

				savesCounter--;

				$("#saveWorksheetLines").html("Saving... (1/" + savesCounter.toString() +")");
				$("#saveWorksheetLinesBottom").html("Saving...(1/" + savesCounter.toString() +")");

			        var response = $.parseJSON(results);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
					$("#saveWorksheetLinesBottom").attr("disabled", false);
				}
				else {
				}
				if (response.newLine) {
					data[response.rowNumber]["lineNumber"]=response.lineNumber;
				}
		
				if (savesCounter < 1) {
					savesCounter = 0;
					$("#saveWorksheetLines").html("Save Worksheet");
					$("#saveWorksheetLinesBottom").html("Save Worksheet");
				}

			})
			.fail(function(data) {

				$("#saveWorksheetLines").html("Save Worksheet");
				$("#saveWorksheetLinesBottom").html("Save Worksheet");

				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
				$("#worksheet-footer").html("Connection Failed! Not Saved.");

				savesCounter--;

			})
			.error(function(data) {

				$("#saveWorksheetLines").html("Save Worksheet");
				$("#saveWorksheetLinesBottom").html("Save Worksheet");

				$("#saveWorksheetLines").attr("disabled", false);
				$("#worksheet-footer").html("Error!");

				savesCounter--;

			})
		    }
		}
	    }
	} 

	function reSort() {
		
		var dt =  $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
		if (dt) {
			dt.order([<?php  $_smarty_tpl->tpl_vars['sorting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sorting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worksheet']->value['sorting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['sorting']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['sorting']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['sorting']->key => $_smarty_tpl->tpl_vars['sorting']->value){
$_smarty_tpl->tpl_vars['sorting']->_loop = true;
 $_smarty_tpl->tpl_vars['sorting']->iteration++;
 $_smarty_tpl->tpl_vars['sorting']->last = $_smarty_tpl->tpl_vars['sorting']->iteration === $_smarty_tpl->tpl_vars['sorting']->total;
?> [<?php echo $_smarty_tpl->tpl_vars['sorting']->value['column'];?>
,"<?php echo $_smarty_tpl->tpl_vars['sorting']->value['direction'];?>
"] <?php if (!$_smarty_tpl->tpl_vars['sorting']->last){?>,<?php }?><?php }
if (!$_smarty_tpl->tpl_vars['sorting']->_loop) {
?> [ 1, "asc" ] <?php } ?>]);
			dt.draw(false);
		
			$("#worksheet-footer").html("Sorted!");
		}
	}

	function updateSort(sortInfo) {

		var sortStr = "";
		var dt =  $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
		var sorting = [[]];

		$(sortInfo).each( function (col) {
			     sorting[col] = [];
			     var direction = sortInfo[col][1];
			     var columnIndex = sortInfo[col][0];
   			     var column = dt.column(columnIndex).header();
			     var columnName = $(column).data("index");
			     sortStr += "[" + columnName + " " + direction + "] ";
			     sorting[col] = [ columnIndex, columnName, direction];
		});

		$("#worksheet-footer").html("Sorting Changed. ( "+sortStr.toString()+")");
			
		saveSort(sorting);
	}

	function saveSort(sorting) {

			console.log(sorting);

			$.post( "/worksheets/ajax/sorting/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", { "sorting": sorting }, function() {
				$("#worksheet-footer").html("Not Saved!");
			})
 			.done(function(results) {
				//console.log("Save Changes Response");
				//console.log(results);
			        var response = $.parseJSON(results);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
					$("#saveWorksheetLinesBottom").attr("disabled", false);
				}
			})
			.fail(function(data) {
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
				$("#worksheet-footer").html("Error!");
			})
	} 

	function removeLines(row,amount) {
			$.post( "/tv/ajax/lines/remove/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", { "row": row, "amount" : amount, "line": data[row]["lineNumber"], "data" : data }, function() {
				$("#worksheet-footer").html("Not Saved!");
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
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})
	}

	function saveLine() {
			$.post( "/tv/ajax/line/update/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
",  { "data" : data }, function() {
				$("#worksheet-footer").html("Not Saved!");
			})
 			.done(function(data) {
			        var response =$.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
					$("#saveWorksheetLinesBottom").attr("disabled", false);
				}
				else {
				}
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})

	}

	function addLine(line) {
			$.post( "/tv/ajax/line/add/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
",  { "data" : line }, function() {
				$("#worksheet-footer").html("Saving New Line...");
			})
 			.done(function(data) {
			        var response =$.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
					$("#saveWorksheetLinesBottom").attr("disabled", false);
				}
				else {
				}
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})

	}

	function saveLines() {
			$("#saveWorksheetLines").attr("disabled", "disabled");
			$.post( "/tv/ajax/lines/update/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
",  { "data" : data, "maxLineNumber": maxLineNumber-1 }, function() {
				$("#worksheet-footer").html("Not Saved!");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#saveWorksheetLines").attr("disabled", false);
					$("#saveWorksheetLinesBottom").attr("disabled", false);
				}
				else {
					window.location.href="/tv/edit/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
";
				}
				
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
				$("#saveWorksheetLines").attr("disabled", false);
				$("#saveWorksheetLinesBottom").attr("disabled", false);
			})

	}

	function saveOrder() {

			$.post( "/orders/ajax/create/tv/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#orderForm").serialize(), function() {
				$("#worksheet-footer").html("Saving Order...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#createOrderButton").text("Create Order");
					$("#createOrderButton").attr("disabled", false);				}
				else {
					if (response.orderID) {
						window.location.href="/orders/show/" + response.worksheetID + "/pdf"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
&orderKey="+response.orderKey;
//						$("#createOrderButton").attr("disabled", false);
//						$("#createOrderButtonDropDown").attr("disabled", false);
//						$("#createOrderButton").text("Create Order");
					}
					else {
						$("#createOrderButton").text("Create Order");
						$("#createOrderButton").attr("disabled", false);
						$("#createOrderButtonDropDown").attr("disabled", false);
						$("#worksheet-footer").html("Unable to display order at this time.");
					}
				}
				
			})
			.fail(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Error!");
			})

	}

	function saveWorksheet(worksheetID) {
		saveLines();
	}

	function editWorksheet(worksheetID) {
		saveLines();
		window.location.href="/worksheet/edit/<?php echo $_smarty_tpl->tpl_vars['worksheetID']->value;?>
";
	}

	function createOrder(worksheetID) {
		$("#createOrderButton").text("Creating...");
		$("#createOrderButton").attr("disabled", "disabled");
		$("#createOrderButtonDropDown").attr("disabled", "disabled");


		<?php if ($_smarty_tpl->tpl_vars['worksheet']->value['isOrdered']){?>
			console.log("Checking Rev #: " + $("#revisionNumber").val() +  " = <?php echo strtr($_smarty_tpl->tpl_vars['orderInfo']->value['revision'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
");

			if ($("#revisionNumber").val() == "<?php echo strtr($_smarty_tpl->tpl_vars['orderInfo']->value['revision'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
") {
				checkRevision();
			}
	
			else {
				saveOrder();
			}
		<?php }else{ ?>
			saveOrder();
		<?php }?>
		
	}

	function wsCheckBox(type, row, state) {
	
		var newState;
		var oldState;

		if (state) {
			newState = 1;
			oldState = 0;
		}
		else {
			newState = 0;
			oldState = 1;
		}			
	
		if (type == "copy") {
			data[row]["copy"]=newState;
			$("#saveWorksheetLines").attr("disabled", false);
			$("#saveWorksheetLinesBottom").attr("disabled", false);
		}
		else if (type == "delete") {
			data[row]["delete"]=newState;
			var changes = [[]];
			changes[0][0]=row;
			changes[0][1]='delete';
			changes[0][2]=oldState;
			changes[0][3]=newState;
			//saveChanges(changes);
			$("#saveWorksheetLines").attr("disabled", false);
			$("#saveWorksheetLinesBottom").attr("disabled", false);
		}
		else if (type == "bold") {
			data[row]["bold"]=newState;
			var changes = [[]];
			changes[0][0]=row;
			changes[0][1]='bold';
			changes[0][2]=oldState;
			changes[0][3]=newState;
			saveChanges(changes);
		}
	}

	function wsCheckBoxMouseUp(type, row, state) {
	
 		var newState;
		var oldState;

		if (state) {
			newState = 0;
			oldState = 1;
		}
		else {
			newState = 1;
			oldState = 0;
		}			
	
		if (type == "copy") {
			data[row]["copy"]=newState;
			$("#saveWorksheetLines").attr("disabled", false);
			$("#saveWorksheetLinesBottom").attr("disabled", false);
		}
		else if (type == "delete") {
			data[row]["delete"]=newState;
			var changes = [[]];
			changes[0][0]=row;
			changes[0][1]='delete';
			changes[0][2]=oldState;
			changes[0][3]=newState;
			saveChanges(changes);
			$("#saveWorksheetLines").attr("disabled", false);
			$("#saveWorksheetLinesBottom").attr("disabled", false);
		}
		else if (type == "bold") {
			data[row]["bold"]=newState;
			var changes = [[]];
			changes[0][0]=row;
			changes[0][1]='bold';
			changes[0][2]=oldState;
			changes[0][3]=newState;
			saveChanges(changes);
		}
	}

	function refreshWorksheet() {
	
		$('#main-content').resize(function(){
			resizeWorksheet();
		});
	}

	function resizeWorksheet() {
	
			var maxWidth = $('#main-content').width()-1;
			//console.log(maxWidth);
			var dataTable = $('#dataTable').handsontable('getInstance');
			//dataTable.updateSettings( { width: maxWidth }  );
			dataTable.render();
        		        //dataTable.handsontable('render');
			//console.log("Refresh Worksheet");
	}

	function setColumnToCheckBox(i, instance) {
	  columns[i].type = "checkbox";
	  instance.updateSettings({ columns: columns });
	  instance.validateCells(function() {
	    instance.render();
          });
        }

	function deleteWorksheet(worksheetID) {
			  
		  	bootbox.confirm('Are you sure?', function(result) { 

				if (result) {

					$("#worksheet-footer").html("Deleting..");

					$.post( "/tv/ajax/delete/<?php echo $_smarty_tpl->tpl_vars['worksheetID']->value;?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $( "#worksheet-form" ).serialize(), function() {
						$("#worksheet-footer").html("Deleting...");
					})
 					.done(function(data) {
					        var response = jQuery.parseJSON(data);
						$("#worksheet-footer").html(response.message);
						if (response.error) {
						}
						else {
							window.location.href="/campaigns/edit/<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
";
						}
					})
					.fail(function(data) {
						$("#worksheet-footer").html("Connection Failed! Not Saved.");
					})
					.error(function(data) {
						$("#worksheet-footer").html("Error!");
					})
				}
	 	 	});
  	}



	function autoCalc() {

			if ($("#autoCalc").is(":checked")) {
				$("#autoUpdate").val("1");
			}
			else {
				$("#autoUpdate").val("0");
			}
	}

	function scrolling() {

			if ($("#scrolling").is(":checked")) {
				$("#isScrolling").val("1");
				var dataTable = $('#dataTable').handsontable('getInstance');
				dataTable.updateSettings( { height:'1500' }  );
				dataTable.render()
			}
			else {
				var dataTable = $('#dataTable').handsontable('getInstance');
				dataTable.updateSettings( { height:'100%' }  );
				dataTable.render()
				$("#isScrolling").val("0");
			}
	}


	function copyBox(worksheetID) {
			 
			var worksheetIDStr = "'"+worksheetID + "'";

			var worksheets = "<div class='form-group'><select id='copyCampaign' class='form-control' name='campaign'><option>-Select A Campaign-</option><option value='<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
' selected>-This Campaign-</option><?php  $_smarty_tpl->tpl_vars['campaign'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['campaign']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['campaigns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['campaign']->key => $_smarty_tpl->tpl_vars['campaign']->value){
$_smarty_tpl->tpl_vars['campaign']->_loop = true;
?><option value='<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
'><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['campaign']->value['name'],'"','\"');?>
</option><?php } ?></select><br><center><button class='btn btn-success' id='copyCampaignBtn' onclick='copyWorksheet($(\"#copyCampaign\").val());'>Copy</button></center></div>"; 

		  	bootbox.alert('Copy this Worksheet to: ' + worksheets);

  	}

	function copyWorksheet(campaignID) {
				if (campaignID) {
					$("#worksheet-footer").html("Copying Worksheet..");

					$.post( "/worksheet/ajax/copy/<?php echo $_smarty_tpl->tpl_vars['worksheetID']->value;?>
/"+campaignID, function() {
						$("#worksheet-footer").html("Copying Worksheet...");
					})
 					.done(function(data) {
					        var response = jQuery.parseJSON(data);
						$("#worksheet-footer").html(response.message);
						if (response.error) {
							$("#worksheet-footer").html("Copy Failed.");
						}
						else {
							window.location ="/" + response.newWorksheetType + "/edit/" + response.newWorksheetID;
						}
					})
					.fail(function(data) {
						$("#worksheet-footer").html("Connection Failed! Not Saved.");
					})
					.error(function(data) {
						$("#worksheet-footer").html("Error!");
					})
				}
  	}

			$("#autoCalc").change(function () {
				autoCalc();
			}); 
			$("#scrolling").change(function () {
				scrolling();
			});

	function updateField(field) {
	   if ($("#autoCalc").is(":checked")) {

	     var line = $(field).data("line");	
	     var row = maxRow;

	     if (line !== "new") {
		     row =$(field).data("row");
	     }
	     else {
		     if(typeof data[row] === 'undefined') {
			     console.log("New Row: " + row);
		data[row] = { lineNumber: 0, daypart: "", vendorID: "", vendor: "", timeOfDay: "",  timeOfDayStd: "", station: "",  program: "", mon: false, tue: false, wed: false, thu: false, fri: false, sat: false, sun: false, length: 0, rate:"", week: { <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?><?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
:0<?php if (!$_smarty_tpl->tpl_vars['week']->last){?>,<?php }?><?php } ?> }, aqh: "", cpp: 0, cpm: 0, impact: "", lineSpendTotal: 0.00, lineAQHTotal: 0.0, lineCPPTotal: 0.00, lineCPMTotal: 0.00, comments: "", copy: false, bold: false, skip: false, trade: false, delete: false };

		     }
	     }	
	     var oldValue = $(field).val();	
	     var newValue;

	     var fieldName = $(field).data("name");

		if (fieldName =="daypart") {
			newValue = $(field).val();
			data[row]["daypart"] = newValue;
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "vendor") {
			newValue = $(field).val();
			data[row]["vendor"] = newValue;
			updateStations();				
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "vendorID") {
			newValue = $(field).val();
			data[row]["vendorID"] = newValue;
			updateStations();				
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "station") {
			newValue = $(field).val();
			data[row]["station"] = newValue.trim();
			updateStations();				
			var changes = [[row,fieldName,oldValue,newValue.trim()]];
		}

		else if (fieldName =="timeOfDay") {
			newValue = nielsen_time_format($(field).val());
			$(field).val(newValue);
			//$(field).closest('.form-group').addClass('has-error');
			data[row]["timeOfDay"] = newValue;
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "program") {
			newValue = $(field).val();
			data[row]["program"] = newValue;
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "mon") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["mon"] = newValue;
			var changes = [[row,"mon",oldValue,newValue]];
		}

		else if (fieldName == "tue") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["tue"] = newValue;
			var changes = [[row,"tue",oldValue,newValue]];
		}

		else if (fieldName == "wed") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["wed"] = newValue;
			var changes = [[row,"wed",oldValue,newValue]];
		}	
		
		else if (fieldName == "thu") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["thu"] = newValue;
			var changes = [[row,"thu",oldValue,newValue]];
		}

		else if (fieldName == "fri") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["fri"] = newValue;
			var changes = [[row,"fri",oldValue,newValue]];
		}

		else if (fieldName == "sat") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["sat"] = newValue;
			var changes = [[row,"sat",oldValue,newValue]];
		}

		else if (fieldName == "sun") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["sun"] = newValue;
			var changes = [[row,"sun",oldValue,newValue]];
		}	

		else if (fieldName == "length") {
			newValue = parseFloat(oldValue).toFixed(0);
			if (isNaN(newValue)) {
				$(field).closest('.form-group').addClass('has-error');
			}
			else {
				$(field).closest('.form-group').removeClass('has-error');
				data[row]["length"] = newValue;
				$("#field-length-"+line).val(data[row]["length"]);
				var changes = [[row,fieldName,oldValue,newValue]];
			}	
		}

		else if (fieldName == "rate") {
			newValue = parseFloat(oldValue).toFixed(2);
			if (isNaN(newValue)) {
				$(field).closest('.form-group').addClass('has-error');
			}
			else {
				$(field).closest('.form-group').removeClass('has-error');
				data[row]["rate"] = newValue;
				data[row]["cpm"] =  ((data[row]["rate"]) / (data[row]["impact"] / 1000)).toFixed(2); 
				data[row]["cpp"] =  (data[row]["rate"] / data[row]["aqh"]).toFixed(2); 
				$("#field-rate-"+line).val(data[row]["rate"]);
				$("#field-cpm-"+line).val(data[row]["cpm"]);
				$("#field-cpp-"+line).val(data[row]["cpp"]);
				var changes = [[row,"cpm",0,data[row]["cpm"]],[row,"cpp",0,data[row]["cpp"]],[row,fieldName,oldValue,newValue]];

			}	
		}

		else if (fieldName == "impact") {
			newValue = parseFloat(oldValue).toFixed(0);
			if (isNaN(newValue)) {
				$(field).closest('.form-group').addClass('has-error');
			}
			else {
				$(field).closest('.form-group').removeClass('has-error');
				data[row]["impact"] = newValue
				data[row]["cpm"] =  ((data[row]["rate"]) / (data[row]["impact"] / 1000)).toFixed(2); 
				data[row]["cpp"] =  (data[row]["rate"] / data[row]["aqh"]).toFixed(2); 				$("#field-impact-"+line).val(data[row]["impact"]);
				$("#field-cpm-"+line).val(data[row]["cpm"]);
 				$("#field-cpp-"+line).val(data[row]["cpp"]);
				var changes = [[row,"cpm",0,data[row]["cpm"]],[row,"cpp",0,data[row]["cpp"]],[row,fieldName,oldValue,newValue]];
			}
			
		}

		else if (fieldName == "aqh") {
			newValue = parseFloat(oldValue).toFixed(2);
			if (isNaN(newValue)) {
				$(field).closest('.form-group').addClass('has-error');
			}
			else {
				$(field).closest('.form-group').removeClass('has-error');
				data[row]["aqh"] = newValue
				data[row]["cpm"] =  ((data[row]["rate"]) / (data[row]["impact"] / 1000)).toFixed(2); 
				data[row]["cpp"] =  (data[row]["rate"] / data[row]["aqh"]).toFixed(2); 
				$("#field-aqhRating-"+line).val(data[row]["aqh"]);				$("#field-cpm-"+line).val(data[row]["cpm"]);
 				$("#field-cpp-"+line).val(data[row]["cpp"]);
				var changes = [[row,"cpm",0,data[row]["cpm"]],[row,"cpp",0,data[row]["cpp"]],[row,fieldName,oldValue,newValue]];
			}
			
		}

		else if (fieldName == "week") {
			newValue = parseFloat(oldValue).toFixed(0);

			if (isNaN(newValue)) {
				newValue = 0;
			}
			if (newValue >= 0) {
				$(field).closest('.form-group').removeClass('has-error');
				var weekCounter = $(field).data("week");	
				data[row]["week"][weekCounter] = newValue;
				$("#field-week-"+line+"-"+weekCounter).val(data[row]["week"][weekCounter]);
				var changes = [[row,fieldName+"."+weekCounter,oldValue,newValue]];
			}	
		}

		else if (fieldName == "comments") {
			newValue = $(field).val();
			data[row]["comments"] = newValue;
			var changes = [[row,fieldName,oldValue,newValue]];
		}

		else if (fieldName == "copy") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["copy"] = newValue;
			var changes = [[row,"copy",oldValue,newValue]];
			wsCheckBox("copy", row, newValue);	
		}

		else if (fieldName == "bold") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["bold"] = newValue;
			var changes = [[row,"bold",oldValue,newValue]];
		}

		else if (fieldName == "trade") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["trade"] = newValue;
			var changes = [[row,"trade",oldValue,newValue]];
		}

		else if (fieldName == "skip") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["skip"] = newValue;
			var changes = [[row,"skip",oldValue,newValue]];
		}

		else if (fieldName == "delete") {
			newValue = 0;
			if ($(field).is(':checked')) {
				newValue = 1;
			}
			data[row]["delete"] = newValue;
			
			wsCheckBox("delete", row, newValue);	
		}
	
		if (line == "new") {	
//			console.log("building new line " + row);
		}
		else {		
			saveChanges(changes);
		}
	       updateSummary();
	    

           }
	   else {
			$("#saveWorksheetLines").attr("disabled", false);
			$("#saveWorksheetLinesBottom").attr("disabled", false);
	   }
	}

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

			$.post( "/home/ajax/sidebar/"+status, function() {
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
	  function updateDaypartSummary() {

		var dayparts =  { none:"-", EM:"EM", DA:"DA", EF:"EF", EN:"EN", PA:"PA", PR:"PR", LF:"LF", LN:"LN", OV:"OV", SP:"SP", RO:"RO" };

		for (var daypart in dayparts) {

			var totalSpend = sumTotalSpendByDaypart(dayparts[daypart]);
			var totalSpots = sumTotalSpotsByDaypart(dayparts[daypart]);
			var totalGRPs = sumTotalGRPsByDaypart(dayparts[daypart]);
			var overallCPP = 0;
			var totalCPM = 0;
			var percentOfTotalGRP = 0.0;

			if (summaryGRPs > 0) {
				var percentOfTotalGRP = (totalGRPs / summaryGRPs) * 100;
			}

			if (totalSpots > 0) {
				$('#daypart-totalSpots-'+daypart).html(totalSpots.toFixed(0));
				$('#summary-daypart-'+daypart).show();
//				overallCPP = sumTotalCPPByDaypart(dayparts[daypart]) / totalSpots;
				overallCPP = totalSpend / totalGRPs;
				totalCPM = sumTotalCPMByDaypart(dayparts[daypart]) / totalSpots;			}
			else {
				$('#daypart-totalSpots-'+daypart).html(totalSpots.toFixed(0));
				$('#summary-daypart-'+daypart).hide();
			}

			if (totalSpend > 0) {
				$('#daypart-totalSpend-'+daypart).html("$" + totalSpend.toFixed(2));
			}
			else {
				$('#daypart-totalSpend-'+daypart).html("$" + totalSpend.toFixed(2));
			}

			if (totalGRPs > 0) {
				$('#daypart-totalGRPs-'+daypart).html(totalGRPs.toFixed(1));
				$('#daypart-percentOfTotalGRP-'+daypart).html(percentOfTotalGRP.toFixed(1) + '%');
				var totalReach = ((1 - Math.pow( 1 - (totalGRPs / totalSpots / 100),totalSpots)) * .85 * 100);
				$('#daypart-reach-'+daypart).html(totalReach.toFixed(2) + "%");
				$('#daypart-freq-'+daypart).html((totalGRPs / totalReach).toFixed(2));
			}
			else {
				$('#daypart-totalGRPs-'+daypart).html(totalGRPs.toFixed(1));
				$('#daypart-percentOfTotalGRP-'+daypart).html(percentOfTotalGRP.toFixed(1) + '%');
			}
			if (overallCPP > 0) {
				$('#daypart-overallCPP-'+daypart).html("$" + overallCPP.toFixed(2));
			}
			else {
				$('#daypart-overallCPP-'+daypart).html("$" + overallCPP.toFixed(2));
			}

			if (isFinite(totalCPM)) {
				$('#daypart-totalCPM-'+daypart).html("$" + totalCPM.toFixed(2));
			}
			else {
				$('#daypart-totalCPM-'+daypart).html("$0.00");
			}	
		}

	  }

	function addNewLine() {
		// take current new line, save to server, insert new row by copying existing into main table
		//do not clear unless asked

		maxRow++;  

		console.log(data);
		console.log("Add New Line: " + maxRow);
		console.log(data[maxRow-1]);

		data[maxRow-1]["lineNumber"] = maxLineNumber;
	
		var isMonday = "";
		var isTuesday = "";
		var isWednesday = "";
		var isThursday = "";
		var isFriday = "";
		var isSaturday = "";
		var isSunday = "";

		if(data[maxRow-1]["mon"]) {
			isMonday = " checked";
		}
		if(data[maxRow-1]["tue"]) {
			isTuesday = " checked";
		}
		if(data[maxRow-1]["wed"]) {
			isWednesday = " checked";
		}
		if(data[maxRow-1]["thu"]) {
			isThursday = " checked";
		}
		if(data[maxRow-1]["fri"]) {
			isFriday = " checked";
		}
		if(data[maxRow-1]["sat"]) {
			isSaturday = " checked";
		} 
		if(data[maxRow-1]["sun"]) {
			isSunday = " checked";
		} 

		var daypartStr = '<?php  $_smarty_tpl->tpl_vars['daypart'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daypart']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dayparts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['daypart']->key => $_smarty_tpl->tpl_vars['daypart']->value){
$_smarty_tpl->tpl_vars['daypart']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
</option><?php } ?>';
		
		daypartStr = daypartStr.replace('value="'+data[maxRow-1]["daypart"]+'"', 'value="'+data[maxRow-1]["daypart"]+'" selected');

		var vendorStr = '<?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vendor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['vendor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
 $_smarty_tpl->tpl_vars['vendor']->iteration++;
 $_smarty_tpl->tpl_vars['vendor']->last = $_smarty_tpl->tpl_vars['vendor']->iteration === $_smarty_tpl->tpl_vars['vendor']->total;
?><option value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"><?php echo strtr($_smarty_tpl->tpl_vars['vendor']->value['name'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
</option><?php } ?>';

		vendorStr = vendorStr.replace('value="'+data[maxRow-1]["vendorID"]+'"', 'value="'+data[maxRow-1]["vendorID"]+'" selected');

		rememberPage();

		var dt = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();

		dt.row.add([
		'<td class="line-number"></td>',
		'<td><input type="hidden" class="worksheet-field" value="'+maxLineNumber+'" name="worksheetLine[]"></td>',
		'<td><select class="form-control input-sm worksheet-field" id="field-daypart-'+maxLineNumber+'" name="daypart[]" data-index="daypart" data-name="daypart" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"><option value=""></option>'+daypartStr+'</select></td>',
		 '<td><select class="form-control input-sm worksheet-field" id="field-vendorID-'+maxLineNumber+'"  name="vendorID[]" data-index="vendorID" data-name="vendorID" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"><option value=""></option>'+vendorStr+'</select></td>',
		'<td><input type=text class="form-control input-sm worksheet-field"  value="'+data[maxRow-1]["station"]+'" id="field-station-'+maxLineNumber+'"  name="station[]" data-index="station" data-name="station" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></td>',
		'  <td><div class="form-group"><input type=text class="form-control input-sm worksheet-field" id="field-timeOfDay-'+maxLineNumber+'" value="'+data[maxRow-1]["timeOfDay"]+'" placeholder="####A/P-####A/P" name="timeOfDay[]" data-index="timeOfDay" data-name="timeOfDay" data-line="'+maxRow+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></div></td>',
		' <td><input type=text class="form-control input-sm" id="field-program-'+maxLineNumber+'" value="'+data[maxRow-1]["program"]+'" name="program[]" data-index="program" data-name="program" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></td>',
		' <td><input type=checkbox name="isMonday[]" class="" id="field-mon-'+maxLineNumber+'" data-index="mon" data-name="mon" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  onchange="updateField(this);"'+isMonday+'></td>',
		'<td><input type=checkbox id="field-tue-'+maxLineNumber+'" data-index="tue" data-name="tue" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isTuesday[]" class=""  onchange="updateField(this);"'+isTuesday+'></td>',
		' <td><input type=checkbox data-index="wed" id="field-wed-'+maxLineNumber+'" data-name="wed" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isWednesday[]" class="" onchange="updateField(this);"'+isWednesday+'></td>',
		' <td><input type=checkbox id="field-thu-'+maxLineNumber+'" data-index="thu" data-name="thu" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isThursday[]" class=""  onchange="updateField(this);"'+isThursday+'></td>',
		'<td><input type=checkbox id="field-fri-'+maxLineNumber+'" data-index="fri" data-name="fri" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isFriday[]" class=""  onchange="updateField(this);"'+isFriday+'></td>',
		' <td><input type=checkbox id="field-sat-'+maxLineNumber+'" data-index="sat" data-name="sat" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isSaturday[]" class="" onchange="updateField(this);"'+isSaturday+'></td>',
		'<td><input type=checkbox id="field-sun-'+maxLineNumber+'" data-index="sun" data-name="sun" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isSunday[]" class="" onchange="updateField(this);"'+isSunday+'></td>',
		' <td><div class="form-group"><input type=text class="form-control input-sm" id="field-length-'+maxLineNumber+'" value="'+data[maxRow-1]["length"]+'" size="3" name="length[]"  data-index="length" data-name="length" data-line="'+maxRow+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm" id="field-rate-'+maxLineNumber+'" data-index="rate" data-name="rate" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" value="'+data[maxRow-1]["rate"]+'" size="5" name="rate[]" onchange="updateField(this);"></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm" id="field-aqh-'+maxLineNumber+'" value="'+data[maxRow-1]["aqh"]+'" size="4" name="aqh[]" data-index="aqhRating" data-name="aqh" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></td>',
		'<td><input type=text class="form-control input-sm" id="field-cpp-'+maxLineNumber+'" value="'+data[maxRow-1]["cpp"]+'" size="4" name="cpp[]" tabindex="-1"  data-name="cpp" data-line="'+maxLineNumber+'" data-index="cpp" readonly></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm id="field-impact-'+maxLineNumber+'"" value="'+data[maxRow-1]["impact"]+'" size="4" name="impact[]" data-index="impact" data-name="impact" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" onchange="updateField(this);"></div></td>',
		'<td><input type=text class="form-control input-sm" id="field-cpm-'+maxLineNumber+'" value="'+data[maxRow-1]["cpm"]+'" id="field-cpm-'+maxRow+'" size="4"  data-index="cpm" data-name="cpm" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" name="cpm[]" tabindex="-1" readonly></td>',
<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'assign'=>"weekCounter"),$_smarty_tpl);?>

<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

		'<td><input type=text class="form-control input-sm" id="field-week-'+maxLineNumber+'-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
"  value="'+data[maxRow-1]["week"][<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]+'" name="week'+maxRow+'[<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]" size="3" data-index="field-week-'+maxLineNumber+'-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" data-name="week" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'" data-week="<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" onchange="updateField(this);"></td>',
<?php } ?>
		
		'<td class="hidden-sm hidden-xs"><input type=text class="form-control input  input-sm" id="field-comments-'+maxLineNumber+'" size=40  value="'+data[maxRow-1]["comments"]+'" name="comments[]" data-index="comments" data-name="comments" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  onchange="updateField(this);"></td>',
		'<td><center><input type=checkbox class="centered" id="field-copy-'+maxLineNumber+'" data-index="copy" data-name="copy" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isCopy[]" onchange="updateField(this);"></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-bold-'+maxLineNumber+'" data-index="bold" data-name="bold" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isBold[]" onchange="updateField(this);"></center></td>',		'<td><center><input type=checkbox class="centered" id="field-trade-'+maxLineNumber+'" data-index="trade" data-name="trade" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isTrade[]" onchange="updateField(this);"></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-skip-'+maxLineNumber+'" data-index="skip" data-name="skip" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isSkipped[]" onchange="updateField(this);"></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-delete-'+maxLineNumber+'" data-index="delete" data-name="delete" data-line="'+maxLineNumber+'" data-row="'+maxRow+'" data-counter="'+maxRow+'"  name="isDeleted[]" onchange="updateField(this);"></center></td>'
		
		]).draw(false);
	
		$('#field-vendorID-'+maxLineNumber).val(data[maxRow-1]["vendorID"]);
		$('#field-daypart-'+maxLineNumber).val(data[maxRow-1]["daypart"]);

		addLine(data[maxRow-1]);
		
		maxLineNumber++;


		data[maxRow] = { lineNumber: maxLineNumber+1, daypart: data[maxRow-1]["daypart"], vendorID: data[maxRow-1]["vendorID"],  vendor: data[maxRow-1]["vendor"], timeOfDay: data[maxRow-1]["timeOfDay"], timeOfDayStd: data[maxRow-1]["timeOfDayStd"], station: data[maxRow-1]["station"],  program: data[maxRow-1]["program"], mon: data[maxRow-1]["mon"], tue: data[maxRow-1]["tue"], wed: data[maxRow-1]["wed"], thu: data[maxRow-1]["thu"], fri: data[maxRow-1]["fri"], sat: data[maxRow-1]["sat"], sun: data[maxRow-1]["sun"], length: data[maxRow-1]["length"], rate:data[maxRow-1]["rate"], week: { <?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?><?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
:data[maxRow-1]["week"][<?php echo $_smarty_tpl->tpl_vars['week']->iteration;?>
]<?php if (!$_smarty_tpl->tpl_vars['week']->last){?>,<?php }?><?php } ?> }, aqh: data[maxRow-1]["aqh"], cpp: data[maxRow-1]["cpp"], cpm: data[maxRow-1]["cpm"], impact: data[maxRow-1]["impact"], lineSpendTotal: data[maxRow-1]["lineSpendTotal"], lineAQHTotal: data[maxRow-1]["lineAQHTotal"], lineCPPTotal: data[maxRow-1]["lineCPPTotal"], lineCPMTotal: data[maxRow-1]["lineCPMTotal"], comments: data[maxRow-1]["comments"], copy: false, bold: false, skip: false, trade: false, delete: false };

 $('input').keyup(function(e){
  var cursor = 0;
  var maxCursor = 0;
  if ($(":focus").attr("type")=="text") {
	  cursor = $(":focus").getCursorPosition();
	  maxCursor = $(":focus").val().length;
  }
  if(e.which==39) {
    if (cursor >= maxCursor ) {
	if (lastCursor == cursor) {
		lastCursor = -1;
	   	$(this).closest('td').next().find('input').focus();
		if ($(":focus").attr("tabindex") < 0) {
		   	$(":focus").closest('td').next().find('input').focus();
		}
	}
	else {
		lastCursor = cursor;
	}
   }
   lastCursor = cursor;
  }
  else if(e.which==37) {
    if (cursor < 1) {
	if (lastCursor == cursor) {
	    lastCursor = -1;
	    $(this).closest('td').prev().find('input').focus();
	    if ($(":focus").attr("tabindex") < 0) {
	   	$(":focus").closest('td').prev().find('input').focus();
	    }
	}
	else {
	    lastCursor = cursor;
	}
    }
    lastCursor = cursor;
  }
  else if(e.which==40) {
   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
  }
  else if(e.which==38) {
   $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
  }
  else if(e.which==13) {
   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();  
   if ($(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').length==0) {
	  updateField($(this));
   }
  }
});


	}


	function addRow(line) {
	
		var isMonday = "";
		var isTuesday = "";
		var isWednesday = "";
		var isThursday = "";
		var isFriday = "";
		var isSaturday = "";
		var isSunday = "";

		var isBold = "";
		var isTrade = "";
		var isSkipped = "";

		lineNumber = line;

		if(data[lineNumber]["mon"]) {
			isMonday = " checked";
		}
		if(data[lineNumber]["tue"]) {
			isTuesday = " checked";
		}
		if(data[lineNumber]["wed"]) {
			isWednesday = " checked";
		}
		if(data[lineNumber]["thu"]) {
			isThursday = " checked";
		}
		if(data[lineNumber]["fri"]) {
			isFriday = " checked";
		}
		if(data[lineNumber]["sat"]) {
			isSaturday = " checked";
		} 
		if(data[lineNumber]["sun"]) {
			isSunday = " checked";
		} 

		if(data[lineNumber]["bold"]) {
			isBold = " checked";
		} 

		if(data[lineNumber]["trade"]) {
			isTrade = " checked";
		} 

		if(data[lineNumber]["skip"]) {
			isSkipped = " checked";
		} 



		var daypartStr = '<?php  $_smarty_tpl->tpl_vars['daypart'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daypart']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dayparts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['daypart']->key => $_smarty_tpl->tpl_vars['daypart']->value){
$_smarty_tpl->tpl_vars['daypart']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['daypart']->value;?>
</option><?php } ?>';
		
		daypartStr = daypartStr.replace('value="'+data[lineNumber]["daypart"]+'"', 'value="'+data[lineNumber]["daypart"]+'" selected');

		var vendorStr = '<?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vendor']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['vendor']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
 $_smarty_tpl->tpl_vars['vendor']->iteration++;
 $_smarty_tpl->tpl_vars['vendor']->last = $_smarty_tpl->tpl_vars['vendor']->iteration === $_smarty_tpl->tpl_vars['vendor']->total;
?><option value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"><?php echo strtr($_smarty_tpl->tpl_vars['vendor']->value['name'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
</option><?php } ?>';

		vendorStr = vendorStr.replace('value="'+data[lineNumber]["vendorID"]+'"', 'value="'+data[lineNumber]["vendorID"]+'" selected');

		var dt = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
		dt.row.add([
		'<td class="line-number"></td>',
		'<td><input type="hidden" class="worksheet-field" value="'+lineNumber+'" name="worksheetLine[]"></td>',
		'<td><select class="form-control input-sm worksheet-field" id="field-daypart-'+lineNumber+'" name="daypart[]" data-index="daypart" data-name="daypart" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"><option value=""></option>'+daypartStr+'</select></td>',
		 '<td><select class="form-control input-sm worksheet-field" id="field-vendorID-'+lineNumber+'"  name="vendorID[]" data-index="vendorID" data-name="vendorID" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);" onload="$(this).val('+data[lineNumber]["vendorID"]+');"><option value=""></option>'+vendorStr+'</select></td>',
		'<td data-order="'+data[lineNumber]["station"]+'"><input type=text class="form-control input-sm worksheet-field"  value="'+data[lineNumber]["station"]+'" id="field-station-'+lineNumber+'"  name="station[]" data-index="station" data-name="station" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></td>',
		'  <td ><input type=hidden value="'+data[lineNumber]["timeOfDayStd"]+'" ><div class="form-group"><input type=text class="form-control input-sm worksheet-field" id="field-timeOfDay-'+lineNumber+'" value="'+data[lineNumber]["timeOfDay"]+'" placeholder="####A/P-####A/P" name="timeOfDay[]" data-index="timeOfDay" data-name="timeOfDay" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></div></td>',
		' <td><input type=text class="form-control input-sm" id="field-program-'+lineNumber+'" value="'+data[lineNumber]["program"]+'" name="program[]" data-index="program" data-name="program" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></td>',
		' <td><input type=checkbox name="isMonday[]" class="" id="field-mon-'+lineNumber+'" data-index="mon" data-name="mon" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  onchange="updateField(this);"'+isMonday+'></td>',
		'<td><input type=checkbox id="field-tue-'+lineNumber+'" data-index="tue" data-name="tue" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isTuesday[]" class=""  onchange="updateField(this);"'+isTuesday+'></td>',
		' <td><input type=checkbox data-index="wed" id="field-wed-'+lineNumber+'" data-name="wed" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isWednesday[]" class="" onchange="updateField(this);"'+isWednesday+'></td>',
		' <td><input type=checkbox id="field-thu-'+lineNumber+'" data-index="thu" data-name="thu" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isThursday[]" class=""  onchange="updateField(this);"'+isThursday+'></td>',
		'<td><input type=checkbox id="field-fri-'+lineNumber+'" data-index="fri" data-name="fri" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isFriday[]" class=""  onchange="updateField(this);"'+isFriday+'></td>',
		' <td><input type=checkbox id="field-sat-'+lineNumber+'" data-index="sat" data-name="sat" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isSaturday[]" class="" onchange="updateField(this);"'+isSaturday+'></td>',
		'<td><input type=checkbox id="field-sun-'+lineNumber+'" data-index="sun" data-name="sun" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isSunday[]" class="" onchange="updateField(this);"'+isSunday+'></td>',
		' <td><div class="form-group"><input type=text class="form-control input-sm" id="field-length-'+lineNumber+'" value="'+data[lineNumber]["length"]+'" size="3" name="length[]"  data-index="length" data-name="length" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm" id="field-rate-'+lineNumber+'" data-index="rate" data-name="rate" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" value="'+data[lineNumber]["rate"]+'" size="5" name="rate[]" onchange="updateField(this);"></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm" id="field-aqh-'+lineNumber+'" value="'+data[lineNumber]["aqh"]+'" size="4" name="aqh[]" data-index="aqhRating" data-name="aqh" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></td>',
		'<td><input type=text class="form-control input-sm" id="field-cpp-'+lineNumber+'" value="'+data[lineNumber]["cpp"]+'" size="4" name="cpp[]" tabindex="-1"  data-name="cpp" data-line="'+lineNumber+'" data-index="cpp" readonly></div></td>',
		'<td><div class="form-group"><input type=text class="form-control input-sm id="field-impact-'+lineNumber+'"" value="'+data[lineNumber]["impact"]+'" size="4" name="impact[]" data-index="impact" data-name="impact" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" onchange="updateField(this);"></div></td>',
		'<td><input type=text class="form-control input-sm" id="field-cpm-'+lineNumber+'" value="'+data[lineNumber]["cpm"]+'" id="field-cpm-'+lineNumber+'" size="4"  data-index="cpm" data-name="cpm" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" name="cpm[]" tabindex="-1" readonly></td>',
<?php echo smarty_function_counter(array('start'=>0,'skip'=>1,'print'=>false,'assign'=>"weekCounter"),$_smarty_tpl);?>

<?php  $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['week']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weeks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['week']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['week']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['week']->key => $_smarty_tpl->tpl_vars['week']->value){
$_smarty_tpl->tpl_vars['week']->_loop = true;
 $_smarty_tpl->tpl_vars['week']->iteration++;
 $_smarty_tpl->tpl_vars['week']->last = $_smarty_tpl->tpl_vars['week']->iteration === $_smarty_tpl->tpl_vars['week']->total;
?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

		'<td><input type=text class="form-control input-sm" id="field-week-'+lineNumber+'-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
"  value="'+data[lineNumber]["week"][<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]+'" name="week'+lineNumber+'[<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
]" size="3" data-index="field-week-'+lineNumber+'-<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" data-name="week" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'" data-week="<?php echo $_smarty_tpl->tpl_vars['weekCounter']->value;?>
" onchange="updateField(this);"></td>',
<?php } ?>
		
		'<td class="hidden-sm hidden-xs"><input type=text class="form-control input  input-sm" id="field-comments-'+lineNumber+'" size=40  value="'+data[lineNumber]["comments"]+'" name="comments[]" data-index="comments" data-name="comments" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  onchange="updateField(this);"></td>',
		'<td><center><input type=checkbox class="centered" id="field-copy-'+lineNumber+'" data-index="copy" data-name="copy" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isCopy[]" onchange="updateField(this);"></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-bold-'+lineNumber+'" data-index="bold" data-name="bold" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isBold[]" onchange="updateField(this);"'+isBold+'></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-trade-'+lineNumber+'" data-index="trade" data-name="trade" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isTrade[]" onchange="updateField(this);"'+isTrade+'></center></td>',
		'<td><center><input type=checkbox class="centered" id="field-skip-'+lineNumber+'" data-index="skip" data-name="skip" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isSkipped[]" onchange="updateField(this);"'+isSkipped+'></center></td>',		'<td><center><input type=checkbox class="centered" id="field-delete-'+lineNumber+'" data-index="delete" data-name="delete" data-line="'+lineNumber+'" data-row="'+lineNumber+'" data-counter="'+lineNumber+'"  name="isDeleted[]" onchange="updateField(this);"></center></td>'
		
		]);
		
		
		$('#field-vendorID-'+lineNumber).val(data[lineNumber]["vendorID"]);
		$('#field-daypart-'+lineNumber).val(data[lineNumber]["daypart"]);
	}

$(document).ready(function () {
    $("select").each(function () {
        $(this).val($(this).find('option[selected]').val());
    });

	loadWorksheetData(); 
	bindKeyEvents();
	checkCols();

});

	function clearNewLine() {
		$('#field-comments-new').val('');
		$('#field-daypart-new').val('');
		$('#field-vendorID-new').val('');
		$('#field-station-new').val('');
		$('#field-timeOfDay-new').val('');
		$('#field-program-new').val('');
		$('#field-mon-new').val('');
		$('#field-tue-new').val('');
		$('#field-wed-new').val('');
		$('#field-thu-new').val('');
		$('#field-fri-new').val('');
		$('#field-sat-new').val('');
		$('#field-sun-new').val('');
		$('#field-rate-new').val('');
		$('#field-length-new').val('');
		$('#field-cpp-new').val('');
		$('#field-impact-new').val('');
		$('#field-aqh-new').val('');
		$('#field-cpm-new').val('');

	}

	function toggleSummary() {

		if ($("#toggleSummary").text() == "Hide Summary") {
			$("#toggleSummary").text("Show Summary");
		}
		else {
			$("#toggleSummary").text("Hide Summary");
		}
		$("#widget-summary").toggle();
		$("#worksheet-div").toggleClass("col-lg-10");
		$("#worksheet-div").toggleClass("col-lg-12");
	}


// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

}



function showAllColumns(maxCol) {
var table = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
 
for ( var i=2 ; i<=maxCol ; i++ ) {
    table.column( i ).visible( true, false );
    $("#col-"+i).prop("checked", true);
    var colName = $("#col-"+i).data("name");
    saveCols(colName, 0);
}
table.columns.adjust().draw( false ); // adjust column sizing and redraw

}

function showAllWeeks(startCol, endCol) {
var table = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
var cols = table.columns();
for ( var i=startCol ; i<cols[0].length; i++ ) {
    table.column( i ).visible(true, false );
    $("#col-"+i).prop("checked", true);
    var colName = $("#col-"+i).data("name");
    saveCols(colName, 0);
}
table.columns.adjust().draw( false ); // adjust column sizing and redraw

}

function hideAllWeeks(startCol, endCol) {
var table = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
var cols = table.columns();
for ( var i=startCol ; i <= endCol; i++ ) {
    table.column( i ).visible(false, false );
    $("#col-"+i).prop("checked", false);
    var colName = $("#col-"+i).data("name");
    saveCols(colName, 0);
}
table.columns.adjust().draw( false ); // adjust column sizing and redraw

}

function checkCols() {

var table = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
var cols = table.columns();

for ( var i=0 ; i<cols[0].length; i++ ) {
    if (table.column( i ).visible()) {
	    $("#col-"+i).prop("checked", true);
    }
    else {
	    $("#col-"+i).prop("checked", false); 
    }
}

}

		function viewPrograms(worksheetID, templateID, format) {

			$("#reportWait").modal('show')

			$("#templateID").val(templateID);
			$("#reportFormat").val(format);

			$.post( "/reports/ajax/create/programs/pdf" + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#report-form-programs").serialize(), function() {
				$("#worksheet-footer").html("Saving Parameters...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#reportWait").modal('hide')
				}
				else {
					if (response.reportID) {
						window.location.href="/reports/show/" + response.reportID + "/" + response.format + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
";

//						var myPDF = new PDFObject({ url: "/reports/show/" + response.reportID + "/pdf" }).embed("pdfViewer");
						if (response.format != "pdf") {
							$("#reportWait").modal('hide');
						}
//						$("#pdfFrame").show();
//						$("#mainContent").hide();
					}
					else {
						$("#worksheet-footer").html("Unable to display schedule at this time.");
						$("#reportWait").modal('hide');
					}
				}
				
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed!");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}


		function viewSchedule(worksheetID, templateID, format) {

			$("#reportWait").modal('show')

			$("#templateID").val(templateID);
			$("#reportFormat").val(format);

			$.post( "/reports/ajax/create/schedule/pdf" + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#report-form").serialize(), function() {
				$("#worksheet-footer").html("Saving Parameters...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#reportWait").modal('hide')
				}
				else {
					if (response.reportID) {
						window.location.href="/reports/show/" + response.reportID + "/" + response.format + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
";

//						var myPDF = new PDFObject({ url: "/reports/show/" + response.reportID + "/pdf" }).embed("pdfViewer");
						if (response.format != "pdf") {
							$("#reportWait").modal('hide');
						}
//						$("#pdfFrame").show();
//						$("#mainContent").hide();
					}
					else {
						$("#worksheet-footer").html("Unable to display schedule at this time.");
						$("#reportWait").modal('hide');
					}
				}
				
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed!");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}	

		function exportWorksheet(worksheetID, templateID, format) {

			$("#reportWait").modal('show')

			$("#templateID").val(templateID);
			$("#reportFormat").val(format);

			$.post( "/reports/ajax/create/worksheet/csv" + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#report-form").serialize(), function() {
				$("#worksheet-footer").html("Saving Parameters...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#reportWait").modal('hide')
				}
				else {
					if (response.reportID) {
						window.location.href="/reports/show/" + response.reportID + "/" + response.format + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
";

//						var myPDF = new PDFObject({ url: "/reports/show/" + response.reportID + "/pdf" }).embed("pdfViewer");
						if (response.format != "pdf") {
							$("#reportWait").modal('hide');
						}
//						$("#pdfFrame").show();
//						$("#mainContent").hide();
					}
					else {
						$("#worksheet-footer").html("Unable to export worksheet at this time.");
						$("#reportWait").modal('hide');
					}
				}
				
			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed!");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}

	$(document).ready(function () {
	
	    	$('.toggle-col').change(function(box) {
	            var colName = $(this).data("name");
	    	    if ($(this).is(':checked')) {
	//		console.log("Box is checked");
			saveCols(colName, 0);
		    }
	            else {
	//		console.log("Box is unchecked");
			saveCols(colName, 1);
		    }
	    	});
	});

	function saveCols(colName, isChecked) {

			$.post( "/worksheet/ajax/cols/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
/"+colName+"/"+isChecked, function() {
				$("#worksheet-footer").html("Saving changes...");
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


	function previewOrder() {
			$.post( "/orders/ajax/preview/tv/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#orderForm").serialize(), function() {
				$("#worksheet-footer").html("Saving Order...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#createOrderButton").text("Create Order");
					$("#createOrderButton").attr("disabled", false);				}
				else {
					if (response.orderID) {
						window.location.href="/orders/show/" + response.worksheetID + "/pdf"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
&orderKey="+response.orderKey;
//						$("#createOrderButton").attr("disabled", false);
//						$("#createOrderButtonDropDown").attr("disabled", false);
//						$("#createOrderButton").text("Create Order");
					}
					else {
						$("#createOrderButton").text("Create Order");
						$("#createOrderButton").attr("disabled", false);
						$("#createOrderButtonDropDown").attr("disabled", false);
						$("#worksheet-footer").html("Unable to display order at this time.");
					}
				}
				
			})
			.fail(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Error!");
			})

	}


	function sendOrder() {

			$.post( "/orders/ajax/create/tv/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#orderForm").serialize(), function() {
				$("#worksheet-footer").html("Creating Order...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#createOrderButton").text("Sending Order");
					$("#createOrderButton").attr("disabled", true);					$("#createOrderButtonDropDown").attr("disabled", true);
				}
				else {
					if (response.orderID) {
						confirmSend(response.worksheetID, response.orderID, response.orderKey);
					}
				}
			})
			.fail(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Error!");
			})
	}

	function deliverOrder(worksheetID, orderID, orderKey) {

						$.post( "/orders/ajax/deliver/tv/"+ worksheetID + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
&orderKey="+orderKey, function() {
							$("#worksheet-footer").html("Sending Order...");
						})
						.done(function(data) {
						        var response = $.parseJSON(data);
							$("#worksheet-footer").html(response.message);
							if (response.error) {
								$("#createOrderButton").text("Create Order");
								$("#createOrderButton").attr("disabled", false);							}
							else {
								if (response.msgCount) {
									$("#createOrderButton").attr("disabled", false);
									$("#createOrderButtonDropDown").attr("disabled", false);
									$("#createOrderButton").text("Create Order");
								}
								else {
									$("#createOrderButton").text("Create Order");
									$("#createOrderButton").attr("disabled", false);
									$("#createOrderButtonDropDown").attr("disabled", false);
									$("#worksheet-footer").html("Unable to send order at this time.");
								}											}
						})
						.fail(function(data) {
							$("#createOrderButton").text("Create Order");
							$("#createOrderButton").attr("disabled", false);							$("#worksheet-footer").html("Connection Failed! Not Saved.");
						})
						.error(function(data) {
							$("#createOrderButton").text("Create Order");
							$("#createOrderButton").attr("disabled", false);							$("#worksheet-footer").html("Error!");
						})

	}

	function cancelOrder() {
			$.post( "/orders/ajax/cancel/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
"+ "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#orderForm").serialize(), function() {
				$("#worksheet-footer").html("Cancelling Order...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				if (response.error) {
					$("#createOrderButton").text("Cancelling Order");
					$("#createOrderButton").attr("disabled", false);				}
				else {
					if (response.cancelled) {
						$("#cancelledStamp").html(response.timestamp);
						$("#isCancelled").show();
					}
					else {
						$("#createOrderButton").text("Create Order");
						$("#createOrderButton").attr("disabled", false);
						$("#createOrderButtonDropDown").attr("disabled", false);
						$("#worksheet-footer").html("Unable to cancel order at this time.");
					}
				}
				
			})
			.fail(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Error!");
			})

	}

	function confirmSend(worksheetID, orderID, orderKey) {
			$.post( "/orders/ajax/send/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
/" + orderID + "/" + orderKey + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", $("#orderForm").serialize(), function() {
				$("#worksheet-footer").html("Sending Order...");
			})
 			.done(function(data) {
			        var response = $.parseJSON(data);
				$("#worksheet-footer").html(response.message);
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);
				$("#createOrderButtonDropDown").attr("disabled", false);
				if (response.content) {
					sendBox(worksheetID, orderID, orderKey, response.content);
				}		
			})
			.fail(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Connection Failed! Nothing Sent.");
			})
			.error(function(data) {
				$("#createOrderButton").text("Create Order");
				$("#createOrderButton").attr("disabled", false);				$("#worksheet-footer").html("Unable to send order at this time.");
			})

	}

	function cancelBox(worksheetID) {
			 
		  	bootbox.confirm('<h4>Cancel Order?</h4>', function(response) {
				if (response) {
					cancelOrder();									}
				else {
					$("#worksheet-footer").html("Order Not Cancelled.");
				}
			});
  	}

	function checkRevision() {

bootbox.dialog({
  message: '<h4>This worksheet was previously ordered.<br>Do you want to set a new revision #?</h4>',
  title: "Change Revision?",
  buttons: {
    success: {
      label: "No",
      className: "btn-danger",
      callback: function() {
		saveOrder();
      }
    },
    main: {
      label: "Yes",
      className: "btn-success",
      callback: function() {
		// increase revision #
		var revNum = $("#revisionNumber").val();
		console.log("Rev # " + revNum);
		var newRevNum = parseInt(revNum) + 1;
		console.log("New Rev # " + newRevNum);
		$("#revisionNumber").val(newRevNum);
		saveOrder();
      }
    }
  }
});
			 


  	}

	function sendBox(worksheetID, orderID, orderKey, message) {
			 
		  	bootbox.confirm('<h4>Send Order?</h4> ' + message, function(response) {
				if (response) {
					deliverOrder(worksheetID, orderID, orderKey);
				}
				else {
					$("#createOrderButton").text("Create Order");
					$("#createOrderButton").attr("disabled", false);
					$("#createOrderButtonDropDown").attr("disabled", false);
					$("#worksheet-footer").html("Send Order Cancelled.");
				}
			});
  	}

	function goToPage(pageNum) {

		var dt = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();
	
		dt.page(pageNum).draw(false);

		console.log("GoToPage: " + pageNum);
	}

	function currentPage() {

		var dt = $('#worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
').DataTable();

		console.log("Current Page: " + dt.page());

		return dt.page();

	}

	function rememberPage() {
		
		remember = true;
		pageNumber = currentPage();
		console.log("Remember Page: " + pageNumber);
		if (remember) {
			goToPage(pageNumber);
			return pageNumber;
		}
		return false;
	}

	</script>

		




	

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
			$('#mini-bar-chart-campaigns').sparkline([<?php echo (($tmp = @$_smarty_tpl->tpl_vars['chartCampaigns']->value)===null||$tmp==='' ? "0" : $tmp);?>
], params);
			params.barColor = '#1D92AF';
			$('#mini-bar-chart-buys').sparkline([<?php echo (($tmp = @$_smarty_tpl->tpl_vars['chartBuys']->value)===null||$tmp==='' ? "0" : $tmp);?>
], params);
			params.barColor = '#3F7577';
			$('#mini-bar-chart-ads').sparkline([<?php echo (($tmp = @$_smarty_tpl->tpl_vars['chartAds']->value)===null||$tmp==='' ? "0" : $tmp);?>
], params);
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

			$.post( "/home/ajax/sidebar/"+status+"?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
", function() {
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

</html><?php }} ?>