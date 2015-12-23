<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left" style="color:#3C8DBC">
    <i class="fa fa-pause"> Available for Dispatch</i>
  </h1>
  <div class="pull-right">
      <p>Cooperative:</p> 
      <select class="form-control" id="coo_select">
        <?php foreach ($cooperatives as $cooperative ): ?>
          <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
        <?php endforeach ?>
      </select>
      <!-- <button class="btn btn-info btn-sm" >Submit</button> -->
  </div>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    <div class="box box-default box-solid">
      <div class="box-header">
        <h3 class="box-title">Dispatching by Driver (<span id="driver_dispatching"></span> drivers)</h3>

        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" type="button" onclick="reload()"><i class="fa fa-refresh"></i></button>
        </div><!-- /.box-tools -->
        <div class="text-center" style="margin-bottom: 20px;" id="notif_table"></div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="table-features clearfix">
          <div class="pull-left feat left-feat">
            <p>Search: </p><input id="filter" class="form-control" type="text" placeholder="Driver's Name">
          </div>
          <div class="pull-right feat right-feat">
              <p>Action: </p>
              <select class="form-control">
                <option value="endday">End Day Selected</option>
              </select>
              <button class="btn btn-primary btn-xs">Submit</button>
          </div>
        </div>
        <div class="wrapper-<?php echo($this->uri->segment(1)); ?>">
          <table id="table-<?php echo($this->uri->segment(1)); ?>" class="table table-hover footable" data-filter="#filter">
            <thead>
              <tr>
                <th data-sort-ignore="true">Select</th>
                <th data-sort-initial="true">Driver</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">Scheduled Unit</th>
                <th data-hide="phone" data-sort-ignore="true">Action</th>
                <th data-hide="phone" data-sort-ignore="true">Dispatch</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="driver_data">
        
            </tbody>
            <tfoot>
              <tr>
                <th data-sort-ignore="true">Select</th>
                <th data-sort-initial="true">Driver</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">Scheduled Unit</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">Action</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">Dispatch</th>
                <th>Status</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div> <!-- /.box-body -->
    </div> <!-- /.box-default -->
  </div>
</section><!-- /.content -->
<div id="editModalWindow" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="schedForm">
        <div class="modal-header">
          <h4 class="modal-title pull-left"><i class="fa fa-user"></i> Schedule for <span id="driver_name"></span></h4>
          <div class="pull-right">
            <p class="pull-left">Route:</p>
            <select id="route" class="form-control route-dropdown" name="route">
            </select>
          </div>
        </div>
        <div class="modal-body">
          <div class="text-center" style="margin-bottom: 20px;" id="notif_update"></div>
        
            <div class="box-body">
              <div class="form-group">
                <p class="server-time"></p>
                <select class="form-control select2" id="unit" name="unit">
                </select>
                <select class="form-control day-night" id="shift" name="shift">
                </select>
              </div> <!-- /.form-group -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 5px">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
