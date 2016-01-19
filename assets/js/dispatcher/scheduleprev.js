var dates = new Array();
$(function(){

	var d = 1;

	if(d == 1){
		$('#next').attr('disabled',true);
	}else{
		$('#next').attr('disabled',false);
	}
	getdata(d);
	$('#prev').click(function(){

		d = d + 7;
		getdata(d);
		$('#next').attr('disabled',false);



	});
	$('#next').click(function(){
		
			d = d - 7;
			getdata(d);
			if(d == 1){
				$('#next').attr('disabled',true);
			}else{
				$('#next').attr('disabled',false);
			}

	});

	

	

});

function getdata(d){
	$.ajax({
		url: 'get_prev',
		type: 'post',
		data: {d: d},
		success: function(data, status) {
			prevheader = '<tr>'+'<th>Driver</th><th>SHIFT</th>';
			dates = [];
			for (var i = 0; i < data['dates'].length; i++) {
				prevheader +='<th>'+ data['dates'][i] +'</th>';
				dates.push(data['dates'][i]);
			};

			prevheader += '</tr>';
			$('#prevheader').html(prevheader);

			$('#coo_select').each(function() {
				getDrivers(this.value);
			});
			$('#coo_select').on('change', function() {
				getDrivers(this.value);
			});

		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function getDrivers(coo_no){
	$.ajax({
		url: 'get_prev_driver',
		type: 'post',
		data: {coo_no: coo_no, dates: dates},
		success: function(data, status) {
			var prevbody = '';

			for(var i = 0; i < data['driver'].length; i++) {
				prevbody += '<tr>'+
							'<td>'+data['driver'][i].emp_lname + ', ' + data['driver'][i].emp_fname + ' (' + data['driver'][i].emp_no + ')'+'</td>'+
							'<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>';

				var sched_dt = new Array();			
				if(data['driver'][i]['sched'].length>0){
					
					for(var c=0; c < data['driver'][i]['sched'].length; c++){
						sched_dt.push(data['driver'][i]['sched'][c]['sched_dt']);
					}
				}

				for(var d=0; d < dates.length; d++){

					var chek = sched_dt.indexOf(dates[d]);

					console.log(chek);
					if(sched_dt.indexOf(dates[d]) !== -1){
						if(data['driver'][i]['sched'][chek]['shift_code_fk'] == 'D'){
							prevbody +='<td><div class="day  unit-plate">'+data['driver'][i]['sched'][chek]['unt_lic']+'</div> <div class="night"></div></td>';
						}else{
							prevbody +='<td><div class="day"></div> <div class="night unit-plate">'+data['driver'][i]['sched'][chek]['unt_lic']+'</div></td>';
						}
					}else{
						prevbody += '<td></td>';
					}
				}

			    prevbody +='</tr>';
			}

			$('#prevbody').html(prevbody);









			// console.log(data);
			// for(var i=0; i<data['driver'].length;i++){

			// 	prevbody += '<tr>'+
			// 				'<td>'+data['driver'][i].emp_lname + ', ' + data['driver'][i].emp_fname + ' (' + data['driver'][i].emp_no + ')'+'</td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<td></td>'+
			// 				'<tr/>';
			// }
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});

}