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
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesCSS, Select2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS, UpdateEmpJS));
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
			$results = $this->UpdateModel->select_where(0, 'emp_no, emp_pos, emp_fname, emp_mname, emp_lname', array('emp_no'=>$_POST['emp_no']));
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
										<option value="D" id="driver" '. ($emp_pos == 'D' ?   'selected="selected"' : ' ' ). '>Driver</option>
										<option value="P" id="dispatcher" '. ($emp_pos == 'P' ?   'selected="selected"' : ' ' ). '>Dispatcher</option>
										<option value="C" id="cashier" '. ($emp_pos == 'C' ?   'selected="selected"' : ' ' ). '>Cashier</option>
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
			            </div>'; 

						$this->get_addedfield($results);
			          
					            
		        echo '    <!--<div id="fields"></div>-->
		        	</form>   
				</div>';
			
			
		}
	}


	public function get_addedfield($emp = array()){
		
		if(isset($_POST['position'])){
			$position = $_POST['position'];
		}else{
			$position = $emp[0]->emp_pos;
		}
	    
	    $coops = $this->UpdateModel->select_where(4, 'coo_no, coo_name');
	    
	    $this->db->distinct();
	    $locs = $this->UpdateModel->select_where(5, 'loc_no, loc_name');

	    $terminals = $this->UpdateModel->select_where(6, 'trm_no, trm_name');

	    if($position == 'P'){
			$emp_coops = $this->UpdateModel->select_where(2, 'coo_no_fk', array('emp_no_fk'=> $emp[0]->emp_no));
			for ($i=0; $i < count($emp_coops) ; $i++) { 
				$emp_coop[$i] = $emp_coops[$i]->coo_no_fk;
			}
	      $data ='<div class="col-sm-12 col-md-6">
	              <div class="form-group"id="fg_pw">
	                <span class="pull-right err-msg"></span>
	                <label class="required" for="lname">Password</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <input type="password" class="form-control reg-input" name="password" placeholder="Password">
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
	                  <input type="password" class="form-control reg-input" name="confirmpassword" placeholder="Confirm Password">
	                </div>
	              </div>
	            </div>
	            <div class="col-sm-12 col-md-6">
	            <div class="form-group"  id="fg_coop">
	                <span class="pull-right err-msg"></span>
	              <label class="required">Cooperative</label>
	              <div class="form-control no-padding">
	                      
	                      <select class="form-control reg-input" name="cooperative[]"  id="cooperative" multiple data-formgroup="fg_coop">';
	                        foreach ($coops as $coo) {
	                          $data .= '<option value="'.$coo->coo_no.'" '.  (in_array( $coo->coo_no, $emp_coop) ? 'selected' : '') . '>'.$coo->coo_name.'</option>';
	                        }
	    
	    $data .= '       </select>
	                    </div>

	            </div>
	          </div>';
	    }
	    elseif($position == 'D'){
			$emp_info= $this->UpdateModel->select_where(1, 'coo_no_fk, emp_lic, emp_ltp, emp_lis, emp_lix, unit_no', array('emp_no_fk'=> $emp[0]->emp_no));
			for ($i=0; $i < count($emp_info) ; $i++) { 
				$emp_coop[$i] = $emp_info[$i]->coo_no_fk;
			}

	     	$data = '<div class="col-sm-12 col-md-6">
	                  <div class="form-group" id="fg_coop">
	                  <span class="pull-right err-msg"></span>
	                    <label class="required">Cooperative</label>
	                    <div class="input-group">
	                <div class="input-group-addon">
	                  <i class="fa fa-users"></i>
	                </div>
	                <select class="form-control reg-input" name="cooperative" data-formgroup="fg_coop">
	                  <option value="" disabled selected id="nocooperative">Select cooperative</option>';
	                  foreach ($coops as $coo) {
	                    $data .= '<option value="'.$coo->coo_no.'" '.  (in_array( $coo->coo_no, $emp_coop) ? 'selected' : '') . '>'.$coo->coo_name.'</option>';
	                  }
	      $data .='</select>
	              </div>
	                  </div>
	                </div>
	                <div class="col-sm-12 col-md-6">
	                  <div class="form-group">
	                    <label>Unit No</label>
	                    <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-car"></i>
	                      </div>
	                      <input type="text" class="form-control" name="unit" placeholder="Unit No" value="'.$emp_info[0]->unit_no.'">
	                    </div>
	                  </div>
	                </div>
	        <div class="col-sm-12 col-md-6">
	                  <div class="form-group" id="fg_emp_lic">
	                    <span class="pull-right err-msg"></span>
	                    <label class="required">License Number</label>
	                    <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-hashtag"></i>
	                      </div>
	                      <input type="text" class="form-control reg-input"  data-formgroup="fg_emp_lic" name="emp_lic" placeholder="License Number" value="'.$emp_info[0]->emp_lic.'">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-sm-12 col-md-6">
	                  <div class="form-group" id="fg_emp_ltp">
	                    <span class="pull-right err-msg"></span>
	                    <label class="required">License Type</label>
	                    <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-credit-card"></i>
	                      </div>
	                      <select class="form-control reg-input" data-formgroup="fg_emp_ltp" name="emp_ltp">
	                        <option value="" selected disabled>Select License Type</option>
	                        <option value="R" id="1" '. (   $emp_info[0]->emp_ltp == 'R' ? 'selected' : ''  ) .'>Regular</option>
	                        <option value="P" id="2" '. (   $emp_info[0]->emp_ltp == 'P ' ? 'selected' : ''  ) .'>Professional</option>                        
	                      </select>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-sm-12 col-md-6">
	                  <div class="form-group" id="fg_emp_lis">
	                    <span class="pull-right err-msg"></span>
	                    <label class="required">License Issue Date</label>
	                      <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
	                        <div class="input-group-addon">
	                           <i class="fa fa-calendar"></i>
	                        </div>
	                        <input type="text" class="form-control data-formgroup="fg_emp_lis" name="emp_lis" placeholder="License Issue Date"  value="'.$emp_info[0]->emp_lis.'">
	                      </div>
	                  </div>
	                </div>
	                <div class="col-sm-12 col-md-6">
	                  <div class="form-group">
	                    <label>License Expiration Date</label>
	                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" >
	                      <div class="input-group-addon">
	                        <i class="fa fa-calendar"></i>
	                      </div>
	                      <input type="text" class="form-control" name="emp_lix" placeholder="License Expiration Date"  value="'.$emp_info[0]->emp_lix.'">
	                    </div>
	                  </div>
	                </div>';
	    }
	    elseif($position == 'C'){

	    $emp_locs = $this->UpdateModel->select_where(3, 'loc_no_fk', array('emp_no_fk'=> $emp[0]->emp_no));
	    for ($i=0; $i < count($emp_locs) ; $i++) { 
	    	$emp_loc[$i] = $emp_locs[$i]->loc_no_fk;
	    }
	    
	      $data = '<div class="col-sm-12 col-md-6">
	              <div class="form-group"id="fg_pw">
	                <span class="pull-right err-msg"></span>
	                <label class="required" for="lname">Password</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <input type="password" class="form-control reg-input" name="password" placeholder="Password">
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
	                  <input type="password" class="form-control reg-input" name="confirmpassword" placeholder="Confirm Password">
	                </div>
	              </div>
	            </div>
	            
	          <div class="col-sm-12 col-md-6">
	            <div class="form-group" id="fg_loc">
	                  <span class="pull-right err-msg"></span>
	              <label class="required">Location</label>
	              
	               <div class="form-control no-padding">
	                <select class="form-control reg-input" name="location[]" id="location" multiple data-formgroup="fg_loc">';
	                  foreach ($locs as $loc) {
	                    $data .= '<option value="'.$loc->loc_no.'" '.  (in_array( $loc->loc_no, $emp_loc) ? 'selected' : '') . '>'.$loc->loc_name.'</option>';
	                  }
	      $data .='</select>
	              <div>
	            </div>
	          </div>';
	    }
	    elseif($position == 'L'){
	      $data = '<div class="col-sm-12 col-md-6">
	              <div class="form-group"id="fg_pw">
	                <span class="pull-right err-msg"></span>
	                <label class="required" for="lname">Password</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <input type="password" class="form-control reg-input" name="password" placeholder="Password">
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
	                  <input type="password" class="form-control reg-input" name="confirmpassword" placeholder="Confirm Password">
	                </div>
	              </div>
	            </div>
	            
	          <div class="col-sm-12 col-md-6">
	            <div class="form-group" id="fg_trm">
	                  <span class="pull-right err-msg"></span>
	              <label class="required">Location</label>
	              
	               <div class="form-control no-padding">
	                <select class="form-control reg-input" name="terminal"  data-formgroup="fg_trm">
	                  <option value="" disabled selected>Select Terminal</option>';
	                  foreach ($terminals as $trm) {
	                    $data .= '<option value="'.$trm->trm_no.'">'.$trm->trm_name.'</option>';
	                  }
	      $data .='</select>
	              <div>
	            </div>
	          </div>';
	    }
	    else{
	      $data = '<div class="col-sm-12">
	                    <div class="form-group">
	                      <h4>Ooops Sorry about that, its under maintenance . . . </h4>
	                    </div>
	                 </div>
	              ';
	    }


	    echo $data;
	  }


}