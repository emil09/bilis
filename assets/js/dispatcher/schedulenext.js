$(document).ready(function(){
	$('#coo_select').each(function() {
		getDriver(this.value);
	});
	$('#coo_select').on('change', function() {
		getDriver(this.value);
	});
	 $('#schednext_data').on('click', 'button#editModal', function () {
        $("#editModalWindow").modal({backdrop: 'static'});
        
    });


		
	
});

function getDriver(coo_no){
	console.log(coo_no); 
	var schednext_data = '';

	$.ajax({
		url: 'get_driver',
		type: 'post',
		data: {coo_no: coo_no},
		success: function(data, status) {
			console.log(data);
			for(var i = 0; i < data.length; i++) {
				schednext_data += 	
				'<tr>'+
			    	'<td>'+ data[i].emp_lname + ', ' + data[i].emp_fname + ' (' + data[i].emp_no + ')' + '</td>'+
					'<td><button id="editModal" onclick="setSched('+ data[i].emp_no +')" class="btn btn-warning">Set</button></td>'+ 
					'<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>' +                                            
			    '</tr>';
			}
			$('#schednext_data').html(schednext_data);	
			


		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function setSched(driver_no){
	console.log(driver_no);
}
