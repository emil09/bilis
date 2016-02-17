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
			if(data.sacks.length > 0) {
				console.log(data);
				var sacks_data = '';
				var batch_no = '';
				for(var i=0;i<data.sacks.length;i++) {
					if(data.sacks[i]['ct_batch_fk'] == "D") {
						batch_no = '1';
					}
					else {
						batch_no = '2';
					}
					sacks_data += '<tr><td><button id="collect_button" class="btn btn-success" value="'+data.sacks[i]['ct_id']+'">Collect</button></td>'+
										'<td>'+data.sacks[i]['ct_date']+'</td>'+
										'<td>'+data.sacks[i]['loc_name']+'</td>'+
										'<td>'+batch_no+'</td>'+
										'<td>'+data.sacks[i]['ct_sack']+'</td>'+
										'<td>'+data.sacks[i]['total_bags']+'</td></tr>';
				}
				$('#uncollected_sacks').html(sacks_data);
			}
			
		}
	});
}