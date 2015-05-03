<?php /* Smarty version Smarty-3.1.13, created on 2013-10-03 10:29:28
         compiled from "db:cal_signup" */ ?>
<?php /*%%SmartyHeaderCode:1503326324524913febe0327-77607974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e50575ffb3a76617adf1de154c999b28fb899a06' => 
    array (
      0 => 'db:cal_signup',
      1 => 1380672359,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1380673290,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1503326324524913febe0327-77607974',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524913fec68699_64725879',
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
<?php if ($_valid && !is_callable('content_524913fec68699_64725879')) {function content_524913fec68699_64725879($_smarty_tpl) {?><!DOCTYPE html>
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
          <a class="brand" href="calendar/home">BUZZ Calendar</a>
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
			<legend>Sign Up for an Account</legend>
          	<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?>
			<div class="alert alert-error">
                		<a class="close" data-dismiss="alert" href="#">×</a><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>

                		</div>
  		<?php }?>
          	<?php if ($_smarty_tpl->tpl_vars['alertSuccess']->value){?>
			<div class="alert alert-success">
                		<?php echo $_smarty_tpl->tpl_vars['successMsg']->value;?>

                		</div>
  		<?php }?>		
			<div class="<?php echo $_smarty_tpl->tpl_vars['signUpHide']->value;?>
" id="signup">
			<form method="POST" action="/buzz/calendar/signup" accept-charset="UTF-8">
			<label>Email Address?</label>
			<input type="text" id="emailAddress" class="input span4" name="emailAddress" placeholder="Email Address">
			<label>First Name?</label>
			<input type="text" id="firstName" class="input span4" name="firstName" placeholder="First Name">
			<label>Last Name?</label>
			 <input type="text" id="lastName" class="input span4" name="lastName" placeholder="Last Name">
									

			<button type="submit" name="submit" class="btn btn-info btn-block">Sign Up</button>
			</form>    
		</div>
<br>
		<div class="toolbar"><div class="pull-left"><i class="icon-arrow-left" style="opacity: .45;"></i><a href="calendar/forgot"> Forgot Password?</a></div><div class="pull-right"><a href="calendar/login">Login? </a><i class="icon-arrow-right" style="opacity: .45;"></i></div></div>

		</div>

	</div>
</div>






    </div>


    <script type="text/javascript" src="/js/jquery-1.8.1.min.js"></script>

    <script type="text/javascript" src="/js/bootstrap.min.js"/></script>
 
    



  </body>
</html>



<?php }} ?>