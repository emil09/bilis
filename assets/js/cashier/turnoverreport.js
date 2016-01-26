var dateSel = '';
$(function(){

	// get_turnovered_list();
	$(window).resize(function(){
		setTable();
	});
	$('#coo_select').each(function(){
		var date = new Date();
		date = date.getFullYear() + '-' + parseInt(date.getMonth()+1) + '-' + date.getDate();
		get_turnovered_list(date, $(this).val());
    });


	$('#coo_select').on('change', function(){
		setTable();
	});


    $('#table-turnoverreport tbody').on('click', 'button#editturnover-button', function () {
        $("#turnoverreportsModal").modal({backdrop: 'static'});
    });

    $('#updateturnoverForm').submit(function(e){
    	e.preventDefault();
    	$.ajax({
			url: 'turnoverreport/update_ct',
			type: 'post',
			data: $('#updateturnoverForm').serialize() + "&trp_id=" + trp_id,
			success: function(data, status) {
				if(data.status == 'success'){
					swal('Success', 'Cash turnover updated.', 'success');
					setTable();
					$(window).resize(function(){
						setTable();
					});
					$('#turnoverreportsModal').modal('hide');
				}else if(data.status == 'bag_error'){
					swal('Error', 'Bag already exists in the batch.', 'error');
				}else{
					swal('Error', 'Cash turnover not updated.', 'error');
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
    });


});

function setTable(){
	var date = new Date();
	var f_date = $('#turnover-date-filter').val();

	if(f_date == ''){
		date = date.getFullYear() + '-' + parseInt(date.getMonth()+1) + '-' + date.getDate();
	}else{
		date = f_date;
	}
	get_turnovered_list(date, $('#coo_select').val());
}

var trp_id = '';

function get_turnovered_list(ct_date, coo_no){


	$.ajax({
		url: 'turnoverreport/turnovered_list',
		type: 'post',
		data: {ct_date: ct_date, coo_no: coo_no},
		success: function(data, status) {
			var table_data = '';
			var batch_no = '';
			if(data.turnover_report.length > 0){
				for(var i = 0; i < data.turnover_report.length; i++) {
					if(data["turnover_report"][i]["ct_batch_fk"] == "D") {
						batch_no = '1';
					}
					else {
						batch_no = '2';
					}
					table_data += '<tr>'+
										'<td>'+batch_no+'</td>'+
										'<td>'+data["turnover_report"][i]["ct_bag"]+'</td>'+
										'<td>('+data['turnover_report'][i]['emp_no_fk']+') '+data['turnover_report'][i]['emp_lname']+', '+data['turnover_report'][i]['emp_fname']+'</td>'+
										'<td>'+data['turnover_report'][i]['unt_lic']+'</td>';
					if(data.turnover_report[0]['ct_date'] == data.datetoday) {
						table_data += 	'<td><button id="editturnover-button" class="btn btn-primary" onclick="updateBag('+data["turnover_report"][i]["emp_no_fk"]+', '+data["turnover_report"][i]["trips_ctr"]+', '+batch_no+', '+data["turnover_report"][i]["ct_bag"]+')">'+ data["turnover_report"][i]["trips_ctr"] +'</button></td>';
					} else {
						table_data += 	'<td><button id="editturnover-button" class="btn btn-primary" disabled>'+ data["turnover_report"][i]["trips_ctr"] +'</button></td>';
					}
					table_data +=		'<td class="priority">'+data['turnover_report'][i]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+ formatDate(data['turnover_report'][i]['ct_date']) +' ' + 
										formatAMPM(data['turnover_report'][i]['ct_date'] + ' ' + data['turnover_report'][i]['ct_time']) +'</td>'+
									'</tr>';
				}
			}
			$('#table-turnoverreport').dataTable().fnDestroy();

		    $('#driver_data').html(table_data);
		    var tabler = $('#table-turnoverreport').DataTable({
				paging : false,
				autoWidth: false,
				scrollY: '45vh',
				scrollCollapse: true,
				scrollX: 'true',
				fixedHeader: false,
				order: [[ 6, "desc" ]]
			});
		    var cells = tabler.cells();
		    var sum = 0;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][5].replace(/,/g, ''));
		    }
		    $('#totalvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
		    $('#totalbags').html(data.turnover_report.length);
			$('#selectallrows').click(function(){
		    	$('#table-turnoverreport tbody tr').addClass('DTTT_selected selected');
		    });
			$('#deselectallrows').click(function(){
		    	$('#table-turnoverreport tbody tr').removeClass('DTTT_selected selected');
		    });

		    $('#turnover-date-filter').datepicker({
		    	format: 'yyyy-mm-dd',
		    	endDate: '0d'
		    });

			$('#turnover-date-filter').datepicker('setDate', dateSel);

		   // var test ='';
		    $('#turnover-date-filter-button').click(function(){
				setTable();
	     		dateSel = $('#turnover-date-filter').datepicker().val();
     		});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}

	});
}
var batch_bk = '';
function updateBag(emp_no, trip_ctr, batch_no, bag_no) {
	$.ajax({
		url: 'turnoverreport/get_reviewed_detail',
		type: 'post',
		data: {emp_no: emp_no, trip_ctr: trip_ctr, bag_no: bag_no, batch_no: batch_no},
		success: function(data, status) {
			trp_id = data['trip'][0]['trp_id'];
			if(data['bagbatch']['batch'] == '1'){
				batch_bk = 'D';
			} else {
				batch_bk = 'N';
			}
			$('#bag_no').val(data['bagbatch']['bag_no']);
			$('#batch').val(batch_bk);

			if(data.driver.length > 0){
				for(var i = 0; i < data.driver.length; i++) {

					var table_data = '<tr>'+
										'<th>Trip</th>'+
										'<td>'+ data['trip'][0]['trips_ctr'] +'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Route</th>'+
										'<td>'+data['driver'][i]['rte_nam']+'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Unit</th>'+
										'<td>'+data['driver'][i]['unt_lic']+'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Driver</th>'+
										'<td>(' + data['driver'][i]['emp_no_fk'] + ') '+data['driver'][i]['emp_lname']+', '+data['driver'][i]['emp_fname']+'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Amount Turnover</th>'+
										'<td>₱ '+data['trip'][0]['amt_in']+'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Arrival</th>'+
										'<td>'+ formatDate(data['driver'][0]['start_dt']) +' ' + 
										formatAMPM(data['driver'][0]['start_dt'] + ' ' + data['driver'][0]['start_time']) +'</td>'+
					                '</tr>'; 
				}
				$('#selected_details').html(table_data);
			}
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
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