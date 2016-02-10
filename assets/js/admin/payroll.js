$(function(){
	$('#pickdate').datepicker({
    	format: 'yyyy-mm-dd',
    	endDate: '0d'
    });
	$('#display-report').click(function(e){
		e.preventDefault();
		get_payroll_report();
	});
	$('#excel-report').click(function(e){
		e.preventDefault();
		$('.buttons-excel').click();
	});
	$('#pdf-report').click(function(e){
		e.preventDefault();
		$('.buttons-pdf').click();
	});
	$('#print-report').click(function(e){
		e.preventDefault();
		$('.buttons-print').click();
	});
});

function get_payroll_report() {
	$.ajax({
		url: 'payroll/filtered_report',
		type: 'post',
		data: $("#filterForm").serialize(),
		success: function(data, status) {
			console.log(data);
			if(data.status != "error") {
				$('#coo_header').html($( "#coo_select option:selected" ).text());
				$('#date_header').html(formatDate(new Date($("#payroll-date").val())));
				$('#shift_header').html($( "#shift option:selected" ).text());
				if(data.payroll.length > 0) {
					$('#export-group').fadeIn();
					$('#payroll-panel').fadeIn();
					var payroll_data = '';
					for(var i=0; i<data.payroll.length; i++) {
						payroll_data += '<tr><td>'+data.payroll[i]['emp_lname']+'</td>'+
											'<td>'+data.payroll[i]['emp_mname']+'</td>'+
											'<td>'+data.payroll[i]['emp_fname']+'</td>'+
											'<td>'+data.payroll[i]['rte_nam']+'</td>'+
											'<td>1,100</td>'+
											'<td></td>'+
											'<td></td>'+
											'<td></td>'+
											'<td>'+data.payroll[i]['unt_lic']+'</td>'+
											'<td></td>';
						if(data.payrollwithcash.length > 0) {
							var sum = 0;
							for(var j=0; j<data.payrollwithcash.length; j++) {
								if(data.payrollwithcash[j]['emp_no_fk'] == data.payroll[i]['emp_no_fk']) {
									sum += parseFloat(data.payrollwithcash[j]['amt_in']);
								}
							}
							payroll_data += '<td>'+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>';
						} else if(data.payrollwithcash.length == 0) {
							var sum = 0;
							payroll_data += '<td>'+sum.toFixed(2).toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")+'</td>';
						} 
						payroll_data += '</tr>';
					}
					
				} else if(data.payroll.length == 0) {
					payroll_data = '';
					$('#payroll-panel').fadeIn();
					$('#export-group').fadeOut();
				}
				$('#payroll-table').dataTable().fnDestroy();
				$('#payroll-tbody').html(payroll_data);
				var tabler = $('#payroll-table').DataTable({
					paging : false,
					order: [[ 0, "asc" ]],
					dom: 'Bfrtip',
			        buttons: [
			            // {
			            //     extend: 'csvHtml5',
			            //     fieldSeparator: '\t',
			            //     title: 'Honorarium',
			            //     extension: '.txt'
			            // },
			            {
			            	extend: 'excelHtml5',
			            	title: 'Honorarium ('+$( "#coo_select option:selected" ).text()+') '+formatDate(new Date($("#payroll-date").val()))+' '+$( "#shift option:selected" ).text(),
			            },
			            {
			            	extend: 'pdfHtml5',
			            	orientation: 'landscape',
			            	title: 'Honorarium ('+$( "#coo_select option:selected" ).text()+') '+formatDate(new Date($("#payroll-date").val()))+' '+$( "#shift option:selected" ).text(),
			            },
			            {
			            	extend: 'print',
			            	orientation: 'landscape',
			            	title: 'Honorarium ('+$( "#coo_select option:selected" ).text()+') '+formatDate(new Date($("#payroll-date").val()))+' '+$( "#shift option:selected" ).text(),
			            }
			        ]
				});
			} else {
				$('#export-group').fadeOut();
				$('#payroll-panel').fadeOut();
				$('#alert-error-status').html(data.msg);
				$('#alert-error-status').fadeIn().delay(3500).fadeOut();
			}
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
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
	return monthNames[monthIndex] + '. ' + day + ', '+ year;
}