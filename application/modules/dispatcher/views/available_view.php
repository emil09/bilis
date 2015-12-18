<?php $this->load->view('dispatcher/dispatcher_sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="color:#3C8DBC; width: 82%; float: left">
    <i class="fa fa-pause"> Available for Dispatch</i>
  </h1>
  <div style=";">
  Action: <select>
  <option value="volvo">Dispatch</option>
  <option value="saab">Clear Scheduled</option>
</select><button type="Submit" value="Submit">Submit</button>
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
        <table class="table table-bordered table-hover dt-responsive table-res">
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
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Bridget Jones</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>Tom Cruise</td>
              <td></td>
              <td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- /.box-default -->
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
