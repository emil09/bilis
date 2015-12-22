
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left "style="color:#3C8DBC">
    <i class="fa fa-play"> Active Trips</i>
  </h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    <div class="box box-default box-solid">
      <div class="box-header">
        <h3 class="box-title">Active Trips (25)</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" type="button" onclick="reload()"><i class="fa fa-refresh"></i></button>
        </div><!-- /.box-tools -->
        <div class="text-center" style="margin-bottom: 20px;" id="notif_table"></div>
      </div><!-- /.box-header -->
      <div class="box-body">
      	<div class="table-features clearfix">
      		<div class="pull-left feat left-feat">
      			<p>Search: </p><input id="filter" class="form-control" type="text">
      		</div>
	        <div class="pull-right feat right-feat">
			    <p>Action: </p>
			    <select class="form-control">
				    <option value="endday">End Day Selected</option>
			    </select>
			    <button class="btn btn-info btn-xs">Submit</button>
			</div>
      	</div>
        <table id="table-<?php echo($this->uri->segment(1)); ?>" class="table table-hover footable" data-filter="#filter">
          <thead>
            <tr>
              <th data-sort-ignore="true">Select</th>
              <th data-sort-ignore="true">Trip</th>
              <th data-sort-ignore="true">Route</th>
              <th data-hide="phone,tablet" data-sort-ignore="true">Unit</th>
              <th data-sort-initial="true">Driver</th>
              <th data-hide="phone,tablet" data-sort-ignore="true">Start</th>
              <th data-hide="phone,tablet">Shift</th>
              <th data-hide="phone,tablet" data-sort-ignore="true">Action</th>
            </tr>
          </thead>
          <tbody id="driver_data">
            <tr>
            	<td><input type="checkbox"></td>
            	<td>1</td>
            	<td>Zabarte-Panay</td>
            	<td class="unit-plate">ABC-123</td>
            	<td>Cruise, Tom (12)</td>
            	<td>Nov 02 2015 06:18 AM</td>
            	<td>Day Shift</td>
            	<td><button class="btn btn-sm btn-danger">END DAY</button></td>
            </tr>
            <tr>
            	<td><input type="checkbox"></td>
            	<td>1</td>
            	<td>Zabarte-Panay</td>
            	<td class="unit-plate">ABC-123</td>
            	<td>Pitt, Brad (13)</td>
            	<td>Nov 02 2015 06:18 AM</td>
            	<td>Day Shift</td>
            	<td><button class="btn btn-sm btn-danger">END DAY</button></td>
            </tr>
            <tr>
            	<td><input type="checkbox"></td>
            	<td>1</td>
            	<td>Zabarte-Panay</td>
            	<td class="unit-plate">ABC-123</td>
            	<td>Clooney, George (14)</td>
            	<td>Nov 02 2015 06:18 AM</td>
            	<td>Day Shift</td>
            	<td><button class="btn btn-sm btn-danger">END DAY</button></td>
            </tr>
            <tr>
            	<td><input type="checkbox"></td>
            	<td>1</td>
            	<td>Zabarte-Panay</td>
            	<td class="unit-plate">ABC-123</td>
            	<td>DiCaprio, Leonardo (15)</td>
            	<td>Nov 02 2015 06:18 AM</td>
            	<td>Day Shift</td>
            	<td><button class="btn btn-sm btn-danger">END DAY</button></td>
            </tr>
          </tbody>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- /.box-default -->
  </div>
</section><!-- /.content -->
<div class="modal modal-default fade" id="editModalWindow" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left"><i class="fa fa-user"></i> Schedule for Jones (1)</h4>
        <div class="pull-right">
          <p class="pull-left">Route:</p>
          <select class="form-control route-dropdown">
            <option selected="selected">All Route</option>
            <option>Lagro - Cubao</option>
          </select>
        </div>
        <input type="text" class="form-control" id="emp_no_d" style="display:none;">
      </div>
      <div class="modal-body">
        <div class="text-center" style="margin-bottom: 20px;" id="notif_update"></div>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <p>Dec 18 2015</p>
              <select class="form-control select2">
                <option value="" selected></option>
                <option value="abc-123">ABC-123</option>
                <option value="abc-123">ABC-123</option>
                <option value="abc-123">ABC-123</option>
                <!-- <option>ABC-123</option>
                <option>ABC-123</option>
                <option>ABC-123</option>
                <option>ABC-123</option> -->
              </select>
              <select class="form-control day-night">
                <option selected="selected">Day</option>
                <option>Night</option>
              </select>
            </div> <!-- /.form-group -->
          </div>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="update_employee" onclick="update_employee()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->