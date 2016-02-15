$(function(){
	$("#errmsg").hide();
	
    $('#table-unassigned-bags tbody').on('click', 'button#cashturnover-button', function () {
        $("#unassignedModal").modal({backdrop: 'static'});
    });

    $('#cashturnoverForm').submit(function(e){
    	e.preventDefault();
    	

    	 $.ajax({
			url: 'cashturnover/post_ct',
			type: 'post',
			data: $('#cashturnoverForm').serialize() + "&trp_id=" + trp_id,
			success: function(data, status) {
				if(data.status == 'success'){
					swal('Success', 'Cash turnover success.', 'success');
					$('#bag_no').val('');
					$('#batch').val('');
					$('#unassignedModal').modal('hide');
					$('#coo_select').each(function(){
						get_unassigned_bags($(this).val());
						get_assigned_bags($(this).val());

				    });

				}else if(data.status == 'bag_error'){
					swal('Error', 'Bag already exists in the batch.', 'error');
				}else{
					swal('Error', 'Please set bag and batch.', 'error');
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
    });
    $('#coo_select').each(function(){
		get_unassigned_bags($(this).val());
		get_assigned_bags($(this).val());

    });
	$('#coo_select').on('change', function(){
		get_unassigned_bags($(this).val());
		get_assigned_bags($(this).val());
	});

});

var trp_id = '';

function get_unassigned_bags(coo_no){
	$.ajax({
		url:"cashturnover/unassigned_bags",
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status){
			var table_data = '';
			var test = '';
			if(data.unassigned_list.length > 0){
				console.log(data);
				for(var i = 0; i < data.unassigned_list.length; i++) {
					table_data += '<tr>'+
										'<td><button id="cashturnover-button" class="btn btn-primary" onclick="assignBag('+data["unassigned_list"][i]["emp_no_fk"]+', '+data["unassigned_list"][i]["trips_ctr"]+')">'+ data["unassigned_list"][i]["trips_ctr"] +'</button></td>'+
										'<td>' + data['unassigned_list'][i]['rte_nam'] + '</td>'+
										'<td>'+data['unassigned_list'][i]['unt_lic']+'</td>'+
										'<td>('+data['unassigned_list'][i]['emp_no_fk']+') '+data['unassigned_list'][i]['emp_lname']+', '+data['unassigned_list'][i]['emp_fname']+'</td>'+
										'<td>'+data['unassigned_list'][i]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+ formatDate(data['unassigned_list'][i]['to_dt']) +' ' + 
										formatAMPM(data['unassigned_list'][i]['to_dt'] + ' ' + data['unassigned_list'][i]['to_time']) +'</td>'+
									'</tr>';
				}

			}

			$('#table-unassigned-bags').dataTable().fnDestroy();

		    $('#unassigned_bags').html(table_data);
		    var tabler = $('#table-unassigned-bags').DataTable({
				paging : false,
				order: [[ 0, "desc" ], [ 5, "desc" ]]
			});
			$('#selectallrows').click(function(){
		    	$('#table-unassigned-bags tbody tr').addClass('DTTT_selected selected');
		    });
			$('#deselectallrows').click(function(){
		    	$('#table-unassigned-bags tbody tr').removeClass('DTTT_selected selected');
		    });
		},
		error: function(xhr, desc, err){
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		} 
	});
}

function get_assigned_bags(coo_no){

	$.ajax({
		url: 'cashturnover/assigned_bags',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			
			var table_data = '';
			var batch_no = '';
			if(data.assigned_list.length > 0){
				for(var i = 0; i < data.assigned_list.length; i++) {
					if(data["assigned_list"][i]["ct_batch_fk"] == "D") {
						batch_no = '1';
					}
					else {
						batch_no = '2';
					}
					table_data += '<tr>'+
										'<td>'+batch_no+'</td>'+
										'<td>'+data["assigned_list"][i]["ct_bag"]+'</td>'+
										'<td>('+data['assigned_list'][i]['emp_no_fk']+') '+data['assigned_list'][i]['emp_lname']+', '+data['assigned_list'][i]['emp_fname']+'</td>'+
										'<td>'+data['assigned_list'][i]['unt_lic']+'</td>';
					if(data.assigned_list[0]['ct_date'] == data.datetoday) {
						table_data += 	'<td><button id="editturnover-button" class="btn btn-primary" onclick="updateBag('+data["assigned_list"][i]["emp_no_fk"]+', '+data["assigned_list"][i]["trips_ctr"]+', '+batch_no+', '+data["assigned_list"][i]["ct_bag"]+')">'+ data["assigned_list"][i]["trips_ctr"] +'</button></td>';
					} else {
						table_data += 	'<td><button id="editturnover-button" class="btn btn-primary" disabled>'+ data["assigned_list"][i]["trips_ctr"] +'</button></td>';
					}
					table_data +=		'<td class="priority">'+data['assigned_list'][i]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+ formatDate(data['assigned_list'][i]['ct_date']) +' ' + 
										formatAMPM(data['assigned_list'][i]['ct_date'] + ' ' + data['assigned_list'][i]['ct_time']) +'</td>'+
									'</tr>';
				}
			}
			$('#table-assigned-bags').dataTable().fnDestroy();

		    $('#driver_data').html(table_data);
		    var tabler = $('#table-assigned-bags').DataTable({
				paging : false,
				order: [[ 6, "desc" ]]
			});
		    var cells = tabler.cells();
		    var sum = 0;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][5].replace(/,/g, ''));
		    }
		    $('#totalvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
		    $('#totalbags').html(data.assigned_list.length);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}

	});
}

function assignBag(emp_no, trip_ctr) {
	$.ajax({
		url: 'cashturnover/get_unassigned_detail',
		type: 'post',
		data: {emp_no: emp_no, trip_ctr: trip_ctr},
		success: function(data, status) {
			trp_id = data['trip'][0]['trp_id'];

			if(data.driver.length > 0){
				console.log(data);
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
										'<td>₱ '+data['trip'][0]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
					                '</tr>'+
					                '<tr>'+
										'<th>Arrival</th>'+
										'<td>'+ formatDate(data['trip'][0]['to_dt']) +' ' + 
										formatAMPM(data['trip'][0]['to_dt'] + ' ' + data['trip'][0]['to_time']) +'</td>'+
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