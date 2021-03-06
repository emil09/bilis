$(function(){
	$("#errmsg").hide();
	var base_url = window.location.origin;
	var emp_data = '';
	var num = '';
	$("#next-btn").click(function(event){
		event.preventDefault();
        $.ajax({
			url: 'login/prelogin',
			type: 'post',
			data: $('#loginForm').serialize(),
			success: function(data, status) {
				if(data.status == 'success'){
					if(data.credentials[0].emp_pos == "D") {
						window.location.href = data.url + '/dashboard';
					}
					else {
						$('.slide-out').addClass('hide-form');
						$('.slide-in').removeClass('hide-form');
						emp_data = data.credentials[0].emp_fname+" "+data.credentials[0].emp_lname;
						$('#employeename').html('Hello, '+emp_data+'!');
						$('#loginForm').css('height', '306px');
					}
				}
				else{
					$("#errmsg").html(data.msg).show(200).delay(1200).fadeOut(800);
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
	    }); 
	});
	$("#loginForm").submit(function(event){
		event.preventDefault();	 

        $.ajax({
			url: 'login/postlogin',
			type: 'post',
			data: $('#loginForm').serialize(),
			success: function(data, status) {
				console.log(data);
				if(data.status == 'success'){
					window.location.href = data.url + '/dashboard';
				}
				else{
					$("#errmsg").html(data.msg).show(200).delay(1200).fadeOut(800);
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			}
	    }); 
	});

	$('#notyou').click(function(){
		$('.slide-out').removeClass('hide-form');
		$('.slide-in').addClass('hide-form');
		emp_data = '';
		num= '';
		$('#employeename').html('');
		$('#emp_no').val('');
		$('#loginForm').css('height', '290px')
	});
	
	$("#emp_no, #password").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
			$("#errmsg").html("Digits Only").show().fadeOut(3000);
			return false;
		}
    });
	// var emp_h = $('#empnokeys').height();
	// var pass_h = $('#passkeys').height();
	// $('#empnokeys').css({'height': '0px', 'transition': '1s'});
	// $('#passkeys').css({'height': '0px', 'transition': '1s'});

	// $('#emp_no').on("focus", function(){
	//     $('#empnokeys').css({'display': 'block', 'height': '188px', 'transition': '1s'});
	//     $('#passkeys').css({'display': 'none', 'height': '0px', 'transition': '1s'});
	// });
	// $('#password').on("focus", function(){
	// 	$('#passkeys').css({'display': 'block', 'height': '188px', 'transition': '1s'});
	//     $('#empnokeys').css({'display': 'none', 'height': '0px', 'transition': '1s'});
	// });
    $('#empnokeys button').click(function(){
		if ($(this).val() != "CLR" && $(this).val() != "backspace") {
			num += $(this).val();
		}
		else if ($(this).val() == "CLR") {
			$("#emp_no").val("");
			num = '';
		}
		else {
			$("#emp_no").val(function(i,v){
			  var new_num = v.substr(0,(v.length-1));
			  num = new_num;
			  return v.substr(0,(v.length-1));
			});
			return false;
		}
		$("#emp_no").val(num);
    });

    var num2 = '';
    $('#passkeys button').click(function(){
		if ($(this).val() != "CLR" && $(this).val() != "backspace") {
			num2 += $(this).val();
		}
		else if ($(this).val() == "CLR") {
			$("#password").val("");
			num2 = '';
		}
		else {
			$("#password").val(function(i,v){
			  var new_num2 = v.substr(0,(v.length-1));
			  num2 = new_num2;
			  return v.substr(0,(v.length-1));
			});
			return false;
		}
		$("#password").val(num2);
    });

    $('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
    });

});