$(function(){
	$("#errmsg").hide();
	get_available_turnover();
	
    $('#table-cashturnover tbody').on('click', 'button#cashturnover-button', function () {
        $("#cashturnoverModal").modal({backdrop: 'static'});
    });

    $('#cashturnoverForm').submit(function(e){
    	e.preventDefault();
    	

    	 $.ajax({
			url: 'cashturnover/post_ct',
			type: 'post',
			data: $('#cashturnoverForm').serialize() + "&trp_id=" + trp_id,
			success: function(data, status) {
				console.log(data);
				if(data.status == 'success'){
					swal('Success', 'Cash turnover success.', 'success');
					get_available_turnover();
					$('#bag_no').val('');
					$('#batch').val('');
					$('#cashturnoverModal').modal('hide');
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
});

var trp_id = '';

function get_available_turnover(){
	$.get("cashturnover/available_turnover", function(data, status){
		var table_data = '';
		var test = '';
		if(data.cash_turnover.length > 0){
			for(var i = 0; i < data.cash_turnover.length; i++) {
				table_data += '<tr>'+
									'<td><button id="cashturnover-button" class="btn btn-primary" onclick="assignBag('+data["cash_turnover"][i]["emp_no_fk"]+', '+data["cash_turnover"][i]["trips_ctr"]+')">'+ data["cash_turnover"][i]["trips_ctr"] +'</button></td>'+
									'<td>' + data['cash_turnover'][i]['rte_nam'] + '</td>'+
									'<td>'+data['cash_turnover'][i]['unt_lic']+'</td>'+
									'<td>('+data['cash_turnover'][i]['emp_no_fk']+') '+data['cash_turnover'][i]['emp_lname']+', '+data['cash_turnover'][i]['emp_fname']+'</td>'+
									'<td>'+data['cash_turnover'][i]['amt_in']+'</td>'+
									'<td>'+ formatDate(data['cash_turnover'][i]['to_dt']) +' ' + 
									formatAMPM(data['cash_turnover'][i]['to_dt'] + ' ' + data['cash_turnover'][i]['to_time']) +'</td>'+
								'</tr>';
			}
			
		}

		$('#table-cashturnover').dataTable().fnDestroy();

	    $('#available_turnover').html(table_data);
	    var tabler = $('#table-cashturnover').DataTable({
			paging : false,
			scrollY: '45vh',
			scrollCollapse: true,
			scrollX: 'true',
			fixedHeader: false,
			order: [[ 5, "desc" ]]
		});
		$('#selectallrows').click(function(){
	    	$('#table-cashturnover tbody tr').addClass('DTTT_selected selected');
	    });
		$('#deselectallrows').click(function(){
	    	$('#table-cashturnover tbody tr').removeClass('DTTT_selected selected');
	    });
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

function assignBag(emp_no, trip_ctr) {
	$.ajax({
		url: 'cashturnover/get_assigned_detail',
		type: 'post',
		data: {emp_no: emp_no, trip_ctr: trip_ctr},
		success: function(data, status) {
			trp_id = data['trip'][0]['trp_id'];
			
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
										'<td>'+data['trip'][0]['amt_in']+'</td>'+
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