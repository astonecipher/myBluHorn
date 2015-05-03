<?php /* Smarty version Smarty-3.1.13, created on 2013-10-01 14:17:03
         compiled from "db:cal_forgot" */ ?>
<?php /*%%SmartyHeaderCode:167650228524913b5395df8-58052435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77eaa0e9a8c8466f67b92510eee0df681caa49d3' => 
    array (
      0 => 'db:cal_forgot',
      1 => 1380588805,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1380534914,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '167650228524913b5395df8-58052435',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524913b5416a71_96296226',
  'variables' => 
  array (
    'navHomeActive' => 0,
    'navCreateActive' => 0,
    'navManageActive' => 0,
    'navShareActive' => 0,
    'navSupportActive' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524913b5416a71_96296226')) {function content_524913b5416a71_96296226($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/buzz/">
    <meta charset="utf-8">
    <title>BUZZ Calendar Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<meta http-equiv="cache-control" content="no-cache"> 
<meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/> 
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

    <!-- Le styles -->
    <link href="/buzz/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/buzz/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/buzz/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/buzz/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/buzz/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/buzz/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/buzz/=/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/buzz/assets/ico/favicon.png">

   


   

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">BUZZ Calendar</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/home">Home</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navCreateActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/add">Create</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navManageActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/manage">Manage</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navShareActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/share">Share</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navSupportActive']->value){?> class="active" <?php }?>><a href="/buzz/calendar/support">Support</a></li>
              <li><a href="/buzz/calendar/logout">Logout</a></li>
            </ul>
          </div>



        </div>
      </div>
    </div>

    <div class="container">




<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
			<legend>Forgot your password?</legend>
          	<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?>
		<div class="alert alert-error">
                <a class="close" data-dismiss="alert" href="#">×</a>Please enter a valid username or email address.
                </div>
  		<?php }?>
			<form method="POST" action="/buzz/calendar/forgot" accept-charset="UTF-8">
			<input type="text" id="username" class="span4" name="username" placeholder="Username or Email Address">

		<button type="submit" name="submit" class="btn btn-info btn-block">Reset Password</button>
			</form>    

		<div class="toolbar"><div class="pull-left"><i class="icon-arrow-left" style="opacity: .45;"></i><a href="calendar/login"> Login?</a></div><div class="pull-right"><a href="calendar/signup">New Account? </a><i class="icon-arrow-right" style="opacity: .45;"></i></div></div>

		</div>

	</div>
</div>


 <div id="recaptcha_widget" style="display:none">

   <div id="recaptcha_image"></div>
   <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

   <span class="recaptcha_only_if_image">Enter the words above:</span>
   <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>

   <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />

   <div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
   <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
   <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>

   <div><a href="javascript:Recaptcha.showhelp()">Help</a></div>

 </div>

 




    </div>


    <script type="text/javascript" src="/js/jquery-1.8.1.min.js"></script>

    <script type="text/javascript" src="/js/bootstrap.min.js"/></script>
 
    



  </body>
</html>



<?php }} ?>