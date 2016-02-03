var dateSel = '';
$(function(){
	var check = 0;
	var date = new Date();
	date = date.getFullYear() + '-' + parseInt(date.getMonth()+1) + '-' + date.getDate();
	dateSel = date;
	$('#sales-date').datepicker({
    	format: 'yyyy-mm-dd',
    	endDate: '0d'
    });
	$('#sales-date').datepicker('setDate', dateSel);
	$('#coo_select').each(function(){
		get_route_list($(this).val());
	});
	$('#coo_select').on('change', function(){
		get_route_list($(this).val());
	});
	if(check == 0) {
		$('#route-header').html('All Routes');
		$('#shift-header').html($('#shift option:selected').text());
		get_sales_by_driver_list('', '', $('#shift').val(), $('#sales-date').val());
	}
	$('#display-report').click(function(e){
		e.preventDefault();
		check = 1;
		if($('#coo_select').val() != '' && $('#route').val() != '') {
			$('#route-header').html($('#route option:selected').text());
			$('#shift-header').html($('#shift option:selected').text());
			get_sales_by_driver_list($('#coo_select').val(), $('#route').val(), $('#shift').val(), $('#sales-date').val());
		} else {
			$('#route-header').html('All Routes');
			$('#shift-header').html($('#shift option:selected').text());
			get_sales_by_driver_list('', '', $('#shift').val(), $('#sales-date').val());
		}
	});
	$('#pickdate').datepicker({
    	format: 'yyyy-mm-dd',
    	endDate: '0d'
    });
});

function get_route_list(coo_no) {
	$.ajax({
		url: "my_route_list",
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status){
			var route_data = '';
			var table_data = '';
			if(data.route_list.length == 0) { route_data += "<option value='' selected>All Routes</option>"; }
			if(data.route_list.length > 0) {
				for (var i=0; i<data.route_list.length; i++) {
					route_data += '<option value="'+data.route_list[i]['rte_no']+'">'+data.route_list[i]['rte_nam']+'</option>';
				}
			}
			$('#route').html(route_data);
		}
	});
}

function get_sales_by_driver_list(coo_no, rte_no, shift_code, start_dt) {
	$.ajax({
		url: "sales_by_driver_list",
		type: 'post',
		data: {coo_no: coo_no, rte_no: rte_no, shift_code: shift_code, start_dt: start_dt},
		success: function(data, status){
			console.log(data);
			var table_data = '';
			if(data.sales_list.length > 0){
				var lg_num = 0;
				for (var i = 0; i < data.sales_list.length; i++) {
					var x = 0;
					var total = 0;
					var average = 0;
					var enddate = '';
					var endtime = '';
					if(data.sales_list[i]['end_dt'] == "0000-00-00") {
						enddate = '';
						endtime = '';
					} else {
						enddate = data.sales_list[i]['end_dt'];
						endtime = data.sales_list[i]['end_time'];
					}
					table_data += '<tr>'+
										'<td><div class="dropdown"><a href="#" id="status-'+data.sales_list[i]['dsp_stat_fk']+'" class="dropdown-toggle fa fa-caret-right" data-toggle="dropdown"> '+data.sales_list[i]['emp_lname']+', '+data.sales_list[i]['emp_fname']+' ('+data.sales_list[i]['emp_no_fk']+')</a>'+
										'<ul class="dropdown-menu"><li>'+
											'<a><strong>Route:</strong> '+data.sales_list[i]['rte_nam']+'</a>'+
											'<a><strong>Start Date:</strong> '+data.sales_list[i]['start_dt']+'</a>'+
											'<a><strong>Start Time:</strong> '+data.sales_list[i]['start_time']+'</a>'+
											'<a><strong>End Date:</strong> '+enddate+'</a>'+
											'<a><strong>End Time:</strong> '+endtime+'</a>'+
											'<a><strong>Status:</strong> '+data.sales_list[i]['dsp_stat_fk']+'</a>'+
										'</li></ul></div></td>'+
										'<td>'+data.sales_list[i]['unt_lic']+'</td>';
					for (var ctr=0;ctr<data.sales_cash.length;ctr++) {
						if(lg_num < data.sales_cash[ctr]['trips_ctr']) {
							lg_num = data.sales_cash[ctr]['trips_ctr'];
						}
					}
					for (var j = 0; j < data.sales_cash.length; j++) {
						if(data.sales_list[i]['emp_no_fk'] == data.sales_cash[j]['emp_no_fk']) {
							if(data.sales_cash[j]['trips_ctr'] == x+1) {
								table_data += '<td><div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+data.sales_cash[j]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+
										'<ul class="dropdown-menu"><li>'+
											'<a><strong>Turnover Time:</strong> '+formatAMPM(data.sales_cash[j]['to_dt']+" "+data.sales_cash[j]['to_time'])+'</a>'+
										'</li></ul></div></td>';
								total+=parseFloat(data.sales_cash[j]['amt_in']);
								x++;
							}
						}
					}
					average = total/x;
					if(lg_num > 7) {
						while(x<lg_num) {
							table_data += '<td>0.00</td>';
							x++;
						}
					} else {
						while(x<7) {
							table_data += '<td>0.00</td>';
							x++;
						}
					}
					table_data += '<td style="color: #09B317">'+total.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+average.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'</tr>'
				}
			}
			var trip = 7;
			var foot = trip+2;
			thead_data = '<tr>'+
							'<th>Driver</th>'+
							'<th>Unit</th>';
			if(lg_num > trip) {
				trip = parseInt(lg_num);
				foot = parseInt(lg_num)+2;
			}
			for(var i=1; i<=trip; i++) {
				thead_data += '<th>Trip '+i+'</th>';
			}
			tfoot_data = '<tr>'+
                        '<th colspan="'+foot+'" style="text-align: right">TOTAL:</th>'+
                        '<th><span id="totalvalue"></span></th>'+
                        '<th><span id="totalAVEvalue"></span></th>'+
                        '</tr>';

			thead_data += '<th>Total</th><th>Average</th></tr>';

			$('#sales-by-driver-thead').html(thead_data);
			$('#sales-by-driver-tfoot').html(tfoot_data);

			$('#sales-by-driver').dataTable().fnDestroy();
		    $('#sales-by-driver-tbody').html(table_data);
			var tabler = $('#sales-by-driver').DataTable({
				paging : true,
				lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]]
				// scrollY: 300, 
			});
			var cells = tabler.cells();
		    var sum = 0;
		    var tots = trip+2;
		    var ave = trip+3;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][tots].replace(/,/g, ''));
		    }
		    $('#totalvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
		    sum=0;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][ave].replace(/,/g, ''));
		    }
		    $('#totalAVEvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
			$('#selectallrows').click(function(){
		    	$('#sales-by-driver tbody tr').addClass('DTTT_selected selected');
		    });
			$('#deselectallrows').click(function(){
		    	$('#sales-by-driver tbody tr').removeClass('DTTT_selected selected');
		    });
	    }
	});
}

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