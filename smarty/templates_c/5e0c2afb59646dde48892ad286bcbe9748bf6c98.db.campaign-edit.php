<?php /* Smarty version Smarty-3.1.13, created on 2015-05-01 19:14:00
         compiled from "db:campaign-edit" */ ?>
<?php /*%%SmartyHeaderCode:271264166554408b86ff083-96908758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e0c2afb59646dde48892ad286bcbe9748bf6c98' => 
    array (
      0 => 'db:campaign-edit',
      1 => 1426657054,
      2 => 'db',
    ),
    '667edc434c4263a0fb1a6a35e42d287396c2c344' => 
    array (
      0 => 'db:kingboard-framework',
      1 => 1430518050,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '271264166554408b86ff083-96908758',
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
  'unifunc' => 'content_554408b90fdf18_69127113',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554408b90fdf18_69127113')) {function content_554408b90fdf18_69127113($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/mnt/stor9-wc1-dfw1/649984/dev.filelogix.com/lib/Smarty-3.1.13/libs/plugins/modifier.replace.php';
?><!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
	<base href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['base']->value)===null||$tmp==='' ? "/" : $tmp);?>
">
	<title>Dashboard | BluHorn</title>
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

			

	
   
<link href="/lib/select2/select2.css" rel="stylesheet"/>

<style>

.form-control .select2-choice {
    border: 0;
    border-radius: 2px;
}

.form-control .select2-choice .select2-arrow {
    border-radius: 0 2px 2px 0;   
}

.form-control.select2-container {
    height: auto !important;
    padding: 0px;
}

.form-control.select2-container.select2-dropdown-open {
    border-color: #5897FB;
    border-radius: 3px 3px 0 0;
}

.form-control .select2-container.select2-dropdown-open .select2-choices {
    border-radius: 3px 3px 0 0;
}

.form-control.select2-container .select2-choices {
    border: 0 !important;
    border-radius: 3px;
}
</style>

<style>

.dropdown-menu {
	border: 1px solid #555;
	padding-bottom: 10px;
}

</style>



	




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
							<i class="fa fa-angle-left <?php if ($_smarty_tpl->tpl_vars['hideSideBar']->value){?>fa-angle-right<?php }?>"  ></i>
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
			<li><a href="campaigns/all">All Campaigns</a></li>
			<li class="active">Test Campaign</li>
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

						

							<div class="main-header">
								<h2>Campaign</h2>
								<em>Summary and Worksheets</em>
							</div>
<div class="col-lg-6 col-sm-12 col-md-10">
	<div class="widget">
		<div class="widget-header">
				<h3>Campaign Summary</h3>

				<div class="btn-group widget-header-toolbar">
					<div class="control-inline toolbar-item-group">
																		<span class="control-title"><i class="fa fa-rocket"></i>Active?</span>
								
						<input type="checkbox" id="campaignActive" <?php if ($_smarty_tpl->tpl_vars['campaign']->value['isActive']){?>checked<?php }?> class="switch-demo switch-mini" data-on="success" data-off="default" data-on-label="Yes" data-off-label="No" >					</div>
																</div>					


		</div>
		<div class="widget-content">

			<form class="form-horizontal label-left"  id="campaign-form" name="campaign" role="form">
<?php if ($_smarty_tpl->tpl_vars['alert']->value['success']){?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Yay!</strong> <?php echo $_smarty_tpl->tpl_vars['alert']->value['success'];?>

</div>
<?php }?>	

<?php if ($_smarty_tpl->tpl_vars['alert']->value['error']){?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Whoa!</strong> <?php echo $_smarty_tpl->tpl_vars['alert']->value['error'];?>

</div>
<?php }?>	
				<input type="hidden" name="campaignID" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
">
				<input type="hidden" name="agencyID" value="<?php echo $_smarty_tpl->tpl_vars['agencyID']->value;?>
">
				<input type="hidden" id="campaign-active" name="isActive" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['isActive'];?>
">
				<input type="hidden" id="flightStart" name="flightStart" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightStart'];?>
">
				<input type="hidden" id="flightEnd" name="flightEnd" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightEnd'];?>
">

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Client</label>
			
						<div class="col-sm-12 col-lg-12 col-md-12" >

								<select name="clientID" id="client-select" style="width: 100%;">
									<?php  $_smarty_tpl->tpl_vars['client'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['client']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['clients']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['client']->key => $_smarty_tpl->tpl_vars['client']->value){
$_smarty_tpl->tpl_vars['client']->_loop = true;
?>										<option value="<?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['client']->value['id']==$_smarty_tpl->tpl_vars['campaign']->value['clientID']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['client']->value['name'];?>
</option>
									<?php } ?>

								</select>
						</div>
																	</div>

					<div class="form-group" id="campaign-name">
																		<label for="text-input" class="col-sm-4 control-label">Campaign Name</label>
																		<div class="col-sm-8">
								<input type="text" name="campaignName" id="campaignName" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['campaign']->value['name']);?>
" class="form-control" required>
								<span id="campaign-name-help" class="help-block text-danger" style="display: none;">Campaign Name Already Exists!</span>						</div>
																	</div>

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Job Number</label>
																		<div class="col-sm-8">
								<input type="text" id="jobNumber" name="jobNumber" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['jobNumber'];?>
" class="form-control">
						</div>
																	</div>

					<div class="form-group">
																		<label for="text-input" class="col-sm-4 control-label">Flight Date Range</label>
																		<div class="col-sm-10">
							<div id="flightRange" class="pull-left report-range">
																				<i class="fa fa-calendar"></i>
																				<span class="range-value"></span><b class="caret"></b>
						
							</div>										</div>				
																	</div>
																	<div class="form-group">
																		<label for="phone" class="col-sm-4 control-label">Agency Commission</label>
																		<div class="col-sm-2 col-md-3 col-lg-2 pull-left">
																			<input type="text" id="agencyCommission" name="agencyCommission" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['commission'];?>
" class="form-control">
																		</div>
																	</div>

					<div class="form-group">
						<div class="col-sm-12">
							<p>Remarks</p>
							<textarea id="textarea" name="remarks" id="remarks" class="form-control" rows="6" cols="30" maxlength="99" style="resize: none;"><?php echo $_smarty_tpl->tpl_vars['campaign']->value['remarks'];?>
</textarea>							<p class="textarea-msg"></p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<p class="pull-right">
								<button type="button" class="btn btn-success" onclick="saveCampaign();">Save</button>
								<button type="button" class="btn btn-danger" onclick="deleteCampaign();">Delete</button>
							</p>
						</div>
					</div>										</form>

		</div>

		<div id="campaign-footer" class="widget-footer">
			Not Saved
		</div>

	</div>


	
</div>

<div class="col-lg-12 col-sm-12 col-md-12 hide">
	<div class="widget">
		<div class="widget-header">
				<h3>Worksheet Summary</h3>	
		</div>
		<div class="widget-content">


												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Media Type</th>
															<th>GRPs</th>
															<th>CPP</th>
															<th>CPM</th>
															<th>Spend ($)</th>
														</tr>
													</thead>
													<tbody>
		<?php  $_smarty_tpl->tpl_vars['summary'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['summary']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['summaries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['summary']->key => $_smarty_tpl->tpl_vars['summary']->value){
$_smarty_tpl->tpl_vars['summary']->_loop = true;
?>						<tr>
															<td><?php echo $_smarty_tpl->tpl_vars['summary']->value['vendorDescription'];?>
</td>
															<td><?php echo $_smarty_tpl->tpl_vars['summary']->value['totalGRPs'];?>
</td>
															<td><?php echo $_smarty_tpl->tpl_vars['summary']->value['totalCPP'];?>
</td>
															<td><?php echo $_smarty_tpl->tpl_vars['summary']->value['totalCPM'];?>
/td>
															<td><?php echo $_smarty_tpl->tpl_vars['summary']->value['totalSpend'];?>
</td>
														</tr>
		<?php } ?>
										</tbody>
												</table>
											</div>
										</div>




</div>


<div class="col-lg-12 col-sm-12 col-md-12">

		<div class="widget widget-table" style="overflow: visible;">
			<div class="widget-header">
				<h3><i class="fa fa-table"></i>Add A New Worksheet</h3>
				<div class="btn-group widget-header-toolbar">					<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
				</div>
			</div>
			<div class="widget-content">
				<div class="row">
					<div class="col-sm-10 col-md-10 col-lg-8">
						<form class="form-horizontal label-left"  id="addWorksheet" name="addWorksheet" role="form">

<div  id="worksheet-alert-success" class="alert alert-success alert-dismissable" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Yay!</strong> <span id="worksheet-alert-success-message"></span>
</div>

<div id="worksheet-alert-error" class="alert alert-danger alert-dismissable" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Whoa!</strong> <span id="worksheet-alert-error-message"></span>
</div>

				<input type="hidden" name="campaignID" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
">
				<input type="hidden" name="agencyID" value="<?php echo $_smarty_tpl->tpl_vars['agencyID']->value;?>
">
				<input type="hidden" id="useBroadcastWeeks" name="useBroadcastWeeks" value="1">
				<input type="hidden" id="isAutoComm" name="isAutoComm" value="1">

							<div class="form-group" id="worksheet-name">
																				<label for="text-input" class="col-sm-4 control-label">Worksheet Name</label>
																				<div class="col-sm-6">
										<input type="text" name="worksheetName" id="worksheetName" value="<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['name'];?>
" class="form-control" required>
										<span id="worksheet-name-help" class="help-block text-danger" style="display: none;">Worksheet Name Already Exists!</span>								</div>
																			</div>
		
							<div class="form-group">
																				<label for="text-input" class="col-sm-4 control-label">Market Type</label>
																				<div class="col-sm-6">

								<select id="marketType" name="rated" class="form-control">
																					<option value="unrated" selected>Unrated</option>
	
									<option value="rated" disabled>Rated</option>
	
								</select>
	
							</div>
																		</div>

						<div class="form-group">
																			<label for="text-input" class="col-sm-4 control-label">Vendor Type</label>
																			<div class="col-sm-6">

								<select id="marketTypes" name="marketType" class="form-control">

									<?php  $_smarty_tpl->tpl_vars['marketType'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['marketType']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['marketTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['marketType']->key => $_smarty_tpl->tpl_vars['marketType']->value){
$_smarty_tpl->tpl_vars['marketType']->_loop = true;
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['marketType']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['marketType']->value['isDisabled']){?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['marketType']->value['description'];?>
</option>
									<?php } ?>
									
								</select>

							</div>
																		</div>

						<div class="form-group">
																			<label for="text-input" class="col-sm-4 control-label">Market</label>
																			<div class="col-sm-6">

								<select id="markets" name="market" class="form-control">
									<?php  $_smarty_tpl->tpl_vars['market'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['market']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['markets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['market']->key => $_smarty_tpl->tpl_vars['market']->value){
$_smarty_tpl->tpl_vars['market']->_loop = true;
?>										<option value="<?php echo $_smarty_tpl->tpl_vars['market']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['market']->value['name'];?>
</option>
									<?php } ?>
									<option value=""></option>

								</select>
	
							</div>
																		</div>

						<div class="form-group">
																			<label for="text-input" class="col-sm-4 control-label">Vendor(s)</label>
																			<div class="col-sm-6 col-md-6 col-lg-6">

								<select id="vendors" name="vendors[]" class="multiselect" multiple="multiple" style="width: 100%;">
									<?php  $_smarty_tpl->tpl_vars['vendor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vendor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vendors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vendor']->key => $_smarty_tpl->tpl_vars['vendor']->value){
$_smarty_tpl->tpl_vars['vendor']->_loop = true;
?>										<option value="<?php echo $_smarty_tpl->tpl_vars['vendor']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['vendor']->value['name'];?>
</option>
									<?php } ?>
																					<option value="0">Other</option>

								</select>
	
							</div>

						</div>

						<div id="vendorReps">
												

						</div>
				
						<div id="grpGoal">

						    <div class="form-group">
																			<label for="text-input" class="col-sm-4 control-label">Total GRP Goal</label>

							<div class="col-sm-2 col-md-3 col-lg-2">
																				<input type="text" id="grpGoal" name="grpGoal" class="form-control">
																			</div>

												
						     </div>

						</div>

						<div id="demoPrimary">

						    <div class="form-group">
																			<label for="text-input" class="col-sm-4 control-label"> Primary Demographic</label>
																			<div class="col-sm-6 col-md-6 col-lg-6">

								<select id="demographics-primary" name="demographic[]" class="form-control">
									<option value=""></option>
									<?php  $_smarty_tpl->tpl_vars['demo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['demo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['demographics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['demo']->key => $_smarty_tpl->tpl_vars['demo']->value){
$_smarty_tpl->tpl_vars['demo']->_loop = true;
?>										<option value="<?php echo $_smarty_tpl->tpl_vars['demo']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['demo']->value['description']){?><?php echo $_smarty_tpl->tpl_vars['demo']->value['description'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['demo']->value['gender'];?>
 <?php echo $_smarty_tpl->tpl_vars['demo']->value['ageFrom'];?>
<?php if ($_smarty_tpl->tpl_vars['demo']->value['ageTo']==0){?>+<?php }else{ ?> - <?php echo $_smarty_tpl->tpl_vars['demo']->value['ageTo'];?>
<?php }?><?php }?></option>
									<?php } ?>
										<option value="">None</option>
								</select>
	
							</div>

						    </div>

						</div>

						<div id="demoSecondary">

						    <div class="form-group" >
																			<label for="text-input" class="col-sm-4 control-label"> Secondary Demographic</label>
																			<div class="col-sm-6 col-md-6 col-lg-6">

								<select id="demographics-secondary" name="demographic[]" class="form-control">
									<option value=""></option>
									<?php  $_smarty_tpl->tpl_vars['demo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['demo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['demographics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['demo']->key => $_smarty_tpl->tpl_vars['demo']->value){
$_smarty_tpl->tpl_vars['demo']->_loop = true;
?>										<option value="<?php echo $_smarty_tpl->tpl_vars['demo']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['demo']->value['description']){?><?php echo $_smarty_tpl->tpl_vars['demo']->value['description'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['demo']->value['gender'];?>
 <?php echo $_smarty_tpl->tpl_vars['demo']->value['ageFrom'];?>
<?php if ($_smarty_tpl->tpl_vars['demo']->value['ageTo']==0){?>+<?php }else{ ?> - <?php echo $_smarty_tpl->tpl_vars['demo']->value['ageTo'];?>
<?php }?><?php }?></option>
									<?php } ?>
										<option value="">None</option>
								</select>
	
							</div>

						    </div>

						</div>

					<div class="form-group" >
							<label for="commission" class="col-sm-4 control-label"> Commission</label>																					<div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
											<input type="text" id="worksheetCommission" name="commission" value="<?php echo $_smarty_tpl->tpl_vars['campaign']->value['commission'];?>
" class="form-control">
									</div>	
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="autoCommGroup">											<input type="checkbox" id="autoComm" name="autoComm"  class="switch" data-on="success" data-off="default" data-on-label="Auto" data-off-label="Man" checked >
									</div>
																	</div>

					<div class="form-group" id="broadcastWeeksGroup">
																		<label for="broadcastWeeks" class="col-sm-4 control-label">Use Broadcast Weeks?</label>
																		<div class="col-sm-2 col-md-3 col-lg-2">
																			<input type="checkbox" id="broadcastWeeks" name="broadcastWeeks"  class="switch" data-on="success" data-off="default" data-on-label="Yes" data-off-label="No"  checked>
						</div>
																	</div>

					<div class="form-group" id="autoPopulateGroup">
																		<label for="autoPopulate" class="col-sm-4 control-label">Auto Populate?</label>
																		<div class="col-sm-2 col-md-3 col-lg-2">
																			<input type="checkbox" id="autoPopulate" name="autoPopulate"  class="switch" data-on="success" data-off="default" data-on-label="Yes" data-off-label="No" <?php if (!$_smarty_tpl->tpl_vars['user']->value['useInventory']){?>disabled<?php }?> >
						</div>
																	</div>

				<div class="form-group">
							<div class="col-sm-12 col-md-12 col-lg-10">
								<div class="pull-right">
									<button type="button" class="btn btn-success" onclick="createWorksheet();">Add Worksheet</button>
								</div>
							</div>
						</div>				
				</div>
							
					</div>


			</div>
			<div id="addWorksheet-footer" class="widget-footer">
			
			</div>
		</div>


								<div class="widget widget-table">
									<div class="widget-header">
										<h3><i class="fa fa-folder"></i> Worksheets</h3>
									</div>
									<div class="widget-content">
										<table id="worksheets" class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%">
											<thead>
												<tr>
												
	<th>Wksht #</th>

	<th>Status</th>

	<th>Name</th>
													<th>Media Type</th>
													<th>Market</th>
													<th>Total Spots</th>
													<th>Total Spend</th>

	<th></th>

	<th></th>

	<th></th>
												</tr>
											</thead>
											<tbody>
<?php  $_smarty_tpl->tpl_vars['worksheet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['worksheet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worksheets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['worksheet']->key => $_smarty_tpl->tpl_vars['worksheet']->value){
$_smarty_tpl->tpl_vars['worksheet']->_loop = true;
?>
												<tr id="worksheet-<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
">
													<td><a href="/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['worksheet']->value['type'])===null||$tmp==='' ? "worksheets" : $tmp);?>
/edit/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
" style="a { color: #333;}"><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
</a></td>
			
	<td><?php if ($_smarty_tpl->tpl_vars['worksheet']->value['isOrdered']){?><?php if ($_smarty_tpl->tpl_vars['worksheet']->value['isCancelled']){?>Cancelled<?php }else{ ?>Ordered<?php }?><?php }else{ ?>Pending<?php }?></td>
	
	<td><a href="/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['worksheet']->value['type'])===null||$tmp==='' ? "worksheets" : $tmp);?>
/edit/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
" style="a { color: #333;}"><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['name'];?>
</a></td>
													<td><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['vendorType'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['marketName'];?>
</td>

	<td><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['totalSpots'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['worksheet']->value['totalSpend'];?>
</td>

	<td><a href="/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['worksheet']->value['type'])===null||$tmp==='' ? "worksheets" : $tmp);?>
/edit/<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
" style="a { color: #333;}"><i class="fa fa-pencil fa-lg" ></i></a></td>

	<td><a href="javascript:copyBox('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" style="a { color: #333;}"> <i class="fa fa-copy fa-lg"></i></a></td>

	<td><a href="javascript:deleteWorksheet('<?php echo $_smarty_tpl->tpl_vars['worksheet']->value['id'];?>
');" style="a { color: #333;}"><i class="fa fa-trash-o fa-lg"></i></a></td>
												</tr>
<?php } ?>
											</tbody>
										</table>
									</div>
			<div id="worksheet-footer" class="widget-footer">
			
			</div>	
							</div>


</div>



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

	

	
		<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.bootstrap.js"></script>
	

	
		<script type="text/javascript" src="/assets/js/fullcalendar.js"></script>
		<script type="text/javascript" src="/assets/js/fullcalendar.min.js"></script>
	

        <script type="text/javascript" src="/lib/gravatar/jquery/md5.js"></script>
        <script type="text/javascript" src="/lib/gravatar/jquery/jquery.gravatar.js"></script>

	

	<script type="text/javascript" src="/assets/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.masked-input.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="/assets/js/parsley.min.js"></script>
	<script type="text/javascript" src="/lib/bootbox/bootbox-4.2.0/bootbox.min.js"></script>

	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/assets/js/datatable/jquery.dataTables.bootstrap.js"></script>

	<script type="text/javascript" src="/assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/assets/js/daterangepicker.js"></script>
	<script type="text/javascript" src="/assets/js/moment.min.js"></script>
    	<script type="text/javascript" src="/lib/select2/select2.js"></script>

	<script>

		function getVendors(marketType, market) {

			$.post( "/vendors/ajax/search/marketandtype/" + marketType + "/" + encodeURI(market) + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
" ,  $( "#addWorksheet" ).serialize(), function() {
				$("#addWorksheet-footer").html("Searching For Vendors...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#addWorksheet-footer").html(response.message);
				if (response.error) {
//					$("#"+response.field).addClass("has-error error");
//					$("#worksheet-name-help").show();
				}
				else {
//					$("#worksheet-name").removeClass("has-error error");
//					$("#worksheet-name-help").hide();
				        $('#vendors').select2("val", "").on("select2-removed", function(vendorRep) { removeVendorRep(vendorRep.val)});
				        var select = $('#vendors').empty();
					  $.each(response.vendors, function(i,item) {
	    					 select.append( '<option value="'
                           			      + item.id
                            			      + '">'
                          			      + item.name
                            			      + '</option>' ); 
   				          });
				}

			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}

		function getDemographics(marketType, marketTypes) {

			$.post( "/demographics/ajax/search/"+marketType+"/" + marketTypes + "/" + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
" ,  function() {
				$("#addWorksheet-footer").html("Loading Demographics...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#addWorksheet-footer").html(response.message);
				if (response.error) {
//					$("#"+response.field).addClass("has-error error");
//					$("#worksheet-name-help").show();
				}
				else {
//					$("#worksheet-name").removeClass("has-error error");
//					$("#worksheet-name-help").hide();

//				        $('#demographics-primary').select2("val", "");
				        var select = $('#demographics-primary').empty();
					 select.append( '<option value=""></option>' ); 
					 $.each(response.demographics, function(i,item) {
	    					 select.append( '<option value="'
                          			      + item.id
                            			      + '">'
                          			      + item.description
                            			      + '</option>' ); 
   				          });
				        var select = $('#demographics-secondary').empty();
					 select.append( '<option value=""></option>' ); 
					 $.each(response.demographics, function(i,item) {
	    					 select.append( '<option value="'
                          			      + item.id
                            			      + '">'
                          			      + item.description
                            			      + '</option>' ); 
   				          });
				}

			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}

		function removeVendorRep(vendorID) {
			$('#vendor-'+vendorID).remove();
			$('#vendorReps-'+vendorID).remove();
		}

		function getVendorReps(vendorID, marketName) {

			$.post( "/vendors/ajax/search/reps/" + vendorID+ "/" + encodeURI(marketName) + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
"  , $( "#addWorksheet" ).serialize(), function() {
				$("#addWorksheet-footer").html("Searching For Vendor Reps...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#addWorksheet-footer").html(response.message);
				if (response.error) {

				}
				else {

				        //$('#vendorReps-'+vendorID).select2("val", "");
				        var select = $('#vendorReps-'+vendorID).select2();
					  $.each(response.vendorReps, function(i,item) {
           					 select.append( '<option value="'
                           			      + item.id
                            			      + '">'
                          			      + item.contactName
                            			      + '</option>' ); 
   				          });
				}

			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}	

		function updateWorksheetFields(vendorType) {

			$.post( "/vendors/ajax/type/" + vendorType + "?PHPSESSID=<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
"  ,  function() {
				$("#addWorksheet-footer").html("Updating Vendor Type...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#addWorksheet-footer").html(response.message);
				if (response.error) {
					
				}
				else {
					if (response.vendorType.isAutoComm >= 1) {
						$("#autoCommGroup").show();
					}
					else {
						$("#autoCommGroup").hide();
					}
					if (response.vendorType.isGoalGRP >= 1) {
						$("#grpGoal").show();		
					}
					else {
						$("#grpGoal").hide();
					}
					if (response.vendorType.isBroadcastWeeks >= 1) {
						$("#broadcastWeeksGroup").show();
					}
					else {
						$("#broadcastWeeksGroup").hide();
					}
					if (response.vendorType.isDemographics >= 1) {
						$("#demoPrimary").show();
						$("#demoSecondary").show();
					}
					else {
						$("#demoPrimary").hide();
						$("#demoSecondary").hide();
					}
				}

			})
			.fail(function(data) {
				$("#worksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#worksheet-footer").html("Error!");
			})

		}

		$(document).ready(function(){

			$("#broadcastWeeks").change(function () {
			    broadcastWeeks();
			}); 

			$("#autoPopulate").change(function () {
			    autoPopulate();
			}); 

			$("#autoComm").change(function () {
			    autoComm();
			}); 	

			$("#client-select").select2({
			    placeholder: "Search Clients",
			    allowClear: true
			});

//			$("#demographics-primary").select2({
//			    placeholder: "Search Demographics",
//			    allowClear: true
//			});

//			$("#demographics-secondary").select2({
//			    placeholder: "Search Demographics",
//			    allowClear: true
//			});

			$("#campaign-form").change(function () {
			    resetFooter(); 
			}); 

			$("#campaignActive").change(function () {
			    resetFooter();
			   campaignActive(); 
			}); 

			$("#markets").change(function () {
				getVendors($("#marketTypes").val(), $("#markets").val());
				$("#vendorReps").html("");
			}); 

			$("#marketType").change(function () {
				$("#vendorReps").html("");
				getVendors($("#marketTypes").val(), $("#markets").val());
				getDemographics($("#marketType").val(), $("#marketTypes").val());
			}); 

			$("#marketTypes").change(function () {
				$("#vendorReps").html("");
				getDemographics($("#marketType").val(), $("#marketTypes").val());
				getVendors($("#marketTypes").val(), $("#markets").val());
				updateWorksheetFields($("#marketTypes").val());
			}); 

		var startDate = new moment("<?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightStart'];?>
");
		var endDate = new moment("<?php echo $_smarty_tpl->tpl_vars['campaign']->value['flightEnd'];?>
");

		$('#flightRange').daterangepicker({
			startDate:  startDate,
			endDate: endDate,
			minDate: '01/01/1999',
			maxDate: '12/31/2019',
			dateLimit: { days: 365 },
			showDropdowns: true,
			showWeekNumbers: true,
			timePicker: false,
			timePickerIncrement: 1,
			timePicker12Hour: true,
			ranges: {
				'Today': [moment(), moment()],
				'Tomorrow': [moment().add('days', 1), moment().add('days', 1)],
				'Next 7 Days': [moment().add('days', 1),moment().add('days', 7)],
				'Next 30 Days': [moment().add('days', 1), moment().add('days', 30)],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Next Month': [moment().add('month', 1).startOf('month'), moment().add('month', 1).endOf('month')]
				},
			opens: 'left',
			buttonClasses: ['btn btn-default'],
			applyClass: 'btn-small btn-primary',
			cancelClass: 'btn-small',
			format: 'MM/DD/YYYY',
			separator: ' to ',
			locale: {
					applyLabel: 'Submit',
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Custom Range',
					daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
					monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
					firstDay: 1
				}
			},

			function(start, end) {

				var startDate = new Date(start);
				var endDate = new Date(end);
				$('#flightRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			
			}
		);

		$('#flightRange span').html(startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY'));
/*
		$('#multiselect4-filter').multiselect({
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			numberDisplayed: 5,
      			includeSelectAllOption: true,
		        includeSelectAllIfMoreThan: 10
		});
*/

			$("#vendors").select2({
			    placeholder: "Search Vendors",
			    allowClear: true
			}).on("select2-removed", function(vendorRep) { removeVendorRep(vendorRep.val)});

			$("#vendors").change(function () {
			   refreshVendorReps(); 
			}); 

			getDemographics($("#marketType").val(), $("#marketTypes").val());
			getVendors($("#marketTypes").val(), $("#markets").val());
			updateWorksheetFields($("#marketTypes").val());
		});

		$('#campaignActive').bootstrapSwitch();
		$('#broadcastWeeks').bootstrapSwitch();
		$('#autoPopulate').bootstrapSwitch();
		$('#autoComm').bootstrapSwitch();

		getVendors($("#marketTypes").val(), $("#markets").val());

	</script>

	<script>


		function createWorksheet() {

			$("#addWorksheet-footer").html("Saving.");

			$.post( "/worksheets/ajax/add/", $( "#addWorksheet" ).serialize(), function() {
				$("#worksheet-footer").html("Saving...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#addWorksheet-footer").html(response.message);
				if (response.error) {
					$("#"+response.field).addClass("has-error error");
					$("#worksheet-name-help").html('');
					$("#worksheet-name-help").show();
				}
				else {
					$("#worksheet-name").removeClass("has-error error");
					$("#worksheet-name-help").hide();
					var newRow = $('#worksheets').dataTable().fnAddData( ["<a href='"+response.newWorksheet.type+"/edit/"+response.newWorksheet.id+"' style='a { color: #333;}'>"+response.newWorksheet.id+"</a>","<a href='"+response.newWorksheet.type+"/edit/"+response.newWorksheet.id+"' style='a { color: #333;}'>"+response.newWorksheet.name+"</a>",response.newWorksheet.vendorType,"","","","","", "<a href='"+response.newWorksheet.type+"/edit/" + response.newWorksheet.id + "' style='a { color: #333;}'><i class='fa fa-pencil fa-lg'></i></a>",  "<a href='javascript:copyBox(" + response.newWorksheet.id + ");' style='a { color: #333;}'><i class='fa fa-copy fa-lg'></i></a>","<a href='javascript:deleteWorksheet(" + response.newWorksheet.id + ");' style='a { color: #333;}'><i class='fa fa-trash-o fa-lg'></i></a>"] );
	
					var wsDataTable = $('#worksheets').dataTable();
					var newRowTR = wsDataTable.fnSettings().aoData[ newRow[0] ].nTr;
					newRowTR.setAttribute("id", "worksheet-" + response.newWorksheet.id);
				}

			})
			.fail(function(data) {
				$("#addWorksheet-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#addWorksheet-footer").html("Error!");
			})

		}

		function resetFooter() {
				$("#campaign-footer").html("Not Saved");
		}

		function campaignActive() {

			if ($("#campaignActive").is(":checked")) {
				$("#campaign-active").val("1");
			}
			else {
				$("#campaign-active").val("0");
			}
		}

		function getDateRange(datepicker, fromField, toField) {

			$(fromField).val($('#flightRange').data('daterangepicker').startDate.format('YYYY-MM-DD'));
			$(toField).val($('#flightRange').data('daterangepicker').endDate.format('YYYY-MM-DD'));
						
		}

		function saveCampaign() {

			getDateRange("#flightRange", "#flightStart", "#flightEnd");
			
			$("#campaign-footer").html("Saving.");

			campaignActive();

			$.post( "/campaigns/ajax/save/<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
", $( "#campaign-form" ).serialize(), function() {
				$("#campaign-footer").html("Saving...");
			})
 			.done(function(data) {
			        var response = jQuery.parseJSON(data);
				$("#campaign-footer").html(response.message);
				if (response.error) {
					$("#"+response.field).addClass("has-error error");
					$("#campaign-name-help").show();

				}
				else {
					$("#campaign-name").removeClass("has-error error");
					$("#campaign-name-help").hide();
				}
				$("#breadcrumb-campaign-name").html($("#campaignName").val());

			})
			.fail(function(data) {
				$("#campaign-footer").html("Connection Failed! Not Saved.");
			})
			.error(function(data) {
				$("#campaign-footer").html("Error!");
			})
		}
	  
	  	function deleteCampaign() {
			  
		  	bootbox.confirm('Are you sure?', function(result) { 

				if (result) {

					$("#campaign-footer").html("Deleting..");

					$.post( "/campaigns/ajax/delete/<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
", $( "#campaign-form" ).serialize(), function() {
						$("#campaign-footer").html("Deleting...");
					})
 					.done(function(data) {
					        var response = jQuery.parseJSON(data);
						$("#campaign-footer").html(response.message);
						if (response.error) {
						}
						else {
							window.location.href="/campaigns/all";
						}
					})
					.fail(function(data) {
						$("#campaign-footer").html("Connection Failed! Not Saved.");
					})
					.error(function(data) {
						$("#campaign-footer").html("Error!");
					})
				}
	 	 	});
	 	 }

		function deleteWorksheet(worksheetID) {
			  
		  	bootbox.confirm('Are you sure?', function(result) { 

				if (result) {

					$("#worksheet-footer").html("Deleting..");

					$.post( "/worksheets/ajax/delete/"+worksheetID, $( "#worksheet-form" ).serialize(), function() {
						$("#worksheet-footer").html("Deleting...");
					})
 					.done(function(data) {
					        var response = jQuery.parseJSON(data);
						$("#worksheet-footer").html(response.message);
						if (response.error) {
							$("#worksheet-footer").html("Delete Failed.");
						}
						else {
							var wsDataTable = $('#worksheets').dataTable();
							wsDataTable.fnDeleteRow(  wsDataTable.$('#worksheet-'+worksheetID)[0] );
//							window.location.href="/campaigns/edit/<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
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

	function copyBox(worksheetID) {
			 
			var worksheetIDStr = "'"+worksheetID + "'";

			var worksheets = "<div class='form-group'><select id='copyCampaign' class='form-control' name='campaign'><option>-Select A Campaign-</option><option value='<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
' selected>-This Campaign-</option><?php  $_smarty_tpl->tpl_vars['campaign'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['campaign']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['campaigns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['campaign']->key => $_smarty_tpl->tpl_vars['campaign']->value){
$_smarty_tpl->tpl_vars['campaign']->_loop = true;
?><option value='<?php echo $_smarty_tpl->tpl_vars['campaign']->value['id'];?>
'><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['campaign']->value['name'],'"','\"');?>
</option><?php } ?></select><br><center><button class='btn btn-success' id='copyCampaignBtn' onclick='copyWorksheet(" + worksheetID + ", $(\"#copyCampaign\").val());'>Copy</button></center></div>"; 

		  	bootbox.alert('Copy this Worksheet to: ' + worksheets);

  	}

	function copyWorksheet(worksheetID, campaignID) {
				if (campaignID) {
					$("#worksheet-footer").html("Copying Worksheet..");

					$.post( "/worksheet/ajax/copy/" + worksheetID + "/"+campaignID, function() {
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

		function refreshVendorReps() {

		         var vendors = $("#vendors").val();
		         var vendorNames = $("#vendors").text();

 			$('#vendors :selected').each(function(i,sel){
			   if ($("#vendorReps-"+$(sel).val()).length) {
			   }
			   else {
				var repHTML = '<div class="form-group"  id="vendor-'+$(sel).val()+'"><label for="text-input" class="col-sm-offset-2 col-sm-2 control-label">'+$(sel).text()+'</label>\
			 				<div class="col-sm-6 col-md-5 col-lg-4">\
								<select id="vendorReps-'+$(sel).val()+'" name="vendorReps[]" class="form-control">\
								</select>\
							</div></div>';

				$('#vendorReps').append(repHTML);
	
				$("#vendorReps-"+$(sel).val()).select2({
				    placeholder: "Search "+$(sel).text()+" Reps",
				    allowClear: true
				});
				getVendorReps($(sel).val(),$("#markets").val()); 
			   }
		       });

		}

		function broadcastWeeks() {

			if ($("#broadcastWeeks").is(":checked")) {
				$("#addWorksheet-footer").html("Broadcast Weeks Turned On.");
				$("#useBroadcastWeeks").val("1");
			}
			else {
				$("#addWorksheet-footer").html("Broadcast Weeks Turned Off.");
				$("#useBroadcastWeeks").val("0");
			}
		}

		function autoPopulate() {

			if ($("#autoPopulate").is(":checked")) {
				$("#addWorksheet-footer").html("Auto Populate Turned On.");
				$("#autoPopulate").val("1");
			}
			else {
				$("#addWorksheet-footer").html("Auto Populate Turned Off.");
				$("#autoPopulate").val("0");
			}
		}

		function autoComm() {

			if ($("#autoComm").is(":checked")) {
				$("#addWorksheet-footer").html("Auto Commission Turned On.");
				$("#isAutoComm").val("1");
				$("#worksheetCommission").attr("disabled",false);
			}
			else {
				$("#addWorksheet-footer").html("Auto Commission Turned Off.");
				$("#isAutoComm").val("0");
				$("#worksheetCommission").attr("disabled","disabled");
			}
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