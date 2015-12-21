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
					swal({
						'title': 'Success!',   
						'text': 'You successfully add employee.',   
						'type':'success'
					},
					function(){
						window.location.reload();
					});
				}
				else{
					console.log(data.msg);
					$('#infomsg').hide();
					$("#errmsg").html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-ban"></i> Error!</h4> ' + data.msg).show();
					$("html, body").animate({ scrollTop: 0 }, "slow");
					
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
	    }); 
	});

	
	$('#position').on('change', function() {
		console.log( this.value ); // 
		$.ajax({
			url: 'get_addedfield',
			type: 'post',
			data: {position: this.value},
			success: function(data, status) {
				$("#fields").html(data);
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		}); 
	});

	
	var currentDate = new Date();  
    $('#pickdate').datepicker();
});
	