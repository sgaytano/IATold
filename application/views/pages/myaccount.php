<div id="content">


<div id="page-heading"><h1>My Account - Change Password</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tbody><tr>
	<th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowleft.jpg" width="20" height="300" alt=""></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowright.jpg" width="20" height="300" alt=""></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	<form action="<?php echo base_url(); ?>index.php/MyAccount/changepassword" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tbody><tr valign="top">
	<td>
	

	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0" id="id-form">
		<tbody>

		<tr>
			<th valign="top">New Password:</th>
			<td><input name="npassword" class="inp-form" type="password"></td>
			<td></td>
		</tr>		
		<tr>
			<th valign="top">Re-Type New Password:</th>
			<td><input name="ncpassword" class="inp-form" type="password"></td>
			<!-- td><input type="text" class="inp-form-error"></td -->
			<td>
			<!--div class="error-left"></div>
			<div class="error-inner">This field is required.</div -->
			</td>
		</tr>


	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit">
		</td>
		<td></td>
	</tr>
	
	</tbody></table>
	<!-- end id-form  -->
	</form>
	<label style="color: red;"><?php echo validation_errors(); ?></label>
	<label style="color: green;"><?php echo $save_msg; ?></label>
	</td>
	<td>
	
	

</td>
</tr>
<tr>
<td><img src="<?php echo base_url(); ?>images/shared/blank.gif" width="695" height="1" alt="blank"></td>
<td></td>
</tr>
</tbody></table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</tbody></table>









 





<div class="clear">&nbsp;</div>

</div>