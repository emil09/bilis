$(function(){
	$('#loc_select').each(function(){
		get_uncollected_sacks($(this).val());
    });
	$('#loc_select').on('change', function(){
		get_uncollected_sacks($(this).val());
	});
});

function get_uncollected_sacks(loc_no) {
	$.ajax({
		url:"cashpickup/uncollected_sacks",
		type: 'post',
		data: {loc_no: loc_no},
		success: function(data, status){
			var sacks_data = '';
			var batch_no = '';
			if(data.sacks.length > 0) {
				console.log(data);
				for(var i=0;i<data.sacks.length;i++) {
					if(data.sacks[i]['ct_batch_fk'] == "D") {
						batch_no = '1';
					}
					else {
						batch_no = '2';
					}
					sacks_data += '<tr><td><button type="button" id="collect_button" class="btn btn-success" onclick="collectSack('+data.sacks[i]['ct_id']+')">Collect</button></td>'+
										'<td>'+formatDate(data.sacks[i]['ct_date'])+'</td>'+
										'<td>'+data.sacks[i]['loc_name']+'</td>'+
										'<td>'+batch_no+'</td>'+
										'<td>'+data.sacks[i]['ct_sack']+'</td>'+
										'<td>'+data.sacks[i]['total_bags']+'</td></tr>';
				}
			}
			$('#table-uncollected-sacks').dataTable().fnDestroy();
			$('#uncollected_sacks').html(sacks_data);
			var tabler = $('#table-uncollected-sacks').DataTable({
				paging : false,
				order: [[ 1, "desc" ], [ 2, "asc" ]]
			});
			var cells = tabler.cells();
		    var sum = 0;
		    for(var ctr=0;ctr<cells['context'][0]['aoData'].length;ctr++) {
		    	sum += parseInt(cells['context'][0]['aoData'][ctr]['_aData'][5].replace(/,/g, ''));
		    }
		    $('#totalsacks').html(data.sacks.length);
		    $('#totalbags').html(sum);
			
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});
}

function collectSack(ct_id) {
	swal({   
        title: 'Are you sure you want to collect this sack?',
        text: 'Action will not be undone',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        closeOnConfirm: false
    }, function() { 
    	swal('Success', 'You collected the sack.', 'success');
    });
}

function formatDate(date){

	date = new Date(date);
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
