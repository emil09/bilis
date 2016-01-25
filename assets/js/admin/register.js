$(function(){
	mem_no();
	// $("#errmsg").hide();
	$('.reg-input').blur(function(){
		var form_g = $(this).data('formgroup');
		if($(this).val()== ''){
			$('#' + form_g).removeClass('has-success');	
			$('#' + form_g).removeClass('has-error');	
			$('#' + form_g + ' span.err-msg').html('');
		}else{
			$('#' + form_g).addClass('has-success');	

			$('#' + form_g).removeClass('has-error');	

			$('#' + form_g + ' span.err-msg').html('');
		}
	});

	$("#employeeForm").submit(function(event){
		event.preventDefault();	 
		console.log($('#employeeForm').serialize());
        $.ajax({
			url: 'save_employee',
			type: 'post',
			data: $('#employeeForm').serialize(),
			success: function(data, status) {
				if(data.status == 'success'){
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
					console.log(data);

					for(var i = 0; i < data['errors'].length; i++){
						if(data['errors'][i]['err_msg']==''){
							$('#'+ data['errors'][i]['name'] +' span.err-msg').html('');
							$('#'+ data['errors'][i]['name']).removeClass('has-error'); 
							$('#'+ data['errors'][i]['name']).addClass('has-success'); 
						}else{

							$('#'+ data['errors'][i]['name'] +' span.err-msg').html(data['errors'][i]['err_msg'] );

							$('#'+ data['errors'][i]['name']).removeClass('has-success'); 
							$('#'+ data['errors'][i]['name']).addClass('has-error'); 
						}
					}

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

function mem_no(){

		

		$.get("emp_no", function(data, status){
	        console.log(data);
	        $('#emp_act').html(data.active);
			$('#emp_inact').html(data.inactive);
	    });
	}
