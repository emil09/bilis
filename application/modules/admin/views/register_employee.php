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
    Register Employee</i>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-sm-12 col-md-6">
      <div class="info-box">
        <span class="info-box-icon" style="background:#3C8DBC; color:#fff;"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active Employee</span>
          <span class="info-box-number" id="emp_act"></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>

    <div class="col-sm-12 col-md-6">
      <div class="info-box">
        <span class="info-box-icon" style="background:#DD4B39; color:#fff;"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Inactive Employee</span>
          <span class="info-box-number" id="emp_inact">11</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>

    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registration Form</h3>
          <div class="text-center" style="margin-bottom: 20px;" id="notif_reg"></div>
        </div><!-- /.box-header -->
        <!-- form start -->
        <!-- <div class="alert alert-warning alert-dismissable" id="infomsg" style="margin-bottom: 0!important;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>
          	<i class="fa fa-warning"></i> Note:</h4>
          	(*) Asterisk indicates required field.
      	</div> -->
        <div id="errmsg" class="alert alert-danger alert-dismissable"></div>
          <form role="form" method="post" id="employeeForm">
            <div class="box-body" >
      				<div class="col-sm-12 col-md-4">
      					<div class="form-group">
      						<label class="required" for="fname">First Name</label>	
      						<div class="input-group">
      							<div class="input-group-addon">
                      <i class="fa fa-user"></i>
      							</div>
                      <input type="text" class="form-control" name="fname" placeholder="First Name">
      						</div>
      					</div>
      				</div>
    					<div class="col-sm-12 col-md-4">
    						<div class="form-group">
    						  <label class="required" for="mname">Middle Name</label>
    						  <div class="input-group">
    						    <div class="input-group-addon">
    						      <i class="fa fa-user"></i>
    						    </div>
    						    <input type="text" class="form-control" name="mname" placeholder="Middle Name">
    						  </div>
    						</div>
    					</div>
    					<div class="col-sm-12 col-md-4">
    						<div class="form-group">
    						  <label class="required" for="lname">Lastname</label>
    						  <div class="input-group">
    						    <div class="input-group-addon">
    						      <i class="fa fa-user"></i>
    						    </div>
    						    <input type="text" class="form-control" name="lname" placeholder="Last Name">
    						  </div>
    						</div>
    					</div>
    					<div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="required" for="lname">Password</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password Number Only">
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label class="required" for="lname">Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </div>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="lname">SAP No.</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-file"></i>
                    </div>
                    <input type="text" class="form-control" name="sapno" placeholder="SAP No.">
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-12">
                <div class="form-group ">
                  <label class="required">Position</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-cog"></i>
                    </div>
                    <select id="position" class="form-control" name="position">
                      <option value="" selected disabled>Please Select</option>
                      <option value="D" id="driver">Driver</option>
                      <option value="P" id="dispatcher">Dispatcher</option>
                      <option value="N" id="counter">Counter</option>
                      <option value="T" id="counter2">Counter 2</option>
                      <option value="R" id="subcounter">Sub Counter</option>
                      <option value="C" id="cashier">Cashier</option>
                      <option value="L" id="terminalmanager">Terminal Manager</option>
                      <option value="M" id="manager">Manager</option>
                      <option value="S" id="supervisor">Administrator</option>
                      <option value="B" id="collector">Collector</option>
                    </select>
                  </div>
                </div>
             	</div>
              <div id="fields">  
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-primary pull-right">Register</button>
              </div>

                <!-- <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label>Terminal</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <select class="form-control" name="terminal">
                      	<option value="" id="noterminal">Select terminal</option>
                      	<option value="1" id="1">Pioneer</option>
                      	<option value="2" id="2"> Padilla</option>
                      	<option value="3" id="3">Parang</option>                            
                      </select>
                    </div>
                  </div>
                </div> -->
            </div><!-- /.box-body -->
          </form>   
      </div>
    </div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
