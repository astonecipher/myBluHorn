<?php /* Smarty version Smarty-3.1.13, created on 2013-09-30 12:29:20
         compiled from "db:login" */ ?>
<?php /*%%SmartyHeaderCode:1095246394524036a1869762-10186311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15252ec59097f63b19ea12498529a13fc08a0c81' => 
    array (
      0 => 'db:login',
      1 => 1380529642,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1095246394524036a1869762-10186311',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524036a188b163_65367628',
  'variables' => 
  array (
    'sessionID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524036a188b163_65367628')) {function content_524036a188b163_65367628($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login Page - The BUZZ Backend</title>
		<base href="/buzz/">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="assets/js/ace-extra.min.js"></script>
	</head>

	<body class="login-layout skin-2">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="_icon-leaf green"></i>
										<span class="blue">CFM</span>
										<span class="white"> System Administration</span>
									</h1>
									<h4 class="white">cfmedia.com &copy; iwantabuzz.com </h4>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Please Enter Your Information
												</h4>

												<div class="space-6"></div>

												<form name="login" id="login" method="post" action="/buzz/login/go/<?php echo $_smarty_tpl->tpl_vars['sessionID']->value;?>
">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" placeholder="Username" name="username" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Password" name="password" />
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
															<label class="inline">
																<input type="checkbox" class="ace" />
																<span class="lbl"> Remember Me</span>
															</label>

															<button onclick="this.submit()" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
														</div>

														<div class="space-4"></div>
													</fieldset>
												</form>

												<div class="social-or-login center">
													<span class="bigger-110">Or Login Using</span>
												</div>

												<div class="social-login center">
													<a class="btn btn-primary">
														<i class="icon-facebook"></i>
													</a>

													<a class="btn btn-info">
														<i class="icon-twitter"></i>
													</a>

													<a class="btn btn-danger">
														<i class="icon-google-plus"></i>
													</a>
												</div>
											</div><!--/widget-main-->

											<div class="toolbar clearfix">
												<div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														I forgot my password
													</a>
												</div>

												<div>
													<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
														I want to register
														<i class="icon-arrow-right"></i>
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Retrieve Password
												</h4>

												<div class="space-6"></div>
												<p>
													Enter your email and to receive instructions
												</p>

												<form>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="email" class="span12" placeholder="Email" />
																<i class="icon-envelope"></i>
															</span>
														</label>

														<div class="clearfix">
															<button onclick="return false;" class="width-35 pull-right btn btn-small btn-danger">
																<i class="icon-lightbulb"></i>
																Send Me!
															</button>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													Back to login
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->

									<div id="signup-box" class="signup-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header green lighter bigger">
													<i class="icon-group blue"></i>
													New User Registration
												</h4>

												<div class="space-6"></div>
												<p> Enter your details to begin: </p>

												<form>
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="email" class="span12" placeholder="Email" />
																<i class="icon-envelope"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" placeholder="Username" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Password" />
																<i class="icon-lock"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Repeat password" />
																<i class="icon-retweet"></i>
															</span>
														</label>

														<label>
															<input type="checkbox" class="ace" />
															<span class="lbl">
																I accept the
																<a href="#">User Agreement</a>
															</span>
														</label>

														<div class="space-24"></div>

														<div class="clearfix">
															<button type="reset" class="width-30 pull-left btn btn-small">
																<i class="icon-refresh"></i>
																Reset
															</button>

															<button onclick="return false;" class="width-65 pull-right btn btn-small btn-success">
																Register
																<i class="icon-arrow-right icon-on-right"></i>
															</button>
														</div>
													</fieldset>
												</form>
											</div>

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													<i class="icon-arrow-left"></i>
													Back to login
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/signup-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
	</body>
</html>
<?php }} ?>