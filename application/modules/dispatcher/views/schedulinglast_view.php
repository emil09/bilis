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
    <i class="fa fa-calendar-plus-o"></i> Previous Days
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
        <div class="btn-group">
          <button type="button" class="btn btn-default" id="prev">Previous</button>
          <button type="button" class="btn btn-default" id="next">Next</button>
        </div>
        <div class="pull-right" id="cooperativeselect" >   
          <p>Cooperative:</p> 
          <select class="form-control" id="coo_select">
            <?php foreach ($cooperatives as $cooperative ): ?>
              <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <table id="table-<?php echo($this->uri->segment(2).'-'.$this->uri->segment(3)); ?>" class="table table-bordered">
          <thead id="prevheader">
          </thead>
          <tbody id="prevbody">
          </tbody>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- /.box-default -->
  </div>
</section>
<!-- /.content -->
<div class="modal modal-default fade" id="scheduling_modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form role="form" id="schedForm">
      <div class="modal-header">
        <h4 class="modal-title pull-left"><i class="fa fa-calendar"></i> Schedule for <span id="driver_detail"></h4>
        <div class="pull-right">
          <p class="pull-left">Route:</p>
          <select class="form-control route-dropdown" id="route">
            
          </select>
        </div>
        <input type="text" class="form-control" id="emp_no_d" style="display:none;">
      </div>
      <div class="modal-body">
        <div class="text-center" style="margin-bottom: 20px;" id="notif_update"></div>
          <div class="box-body">
            
              <table class="table">
                <thead>
                  <tr>
                    <th>Day</th>
                    <th>Unit</th>
                    <th>Shift</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="set_sched_table">
                  
                </tbody>
              </table>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 5px">Close</button>
          <button type="button" class="btn btn-primary" id="schedFormSubmit">Save changes</button>
      </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
