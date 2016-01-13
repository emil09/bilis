$(function(){
	var tabler = $('#table-turnoverreport').DataTable({
		paging : false,
		scrollY: '45vh',
		scrollCollapse: true,
		scrollX: 'true',
		fixedHeader: false
	});
	$('#selectallrows').click(function(){
    	$('#table-turnoverreport tbody tr').addClass('DTTT_selected selected');
    });
	$('#deselectallrows').click(function(){
    	$('#table-turnoverreport tbody tr').removeClass('DTTT_selected selected');
    });
    $('#table-turnoverreport tbody').on('click', 'button#editturnover-button', function () {
        $("#cashturnoverModal").modal({backdrop: 'static'});
    });

    $('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        console.log($('#datetimepicker6').data("DateTimePicker").date());
    });
    $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        console.log($('#datetimepicker7').data("DateTimePicker").date());
    });
});
