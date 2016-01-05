var num = '';
var dsp_no = '';
$(document).ready(function(){
	get_active_trips();
	$(".screen" ).focus();

	$("#calculator button").click(function(e) {
		if ($(this).val() != "C" && $(this).val() != "OK") {
			num += $(this).val();

			var valid = /^\d*(\.\d{0,2})?$/.test(num);
		    if(!valid){
		        console.log("Invalid input!");
		        num = num.substring(0, num.length - 1)
		    }
		   
			$(".screen").val(num);
		}
		else if ($(this).val() == "C") {
			$(".screen").val("");
			num = '0';
		}
		$("#amt").html(num);
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

	// $("#screen").change(function(){
	// 	console.log('test');
	// 	// if($(this).val.length == 0){

	// 	// 	$("#amt").html(0);
	// 	// }
	// });




});

function get_active_trips(){

	$.get("cashturnover/active_trip", function(data, status){
		console.log(data);
		if(data.driver.length > 0){
			dsp_no = data['driver'][0]['dsp_unit_no'];
			var table_data = '<tr>'+
							'<th class="col-lg-4">Shift</th>'+
							'<td  class="col-lg-8">'+ data['driver'][0]['shift_name'] +' Shift </td>'+
		                '</tr>'+
		                '<tr>'+
							'<th>Trip</th>'+
							'<td>' + parseInt(data['trip'].length + 1) + '</td>'+
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
							'<td>'+ data['driver'][0]['start_dt'] +' ' + 
							data['driver'][0]['start_time'] +'</td>'+
		                '</tr>';
		    $('#act_table').html(table_data);

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
			data: $('#turnoverForm').serialize() + '&dsp_no=' + dsp_no,
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
				        });
					}else{
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
					
					
				},
				error: function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
		    }); 
			
        });


	
})