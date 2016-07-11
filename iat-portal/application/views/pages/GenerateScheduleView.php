<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Generate Schedule</h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="<?php echo base_url(); ?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">

			<form method="post" action="<?php echo base_url(); ?>index.php/AttendanceSchedule/ProcessGenerateSchedule">
			<!--  start table-content  -->
			<div id="table-content">		
		 
				<!--  start product-table ..................................................................................... -->
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Days</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Location</a></th>
					<th class="table-header-repeat line-left"><a href="">Start Time</a></th>
					<th class="table-header-repeat line-left"><a href="">End Time</a></th>
					<th class="table-header-repeat line-left"><a href=""> Total Hours</a></th>
				</tr>
				<?php $num_rows = 0;?>
				<?php foreach ($days as $day) {?>
				<tr>
						<td><?php echo $day; ?></td>
						<td>
						<select name="location_choices<?php echo $num_rows; ?>" id="location_choices<?php echo $num_rows; ?>">
							<?php foreach ($locations as $location) {?>
								<option value="<?php echo $location; ?>"><?php echo $location;?><option>
							<?php } ?>
						</select>
						</td>
						<td><input type="time" id="start_time<?php echo $num_rows;?>" name="start_time<?php echo $num_rows;?>" onchange="startTimeChange(<?php echo $num_rows;?>)"/></td>
						<td name="end_time_td<?php echo $num_rows;?>" id="end_time_td<?php echo $num_rows;?>"><input type="time" id="end_time<?php echo $num_rows;?>" name="end_time<?php echo $num_rows;?>"></span></td>
						<td name="total_hours<?php echo $num_rows;?>" id="total_hours<?php echo $num_rows;?>"><h4></h4></td>					
				</tr>
				<?php $num_rows++; ?>
				<?php } ?>
				</table>
				
				<div id="action-button">
					<input type="submit" class="form-submit">	
				</div>
							
				<!--  end product-table................................... --> 
				
			</div>
			<!--  end content-table  -->
			</form>
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->