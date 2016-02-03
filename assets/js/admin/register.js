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
				console.log(data);
				if(data.status == 'success'){
					// window.location.href = data.url + '/dashboard';
					get_emp_info(data.emp_id);
					$('#user_info_modal').modal('show');

				$('#user_info_data').html('test');

					$('#closeModal').click(function(){
						$('#user_info_modal').modal('hide');
						window.location.reload();
					});
					// swal({
					// 	'title': 'Success!',   
					// 	'text': 'You successfully add employee.',   
					// 	'type':'success'
					// },
					// function(){
					// });
				}
				else{

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
					if(data['errors'] == ''){
						swal({
							'title': 'Warning!',   
							'text': 'it\s under maintenance',   
							'type':'warning'
						});
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

				$("#location").select2({
				  placeholder: "Select a Location"
				});
				$("#cooperative").select2({
				  placeholder: "Select a Cooperative"
				});
				$('.select2-selection--multiple').addClass('select2-selection--custom');
				$('.select2-container').addClass('select2-container-custom');
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		}); 
	});

	

});

function mem_no(){
	$.get("emp_no", function(data, status){
        console.log(data);
        $('#emp_act').html(data.active);
		$('#emp_inact').html(data.inactive);
    });
}

function get_emp_info(emp_id){

	$.ajax({
			url: 'get_user_info',
			type: 'post',
			data: {'id': emp_id},
			success: function(data, status) {
				$('#user_info_data').html(data);
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
		}); 

}