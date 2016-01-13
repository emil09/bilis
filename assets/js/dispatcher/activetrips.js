$(document).ready(function(){

	$('#coo_select').each(function() {
		getDspDriver(this.value);
	});
	$('#coo_select').on('change', function() {
		getDspDriver(this.value);
	});

	$('#driver_data').on('click', 'button.end-day', function () {
    	var dsp_no = $(this).data("value");
        swal({   
        	title: 'Are you sure to end this trip?',
        	text: 'The action will not be undone.',
        	type: 'warning',
        	showCancelButton: true,
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'Confirm',
        	closeOnConfirm: false
        }, function() {  
	        $.ajax({
				url: 'activetrips/end_day',
				type: 'post',
				data: {dsp_no: dsp_no},
				success: function(data, status) {
					// $('#coo_select').each(function() {
					// 	getDriver(this.value);
					// });
					if(data.status == 'success'){
			        	swal('Success', 'Trip Successfully Ended .', 'success'); 
						$('#coo_select').each(function() {
							getDspDriver(this.value);
						});
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
});

function getDspDriver(coo_no){
	$.ajax({
		url: 'activetrips/dsp_driver',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			console.log(data);
			var table_data = '';
				for(var i = 0; i < data.length; i++) {

					start_date = formatDate(new Date(data[i]['start_dt']));
					start_time = formatAMPM(new Date(data[i]['start_dt'] + ' '+data[i]['start_time']));

					table_data += '<tr>'+
						'<td>'+data[i]['trips_ctr']+'</td>'+
						'<td>'+ data[i]['rte_nam']+'</td>'+
						'<td><div class="unit-plate">'+data[i]['unt_lic']+'</div></td>'+
						'<td>'+ data[i]['emp_lname'] + ', ' + data[i]['emp_fname'] +' ('+data[i]['emp_no']+')</td>'+
						'<td>'+start_date+ ' ' + start_time +'</td>'+
						'<td>'+data[i]['shift_name']+' Shift</td>'+
						'<td><button class="btn btn-sm btn-danger end-day" data-value="'+data[i]['dsp_unit_no']+'">END DAY</button></td>'+
					'</tr>';
				}

				$('#table-activetrips').dataTable().fnDestroy();
				$("#driver_data").html(table_data);
				$("#active-drivers-count").html(data.length);
				var tabler = $('#table-activetrips').DataTable({ // height: 837px
					paging : false,
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
			    	$('#table-activetrips tbody tr').addClass('DTTT_selected selected');
			    });
				$('#deselectallrows').click(function(){
			    	$('#table-activetrips tbody tr').removeClass('DTTT_selected selected');
			    });

			    $('#submitaction').click( function () {
			        var e = document.getElementById("actionselect");
					var value = e.options[e.selectedIndex].value;
					if(value=="endday" && tabler.rows('.selected').data().length) {
				        swal({   
				        	title: 'Are you sure to end day these units?',
				        	text: 'The action will not be undone.',
				        	type: 'warning',
				        	showCancelButton: true,
				        	confirmButtonColor: '#3085d6',
				        	cancelButtonColor: '#d33',
				        	confirmButtonText: 'Confirm',
				        	closeOnConfirm: false
				        }, function() {
				        	for(var i=0; i<tabler.rows('.selected').data().length; i++) {
				        		if(tabler.rows('.selected').data()[i][6] !== '') {
				        			var dsp_val = tabler.rows('.selected').data()[i][6];
				        			var dsp_no  = $(dsp_val).data("value");
							        $.ajax({
										url: 'activetrips/end_day',
										type: 'post',
										data: {dsp_no: dsp_no},
										success: function(data, status) {
											if(data.status == 'success'){
									        	swal('Success', 'Units Successfully Ended .', 'success'); 
												$('#coo_select').each(function() {
													getDspDriver(this.value);
												});
											}else{

									        	swal('Dispatch Error!', data.msg, 'error'); 
											}


										},
										error: function(xhr, desc, err) {
											console.log(xhr);
											console.log("Details: " + desc + "\nError:" + err);
										}
									}); //ajax
								} //if
							} //for
				        });  //swal
					}
			    });
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}


function formatAMPM(date) {
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

function reload() {
	window.location.reload(true);
}