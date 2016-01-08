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
});
