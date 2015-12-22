$(document).ready(function(){

    $('#table-dispatcher tbody').on('click', 'button#editModal', function () {
        $("#editModalWindow").modal({backdrop: 'static'});
    });
    $('#table-dispatcher tbody').on('click', 'button#dispatch-button', function () {
        swal({   
        	title: 'Are you sure?',
        	text: 'You will not be able to dispatch it again!',
        	type: 'warning',
        	showCancelButton: true,
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'Yes, dispatch unit.',
        	closeOnConfirm: false
        }, function() {   
        	swal('Dispatch Success!', 'The unit has been dispatched.', 'success'); 
        });
    });
    $(".select2").select2({
        placeholder: "Select a vehicle",
        allowClear: true
    });

	$('#coo_select').each(function() {
		 
		getDriver(this.value);
	});
	$('#coo_select').on('change', function() {
		getDriver(this.value);
	});
	

});

function getDriver(coo_no){
	$.ajax({
			url: 'available/get_driver',
			type: 'post',
			data: {coo_no: coo_no},
			success: function(data, status) {
				var table_data = '';
				for (var i = 0; i < data.driver.length; i++) {
					table_data += '<tr><td><input type="checkbox"></td><td>' + 
					data.driver[i].lname + ', ' + data.driver[i].fname + 
					' (' + data.driver[i].emp_no + ')' +
					'</td><td></td><td><button class="btn btn-warning editModal" '+
					' id="editModal" onclick="setSched('+data.driver[i].emp_no+')">' + 
					'<i class="fa fa-edit"></i> Edit</button></td><td><button id="dispatch-button" class="btn btn-warning col-xs-11">DISPATCH</button></td><td><span class="dispatch-status">Dispatch in Day Shift</span></td></tr>';
				};
				$("#driver_data").html(table_data);
				$("#driver_dispatching").html(data.total);
				$('#table-dispatcher').footable();

			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		});
}

function setSched(emp_no) {
	$('#route').empty();
	$.ajax({
		url: 'available/get_driver_by_empno',
		type: 'post',
		data: {emp_no: emp_no},
		success: function(data, status) {
			console.log(data);
			var driver_info = data.driver[0].lname + ' (' + data.driver[0].emp_no + ')' ;
			$('#driver_name').html(driver_info);
			$('.server-time').html(data.date);

			$.each(data.driver[0].route, function() {
			    $('#route').append($("<option />").val(this.rte_no).text(this.rte_nam));
			});

			$('#route').each(function(){
				getUnit(this.value);
			});
			$('#route').on('change', function() {
				getUnit(this.value);
			});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}


function getUnit(route_no){

	$('#unit').empty();
	$.ajax({
		url: 'available/get_unit',
		type: 'post',
		data: {route_no: route_no},
		success: function(data, status) {
			$.each(data, function() {
			    $('#unit').append($("<option />").val(this.unt_no).text(this.unt_lic));
			});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});

}