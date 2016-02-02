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
          <h3>Registration Form</h3>
          <p><b>Note: </b>( <label class="required"></label> ) Required Fields</p>
          <div class="text-center" style="margin-bottom: 20px;" id="notif_reg"></div>
        </div><!-- /.box-header -->
      
        <form role="form" method="post" id="employeeForm">
          <div class="box-body" >

            
    				<div class="col-sm-12 col-md-4">
    					<div class="form-group" id="fg_fname">
                <span class="pull-right err-msg"></span>
    						<label class="required" for="fname">First Name</label>	
    						<div class="input-group">
    							<div class="input-group-addon">
                    <i class="fa fa-user"></i>
    							</div>
                  <input type="text" data-formgroup='fg_fname' class="form-control reg-input" name="fname" placeholder="First Name">
    						</div>
    					</div>
    				</div>


  					<div class="col-sm-12 col-md-4">
  						<div class="form-group" id="fg_mname">
                <span class="pull-right err-msg"></span>
  						  <label class="required" for="mname">Middle Name</label>
  						  <div class="input-group">
  						    <div class="input-group-addon">
  						      <i class="fa fa-user"></i>
  						    </div>
  						    <input type="text" data-formgroup='fg_mname' class="form-control reg-input" name="mname" placeholder="Middle Name">
  						  </div>
  						</div>
  					</div>

  					<div class="col-sm-12 col-md-4">
  						<div class="form-group" id="fg_lname">
                <span class="pull-right err-msg"></span>
  						  <label class="required" for="lname">Lastname</label>
  						  <div class="input-group">
  						    <div class="input-group-addon">
  						      <i class="fa fa-user"></i>
  						    </div>
  						    <input type="text" data-formgroup='fg_lname' class="form-control reg-input" name="lname" placeholder="Last Name">
  						  </div>
  						</div>
  					</div>


  					<!-- <div class="col-sm-12 col-md-6">
              <div class="form-group"id="fg_pw">
                <span class="pull-right err-msg"></span>
                <label class="required" for="lname">Password</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-group" id="fg_conpw">
                <span class="pull-right err-msg"></span>
                <label class="required" for="lname">Confirm Password</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                </div>
              </div>
            </div> -->

            <div class="col-sm-12 col-md-6">
                <div class="form-group"  id="fg_pos">
                <span class="pull-right err-msg"></span>
                  <label class="required">Position</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-cog"></i>
                    </div>
                    <select id="position" class="form-control reg-input" name="position" data-formgroup='fg_pos'>
                      <option value="" selected disabled>Please Select</option>
                      <option value="D" id="driver">Driver</option>
                      <option value="P" id="dispatcher">Dispatcher</option>
                      <option value="C" id="cashier">Cashier</option>
                      <option value="N" id="counter">Counter</option>
                      <option value="T" id="counter2">Counter 2</option>
                      <option value="R" id="subcounter">Sub Counter</option>
                      <option value="L" id="terminalmanager">Terminal Manager</option>
                      <option value="M" id="manager">Manager</option>
                      <option value="S" id="supervisor">Administrator</option>
                      <option value="B" id="collector">Collector</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" >
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="start_date" placeholder="Start Date">
                </div>
              </div>
            </div>
            <!-- <div class="col-sm-12">
              <div class="form-group">
                <label for="lname">SAP No.</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-file"></i>
                  </div>
                  <input type="text" class="form-control" name="sapno" placeholder="SAP No.">
                </div>
              </div>
            </div> -->
            
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
<div id="user_info_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title pull-left"><i class="fa fa-user"></i> User Information</span></h4>
        </div>
        <div class="modal-body" id="user_info">

            <div class="center-block user-info-con">
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> Employee successfully registered.
              </div>
              <table class="table borderless" id="user_info_data">
              
              </table>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" id="closeModal" style="margin-left: 5px">Close</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
