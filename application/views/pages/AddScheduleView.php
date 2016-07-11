<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Submitted Schedule</h1>
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
		<form method="post" action="<?php echo base_url(); ?>index.php/AttendanceSchedule/ProcessAddSchedule">
		<div id="content-table-inner">	

		<?php if( $schedule_generated == true) {?>
		<!--  start message-yellow -->
		<div id="message-yellow">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td class="yellow-left">Schedule Generated, Email Sent </td>
			<td class="yellow-right"><a class="close-yellow"><img src="<?php echo base_url(); ?>images/table/icon_close_yellow.gif"   alt="" /></a></td>
		</tr>
		</table>
		</div>
		<?php } ?>
		<!--  end message-yellow -->	
		
		<!--  start message-green -->
		<?php if( $schedule_saved == true) {?>
		<div id="message-green">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td class="green-left">New Schedule Saved !</td>
			<td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/table/icon_close_green.gif"   alt="" /></a></td>
		</tr>
		</table>
		</div>
		<?php } ?>
		<!--  end message-green -->		
		

			<div id="actions-box-employee">
				<h2>Work Week:</h2>
				<input type="hidden" name="work_week" id="work_week" value="<?php echo $work_week_num; ?>"/>

				<select id="work_week_dp" name="work_week_dp" onchange="changeWorkWeek(this);">
					<?php foreach ($work_week as $key=>$values) {?>
						<?php if($this->session->userdata("workweek")==$key){?>
						<option value="<?php echo $key; ?>" selected><?php echo $values; ?></option>
						<?php } else {?>
						<option value="<?php echo $key; ?>"><?php echo $values; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
							
				<div class="clear"></div>
			</div>

		
			<!--  start table-content  -->
			<div id="table-content">
			
		 
				<!--  start product-table ..................................................................................... -->
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
				<th class="table-header-repeat line-left"><a href="">Employee</a></th>
				<?php $num_rows = 0;?>
				<?php foreach ($days as $day) {?>
					<th class="table-header-repeat line-left"><a href=""><?php echo $day; ?>  (<?php echo $week_dates[$num_rows]; ?>)</a></th>
				<?php $num_rows++; ?>
				<?php } ?>
				</tr>
				<?php $num_rows = 0;?>
				<?php foreach ($employee_data as $employee) {?>
				<tr>
						<td><?php echo $employee; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Monday'])){echo $employee_work_days[$employee]['Monday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Tuesday'])){ echo $employee_work_days[$employee]['Tuesday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Wednesday'])){ echo $employee_work_days[$employee]['Wednesday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Thursday'])){  echo $employee_work_days[$employee]['Thursday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Friday'])){ echo $employee_work_days[$employee]['Friday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Saturday'])){ echo $employee_work_days[$employee]['Saturday']; }; ?></td>
						<td><?php if(isset($employee_work_days[$employee]['Sunday'])){ echo $employee_work_days[$employee]['Sunday']; }; ?></td>					
				</tr>
				<?php $num_rows++; ?>
				<?php } ?>
				</table>
							
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
			
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






<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Add Schedule</h1>
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
		<form method="post" action="<?php echo base_url(); ?>index.php/AttendanceSchedule/ProcessAddSchedule">
		<div id="content-table-inner">


			<div id="actions-box-employee">
				<h2>Employee:</h2>
				
				<?php if($access_level == 1 ) {?>
				<select id="employee_list" name="employee_list" onchange="userdropdownChange()">
					<?php foreach ($employee_data as $employee) {?>
						<option value="<?php echo $employee; ?>"><?php echo $employee; ?></option>
					<?php } ?>
				</select>								
				<?php } else {?>
				<select id="employee_list" name="employee_list">
						<option value="<?php echo $current_user_fullname; ?>"><?php echo $current_user_fullname; ?></option>
				</select>				
				<?php } ?>
				<div class="clear"></div>
			</div>
			<input type="hidden" name="work_week" id="work_week" value="<?php echo $work_week_num; ?>"/>
			
		
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
						<td>
						<input type="hidden" name="weekdates<?php echo $num_rows; ?>" id="weekdates<?php echo $num_rows; ?>" value="<?php echo $week_dates[$num_rows]; ?>">
						<?php echo $day; ?>  (<?php echo $week_dates[$num_rows]; ?>)
						</td>
						<td>
						<select name="location_choices<?php echo $num_rows; ?>" id="location_choices<?php echo $num_rows; ?>" onchange="locationChange(<?php echo $num_rows;?>)">
							<?php foreach ($locations as $location) {?>
								<option value="<?php echo $location; ?>"><?php echo $location;?></option>
							<?php } ?>
						</select>
						</td>

						<td>
							<select onchange="startTimeChange(<?php echo $num_rows;?>)" id="start_time<?php echo $num_rows;?>" name="start_time<?php echo $num_rows;?>" <?php if( $num_rows==0) { ?>onfocusout="populateall()" <?php } ?>">
								<option value="">Select Time</option>
								<?php foreach($timemap as $key=>$value) {?>
								<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						</td>
						<td name="end_time_td<?php echo $num_rows;?>" id="end_time_td<?php echo $num_rows;?>"><input type="text" id="end_time<?php echo $num_rows;?>" name="end_time<?php echo $num_rows;?>" onchange="endTimeChange(<?php echo $num_rows;?>)" readonly="readonly"><input type="hidden" id="end_time_nextday<?php echo $num_rows;?>" name="end_time_nextday<?php echo $num_rows;?>" value="0"><input type="hidden" id="end_time_db<?php echo $num_rows;?>" name="end_time_db<?php echo $num_rows;?>" value=""/></td>
						<td name="total_hours<?php echo $num_rows;?>" id="total_hours<?php echo $num_rows;?>"><h4></h4></td>					
				</tr>
				<?php $num_rows++; ?>
				<?php } ?>
				</table>
				
				<div id="action-button">
					<input type="submit" value="" class="form-submit">	
				</div>
							
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
			
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