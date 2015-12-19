$(document).ready(function(){

	$('#driver_data').each(function(){
		$.ajax({
			url: 'available/get_driver',
			type: 'post',
			data: {page: 1},
			success: function(data, status) {
				$("#driver_data").append(data);
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		}); 
	})
});
	