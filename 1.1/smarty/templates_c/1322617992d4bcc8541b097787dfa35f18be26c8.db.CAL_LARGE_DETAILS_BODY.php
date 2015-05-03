<?php /* Smarty version Smarty-3.1.13, created on 2014-01-02 09:20:36
         compiled from "db:cal_large_details_body" */ ?>
<?php /*%%SmartyHeaderCode:125009733852a2199d6745b6-56959379%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1322617992d4bcc8541b097787dfa35f18be26c8' => 
    array (
      0 => 'db:cal_large_details_body',
      1 => 1388672418,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '125009733852a2199d6745b6-56959379',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a2199d695346_03482521',
  'variables' => 
  array (
    'event' => 0,
    'bGeocoded' => 0,
    'address' => 0,
    'sLat' => 0,
    'sLon' => 0,
    'lat' => 0,
    'lon' => 0,
    'events' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a2199d695346_03482521')) {function content_52a2199d695346_03482521($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/usr/local/lib/Smarty-3.1.13/libs/plugins/modifier.replace.php';
?>

  <div class="hide" id="address" style="display: none; visibility: hidden;"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
 <?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</div>
			<div class="heading-block ie-fix">
				<a href='javascript:calendarBackToSearch("<?php echo $_smarty_tpl->tpl_vars['event']->value['eventID'];?>
");' class="link-back">Back to search</a>
			</div><!-- end heading-block -->
			<div class="info-section">
				<div class="event-detailed">
					<div class="holder">
						<div class="img">
							<img src="http://www.filelogix.com/buzz/images/categories/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['squareImg'])===null||$tmp==='' ? "Blue_COMMUNITY.png" : $tmp);?>
" width="170" height="161" alt="image" />
						</div><!-- end img -->
								<h1 style="width: 400px; display: inline; position: relative; top: 10px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['sTitle'];?>
</h1>
						<div class="description">
							<div class="box" style="width:405px;">
								<div class="social">
									<ul>
										<li><a href="#" class="facebook">facebook</a></li>
										<li><a href="#" class="twitter">twitter</a></li>
									</ul>
								</div><!-- end social -->
								<div class="frame">
									<div id="map" style="height: 250px; width: 250px; float: right; padding-left: 10px; margin-left: 10px;">
<?php if ($_smarty_tpl->tpl_vars['bGeocoded']->value){?>
										<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=near&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=<?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['lon']->value;?>
&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=<?php echo $_smarty_tpl->tpl_vars['sLat']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['sLon']->value;?>
&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small><p>Location Geocoded</p>

<?php }else{ ?>
<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=near&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;aq=0&amp;oq=Jackson&amp;sll=27.698638,-83.804601&amp;sspn=22.921151,22.895508&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
&amp;t=m&amp;ll=30.332583,-81.655884&amp;spn=0.355589,0.411987&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small><p>Location Not Geocoded</p>



<?php }?>
	
									</div><!-- end map -->

									<div class="desc">
										<div class="section">
											<strong class="title" style="padding: 0px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>
</strong>
											<p><?php echo $_smarty_tpl->tpl_vars['event']->value['zAddress'];?>
</p>
											<p><?php echo $_smarty_tpl->tpl_vars['event']->value['sCity'];?>
, <?php echo $_smarty_tpl->tpl_vars['event']->value['sState'];?>
  <?php echo $_smarty_tpl->tpl_vars['event']->value['sZipcode'];?>
</p>
										</div><!-- end section -->
										<p><?php echo $_smarty_tpl->tpl_vars['events']->value['phoneNumber'];?>
</p>
										<p><a href="http://<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['event']->value['uWebsite'],'http://','');?>
">Website</a></p>
										<div class="email">
											<a href="mailto:">EMAIL US</a>
										</div><!-- end email -->
									</div><!-- end desc -->
								</div><!-- end frame -->
							</div><!-- end box -->
							<div class="block">
								<span class="category" style="padding-left: 3px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>
</span>
								<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartDate'];?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tEndDate'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp1==$_tmp2){?> 
								<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['tDateStr'];?>
</em>
								<?php }else{ ?>
								<em class="date"><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartDate'];?>
 - <?php echo $_smarty_tpl->tpl_vars['event']->value['tEndDate'];?>
</em>
								<?php }?>
								<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['event']->value['tEndTime'];?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp3==$_tmp4){?> 
								<em class="time">Starts at <?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
</em>
								<?php }else{ ?>
								<em class="time"><?php echo $_smarty_tpl->tpl_vars['event']->value['tStartTime'];?>
 - <?php echo $_smarty_tpl->tpl_vars['event']->value['tEndTime'];?>
</em>
								<?php }?>
								<dl>
									<dt>Cost:</dt><dd><?php if ($_smarty_tpl->tpl_vars['event']->value['bFree']){?>FREE!<?php }else{ ?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['event']->value['cost'])===null||$tmp==='' ? "TBA" : $tmp);?>
<?php }?></dd>
								</dl>
								<a href="#" class="btn-buy ie-fix">Buy Tickets</a>
								<a href="#" class="btn-contact ie-fix">Contact Venue<i>&nbsp;</i></a>
							</div><!-- end block -->
						</div><!-- end description -->
					</div><!-- end holder -->
					<div class="txt">
						<p style="font-size:18px/22px;"><?php echo $_smarty_tpl->tpl_vars['event']->value['sDetails'];?>
</p>
					</div><!-- end txt -->
				</div><!-- end event-detailed -->
				<ul class="direction-nav direction-nav2">
					<li><a href="#" class="prev">view previous</a></li>
					<li><a href="#" class="next">View more</a></li>
				</ul><!-- end direction-nav -->
			</div><!-- end info-section -->

<?php }} ?>