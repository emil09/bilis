<style type="text/css">
	.required:after {
	  content:" *";
	  color:red;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Update Employee</i>
	  </h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
				  <div class="box-header">
				    <h3 class="box-title">Employee List</h3>

				    <div class="box-tools pull-right">
				      <button class="btn btn-box-tool" type="button" onclick="reload()"><i class="fa fa-refresh"></i></button>
				    </div><!-- /.box-tools -->
				  </div><!-- /.box-header -->
				  <div class="box-body">
				    <table id="emp_table" class="table table-bordered">
				      <thead id="prevheader">
				      	<tr>
			                <th>Member No.</th>
			                <th>First Name</th>
			                <th>Middle Name</th>
			                <th>Last Name</th>
			                <th>Position</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
				      </thead>
				      <tbody>
				      </tbody>
				    </table>
				  </div> <!-- /.box-body -->
				</div> <!-- /.box-default -->
			</div>
		</div>
	</section>
</div><!-- /.content-wrapper -->

<div id="editModalWindow" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="schedForm">
        <div class="modal-header">
			<h4 class="modal-title pull-left">
          		<i class="fa fa-user"></i> Update <span id="driver_name"></span>
			</h4>
       
        </div>
        <div class="modal-body" id="formdata">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 5px">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
