$(function(){
	get_dispatch_list();
	$('#display-report').click(function(){
		get_dispatch_list();
	});
});

function get_dispatch_list() {
	$.ajax({
		url: "get_dispatch_list",
		type: 'post',
		data: $('#filterForm').serialize(),
		success: function(data, status){
			// console.log(data);
			var thead_data = '<tr><th>Route</th><th>Status</th>';
			var tbody_data = '';
			var lg = 0;

			for(var i = 0; i < data.date.length; i++){
				thead_data += '<th>' + formatDate(new Date(data.date[i])) + '</th>';
				// $('#dispatch-by-driver-tbody').html('<td>test</td>')
			}
			thead_data += '</tr>';
			$('#dispatch-by-driver-thead').html(thead_data);

			for(var j = 0; j < data.routes.length; j++){
				tbody_data += '<tr><td rowspan="2">' + data.routes[j]['rte_nam'] + '</td>';
				tbody_data += '<td>Dispatched</td>';

				for(var x = 0; x < data.routes[j]['dispatched'].length; x++){
					tbody_data+='<td>'+data.routes[j]['dispatched'][x]['total']+'</td>';
				}
				tbody_data += '</tr>';

				tbody_data += '<tr><td>Not Dispatched</td>';
				for(var y = 0; y < data.routes[j]['not_dispatched'].length; y++){
					tbody_data += 	'<td><div class="dropdown">'+'<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #00C0EF">'+
									data.routes[j]['not_dispatched'][y]['total'] +'</a>'+
									'<ul class="dropdown-menu">'+
									'<li>'+'<a><strong>Available: </strong>'+ data.routes[j]['not_dispatched'][y]['available']+'</a>'+ '</li>'+
									'<li>'+'<a><strong>Coding: </strong>'+ data.routes[j]['not_dispatched'][y]['coding_unt']+'</a>'+ '</li>'+
									'<li>'+'<a><strong>Maintenance: </strong> 0 </a>'+ '</li>'+
									'</ul></div></td>';
				}
				tbody_data += '</tr>';
			}

			// $('#dispatch-by-driver').dataTable().fnDestroy();
			$('#dispatch-by-driver-tbody').html(tbody_data);

			// var tabler = $('#dispatch-by-driver').DataTable({
			// 	paging : true,
			// 	lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]]
			// });

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
	return monthNames[monthIndex] + ' ' + day + ', '+ year;
}