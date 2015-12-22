$(document).ready(function(){

    $('#table-dispatcher').footable();
    $('#table-dispatcher tbody').on('click', 'button', function () {
        $("#editModalWindow").modal({backdrop: 'static'});
    });
    $('#editModalWindow').on('hidden', function () {
		
	    document.getElementById("schedForm").reset();
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

	var driver_no;
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
				' id="editModal" onclick="setSched('+data.driver[i].emp_no+ ',' +  data.driver[i].driver_no+')">' + 
				'<i class="fa fa-edit"></i> Edit</button></td><td></td><td></td></tr>';
			};
			$("#driver_data").html(table_data);
			$("#driver_dispatching").html(data.total);

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function setSched(emp_no, dvr_no) {
	driver_no = dvr_no;
	$('#route').empty();
	$.ajax({
		url: 'available/get_driver_by_empno',
		type: 'post',
		data: {emp_no: emp_no},
		success: function(data, status) {
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
	$("#unit").select2("val", "");
	$.ajax({
		url: 'available/get_unit',
		type: 'post',
		data: {route_no: route_no},
		success: function(data, status) {

			$('#unit').append($("<option />").val('').text(''));
			$.each(data.unit, function() {
			    $('#unit').append($("<option />").val(this.unt_no).text(this.unt_lic));
			});
			$.each(data.shift, function() {
			    $('#shift').append($("<option />").val(this.shift_code).text(this.shift_name));
			});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

$("#schedForm").submit(function(event){
	event.preventDefault();	 
	console.log(driver_no);
    console.log($("#schedForm").serialize()  + '&driver_no=' + driver_no);
    $.ajax({
		url: 'available/save_sched',
		type: 'post',
		data: $("#schedForm").serialize()  + '&driver_no=' + driver_no,
		success: function(data, status) {
			console.log(data);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
    }); 
});