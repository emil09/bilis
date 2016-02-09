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
			var thead_data = '<th>Route</th><th>Status</th>';
			var tbody_data = '';
			var tfoot_data = '';
			var lg = 0;
			// for(var i = 0; i < data.date.length; i++){
			// 	thead_data += '<th>' + data.date[i] + '</th>';
			// 	// $('#dispatch-by-driver-tbody').html('<td>test</td>')
			// }
			// $('#dispatch-by-driver-thead').append(thead_data);

			for(var i = 0; i < data.date.length; i++){
				thead_data += '<th>' + formatDate(new Date(data.date[i])) + '</th>';
				// $('#dispatch-by-driver-tbody').html('<td>test</td>')
			}
			$('#dispatch-by-driver-thead').html(thead_data);

			for(var j = 0; j < data.routes.length; j++){
				tbody_data += '<tr><td rowspan="2">' + data.routes[j]['rte_nam'] + '</td>';

				tbody_data += '<td>Dispatched</td>';
				for(var x = 0; x < data.routes[j]['dispatched'].length; x++){
					tbody_data+='<td>'+data.routes[j]['dispatched'][x]['total']+'</td>';
				}

				tbody_data += '</tr><tr><td>Not Dispatched</td>';
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

			$('#dispatch-by-driver-tbody').html(tbody_data);


			// if(data.route_list_result.length > 0) {
			// 	// if(data.dispatch_list_result[1].length > 0) {
			// 		console.log(data.dispatch_list_result[1][0]);
			// 		thead_data = '<tr><th>Route</th><th>Count</th>';
			// 		for(var i=1; i<=7; i++) {
			// 			if(lg < data.dispatch_list_result[i].length) lg=parseInt(data.dispatch_list_result[i].length);
			// 			console.log(data.dispatch_list_result[i]);
			// 			thead_data += '<th>'+formatDate(new Date(data.dispatch_list_result[i][0]['start_dt']))+'</th>';
			// 		}
			// 		thead_data += '</tr>';
			// 		for(var i=0; i<data.route_list_result.length; i++) {
			// 			tbody_data += '<tr><td rowspan="2">'+data.route_list_result[i]['rte_nam']+'</td><td>Dispatched</td>';
			// 			if(data.route_list_result[i]['rte_nam'] == data.dispatch_list_result[1][0]['rte_nam']) {
			// 				tbody_data += '<td>'+data.dispatch_list_result[1][0]['dsp_unit']+'</td>';
			// 			} else {
			// 				tbody_data += '<td>0</td>';
			// 			}
			// 			tbody_data += '</tr><tr><td>Not Dispatched</td>';
			// 			if(data.route_list_result[i]['rte_nam'] == data.dispatch_list_result[1][0]['rte_nam']) {
			// 				tbody_data += '<td>'+data.dispatch_list_result[1][0]['udsp_unit']+'</td>';
			// 			} else {
			// 				tbody_data += '<td>0</td>';
			// 			}
			// 			tbody_data += '</tr>';
			// 		}
					
			// 		$('#dispatch-by-driver-thead').html(thead_data);
			// 		$('#dispatch-by-driver-tbody').html(tbody_data);
			// 		for(var i=1; i<=7; i++) {
			// 			// tbody_data += '<tr>
			// 	  //           				<td rowspan="2">Almar - Welcome</td>
			// 	  //           				<td>Dispatched</td>
			// 	  //           				<td>6</td>
			// 	  //           				<td>5</td>
			// 	  //           				<td>6</td>
			// 	  //           				<td>2</td>
			// 	  //           				<td>3</td>
			// 	  //           				<td>6</td>
			// 	  //           				<td>3</td>
			// 	  //           			</tr>
			// 	  //           			<tr>
			// 	  //           				<td>Not Dispatched</td>
			// 	  //           				<td>11</td>
			// 	  //           				<td>12</td>
			// 	  //           				<td>11</td>
			// 	  //           				<td>15</td>
			// 	  //           				<td>14</td>
			// 	  //           				<td>11</td>
			// 	  //           				<td>14</td>
			// 	  //           			</tr>';
			// 			tbody_data += '<tr><td rowspan="2"></td>Dispatched<td>';
			// 		}
			// 	// }
			// }
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