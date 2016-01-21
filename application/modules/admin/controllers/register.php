<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Register extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('RegisterModel','',TRUE);
		$this->check_session_admin();
	}

	public function index()
	{
			$data['module'] = 'admin';
			$data['view_file'] = 'dashboard_view';	
			echo Modules::run('templates/bilis_template', $data);
	
	}

	public function employee()
	{
		$data['css'] = $this->add_css(array(DatePicker3));
    $data['js'] = $this->add_js(array(BootstrapDate , RegisterJS));    
    
		$data['module'] = 'admin';
		$data['view_file'] = 'register_employee';	
    $data['sidebar'] = 'admin/admin_sidebar';
		echo Modules::run('templates/bilis_template', $data);
		
	}

	public function save_employee(){

		$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('position', 'Position', 'required|xss_clean');
		$this->form_validation->set_rules('sapno', 'SAP No.', 'xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|integer');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|xss_clean|matches[password]');

		$this->form_validation->set_message('required', 'Please enter %s ');
		$this->form_validation->set_message('integer', '%s numbers only. ');
 
		if(@$_POST['position'] == 'D'){

			$this->form_validation->set_rules('unit', 'Unit Number', 'required|xss_clean');
			$this->form_validation->set_rules('cooperative', 'Cooperative', 'required|xss_clean');
			$this->form_validation->set_rules('emp_lis', 'License Number', 'required|xss_clean');
			$this->form_validation->set_rules('emp_ltp', 'License Type', 'required|xss_clean');
			$this->form_validation->set_rules('emp_lis', 'License Issue Date', 'required|xss_clean');
		}
		if ($this->form_validation->run() == FALSE)
		{
			$msg = array('status'=>'error', 'msg' => validation_errors(' ' , '<br/>'));
		}
		else
		{
			$data = array(
				'emp_fname'		=> $_POST['fname'],
				'emp_mname'		=> $_POST['mname'],
				'emp_lname'		=> $_POST['lname'],
				'emp_pos'	=> $_POST['position'],
				'emp_pwd'	=> $_POST['password']
			);

		

			$this->RegisterModel->insert(0, $data);
      $insert_id = $this->db->insert_id();
      if($_POST['position'] == 'D'){
        $data2['emp_no_fk'] = $insert_id;
        $data2['unit_no'] = $_POST['unit'];
        $data2['coo_no_fk'] = $_POST['cooperative'];
        $data2['emp_lic'] = $_POST['emp_lic'];
        $data2['emp_ltp'] = $_POST['emp_ltp'];
        $data2['emp_lis'] = $_POST['emp_lis'];
        $data2['emp_lix'] = $_POST['emp_lix'];
        $this->RegisterModel->insert(1, $data2);
      $msg = array('status'=>'success', 'msg' => $insert_id);
      }
      
		}
		echo json_encode($msg);
	}

	public function get_addedfield(){
		if($_POST['position'] == 'P'){
			echo '
				<div class="col-sm-12">
                  <div class="form-group">
                    <label>Cooperative</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <select class="form-control" name="cooperative">
                        <option value="" id="nocooperative">Select cooperative</option>
                        <option value="1" id="1">Basicano</option>
                        <option value="2" id="2">Lacoda</option>
                        <option value="3" id="3">Padilla</option>
                        <option value="5" id="5">Parang</option>
                        <option value="6" id="6">Lacoda - Other Route</option>                            
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="lname">License</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                      <input type="text" class="form-control" name="license" placeholder="License">
                    </div>
                  </div>
                </div>
				<div class="col-sm-12">
                  <div class="form-group">
                    <label>Cooperative</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <select class="form-control" name="cooperative">
                        <option value="" id="nocooperative">Select cooperative</option>
                        <option value="1" id="1">Basicano</option>
                        <option value="2" id="2">Lacoda</option>
                        <option value="3" id="3">Padilla</option>
                        <option value="5" id="5">Parang</option>
                        <option value="6" id="6">Lacoda - Other Route</option>                            
                      </select>
                    </div>
                  </div>
                </div>';
		}
		elseif($_POST['position'] == 'D'){
			echo '
				<div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="required">Cooperative</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-users"></i>
                      </div>
                      <select class="form-control" name="cooperative">
                        <option value="" id="nocooperative">Select cooperative</option>
                        <option value="1" id="1">Basicano</option>
                        <option value="2" id="2">Lacoda</option>
                        <option value="3" id="3">Padilla</option>
                        <option value="5" id="5">Parang</option>
                        <option value="6" id="6">Lacoda - Other Route</option>                            
                      </select>
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
                      <input type="text" class="form-control" name="unit" placeholder="Unit No">
                    </div>
                  </div>
                </div>
				<div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="required">License Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-hashtag"></i>
                      </div>
                      <input type="text" class="form-control" name="emp_lic" placeholder="License Number">
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="required">License Type</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                      <select class="form-control" name="emp_ltp">
                        <option value="" selected disabled>Select License Type</option>
                        <option value="R" id="1">Regular</option>
                        <option value="P" id="2">Professional</option>                        
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="required">License Issue Date</label>
                    	<div class="input-group date" data-provide="datepicker">
		                    <div class="input-group-addon">
		                       <i class="fa fa-calendar"></i>
		                    </div>
		                    <input type="text" class="form-control" name="emp_lis" placeholder="License Issue Date">
                    	</div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label>License Expiration Date</label>
                    <div class="input-group date" data-provide="datepicker">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" name="emp_lix" placeholder="License Expiration Date">
                    </div>
                  </div>
                </div>';
		}else{
			echo '<div class="col-sm-12">
	                  <div class="form-group">
	                  	<h4>Ooops Sorry about that, its under maintenance . . . </h4>
	                  </div>
	               </div>
	            ';
		}
	}
	
  public function emp_no(){

    
    $emp_act = $this->RegisterModel->select_where(0, 'emp_no', array('emp_stat'=>'A'));

    $emp_inact = $this->RegisterModel->select_where(0, 'emp_no', array('emp_stat'=>'I'));

    $data['active'] = count($emp_act);
    $data['inactive'] = count($emp_inact);
    header('Content-Type: application/json');
    echo json_encode($data);
  }
}