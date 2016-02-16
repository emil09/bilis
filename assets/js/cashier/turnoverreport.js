var dateSel = '';
$(function(){

	$(window).resize(function(){
		setTable();
	});
	$('#coo_select').each(function(){
		var date = new Date();
		date = date.getFullYear() + '-' + parseInt(date.getMonth()+1) + '-' + date.getDate();
		dateSel = date;
		$('#turnover-date-filter').datepicker('setDate', dateSel);
		get_turnovered_list(date, $(this).val());
    });


	$('#coo_select').on('change', function(){
		setTable();
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
										'<td>'+data["turnover_report"][i]["ct_sack"]+'</td>'+
										'<td>('+data['turnover_report'][i]['emp_no_fk']+') '+data['turnover_report'][i]['emp_lname']+', '+data['turnover_report'][i]['emp_fname']+'</td>'+
										'<td>'+data['turnover_report'][i]['unt_lic']+'</td>'+
										'<td>'+ data["turnover_report"][i]["trips_ctr"] +'</td>'+
										'<td class="priority">'+data['turnover_report'][i]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+ formatDate(data['turnover_report'][i]['ct_date']) +' ' + 
										formatAMPM(data['turnover_report'][i]['ct_date'] + ' ' + data['turnover_report'][i]['ct_time']) +'</td>'+
										'<td>('+data['encoder_details'][i][0]['emp_no']+') '+data['encoder_details'][i][0]['emp_fname']+' '+data['encoder_details'][i][0]['emp_lname']+'</td>'
									'</tr>';
				}
			}
			$('#table-turnoverreport').dataTable().fnDestroy();

		    $('#driver_data').html(table_data);
		    var tabler = $('#table-turnoverreport').DataTable({
				paging : false,
				order: [[ 3, "asc" ]]
			});
		    var cells = tabler.cells();
		    var sum = 0;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][6].replace(/,/g, ''));
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