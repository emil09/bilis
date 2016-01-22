var driver_no = '';
$(function(){

	
	$('#editModalWindow').on('hidden', function () {
	    document.getElementById("schedForm").reset();
	});

    $('#table-available tbody').on('click', 'button#editModal', function () {
        $("#editModalWindow").modal({backdrop: 'static'});
    });

    $('#table-available tbody').on('click', 'button#dispatch-button', function () {
    	var sched_no = $(this).data("value");
    	var unit_no = $(this).data("unit");
        swal({   
        	title: 'Are you sure?',
        	text: 'You will not be able to dispatch it again!',
        	type: 'warning',
        	showCancelButton: true,
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'Yes, dispatch unit.',
        	closeOnConfirm: false
        }, function() {  
	        $.ajax({
				url: 'available/dispatch_unit',
				type: 'post',
				data: {sched_no: sched_no, unit_no: unit_no},
				success: function(data, status) {
					$('#coo_select').each(function() {
						getDriver(this.value);
					});
					if(data.status == 'success'){
			        	swal('Dispatch Success!', 'The unit has been dispatched.', 'success'); 
					}else{

			        	swal('Dispatch Error!', data.msg, 'error'); 
					}

				},
				error: function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
			});
        });
    });

    $('#table-available tbody').on('click', 'button#clear-sched', function () {
    	var sched_no = $(this).data("value");
        swal({   
        	title: 'Are you sure?',
        	text: 'Delete this data',
        	type: 'warning',
        	showCancelButton: true,
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'Confirm',
        	closeOnConfirm: false
        }, function() {  
        	
	        $.ajax({
				url: 'available/delete_sched',
				type: 'post',
				data: {sched_no: sched_no},
				success: function(data, status) {
					$('#coo_select').each(function() {
						getDriver(this.value);
						console.log(this.value);
					});
					if(data.status == 'success'){
			        	swal('Clear Data Success!', 'The unit has been cleared.', 'success'); 
					}else{

			        	swal('Clear Data Error!', data.msg, 'error'); 
					}

				},
				error: function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
			});
        });
    });

    $(".select2").select2({
        placeholder: "Select a vehicle"
    });
    var $eventSelect = $(".select2");
    $eventSelect.on("select2:select", function () { 
    	$('#select2-unit-container').addClass('unit-plate');
    });

	$('#coo_select').each(function() {
		getDriver(this.value);
	});
	$('#coo_select').on('change', function() {
		getDriver(this.value);
	});

	var driver_no;

});

function getDriver(coo_no){

	
	$.ajax({

			url: 'available/get_driver',
			type: 'post',
			data: {coo_no: coo_no},
			success: function(data, status) {
				console.log(data);
				var table_data = '';
				for(var i = 0; i < data.driver.length; i++) {
					var btn_dispatched = '';
					var unit = '';
					var shift = '';
					var btn_val = 'Set';
					var btn_class = 'warning';
					var btn_state = '';
					var button_clear = '';
					if(data.driver[i].sched.length>0){
						sched_arr = data.driver[i].sched.length - 1;
						dsp_arr = data.driver[i].dispatched.length - 1;
						if(data.driver[i].dispatched.length>0 && data.driver[i].dispatched[dsp_arr]['dsp_stat_fk']=='A'){
							btn_dispatched = '<button class="btn btn-success col-xs-11" data-value="'+ data.driver[i].sched[0]['dsp_sched_no']+'" disabled>DISPATCHED</button>';
							unit = data.driver[i].sched[sched_arr]['unt_lic'];
							shift = 'Dispatched in ' + data.driver[i].sched[sched_arr]['shift_name']+ ' Shift';

							if(!data.driver[i].sched[sched_arr]['dsp_sched_no']){
								btn_dispatched = '';
							}
							if(!unit){
								unit = '';
							}
							if(!data.driver[i].sched[sched_arr]['shift_name']){
								shift = '';
							}
							btn_val = 'Edit';
							btn_class = 'primary';
							btn_state = 'disabled';
						}
						else if(data.driver[i].sched[sched_arr]['sched_type']=='F'){

						}
						else {

						
							btn_dispatched = '<button id="dispatch-button" class="btn btn-warning col-xs-11" data-value="'+ data.driver[i].sched[sched_arr].dsp_sched_no+'" data-unit="'+ data.driver[i].sched[sched_arr].unit_no_fk+'">DISPATCH</button>';
							unit = data.driver[i].sched[sched_arr]['unt_lic'];
							shift = 'Scheduled in ' + data.driver[i].sched[sched_arr]['shift_name']+ ' Shift';
							if(!data.driver[i].sched[sched_arr]['dsp_sched_no']){
								btn_dispatched = '';
							}
							if(!unit){
								unit = '';
							}
							if(!data.driver[i].sched[sched_arr]['shift_name']){
								shift = '';
							}
							btn_val = 'Edit';
							btn_class = 'primary';

							button_clear = ' <button class="btn btn-danger" id="clear-sched" data-value="'+ data.driver[i].sched[sched_arr].dsp_sched_no +'">Clear</button>';
						}
						
					}
					
					table_data += '<tr id="driver-' + data.driver[i].emp_no + '"><td>' + 
					data.driver[i].lname + ', ' + data.driver[i].fname + 
					' (' + data.driver[i].emp_no + ')' +
					'</td><td><div class="unit-plate">'+ unit +'</div></td><td><button class="btn btn-'+ btn_class+' editModal" '+
					' id="editModal" onclick="setSched('+data.driver[i].emp_no+ ',' +  data.driver[i].driver_no+')" '+btn_state+'>' + btn_val +
					'</button>'+ button_clear +'</td><td>'+btn_dispatched+'</td><td><span class="dispatch-status">'+shift +'</span></td></tr>';
					$('#route').empty();
					$('#route').append($("<option />").val(0).text('All Route'));
					$.each(data.driver[i].route, function() {
					    $('#route').append($("<option />").val(this.rte_no).text(this.rte_nam));
					});
				};

				
				$('#table-available').dataTable().fnDestroy();

				$("#driver_data").html(table_data);
				$("#driver_dispatching").html(data.total);
				var tabler = $('#table-available').DataTable({
					paging : true,
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
			    $('#submitaction').click( function () {
			        var e = document.getElementById("actionselect");
					var value = e.options[e.selectedIndex].value;
					if(value=="dispatch" && tabler.rows('.selected').data().length) {
				        swal({   
				        	title: 'Are you sure?',
				        	text: 'You will not be able to dispatch these units again.',
				        	type: 'warning',
				        	showCancelButton: true,
				        	confirmButtonColor: '#3085d6',
				        	cancelButtonColor: '#d33',
				        	confirmButtonText: 'Yes, dispatch units.',
				        	closeOnConfirm: false
				        }, function() {  
							for(var i=0; i<tabler.rows('.selected').data().length; i++) {
								if(tabler.rows('.selected').data()[i][3] !== '') {
									var sched_val = tabler.rows('.selected').data()[i][3];
									var sched_no  = $(sched_val).data("value");
									var unit_no  = $(sched_val).data("unit");
					        		$.ajax({
										url: 'available/dispatch_unit',
										type: 'post',
										data: {sched_no: sched_no, unit_no: unit_no},
										success: function(data, status) {
											$('#coo_select').each(function() {
												getDriver(this.value);
											});
											if(data.status == 'success'){
									        	swal('Dispatch Success!', 'The units have been dispatched.', 'success');
											}else{

									        	swal('Dispatch Error!', data.msg, 'error');
											}

										},
										error: function(xhr, desc, err) {
											console.log(xhr);
											console.log("Details: " + desc + "\nError:" + err);
										}
									});
								}
							}
						});
					}
					else if (value=="clear" && tabler.rows('.selected').data().length) {
				        swal({   
				        	title: 'Are you sure?',
				        	text: 'Delete these data',
				        	type: 'warning',
				        	showCancelButton: true,
				        	confirmButtonColor: '#3085d6',
				        	cancelButtonColor: '#d33',
				        	confirmButtonText: 'Confirm',
				        	closeOnConfirm: false
				        }, function() {  
				        	for(var i=0; i<tabler.rows('.selected').data().length; i++) {
								if(tabler.rows('.selected').data()[i][3] !== '') {
									var sched_val = tabler.rows('.selected').data()[i][3];
									var sched_no = $(sched_val).data("value");
							        $.ajax({
										url: 'available/delete_sched',
										type: 'post',
										data: {sched_no: sched_no},
										success: function(data, status) {
											$('#coo_select').each(function() {
												getDriver(this.value);
											});
											if(data.status == 'success'){
									        	swal('Clear Data Success!', 'The units have been cleared.', 'success'); 
											}else{

									        	swal('Clear Data Error!', data.msg, 'error'); 
											}

										},
										error: function(xhr, desc, err) {
											console.log(xhr);
											console.log("Details: " + desc + "\nError:" + err);
										}
									});
								}
							}
				        }); 
					}
			    });
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function setSched(emp_no, dvr_no) {
	driver_no = dvr_no;
	$('#shift').empty();
	$.ajax({
		url: 'available/get_driver_detail',
		type: 'post',
		data: {emp_no: emp_no, dvr_no: dvr_no},
		success: function(data, status) {
			console.log(data);
			var driver_info = data.driver[0].lname + ' (' + data.driver[0].emp_no + ')' ;
			$('#driver_name').html(driver_info);
			$('.server-time').html(data.date);
			

			$.each(data.shift, function() {
			    $('#shift').append($("<option />").val(this.shift_code).text(this.shift_name));
			});

			$('#route').each(function(){
				getUnit(this.value);

			});
			$('#route').on('change', function() {
				getUnit(this.value);

			});

			$('#shift').on('change', function() {
				getUnit($('#route').val());
			});
			$('#route').each(function(){
				getUnit($('#route').val());

			});

			if(data.sched_exist.length>0){
				$('#unit').append($("<option />").val(data.sched_exist[0].unt_no).text(data.sched_exist[0].unt_lic));
				$("#unit").select2("val", data.sched_exist[0].unt_no);
				$('#select2-unit-container').addClass('unit-plate');
				$('#shift').val(data.sched_exist[0].shift_code_fk);
				$('#route').val(data.sched_exist[0].rte_no_fk);

			}

			$('.select2').on('change', function(){
				console.log($(this).val());
				shift_avail($(this).val());
			});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function shift_avail(unit_no){
	$.ajax({
		url: 'available/shift_avail',
		type: 'post',
		data: {unit_no: unit_no, driver_no: driver_no},
		success: function(data, status) {
			if(data.length>0){
				if(data[0]['shift_code_fk'] == 'D' ){
					$('#shift' ).val('N');
					$('#shift' + ' option[value="D"]').attr("disabled",true);
				
				}
				else{
					$('#shift').val('D');
					$('#shift' + ' option[value="N"]').attr("disabled",true);
				}
			}else{

					$('#shift' + ' option[value="N"]').attr("disabled",false);

					$('#shift' + ' option[value="D"]').attr("disabled",false);
			}

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}


function getUnit(route_no){
	$('#unit').empty();
	$("#unit").select2("val", "");
	var shift_sel = $('#shift').val();
	$('#shift').on('change', function(){
		shift_sel = $(this).val();
	});
	$('#select2-unit-container').removeClass('unit-plate');
	$.ajax({
		url: 'available/get_unit',
		type: 'post',
		data: {route_no: route_no, coo_no: $('#coo_select').val(), shift_sel: shift_sel},
		success: function(data, status) {
			$('#unit').append($("<option />").val('').text(''));
			
			$.each(data.unit, function() {
			    $('#unit').append($("<option />").val(this.unt_no).text(this.unt_lic));
			});
			

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

$("#schedForm").submit(function(event){
	event.preventDefault();	 
    $.ajax({
		url: 'available/save_sched',
		type: 'post',
		data: $("#schedForm").serialize()  + '&driver_no=' + driver_no,
		success: function(data, status) {
			console.log(data);
			if(data.status=='success'){
				$('#editModalWindow').modal('hide');
				swal({   
					title: 'Success!',   
					text: 'Schedule successfully added.', 
					type: 'success' 
				});
			}else{
				swal({   
					title: 'Error!',   
					text: 'Schedule Error.', 
					type: 'error' 
				});
			}
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


function reload() {
	window.location.reload(true);
}