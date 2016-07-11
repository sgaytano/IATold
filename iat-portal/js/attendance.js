// end time map, migrate to a constant file
var end_time_map = {
		"00:00":"12:00 AM",
		"01:00":"1:00 AM",
		"02:00":"2:00 AM",
		"03:00":"3:00 AM",
		"04:00":"4:00 AM",
		"05:00":"5:00 AM",
		"06:00":"6:00 AM",
		"07:00":"7:00 AM",
		"08:00":"8:00 AM",
		"09:00":"9:00 AM",
		"10:00":"10:00 AM",
		"11:00":"11:00 AM",
		"12:00":"12:00 PM",
		"13:00":"1:00 PM",
		"14:00":"2:00 PM",
		"15:00":"3:00 PM",
		"16:00":"4:00 PM",
		"17:00":"5:00 PM",
		"18:00":"6:00 PM",
		"19:00":"7:00 PM",
		"20:00":"8:00 PM",
		"21:00":"9:00 PM",
		"22:00":"10:00 PM",
		"23:00":"11:00 PM"
}

$(function(){
	$.ajax({
		  type: "POST",
		  url: "AttendanceSchedule/getUserSchedule",
		  data:{name:$("#employee_list").val(),workweek:$("#work_week").val()},
		  success: function(data){
			  userweekdata = jQuery.parseJSON(data)			  
			  $.each(userweekdata, function(index,value){
				  $("#start_time"+index).val(value.starttime);
				  var endtime_tmp = value.endtime;
				  if(endtime_tmp.charAt(String(endtime_tmp).length-1)=='_'){
					  endtime_tmp = endtime_tmp.substr(0,String(endtime_tmp).length-1);
					  console.log(endtime_tmp);
					  $("#end_time_db"+index).val(endtime_tmp);
					  $("#end_time"+index).val(end_time_map[endtime_tmp]);
				  }else{
					  $("#end_time_db"+index).val(value.endtime);
					  $("#end_time"+index).val(end_time_map[value.endtime]);
				  }					  
				  $("#location_choices"+index).val(value.location);
				  if(value.starttime && value.endtime) {
					  $("#total_hours"+index+" h4").html("9 hours");
				  }
			  });
		  }
	});

});

function userdropdownChange(){
	$.each([0,1,2,3,4,5,6], function(index,value){
		  $("#start_time"+index).val("");
		  $("#end_time"+index).val("");
		  $("#end_time_db"+index).val("");
		  $("#total_hours"+index+" h4").html("");
	});
	
	$.ajax({
		  type: "POST",
		  url: "AttendanceSchedule/getUserSchedule",
		  data:{name:$("#employee_list").val(),workweek:$("#work_week").val()},
		  success: function(data){
			  userweekdata = jQuery.parseJSON(data)			  
			  $.each(userweekdata, function(index,value){
				  $("#start_time"+index).val(value.starttime);
				  var endtime_tmp = value.endtime;
				  if(endtime_tmp.charAt(String(endtime_tmp).length-1)=='_'){
					  endtime_tmp = endtime_tmp.substr(0,String(endtime_tmp).length-1);
					  console.log(endtime_tmp);
					  $("#end_time_db"+index).val(endtime_tmp);
					  $("#end_time"+index).val(end_time_map[endtime_tmp]);
				  }else{
					  $("#end_time_db"+index).val(value.endtime);
					  $("#end_time"+index).val(end_time_map[value.endtime]);
				  }		  
				  $("#location_choices"+index).val(value.location);
				  if(value.starttime && value.endtime) {
					  $("#total_hours"+index+" h4").html("9 hours");
				  }
			  });
		  }
	});	
}

function locationChange(target) {
	  $("#start_time"+target).val("");
	  $("#end_time"+target).val("");
	  $("#end_time_db"+target).val("");
	  $("#total_hours"+target+" h4").html("");	
}

// StartTimeChange
function startTimeChange(target) {
	
	var startTime = $("#start_time"+target).val();
	time_array = startTime.split(":");
	incremented = Number(time_array[0]) + 9;
	
	if(incremented >= 24) {incremented = incremented - 24;$("#end_time_nextday"+target).val("1");} else {$("#end_time_nextday"+target).val("0");};
	if(incremented.toString().length ==1){incremented="0"+incremented;}
	$("#end_time"+target).val(end_time_map[incremented+":00"]);
	$("#end_time_db"+target).val(incremented+":00");
	
	if($("#start_time"+target).val() !="" || $("#end_time"+target).val() !="") {
		total_hrs = Number(time_array[0]) - incremented;
		$("#total_hours"+target+" h4").html("9 hours");
	} else {
		total_hrs = Number(time_array[0]) - incremented;
		$("#total_hours"+target+" h4").html("");		
	}
	
	$("#start_time"+target).val(time_array[0]+":00");
	
	if(!startTime.trim()) {
		$("#end_time"+target).val("");
		$("#end_time_db"+target).val("");
		$("#total_hours"+target+" h4").html("");
	}	
	

}


function changeWorkWeek(dp){
	workweek = $(dp).val();
	workweek_array = workweek.split(",");
	window.location = "AttendanceSchedule/redirectWorkWeek/"+workweek_array[0];
}



function populateall() {
	
	populatetoall = confirm("SAME ENTRIES FROM MONDAY TO FRIDAY?");
	
	if(populatetoall==true){
	
	for(i=0;i<5;i++){
		var startTime = $("#start_time0").val();
		var locationChoice = $("#location_choices0").val();
		
		$("#location_choices"+i).val(locationChoice);
		
		
		time_array = startTime.split(":");
		incremented = Number(time_array[0]) + 9;
		
		if(incremented >= 24) {incremented = incremented - 24;$("#end_time_nextday"+i).val("1");} else {$("#end_time_nextday"+i).val("0");};
		if(incremented.toString().length ==1){incremented="0"+incremented;}
		$("#end_time"+i).val(end_time_map[incremented+":00"]);
		$("#end_time_db"+i).val(incremented+":00");
		
		if($("#start_time"+i).val() !="" || $("#end_time"+i).val() !="") {
			total_hrs = Number(time_array[0]) - incremented;
			$("#total_hours"+i+" h4").html("9 hours");
		} else {
			total_hrs = Number(time_array[0]) - incremented;
			$("#total_hours"+i+" h4").html("");
		}
		
		$("#start_time"+i).val(time_array[0]+":00");
		
	}
	} else {
		//do nothing..
	}
	
	
}

//endtime
function endTimeChange(target) {
	alert("endtime called");
	
	if($("#end_time"+target).val() !="") {
		$("#total_hours"+target+" h4").html("9 hours");
	} else {
		$("#total_hours"+target+" h4").html("");		
	}
}