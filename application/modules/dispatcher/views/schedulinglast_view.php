
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left">
    <i class="fa fa-backward"></i> Previous Days
  </h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    <div class="box box-default box-solid">
      <div class="box-header">
        <h3 class="box-title">Scheduling by Driver (25)</h3>
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
              <th data-sort-initial="true">Driver</th>
              <th data-sort-ignore="true">Shift</th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-7 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-6 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-5 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-4 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-3 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-2 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-1 day')); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
            	<td>Cruise, Tom (12)</td>
            	<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            </tr>
            <tr>
            	<td>Pitt, Brad (13)</td>
            	<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
				<td><div class="day unit-plate">ABC-123</div> <div class="night"></div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            </tr>
            <tr>
            	<td>Clooney, George (14)</td>
            	<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>
				<td><div class="day unit-plate">ABC-123</div> <div class="night"></div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            </tr>
            <tr>
            	<td>DiCaprio, Leonardo (15)</td>
            	<td><div class="day-text">DAY</div><div class="night-text">NIGHT</div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
				<td><div class="day unit-plate">ABC-123</div> <div class="night"></div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day"></div> <div class="night unit-plate">ABC-123</div></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
            	<td></td>
            	<td><div class="day unit-plate">ABC-123</div> <div class="night"></td>
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
