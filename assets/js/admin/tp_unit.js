var base_url = window.location.origin;
$(function(){
	var date = new Date();
	date = date.getFullYear() + '-' + parseInt(date.getMonth()+1) + '-' + date.getDate();
	dateSel = date;
	$('#sales-date').datepicker({
    	format: 'yyyy-mm-dd',
    	endDate: '0d'
    });
    $('#route-header').html($('#coo_select option:selected').text());
    $('#shift-header').html($('#shift option:selected').text());
    $('#date-header').html(formatDate(new Date(date)));
	$('#sales-date').datepicker('setDate', dateSel);
	get_driver_stp();

	$('#display-report').click(function(){
	    $('#route-header').html($('#coo_select option:selected').text());
	    $('#shift-header').html($('#shift option:selected').text());
	    var date = formatDate(new Date($('#sales-date').val()));
	    $('#date-header').html(date);
		get_driver_stp();
	});
	// get_driver_stp();
	
	});

function get_driver_stp(){
	$.ajax({
		url: base_url+ "/admin/sales/get_driver_stp",
		type: 'post',
		data: $('#filterForm').serialize(),
		success: function(data, status){
			console.log(data.test);
			var t_header = '<th>Unit</th><th>Driver</th><th>Shift</th>';
			var t_detail = '';
			var t_footer = '<td></td><td></td><td><div>DAY</div><div>NIGHT</div><div>TOTAL</div></td>';


			for(var i = 0; i< data.tme_period.length; i++){
				t_header += '<th>' + data.tme_period[i]['startTime'] +' - '+ data.tme_period[i]['endTime'] + '</th>';
			}
			t_header += '<th>Total</th>';
			$('#tp_driver_table_header').html(t_header);

			for(var i = 0; i< data.stp_driver.length; i++){
				t_detail += '<tr><td>'+
					'<div class="dropdown">'+
						'<a href="#" id="status-A" class="dropdown-toggle fa fa-caret-right" data-toggle="dropdown" aria-expanded="true">'+data.stp_driver[i]['unt_lic']+'</a>'+
								'<ul class="dropdown-menu">'+
									'<li>'+'<a><strong>Dispatch No.: </strong>' +data.stp_driver[i]['dsp_unit_no']+'</a></li>'+
									'<li>'+'<a><strong>Start Date: </strong>'+data.stp_driver[i]['start_dt']+'</a></li>'+
									'<li>'+'<a><strong>Start Time: </strong>'+data.stp_driver[i]['start_time']+'</a></li>'+
									'<li>'+'<a><strong>End Date: </strong>'+data.stp_driver[i]['end_dt']+'</a></li>'+
									'<li>'+'<a><strong>End Time: </strong>'+data.stp_driver[i]['end_time']+'</a></li>'+
									'<li>'+'<a><strong>Status: </strong>'+data.stp_driver[i]['dsp_stat_fk']+'</a>'+ '</li>'+
								'</ul></div></td>'+
					'<td>'+data.stp_driver[i]['emp_name']+
				'</td><td><div>'+data.stp_driver[i]['shift_name']+'</div></td>';
				if (data.stp_driver[i]['shift_code_fk'] == 'D') {
					for(var j = 0; j < data.tme_period.length; j++){
						// console.log(data.stp_driver[i]['s'][j]);	
						if(data.stp_driver[i]['s'][j].length == 0){
							t_detail += '<td><div>0.00</div></td>';
						}else{
							t_detail +='<td><div>'+data.stp_driver[i]['s'][j][0]['total_amt_in']+'</div></td>';
						}
					}

						t_detail +='<td id="status-C">'+data.stp_driver[i]['total_to']+'</td>';
				}else{
					for(var j = 0; j < data.tme_period.length; j++){
						// console.log(data.stp_driver[i]['s'][j]);	
						if(data.stp_driver[i]['s'][j].length == 0){
							t_detail += '<td><div>0.00</div></td>';
						}else{
							t_detail +='<td><div>'+data.stp_driver[i]['s'][j][0]['total_amt_in']+'</div></td>';				
						}
					}

						t_detail +='<td id="status-C">'+data.stp_driver[i]['total_to']+'</td>';
				};

					

	            t_detail += '</tr>';
			};

			$('#tp_driver_table').dataTable().fnDestroy();
			$('#tp_driver_table_detail').html(t_detail);

			for(var i = 0; i< data.total_tp_day.length; i++){
				t_footer += '<td>';
				if(data.total_tp_day[i].length > 0){
					console.log(data.total_tp_day[i][0]['total_amt_in']);
					t_footer += '<div id="status-C">' + data.total_tp_day[i][0]['total_amt_in'] +'</div>';
				}else{
					t_footer += '<div id="status-C">0.00</div>';
				}
				if(data.total_tp_night[i].length > 0){
					console.log(data.total_tp_night[i][0]['total_amt_in']);
					t_footer += '<div id="status-C">' + data.total_tp_night[i][0]['total_amt_in'] +'</div>';
				}else{
					t_footer += '<div id="status-C">0.00</div>';
				}

				if(data.total_tp_shift[i].length > 0){
					console.log(data.total_tp_shift[i][0]['total_amt_in']);
					t_footer += '<div id="status-A">' + data.total_tp_shift[i][0]['total_amt_in'] +'</div>';
				}else{
					t_footer += '<div id="status-A">0.00</div>';
				}
				t_footer += '</td>';
			}

			t_footer += '<td>';
			if (data.total_to_day != null) 
				t_footer += '<div id="status-C">'+ data.total_to_day+'</div>';
			else{
				t_footer += '<div id="status-C">0.00</div>';			
			}

			if (data.total_to_night != null) 
				t_footer += '<div id="status-C">'+ data.total_to_night+'</div>';
			else{
				t_footer += '<div id="status-C">0.00</div>';			
			}
			
			if (data.total_to != null) 
				t_footer += '<div id="status-A">'+ data.total_to+'</div>';
			else{
				t_footer += '<div class="total">0.00</div>';			
			}

			t_footer += '</td>';

				// +'<div>'+ data.total_to_night+'</div>'+'<div>'+ data.total_to+'</div>'+'</td>';
			$('#tp_driver_table_footer').html(t_footer);

			$('#tp_driver_table').DataTable( {
				scrollY:        "300px",
				scrollX:        true,
				scrollCollapse: false,
				paging:         false,
				autoWidth: 		true,
				fixedColumns:   {
					leftColumns: 3,
					rightColumns: 1
				},
				columnDefs: [
					{ "width": 210, "targets": 0 }
				],
			});

		}
	});
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