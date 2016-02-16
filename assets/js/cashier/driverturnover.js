var num = '';
var dsp_no = '';
$(function(){
	$('#coo_select').each(function() {
		getActiveList(this.value);
	});
	$('#coo_select').on('change', function() {
		getActiveList(this.value);
	});

	$('#table-driverturnover tbody').on('click', 'button#driverturnover_btn', function () {
		$(".screen").val("");
		$("#amt").html('');
		num = '';
        $("#driverturnoverModal").modal({backdrop: 'static'});
    });

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

function getActiveList(coo_no){
	$.ajax({
		url: 'driverturnover/active_trips_list',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			var table_data = '';
			for(var i = 0; i < data.length; i++) {

				start_date = formatDate(new Date(data[i]['start_dt']));
				start_time = formatAMPM(new Date(data[i]['start_dt'] + ' '+data[i]['start_time']));

				table_data += '<tr>'+
					'<td><button id="driverturnover_btn" class="btn btn-success" onclick="openTurnoverModal('+data[i]['emp_no']+')">'+ (parseInt(data[i]['count_trp'])) +'</button></td>'+
					'<td>'+ data[i]['rte_nam']+'</td>'+
					'<td>'+data[i]['unt_lic']+'</td>'+
					'<td>'+ data[i]['emp_lname'] + ', ' + data[i]['emp_fname'] +' ('+data[i]['emp_no']+')</td>'+
					'<td>'+start_date+ ' ' + start_time +'</td>'+
					'<td>'+data[i]['shift_name']+' Shift</td>'+
				'</tr>';
			}

			$('#table-driverturnover').dataTable().fnDestroy();
			$("#active_list_data").html(table_data);
			var tabler = $('#table-driverturnover').DataTable({
				paging : false,
				order: [[ 3, "asc" ]]
			});

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function openTurnoverModal(emp_no) {
	$.ajax({
		url: 'driverturnover/driver_turnover_details',
		type: 'post',
		data: {emp_no: emp_no},
		success: function(data, status) {
			if(data.details.length > 0) {
				dsp_no = data.details[0]['dsp_unit_no'];
				$('#drivername').html(data.details[0]['emp_fname']+" "+data.details[0]['emp_lname']+" ("+data.details[0]['emp_no']+")");
				var table_data = '<tr>'+
							'<th>Shift</th>'+
							'<td>'+ data.details[0]['shift_name'] +' Shift </td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Trip</th>'+
							'<td>' + (parseInt(data.details[0]['trips_ctr'])+1) + '</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Route</th>'+
							'<td>'+data.details[0]['rte_nam']+'</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Unit</th>'+
							'<td>'+data.details[0]['unt_lic']+'</td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Amount</th>'+
							'<td><span id="amt"></span></td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Departure</th>'+
							'<td>'+ formatDate(data.details[0]['start_dt']) +' ' + 
							formatAMPM(data.details[0]['start_dt'] + ' ' + data.details[0]['start_time']) +'</td>'+
		                '</tr>';
		        $('#act_table').html(table_data);
		    	$('.turnoverbutton').attr('id', (parseInt(data.details[0]['trips_ctr'])+1));
				$("#amt").html(0);
			}
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
			url: 'driverturnover/save_turnover',
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
						$('#coo_select').each(function() {
							getActiveList(this.value);
						});
				    	$('#driverturnoverModal').modal('hide');
				    });
				}else {
					sentence = data.msg;
					if (sentence.indexOf('Amount') >= 0) { 
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
			}
		});
    });
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