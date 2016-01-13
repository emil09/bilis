var next_days = '';
var dates = [];
var sel_emp_no = '';
var sel_drver_no = '';
$(document).ready(function(){
	$('#coo_select').each(function() {
		getDriver(this.value);
	});
	$('#coo_select').on('change', function() {
		getDriver(this.value);
	});
	$('#schednext_data').on('click', 'button#editModal', function () {
        $("#scheduling_modal").modal({backdrop: 'static'});
    });	


	$('#schedFormSubmit').click(function(){
		console.log($('#schedForm').serializeArray());
		data = $('#schedForm').serializeArray();
		data.push({name: 'emp_no', value: sel_emp_no});
		data.push({name: 'driver_no', value: sel_drver_no});
		for(var c=0; c<dates.length;c++){
			data.push({name: 'dates[]', value: dates[c]});
		}// console.log(dates);
		$.ajax({
			url: 'save_sched',
			type: 'post',
			data: data,
			success: function(data, status) {
				
				$('#coo_select').each(function() {
					getDriver(this.value);
				});
				$("#scheduling_modal").modal('hide');
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
	});

});

function getDriver(coo_no){
	var schednext_data = '';


	$.ajax({
		url: 'get_driver',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			
			for(var i = 0; i < data['driver'].length; i++) {
				schednext_data += 	
				'<tr>'+
			    	'<td>'+ data['driver'][i].emp_lname + ', ' + data['driver'][i].emp_fname + ' (' + data['driver'][i].emp_no + ')' + '</td>'+
					'<td><button id="editModal" onclick="setSched('+ data['driver'][i].emp_no +')" class="btn btn-warning">Set</button></td>'+ 
					'<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>';
					if(data['driver'][i]['sched'].length>0){
						// schednext_data += '<td>test</td>';
						for(var c=0; c < data['driver'][i]['sched'].length; c++){
							if(data['driver'][i]['sched'][c]['shift_code_fk'] == 'D'){
								schednext_data +='<td><div class="day  unit-plate">'+data['driver'][i]['sched'][c]['unt_lic']+'</div> <div class="night"></div></td>';
							}else{
								schednext_data +='<td><div class="day"></div> <div class="night unit-plate">'+data['driver'][i]['sched'][c]['unt_lic']+'</div></td>';
							}
						}
						for(var d=0; d<=(6-data['driver'][i]['sched'].length); d++){
							schednext_data += '<td></td>';
						}
					}else{
						schednext_data += '<td></td>'+
						'<td></td>'+
						'<td></td>'+
						'<td></td>'+                                         
						'<td></td>'+
						'<td></td>'+
						'<td></td>';
					}
					

			    schednext_data +='</tr>';
			}
			$('#table-scheduling-next').dataTable().fnDestroy();
			$('#schednext_data').html(schednext_data);

			var tabler = $('#table-scheduling-next').DataTable({
				paging : false,
				autoWidth : false,
				scrollY: '45vh',
    			scrollCollapse: true,
				scrollX: 'true',
				fixedHeader: false,
				dom: 'T<"clear">lfrtip',
				tableTools: {
		            sRowSelect:   'multi',
		            sRowSelector: 'td:first-child',
		            aButtons:     [  ]
		        }
			});

			$('#selectallrows').click(function(){
		    	$('#table-available tbody tr').addClass('DTTT_selected selected');
		    });
			$('#deselectallrows').click(function(){
		    	$('#table-available tbody tr').removeClass('DTTT_selected selected');
		    });


		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function setSched(emp_no){
	// console.log(emp_no);
	sel_emp_no = emp_no;	

	$.ajax({
		url: 'get_driver_detail',
		type: 'post',
		data: {emp_no: emp_no},
		success: function(data, status) {
			console.log(data);
			next_days = data.date;
			sel_drver_no = data.driver[0]['driver_no'];

			$('#driver_detail').html(data.driver[0]['lname'] + ' ('+ data.driver[0]['emp_no']+ ')');
			var set_sched_table = '';
			var shift_option = '';
			$('#route').empty();
		    $.each(data.route, function() {
			    $('#route').append($("<option/>").val(this.rte_no).text(this.rte_nam));
			});

			for(var c = 0; c< data.shift.length; c++){
				shift_option += '<option value="'+data.shift[c]['shift_code']+'">' + data.shift[c]['shift_name'] + '</option>';
			}

			for (var i = 0; i < data.date.length; i++) {
				dates.push(data.date[i]);
				set_sched_table += '<tr>'+
                    '<td>'+data.date[i]+'</td>'+
                    '<td>'+
                    	'<select class="form-control select2" id="unit'+ i +'" name="unit[]">'+
                		'</select>'+
                	'</td>'+
                    '<td>'+
                    	'<select class="form-control shift" name="shift[]">'+ shift_option +
                		'</select>'+
                	'</td>'+
                    '<td><button class="btn btn-danger" disabled>Clear</button></td>'+
                '</tr>';
			};
			
            $('#set_sched_table').html(set_sched_table);
            $(".select2").select2({
		        placeholder: "Select a vehicle"
		    });
		    // $('.select2').select2("enable",false)

            
            $('#route').each(function(){
				getUnit(this.value);
			});
			$('#route').on('change', function() {
				getUnit(this.value);
			});

			

			
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});

	function getUnit(rte_no){
		console.log(rte_no);
		console.log(next_days.length);
		
			
		
		
				
		$.ajax({
			url: 'get_unit',
			type: 'post',
			data: {route_no: rte_no, date: next_days},
			success: function(data, status) {
				console.log(data);
				// console.log(data.length);
				// $('#unit'+i).append($("<option />").val('').text(''));

				for(i = 0; i < data.length; i++){
					test = $('#unit'+i).val()
					test2 = $('#unit'+i).text()
					$('#unit'+i).empty();
					// $('#unit'+i).select2("val", "");
					// console.log(test);
					// $('#select2-unit-container').removeClass('unit-plate');
					// console.log($('#unit'+i).val());
					$('#unit'+i).append($("<option />").val(test).text(test2));
					// console.log(test);
					$.each(data[i].unit, function() {
					    $('#unit'+i).append($("<option />").val(this.unt_no).text(this.unt_lic));
					});
				};

			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});

			
		
	}

}

function reload() {
	window.location.reload(true);
}