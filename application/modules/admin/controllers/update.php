<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Update extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('UpdateModel','',TRUE);

		$this->load->library('datatables');
		$this->check_session_admin();
		$this->load->helper('MY_Datatable_helper');  //load before generate function
	}

	public function index(){
		$this->employee();
	}
	public function employee(){
		$data['css'] = $this->add_css(array(DataTablesCSS));
		$data['js'] = $this->add_js(array(DataTablesJS, UpdateEmpJS));
		$data['module'] = 'admin';
		$data['view_file'] = 'update_employee';	
	    $data['sidebar'] = 'admin/admin_sidebar';
		echo Modules::run('templates/bilis_template', $data);
	}

	public function get_employee(){
		$this->datatables->select('emp_no, emp_fname, emp_mname, emp_lname, emp_pos, name, emp_stat, code_name as status');
		$this->datatables->unset_column('emp_no');

		$this->datatables->edit_column('action', $this->edit_btn('$1') , 'emp_no');
		// print_r($this->datatables->add_column('Test', $this->test('$1') , 'emp_no'));
        $this->datatables->from('employee');
 		$this->datatables->join('employee_role', 'role_id = emp_pos','left');
 		$this->datatables->join('lookup_code', 'code_id = emp_stat','left');
		echo $this->datatables->generate();
	}

	public function edit_btn($str){

	   return '<button class="btn btn-warning btn-edit" data-value="' . $str .'"> <i class="fa fa-edit"></i> Edit</button>';
	}

	public function get_form(){
		if(isset($_POST['emp_no'])){
			$this->db->limit(1);
			$results = $this->UpdateModel->select_where(0, 'emp_pos, emp_fname, emp_mname, emp_lname', array('emp_no'=>$_POST['emp_no']));
			$emp_pos = $results[0]->emp_pos;

			echo ' <div class="col-sm-12">
			        <form role="form" method="post" id="employeeForm">
		    			<div class="col-sm-12 col-md-4">
		    				<div class="form-group" id="fg_fname">
		                		<span class="pull-right err-msg"></span>
		    					<label class="required" for="fname">First Name</label>
    							<div class="input-group">
    								<div class="input-group-addon">
                   						<i class="fa fa-user"></i>
    								</div>
                  					<input type="text" data-formgroup="fg_fname" class="form-control reg-input" name="fname" value="'.$results[0]->emp_fname .'" placeholder="First Name">
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
		  						    <input type="text" data-formgroup="fg_mname" class="form-control reg-input" name="mname" value="'.$results[0]->emp_mname .'" placeholder="Middle Name">
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
		  						    <input type="text" data-formgroup="fg_lname" class="form-control reg-input" name="lname" value="'.$results[0]->emp_lname .'" placeholder="Last Name">
								</div>
	  						</div>
	  					</div>


						<div class="col-sm-12 col-md-6">
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
			            </div> 

			            <div class="col-sm-12 col-md-12">
			                <div class="form-group"  id="fg_pos">
				                <span class="pull-right err-msg"></span>
								<label class="required">Position</label>
								<div class="input-group">
				                    <div class="input-group-addon">
										<i class="fa fa-cog"></i>
				                    </div>
				                    <select id="position" class="form-control reg-input" name="position" data-formgroup="fg_pos">
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
					            
			            <div id="fields"></div>
		        	</form>   
				</div>';
			if($emp_pos == 'D'){
				$this->driver_form();
			}
		}
	}


	public function driver_form(){
		echo 	'<div class="col-sm-12">
                    <div class="form-group">
                      <h4>Ooops Sorry about that, its under maintenance . . . </h4>
                    </div>
                 </div>';
	}


}