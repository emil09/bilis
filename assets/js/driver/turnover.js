var num = '';
var dsp_no = '';
$(function(){
	get_active_trips();
	get_turnover_location();
	$(".screen" ).focus();
	var floorValue = 0;
	var remainder = 0;
	var newValue = 0;
	$("#calculator button").click(function(e) {
		if ($(this).val() != "C" && $(this).val() != "OK") {
			num += $(this).val();

			var valid = /^\d*(\.\d{0,2})?$/.test(num);
		    if(!valid){
		        num = num.substring(0, num.length - 1)
		    }
		    else {
		    	if(num.indexOf(".")!=-1) {
		    		floorValue = Math.floor(parseFloat(num));
		    		remainder = num - floorValue;
		    		if (remainder < 0.325) {
		    			if (remainder < 0.125) {
		    				newValue = floorValue;
		    			} else {
		    				newValue = floorValue + 0.25;
		    			}
		    		} else {
		    			if (remainder < 0.625) {
		    				newValue = floorValue + 0.5;
		    			} else if (remainder < 0.875) {
		    				newValue = floorValue + 0.75;
		    			} else {
		    				newValue = floorValue + 1;
		    			}
		    		}
		    		$(".screen").val(newValue);
		    		$("#amt").html(newValue);
		    	}
				if(newValue ==0) {
					$(".screen").val(num);
					$("#amt").html(num);
				}
		    }
		}
		else if ($(this).val() == "C") {
			$(".screen").val("");
			$("#amt").html('');
			num = '';
			newValue = 0;
			floorValue = 0;
			remainder = 0;
		}
	});

	$(".screen").keyup(function (e) {

			var valid = /^\d*(\.\d{0,2})?$/.test(this.value),
		        val = this.value;

		    if(!valid){
		        console.log("Invalid input!");
		        this.value = val.substring(0, val.length - 1);
		    }
			$("#amt").html(this.value);

   	});
});

function get_turnover_location(){

	$.get("cashturnover/turnover_location", function(data, status){
		var loc_data = '';
		loc_data = '<option value="" selected disabled>Select your location</option>';
		for (var i=0; i<parseInt(data.location.length);i++) {
			loc_data += '<option value="'+data['location'][i]['loc_no_fk']+'">'+data['location'][i]['loc_name']+'</option>'
		}
		$('#loc_select').html(loc_data);
		//     $('.turnoverbutton').attr('id', trip_ctr);
		// 	$("#amt").html(0);
		// }
    });
}

function get_active_trips(){

	$.get("cashturnover/active_trip", function(data, status){
		var test ='';
		if(data.driver.length > 0){
			var tempctr = parseInt(data['trip'].length) -1;
			dsp_no = data['driver'][0]['dsp_unit_no'];
			if(data.trip.length > 0) {
				test = data['trip'][tempctr]['trips_ctr'];
				trip_ctr = parseInt(data['trip'][tempctr]['trips_ctr']) + 1;
			} else { trip_ctr=1; }
			
			var table_data = '<tr>'+
							'<th>Shift</th>'+
							'<td>'+ data['driver'][0]['shift_name'] +' Shift </td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Trip</th>'+
							'<td>' + trip_ctr + '</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Route</th>'+
							'<td>'+data['driver'][0]['rte_nam']+'</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Unit</th>'+
							'<td>'+data['driver'][0]['unt_lic']+'</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Amount</th>'+
							'<td><span id="amt"></span></td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Departure</th>'+
							'<td>'+ formatDate(data['driver'][0]['start_dt']) +' ' + 
							formatAMPM(data['driver'][0]['start_dt'] + ' ' + data['driver'][0]['start_time']) +'</td>'+
		                '</tr>';
		    $('#act_table').html(table_data);
		    $('.turnoverbutton').attr('id', trip_ctr);
			$("#amt").html(0);
		}else{
			swal({   
        	title: 'No Active Trip.',
        	text: 'Please Contact your Dispatcher',
        	type: 'warning',
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'Ok',
        	closeOnConfirm: true
	        }, function() {  
	        	console.log('no_data');
	        	window.location.href = 'dashboard';
	        });
		}
    });
}

$("#turnoverForm").submit(function(event){
	var trip_ctr = $('.turnoverbutton')[0].id;
	var sentence ='';
	event.preventDefault();
	swal({   
        title: 'Are you sure you want to turn over?',
        text: 'Action will not be undone',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        closeOnConfirm: false
    }, function() {  
		$.ajax({
			url: 'cashturnover/save_turnover',
			type: 'post',
			data: $('#turnoverForm').serialize() + '&dsp_no=' + dsp_no + '&trip_ctr=' + trip_ctr,
			success: function(data, status) {


				if(data.status == 'success'){
					swal({   
			        	title: 'Success',
			        	text: 'Amount successfully turnover',
			        	type: 'success',
			        	confirmButtonColor: '#3085d6',
			        	cancelButtonColor: '#d33',
			        	confirmButtonText: 'Ok',
			        	closeOnConfirm: true
				    }, 
				    function() {
				    	window.location.reload(true);
				    });
				}else {
					sentence = data.msg;
					if (sentence.indexOf('Location') >= 0) { 
						swal({   
				        	title: 'Error',
				        	text: 'Location is Required',
				        	type: 'error',
				        	confirmButtonColor: '#3085d6',
				        	cancelButtonColor: '#d33',
				        	confirmButtonText: 'Ok',
				        	closeOnConfirm: true
					    });
					} else if (sentence.indexOf('Location') >= 0) { 
						swal({   
				        	title: 'Error',
				        	text: 'Amount is Required',
				        	type: 'error',
				        	confirmButtonColor: '#3085d6',
				        	cancelButtonColor: '#d33',
				        	confirmButtonText: 'Ok',
				        	closeOnConfirm: true
					    });
					}
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		}); // ajax	
    }); //swal
})

function formatAMPM(date) {

	date = new Date(date);
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	return strTime;
}

function formatDate(date){

	date = new Date(date);
	var monthNames = [
	  "Jan", "Feb", "Mar",
	  "Apr", "May", "Jun", "Jul",
	  "Aug", "Sept", "Oct",
	  "Nov", "Dec"
	];
	var day = date.getDate();
	var monthIndex = date.getMonth();
	var year = date.getFullYear();
	return monthNames[monthIndex] + '. ' + day + ', '+ year;
}