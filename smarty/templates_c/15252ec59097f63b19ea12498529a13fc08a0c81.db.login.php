<?php /* Smarty version Smarty-3.1.13, created on 2015-05-01 08:45:10
         compiled from "db:login" */ ?>
<?php /*%%SmartyHeaderCode:1819438656554375564284a9-83537588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15252ec59097f63b19ea12498529a13fc08a0c81' => 
    array (
      0 => 'db:login',
      1 => 1407735354,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1819438656554375564284a9-83537588',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base' => 0,
    'alertError' => 0,
    'errorMsg' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5543755671da78_07108672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5543755671da78_07108672')) {function content_5543755671da78_07108672($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
	<base href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['base']->value)===null||$tmp==='' ? "/bluhorn/" : $tmp);?>
">
	<title>Login | BluHorn - Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="BluHorn Dashboard">
	<meta name="author" content="BluHorn">

	<!-- CSS -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/main.css" rel="stylesheet" type="text/css">

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/kingboard-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/kingboard-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/kingboard-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/ico/kingboard-favicon57x57.png">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

</head>

<body>
	<div class="full-page-wrapper page-login text-center">

		<div class="inner-page">

			<div class="logo">
				<a href="/">
					<img src="assets/img/kingboard-logo.png" alt="" />
				</a>
			</div>

			<div class="login-box center-block">
				<form action="/login/go" method="post">
					<p class="title">Use your Username or Email Address</p>
					<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?>
						<div class="alert alert-danger" role="alert"><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div>
					<?php }?>
					<div class="input-group">
						<input type="text" name="username" placeholder="username" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
					</div>
					<div class="input-group">
						<input type="password" name="password" placeholder="password" class="form-control">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					</div>
					<div class="simple-checkbox hidden">
						<input type="checkbox" id="checkbox1">
						<label for="checkbox1">Remember me next time</label>
					</div>
					<button class="btn btn-custom-primary btn-lg btn-block btn-login"><i class="fa fa-arrow-circle-o-right"></i> Login</button>
				</form>

				<div class="links">
					<p><a href="/login/forgot">Forgot Username or Password?</a></p>
					<p><a href="/login/register">Create New Account</a></p>
				</div>
			</div>
		</div>

		<footer class="footer">&copy; 2014 BluHorn (powered by FileLogix)</footer>

	</div>

	<!-- Javascript -->
	<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr.js"></script>

</body>

</html><?php }} ?>