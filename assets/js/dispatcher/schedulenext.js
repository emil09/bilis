var next_days = '';
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
	});

});

function getDriver(coo_no){
	var schednext_data = '';

	$.ajax({
		url: 'get_driver',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {

			for(var i = 0; i < data.length; i++) {
				schednext_data += 	
				'<tr>'+
			    	'<td>'+ data[i].emp_lname + ', ' + data[i].emp_fname + ' (' + data[i].emp_no + ')' + '</td>'+
					'<td><button id="editModal" onclick="setSched('+ data[i].emp_no +')" class="btn btn-warning">Set</button></td>'+ 
					'<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>' +   
					'<td></td>'+
					'<td></td>'+
					'<td></td>'+
					'<td></td>'+                                         
					'<td></td>'+
					'<td></td>'+
					'<td></td>'+
			    '</tr>';
			}
			$('#schednext_data').html(schednext_data);	
			


		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function setSched(emp_no){
	// console.log(emp_no);

	$.ajax({
		url: 'get_driver_detail',
		type: 'post',
		data: {emp_no: emp_no},
		success: function(data, status) {
			console.log(data);
			next_days = data.date;
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
				console.log(data.length);
				// $('#unit'+i).append($("<option />").val('').text(''));

				for(i = 0; i < data.length; i++){
					$('#unit'+i).empty();
					// $('#unit'+i).select2("val", "");
					// $('#select2-unit-container').removeClass('unit-plate');
					$('#unit'+i).append($("<option />").val('').text(''));
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
