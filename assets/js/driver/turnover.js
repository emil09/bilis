$(document).ready(function(){

	// var keys = document.querySelectorAll('#calculator span');
	// var decimalAdded = false;

	// for(var i = 0; i < keys.length; i++) {
	// 	keys[i].onclick = function(e) {
	// 		// Get the input and button values
	// 		var input = document.querySelector('.screen');
	// 		var inputVal = input.innerHTML;
	// 		var btnVal = this.innerHTML;
	// 		console.log(btnVal + "> " + inputVal + "x " + input);
	// 	}
	// }

	$("#calculator button").click(function() {
		if ($(this).val() != "C" && $(this).val() != "OK") {
			$(".screen").append($(this).val());
		}
		else if ($(this).val() == "C") {
			$(".screen").html("");
		}
	});

});