$(function(){
	var tabler = $('#table-turnoverreport').DataTable({
		paging : false,
		scrollY: '45vh',
		scrollCollapse: true,
		scrollX: 'true',
		fixedHeader: false
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
        var min = $('#datetimepicker6').data("DateTimePicker").date();
        // var min = Date.parse( $('#datetimepicker6').data("DateTimePicker").date());
    	console.log("min: " + min);
    });
    $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        console.log($('#datetimepicker7').data("DateTimePicker").date());
    });
	// $.fn.dataTable.ext.search.push(
	//    function( settings, data, dataIndex ) {
	//      var min = Date.parse( $('#datetimepicker6').data("DateTimePicker").date());
	//      var max = Date.parse( $('#datetimepicker7').data("DateTimePicker").date());
	//      var date = Date.parse( tabler.cell( 6 ).data() );
	//      console.log("data: "+data[1]);
	//      console.log("min: "+min);
	//      console.log("max: "+max);
	//      console.log("date: "+date);
	//       if ( ( isNaN( min ) && isNaN( max ) ) ||
	//            ( isNaN( min ) && date <= max ) ||
	//            ( min <= date   && isNaN( max ) ) ||
	//            ( min <= date   && date <= max ) )
	//       {
	//         return true;
	//       }
	//       return false;
	//   }
	// );
	// $('#datetimepicker6, #datetimepicker7').on("dp.change", function() {
	// 	console.log("Hooray");
	// 	tabler.draw();
	// });
});
