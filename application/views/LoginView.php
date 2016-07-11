<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Innovation Team Portal</title>
<link rel="stylesheet" href="<?php echo base_url() ?>css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="<?php echo base_url() ?>js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="<?php echo base_url() ?>js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="<?php echo base_url() ?>js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<form method="post" action="<?php echo base_url(); ?>index.php/LoginController/processLogin">
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text" id="username" name="username" class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" id="password" name="password" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" class="submit-login"  /></td>
		</tr>		
		
		</table>
		<label style="color: red;"><?php echo validation_errors(); ?></label>
		<label style="color: red;"><?php echo $login_error; ?></label>
	</div>
	</form>

 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>
 <!--  end loginbox -->
 


</div>
<!-- End: login-holder -->
</body>
</html>