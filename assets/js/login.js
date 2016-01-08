$(document).ready(function(){
	$("#loginForm").submit(function(event){
		event.preventDefault();	 

        $.ajax({
			url: 'login/postlogin',
			type: 'post',
			data: $('#loginForm').serialize(),
			success: function(data, status) {
				data = JSON.parse(data);
				if(data.status == 'success'){
					window.location.href = data.url + '/dashboard';
				}
				else{
					$("#errmsg").html(data.msg).show();
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
	    }); 
	});
	$("#errmsg").hide();
	$("#emp_no, #password").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
			$("#errmsg").html("Digits Only").show().fadeOut(3000);
			return false;
		}
   });
});