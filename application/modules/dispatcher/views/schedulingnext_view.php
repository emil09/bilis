<style type="text/css">
  .content-header>.breadcrumb>li>a {
      color: #444;
      text-decoration: none;
      display: inline-block;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left">
    <i class="fa fa-calendar-plus-o"></i> Next Days
  </h1>
  <ol class="breadcrumb">
    <li><a href="#">Scheduling</a></li>
    <li class="active">Previous</li>
  </ol>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Scheduling by Driver (25)</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" type="button" onclick="reload()"><i class="fa fa-refresh"></i></button>
        </div><!-- /.box-tools -->
        
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="pull-right" id="cooperativeselect" >   
          <p>Cooperative:</p> 
          <select class="form-control" id="coo_select">
            <?php foreach ($cooperatives as $cooperative ): ?>
              <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <table id="table-<?php echo($this->uri->segment(1)); ?>" class="table table-hover footable" data-filter="#filter">
          <thead>
            <tr>
              <th data-sort-initial="true">Driver</th>
              <th data-sort-ignore="true">ACTION</th>
              <th data-sort-ignore="true">SHIFT</th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-5 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-4 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-3 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-2 days')); ?></th>
              <th data-sort-ignore="true"><?php echo date("M j Y", strtotime('-1 day')); ?></th>
            </tr>
          </thead>
          <tbody id="schednext_data">
          </tbody>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- /.box-default -->
  </div>
</section>
<!-- /.content -->
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
