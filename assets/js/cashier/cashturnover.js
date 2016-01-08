$(function(){
	var tabler = $('#table-cashturnover').DataTable({
		paging : false,
		scrollY: '45vh',
		scrollCollapse: true,
		scrollX: 'true',
		fixedHeader: false
	});
	$('#selectallrows').click(function(){
    	$('#table-cashturnover tbody tr').addClass('DTTT_selected selected');
    });
	$('#deselectallrows').click(function(){
    	$('#table-cashturnover tbody tr').removeClass('DTTT_selected selected');
    });
    $('#table-cashturnover tbody').on('click', 'button#cashturnover-button', function () {
        $("#cashturnoverModal").modal({backdrop: 'static'});
    });
});
