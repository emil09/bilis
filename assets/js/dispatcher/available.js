$(document).ready(function(){

	$('#editModalWindow').on('hidden', function () {
	    document.getElementById("schedForm").reset();
	});

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
        placeholder: "Select a vehicle"
    });
    var $eventSelect = $(".select2");
    $eventSelect.on("select2:select", function () { 
    	$('#select2-unit-container').addClass('unit-plate');
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
				console.log(data);
				var table_data = '';
				
				for (var i = 0; i < data.driver.length; i++) {
					var btn_dispatched = '';
					var unit = '';
					var shift = '';
					if(data.driver[i].is_today == true){
						btn_dispatched = '<button id="dispatch-button" class="btn btn-warning col-xs-11">DISPATCH</button>';
						unit = data.driver[i].unit_no;
						shift = 'Scheduled in ' + data.driver[i].shift_name + ' Shift';
						if(!data.driver[i].dsp_sched_no){
							btn_dispatched = ''
						}
						if(!unit){
							unit = '';
						}
						if(!data.driver[i].shift_name){
							shift = '';
						}
					}
					
					table_data += '<tr><td><input type="checkbox"></td><td>' + 
					data.driver[i].lname + ', ' + data.driver[i].fname + 
					' (' + data.driver[i].emp_no + ')' +
					'</td><td>'+ unit +'</td><td><button class="btn btn-warning editModal" '+
					' id="editModal" onclick="setSched('+data.driver[i].emp_no+ ',' +  data.driver[i].driver_no+')">' + 
					'<i class="fa fa-edit"></i> Edit</button></td><td>'+btn_dispatched+'</td><td><span class="dispatch-status">'+shift +'</span></td></tr>';
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

function setSched(emp_no, dvr_no) {
	driver_no = dvr_no;
	$('#route').empty();
	$.ajax({
		url: 'available/get_driver_detail',
		type: 'post',
		data: {emp_no: emp_no, dvr_no: dvr_no},
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

			if(data.sched_exist.length>0){
				console.log(data.sched_exist[0].unt_no);
				// $("#select").select2("val", data.sched_exist[0].unt_no);
				
				// $("#unit").select2("val", "175");

				$('#unit').append($("<option />").val(data.sched_exist[0].unt_no).text(data.sched_exist[0].unt_lic));
				$("#unit").select2("val", data.sched_exist[0].unt_no);
				// this.$("#yourSelector").select2("data", existingData);
			}

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}


function getUnit(route_no){
	$('#shift').empty();
	$('#unit').empty();
	$("#unit").select2("val", "");
	$('#select2-unit-container').removeClass('unit-plate');
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
			$('#coo_select').each(function() {
				getDriver(this.value);
				// console.log(this.value);
			});
			$('#editModalWindow').modal('hide');
			swal({   
				title: 'Success!',   
				text: 'Schedule successfully added.', 
				type: 'success' 
			});
			// console.log(data);
			// get_driver(coo_no);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
    }); 
});