$(function(){
	$('#coo_select').each(function(){
		get_active_list($(this).val());
	});
	$('#coo_select').on('change', function(){
		get_active_list($(this).val());
	});
});


function get_active_list(coo_no){
	$.ajax({
		url: "activetripsreport/active_list",
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status){
			var table_data = '';
			if(data.active_list.length > 0){
				console.log(data);
				for (var i = 0; i < data.active_list.length; i++) {
					var x = 0;
					var total = 0;
					var average = 0;
					table_data += '<tr>'+
										'<td><div class="dropdown"><a href="#" class="dropdown-toggle fa fa-caret-right" data-toggle="dropdown" style="color: #00A65A"> ('+data.active_list[i]['emp_no_fk']+') '+data.active_list[i]['emp_lname']+', '+data.active_list[i]['emp_fname']+'</a>'+
										'<ul class="dropdown-menu"><li>'+
											'<a><strong>Route:</strong> '+data.active_list[i]['rte_nam']+'</a>'+
											'<a><strong>Start Date:</strong> '+data.active_list[i]['start_dt']+'</a>'+
											'<a><strong>Start Time:</strong> '+data.active_list[i]['start_time']+'</a>'+
										'</li></ul></div></td>'+
										'<td>'+data.active_list[i]['unt_lic']+'</td>';
					for (var j = 0; j < data.active_cash.length; j++) {
						if(data.active_list[i]['emp_no_fk'] == data.active_cash[j]['emp_no_fk']) {
							if(data.active_cash[j]['trips_ctr'] == x+1) {
								table_data += '<td><div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+data.active_cash[j]['amt_in'].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+
										'<ul class="dropdown-menu"><li>'+
											'<a><strong>Turnover Time:</strong> '+formatAMPM(data.active_cash[j]['to_dt']+" "+data.active_cash[j]['to_time'])+'</a>'+
										'</li></ul></div></td>';
								total+=parseFloat(data.active_cash[j]['amt_in']);
								x++;
							}
						}
					}
					average = total/x;
					while(x<7) {
						table_data += '<td>0.00</td>';
						x++;
					}
					table_data += '<td>'+total.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td>'+average.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>'+
										'</tr>'
				}
			}
			$('#table-activetripsreport').dataTable().fnDestroy();

	    $('#active_list_data').html(table_data);
		var tabler = $('#table-activetripsreport').DataTable({
			paging : false,
			autoWidth : false,
			scrollY: '45vh',
			scrollCollapse: true,
			scrollX: 'true',
			fixedHeader: false,
		});
		var cells = tabler.cells();
	    var sum = 0;
	    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
	    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][9].replace(/,/g, ''));
	    }
	    $('#totalvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
	    sum=0;
	    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
	    	sum += parseFloat(cells['context'][0]['aoData'][ctr]['_aData'][10].replace(/,/g, ''));
	    }
	    $('#totalAVEvalue').html('₱ '+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
		$('#selectallrows').click(function(){
	    	$('#table-activetripsreport tbody tr').addClass('DTTT_selected selected');
	    });
		$('#deselectallrows').click(function(){
	    	$('#table-activetripsreport tbody tr').removeClass('DTTT_selected selected');
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