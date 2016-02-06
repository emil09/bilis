var next_days = '';
var dates = [];
var sel_emp_no = '';
var sel_drver_no = '';
$(function(){
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
		data = $('#schedForm').serializeArray();
		data.push({name: 'emp_no', value: sel_emp_no});
		data.push({name: 'driver_no', value: sel_drver_no});
		for(var c=0; c<dates.length;c++){
			data.push({name: 'dates[]', value: dates[c]});
		}
		console.log(data);
		$.ajax({
			url: 'scheduling/save_sched',
			type: 'post',
			data: data,
			success: function(data, status) {
				console.log(data);
				$("#scheduling_modal").modal('hide');
				$('#coo_select').each(function() {
					getDriver(this.value);
				});
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
	});
});

function getDriver(coo_no){
	var schednext_data = ' ';

	$.ajax({
		url: 'scheduling/get_driver',
		type: 'post',
		data: {coo_no: coo_no, date: dates},
		success: function(data, status) {

			dates = [];
			for (var i = 0; i < data.date.length; i++){ 
		    	dates.push(data.date[i]);
		    }

			for(var i = 0; i < data['driver'].length; i++) {

				schednext_data += 	
				'<tr>'+
			    	'<td>'+ data['driver'][i].emp_lname + ', ' + data['driver'][i].emp_fname + ' (' + data['driver'][i].emp_no + ')' + '</td>'+
					'<td><button id="editModal" onclick="setSched('+ data['driver'][i].emp_no +')" class="btn btn-warning">Set</button></td>'+ 
					'<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>';


					var sched_dt = new Array();
					

					if(data['driver'][i]['sched'].length>0){
						
						for(var c=0; c < data['driver'][i]['sched'].length; c++){
							sched_dt.push(data['driver'][i]['sched'][c]['sched_dt']);
						}
					}

					for(var d=0; d < dates.length; d++){

						var chek = sched_dt.indexOf(dates[d]);
						if(sched_dt.indexOf(dates[d]) !== -1){
							if(data['driver'][i]['sched'][chek]['shift_code_fk'] == 'D'){
								schednext_data +='<td><div class="day  unit-plate">'+data['driver'][i]['sched'][chek]['unt_lic']+'</div> <div class="night"></div></td>';
							}else{
								schednext_data +='<td><div class="day"></div> <div class="night unit-plate">'+data['driver'][i]['sched'][chek]['unt_lic']+'</div></td>';
							}
						}else{
							schednext_data += '<td></td>';
						}
					}

			    schednext_data +='</tr>';
			}


			// console.log(schednext_data);
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
	sel_emp_no = emp_no;	
	$.ajax({
		url: 'scheduling/get_driver_detail',
		type: 'post',
		data: {emp_no: emp_no, date: dates},
		success: function(data, status) {

			sel_drver_no = data.driver[0]['driver_no'];

			$('#driver_detail').html(data.driver[0]['lname'] + ' ('+ data.driver[0]['emp_no']+ ')');
			var set_sched_table = '';
			var shift_option = '';
			$('#route').empty();

			$('#route').append($("<option />").val(0).text('All Route'));
		    $.each(data.route, function() {
			    $('#route').append($("<option/>").val(this.rte_no).text(this.rte_nam));
			});

			for(var c = 0; c< data.shift.length; c++){
				shift_option += '<option value="'+data.shift[c]['shift_code']+'">' + data.shift[c]['shift_name'] + '</option>';
			}

			for (var i = 0; i < dates.length; i++) {
			
				set_sched_table += '<tr>'+
                    '<td>'+dates[i]+'</td>'+
                    '<td>'+
                    	'<select class="form-control select2" id="unit'+ i +'" name="unit[]"  data-value="'+i+'">'+
                		'</select>'+
                	'</td>'+
                    '<td>'+
                    	'<select class="form-control shift" id="shift'+i+'" name="shift[]">'+ shift_option +
                		'</select>'+
                	'</td>'+
                    '<td><button type="button" class="btn btn-danger clear" data-value="'+i+'">Clear</button></td>'+
                '</tr>';
			};
			
            $('#set_sched_table').html(set_sched_table);
            $(".select2").select2({
		        placeholder: "Select a vehicle"
		    });
		    // $('.select2').select2("enable",false)

            
            $('#route').each(function(){
            	getUnit(this.value);
				check_sched(sel_emp_no, this.value);
				
				
			});
			$('#route').on('change', function() {

				getUnit(this.value);
				check_sched(sel_emp_no, this.value);
				
				
			});

			$('.select2').on('change', function(){
				shift_avail($(this).val(), $(this).data('value'));

			});

			var $eventSelect = $(".select2");
		    $eventSelect.on("select2:select", function () { 
		    	// console.log($(this).data('value'));
				$('#select2-unit'+$(this).data('value')+ '-container').addClass('unit-plate');
		    });

			$('.clear').click(function(){
				var i = $(this).data('value');
				$('#unit'+i).select2("val", "");
				$('#select2-unit'+i+ '-container').removeClass('unit-plate');
			});

			
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function shift_avail(unit_no, i){
	$.ajax({
		url: 'scheduling/shift_avail',
		type: 'post',
		data: {unit_no: unit_no, date: dates[i], driver_no: sel_drver_no},
		success: function(data, status) {
			
			if(data.length>0){
				if(data[0]['shift_code_fk'] == 'D' ){
					$('#shift'+i ).val('N');
					$('#shift' + i + ' option[value="D"]').attr("disabled","disabled");
				}
				else{
					$('#shift'+i ).val('D');
					$('#shift' + i + ' option[value="N"]').attr("disabled","disabled");
				}
			}

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}


function check_sched(emp_no, rte_no){
	console.log(emp_no);
	$.ajax({
		url: 'scheduling/check_sched',
		type: 'post',
		data: {emp_no: emp_no, rte_no: rte_no, date: dates},
		success: function(data, status) {
		 	console.log(data.schedule);
			for (var i = 0; i < data.schedule.length;i++) {
				
				if(data.schedule.length>0){

					var dateIndex = dates.indexOf(data.schedule[i]['sched_dt']);
					var unitval = data.schedule[i]['unit_no_fk'];
					var unittext = data.schedule[i]['unt_lic'];
					var shiftval = data.schedule[i]['shift_code_fk'];
				
					$('#unit'+dateIndex).append($("<option />").val(unitval).text(unittext));
					// $("#unit"+dateIndex).val(unitval);
					// $("#unit"+dateIndex).val("val", unitval);
					$('#unit'+dateIndex).select2("val", unitval);
					// console.log(unitval);

					$('#shift'+dateIndex).val(shiftval);

					$('#select2-unit'+dateIndex+'-container').addClass('unit-plate');

				}
			};

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
	
}

function getUnit(rte_no){
	
	$.ajax({
		url: 'scheduling/get_unit',
		type: 'post',
		data: {route_no: rte_no, date: dates, coo_no: $('#coo_select').val()},
		success: function(data, status) {
			for(i = 0; i < data.length; i++){
				test = $('#unit'+i).select2('val');
				test2 = $('#unit'+i + " option:selected").text();
			
				$('#unit'+i).select2('val', '');
				$('#unit'+i).empty();
				
				$.each(data[i].unit, function() {
				    $('#unit'+i).append($("<option />").val(this.unt_no).text(this.unt_lic));
				});


				$('#unit'+i).append($("<option />").val(test).text(test2));
				$('#unit'+i).select2('val', test);
			};

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}



function reload() {
	window.location.reload(true);
}