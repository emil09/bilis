$(function(){
	$('#coo_select').each(function() {
		getActiveList(this.value);
	});
	$('#coo_select').on('change', function() {
		getActiveList(this.value);
	});
});

function getActiveList(coo_no){
	$.ajax({
		url: 'activetripsreport/active_trips_list',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			console.log(data);
			var table_data = '';
			for(var i = 0; i < data.length; i++) {

				start_date = formatDate(new Date(data[i]['start_dt']));
				start_time = formatAMPM(new Date(data[i]['start_dt'] + ' '+data[i]['start_time']));

				table_data += '<tr>'+
					'<td>'+ (parseInt(data[i]['count_trp'])) +'</td>'+
					'<td>'+ data[i]['rte_nam']+'</td>'+
					'<td>'+data[i]['unt_lic']+'</td>'+
					'<td>'+ data[i]['emp_lname'] + ', ' + data[i]['emp_fname'] +' ('+data[i]['emp_no']+')</td>'+
					'<td>'+start_date+ ' ' + start_time +'</td>'+
					'<td>'+data[i]['shift_name']+' Shift</td>'+
				'</tr>';
			}

			$('#table-activetripsreport').dataTable().fnDestroy();
			$("#active_list_data").html(table_data);
			var tabler = $('#table-activetripsreport').DataTable({ // height: 837px
				paging : false,
				scrollY: '45vh',
    			scrollCollapse: true,
				scrollX: true,
				fixedHeader: false,
				dom: 'T<"clear">lfrtip',
				tableTools: {
		            sRowSelect:   'multi',
		            sRowSelector: 'td:first-child',
		            aButtons:     [  ]
		        }
			});

			$('#selectallrows').click(function(){
		    	$('#table-activetripsreport tbody tr').addClass('DTTT_selected selected');
		    });
			$('#deselectallrows').click(function(){
		    	$('#table-activetripsreport tbody tr').removeClass('DTTT_selected selected');
		    });

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function formatAMPM(date) {
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