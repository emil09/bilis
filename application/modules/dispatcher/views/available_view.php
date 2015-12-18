<?php $this->load->view('dispatcher/dispatcher_sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 style="color:#3C8DBC; float: left">
    <i class="fa fa-pause"> Available for Dispatch</i>
  </h1>
  <div class="pull-right">
      <p>Action:</p> <select class="form-control">
      <option value="volvo">Dispatch</option>
      <option value="saab">Clear Scheduled</option>
    </select><button class="btn btn-info btn-sm" >Submit</button>
  </div>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    <div class="box box-default box-solid">
      <div class="box-header">
        <h3 class="box-title">Dispatching by Driver (409 drivers)</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" type="button" onclick="reload()"><i class="fa fa-refresh"></i></button>
        </div><!-- /.box-tools -->
        <div class="text-center" style="margin-bottom: 20px;" id="notif_table"></div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table class="table table-hover dt-responsive table-res">
          <thead>
            <tr>
              <th>Select</th>
              <th>Driver</th>
              <th>Scheduled Unit</th>
              <th>Action</th>
              <th>Dispatch</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (1)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (2)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise (3)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (4)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (5)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise (6)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (7)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (8)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise (9)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones (10)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise (11)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones(12)</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning editModal" id="editModal"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
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
