$(function(){
	get_active_list();
});

function get_active_list(){
	$.get("activetripsreport/active_list", function(data, status){
		var table_data = '';
		if(data.active_list.length > 0){
			console.log(data);
			for (var i = 0; i < data.active_list.length; i++) {
				var x = 0;
				var total = 0;
				var average = 0;
				table_data += '<tr>'+
									'<td><div class="dropdown"><a href="#" class="dropdown-toggle fa fa-caret-right" data-toggle="dropdown"> ('+data.active_list[i]['emp_no_fk']+') '+data.active_list[i]['emp_lname']+', '+data.active_list[i]['emp_fname']+'</a>'+
									'<ul class="dropdown-menu"><li>'+
										'<a><strong>Route:</strong> '+data.active_list[i]['rte_nam']+'</a>'+
										'<a><strong>Start Date:</strong> '+data.active_list[i]['start_dt']+'</a>'+
										'<a><strong>Start Time:</strong> '+data.active_list[i]['start_time']+'</a>'+
									'</li></ul></div></td>'+
									'<td>'+data.active_list[i]['unt_lic']+'</td>';
				for (var j = 0; j < data.active_cash.length; j++) {
					if(data.active_list[i]['emp_no_fk'] == data.active_cash[j]['emp_no_fk']) {
						if(data.active_cash[j]['trips_ctr'] == x+1) {
							table_data += '<td>'+data.active_cash[j]['amt_in']+'</td>';
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
				table_data += '<td>'+total.toFixed(2)+'</td>'+
									'<td>'+average.toFixed(2)+'</td>'+
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
		$('#selectallrows').click(function(){
	    	$('#table-activetripsreport tbody tr').addClass('DTTT_selected selected');
	    });
		$('#deselectallrows').click(function(){
	    	$('#table-activetripsreport tbody tr').removeClass('DTTT_selected selected');
	    });
	});
}