var base_url = window.location.origin;
$(document).ready(function () {

    var oTable = $('#emp_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
        	'url': base_url +"/admin/update/get_employee",
        	'type':"post"
        },
        "columns": [
            { "data": "emp_no" },
            { "data": "emp_fname" },
            { "data": "emp_mname" },
            { "data": "emp_lname" },
            { "data": "name" },
            { "data": "status"},
            { "data": "action", "searchable": false, "sortable": false}
        ],
        "fnDrawCallback": function(oSettings, json) {
            $('.btn-edit').click(function(){
                var emp_no = $(this).data('value');
                
                $('#editModalWindow').modal({'backdrop':'static'});
                $('#editModalWindow').modal('show');
                
                openUpdateForm(emp_no);
            });
        }

    });
});

function openUpdateForm(emp_no){
    $.ajax({
        url: 'get_form',
        type: 'post',
        data: {'emp_no': emp_no},
        success: function(data, status) {
            console.log(emp_no);
            $('#formdata').html(data);
            $("#fields").html(data);

            $("#location").select2({
              placeholder: "Select a Location"
            });
            $("#cooperative").select2({
              placeholder: "Select a Cooperative"
            });
            if(data.status == 'success'){
                
            }
            else{
               
            }
        },
        error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
        }
    }); 
}

