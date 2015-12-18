$(document).ready(function(){
	$("#errmsg").hide();
	
	$("#employeeForm").submit(function(event){
		event.preventDefault();	 
		console.log($('#employeeForm').serialize());
        $.ajax({
			url: 'save_employee',
			type: 'post',
			data: $('#employeeForm').serialize(),
			success: function(data, status) {
				data = JSON.parse(data);
				console.log(data);
				if(data.status == 'success'){
					console.log(data.msg);
					// window.location.href = data.url + '/dashboard';
				}
				else{
					console.log(data.msg);
					$("#errmsg").html('<button type="button" class="close" id="errmsg-close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.msg).show();
					
					$("#errmsg-close").click(function(){
						$('#errmsg').fadeOut('slow');
					});
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
	    }); 
	});
});
	