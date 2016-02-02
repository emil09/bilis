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
		$data['css'] = $this->add_css(array(DatePicker3, Sweetalert2CSS, Select2CSS));
    $data['js'] = $this->add_js(array(BootstrapDate , Sweetalert2, Select2JS, RegisterJS));    
    
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

		$this->form_validation->set_message('required', 'Please enter %s ');
		$this->form_validation->set_message('integer', '%s numbers only. ');
 
		if(@$_POST['position'] == 'D'){
      $this->add_driver();
		}elseif(@$_POST['position'] == 'P'){
      $this->add_dispatcher();
    }elseif(@$_POST['position'] == 'C'){
      $this->add_cashier();
    }else{
      if ($this->form_validation->run() == FALSE){
        $msg = array('status'=>'error');
        $msg['errors'] = array(
          array(
            'err_msg' => form_error('fname', ' ', ' '),
            'name' => 'fg_fname'
          ),
          array(
            'err_msg' => form_error('mname', ' ', ' '),
            'name' => 'fg_mname'
          ),
          array(
            'err_msg' => form_error('lname', ' ', ' '),
            'name' => 'fg_lname'
          ),
          array(
            'err_msg' => form_error('position', ' ', ' '),
            'name' => 'fg_pos'
          )
        );
      }else{
        $msg = array('status'=>'error');
        $msg['errors'] = '';
      }
      header('Content-Type: application/json');
      echo json_encode($msg);
    }
		
	}
  public function add_driver(){

      $this->form_validation->set_rules('unit', 'Unit Number', 'required|xss_clean');
      $this->form_validation->set_rules('cooperative', 'Cooperative', 'required|xss_clean');
      $this->form_validation->set_rules('emp_lic', 'License Number', 'required|xss_clean');
      $this->form_validation->set_rules('emp_ltp', 'License Type', 'required|xss_clean');
      $this->form_validation->set_rules('emp_lis', 'License Issue Date', 'required|xss_clean');
      $this->form_validation->set_rules('start_date', 'License Issue Date', 'xss_clean');
      $this->form_validation->set_rules('emp_lix', 'License Expiration Date', 'xss_clean');
      if ($this->form_validation->run() == FALSE){
        $msg = array('status'=>'error');
        $msg['errors'] = array(
          array(
            'err_msg' => form_error('fname', ' ', ' '),
            'name' => 'fg_fname'
          ),
          array(
            'err_msg' => form_error('mname', ' ', ' '),
            'name' => 'fg_mname'
          ),
          array(
            'err_msg' => form_error('lname', ' ', ' '),
            'name' => 'fg_lname'
          ),
          array(
            'err_msg' => form_error('position', ' ', ' '),
            'name' => 'fg_pos'
          ),
          array(
            'err_msg' => form_error('unit', ' ', ' '),
            'name' => 'fg_unit'
          ),
          array(
            'err_msg' => form_error('cooperative', ' ', ' '),
            'name' => 'fg_coop'
          ),
          array(
            'err_msg' => form_error('emp_lic', ' ', ' '),
            'name' => 'fg_emp_lic'
          ),
          array(
            'err_msg' => form_error('emp_ltp', ' ', ' '),
            'name' => 'fg_emp_ltp'
          ),
          array(
            'err_msg' => form_error('emp_lis', ' ', ' '),
            'name' => 'fg_emp_lis'
          )
        );
      }
      else{
        // success
        $data = array(
          'emp_fname'   => $_POST['fname'],
          'emp_mname'   => $_POST['mname'],
          'emp_lname'   => $_POST['lname'],
          'emp_pos' => $_POST['position'],
          'emp_stat' => 1,
          'emp_cby' => $this->session->userdata('emp_id'),
          'emp_beg' => $_POST['start_date']
        );
        $this->RegisterModel->insert(0, $data);
        $emp_id =  $this->db->insert_id();
        $data2['emp_no_fk'] = $this->db->insert_id();
        $data2['unit_no'] = $_POST['unit'];
        $data2['coo_no_fk'] = $_POST['cooperative'];
        $data2['emp_lic'] = $_POST['emp_lic'];
        $data2['emp_ltp'] = $_POST['emp_ltp'];
        $data2['emp_lis'] = $_POST['emp_lis'];
        $data2['emp_lix'] = $_POST['emp_lix'];
        $this->RegisterModel->insert(1, $data2);
        $msg = array('status'=>'success', 'msg' => 'success', 'emp_id'=>$emp_id);
          
      }

      header('Content-Type: application/json');
      echo json_encode($msg);
  }

  public function add_dispatcher(){

      
      $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|integer');
      $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|xss_clean|matches[password]');
      $this->form_validation->set_rules('cooperative', 'Cooperative', 'required|xss_clean');

      if ($this->form_validation->run() == FALSE){
        $msg = array('status'=>'error');
        $msg['errors'] = array(
          array(
            'err_msg' => form_error('fname', ' ', ' '),
            'name' => 'fg_fname'
          ),
          array(
            'err_msg' => form_error('mname', ' ', ' '),
            'name' => 'fg_mname'
          ),
          array(
            'err_msg' => form_error('lname', ' ', ' '),
            'name' => 'fg_lname'
          ),
          array(
            'err_msg' => form_error('password', ' ', ' '),
            'name' => 'fg_pw'
          ),
          array(
            'err_msg' => form_error('confirmpassword', ' ', ' '),
            'name' => 'fg_conpw'
          ),
          array(
            'err_msg' => form_error('position', ' ', ' '),
            'name' => 'fg_pos'
          ),
          array(
            'err_msg' => form_error('cooperative', ' ', ' '),
            'name' => 'fg_coop'
          )
        );
      }
      else
      {
        // success
        $data = array(
          'emp_fname'   => $_POST['fname'],
          'emp_mname'   => $_POST['mname'],
          'emp_lname'   => $_POST['lname'],
          'emp_pwd'   => $_POST['password'],
          'emp_pos' => $_POST['position'],
          'emp_stat' =>1,
          'emp_beg' => $_POST['start_date']
        );
        $this->RegisterModel->insert(0, $data);
        $emp_id = $this->db->insert_id();
        for ($i=0; $i < count($_POST['cooperative']); $i++) { 
          $data2['emp_no_fk'] = $emp_id;
          $data2['coo_no_fk'] = $_POST['cooperative'][$i];
          $this->RegisterModel->insert(2, $data2);
          $msg = array('status'=>'success', 'msg' => 'success', 'emp_id'=>$emp_id);
        }
        
        
      }
      header('Content-Type: application/json');
      echo json_encode($msg);
  }


  public function add_cashier(){

      
      $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|integer');
      $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|xss_clean|matches[password]');
      $this->form_validation->set_rules('location', 'Location', 'required|xss_clean');

      if ($this->form_validation->run() == FALSE){
        $msg = array('status'=>'error');
        $msg['errors'] = array(
          array(
            'err_msg' => form_error('fname', ' ', ' '),
            'name' => 'fg_fname'
          ),
          array(
            'err_msg' => form_error('mname', ' ', ' '),
            'name' => 'fg_mname'
          ),
          array(
            'err_msg' => form_error('lname', ' ', ' '),
            'name' => 'fg_lname'
          ),
          array(
            'err_msg' => form_error('password', ' ', ' '),
            'name' => 'fg_pw'
          ),
          array(
            'err_msg' => form_error('confirmpassword', ' ', ' '),
            'name' => 'fg_conpw'
          ),
          array(
            'err_msg' => form_error('position', ' ', ' '),
            'name' => 'fg_pos'
          ),
          array(
            'err_msg' => form_error('location', ' ', ' '),
            'name' => 'fg_loc'
          )
        );
      }
      else
      {
        // success
        $data = array(
          'emp_fname'   => $_POST['fname'],
          'emp_mname'   => $_POST['mname'],
          'emp_lname'   => $_POST['lname'],
          'emp_pwd'   => $_POST['password'],
          'emp_pos' => $_POST['position'],
          'emp_stat' => 1,
          'emp_beg' => $_POST['start_date']
        );
        $this->RegisterModel->insert(0, $data);
        $emp_id = $this->db->insert_id();
        for ($i=0; $i < count($_POST['location']) ; $i++) { 
          $data2['emp_no_fk'] = $emp_id;
          $data2['loc_no_fk'] = $_POST['location'][$i];
          $this->RegisterModel->insert(3, $data2);
        }
        
        $msg = array('status'=>'success', 'msg' => 'success', 'emp_id'=>$emp_id);
        
      }
      header('Content-Type: application/json');
      echo json_encode($msg);
  }

	public function emp_no(){

    
    $emp_act = $this->RegisterModel->select_where(0, 'emp_no', array('emp_stat'=>'1'));

    $emp_inact = $this->RegisterModel->select_where(0, 'emp_no', array('emp_stat'=>'2'));

    $data['active'] = count($emp_act);
    $data['inactive'] = count($emp_inact);
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function get_user_info(){
    $mem_id = $_POST['id'];
    $this->db->limit(1);
    $this->db->join('employee_role', 'role_id = emp_pos', 'left');
    $results = $this->RegisterModel->select_where(0, 'emp_no, CONCAT(emp_fname, " ", emp_lname) as emp_name, emp_pos, name, emp_beg', array('emp_no'=>$mem_id));
    echo  '<tr>
            <th class="col-xs-4">Name:</th>
            <td class="col-xs-8">'.$results[0]->emp_name.'</td>
          </tr>
          <tr>
            <th class="col-xs-4">Employee Number:</th>
            <td class="col-xs-8">'.$results[0]->emp_no.'</td>
          </tr>
          <tr>
            <th class="col-xs-4">Position:</th>
            <td class="col-xs-8">'.$results[0]->name.'</td>
          </tr>
          <tr>
            <th class="col-xs-4">Start Date:</th>
            <td class="col-xs-8">'.$results[0]->emp_beg.'</td>
          </tr>';
  }

  public function get_addedfield(){
    $coops = $this->RegisterModel->select_where(4, 'coo_no, coo_name');
    
    $this->db->distinct();
    $locs = $this->RegisterModel->select_where(5, 'loc_no, loc_name');

    if($_POST['position'] == 'P'){
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
            <div class="col-sm-12 col-md-12">
            <div class="form-group"  id="fg_coop">
                <span class="pull-right err-msg"></span>
              <label class="required">Cooperative</label>
              <div class="form-control no-padding">
                      
                      <select class="form-control reg-input" name="cooperative[]"  id="cooperative" multiple data-formgroup="fg_coop">';
                        foreach ($coops as $coo) {
                          $data .= '<option value="'.$coo->coo_no.'">'.$coo->coo_name.'</option>';
                        }
    
    $data .= '       </select>
                    </div>

            </div>
          </div>';
    }
    elseif($_POST['position'] == 'D'){
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
                    $data .= '<option value="'.$coo->coo_no.'" id="nocooperative">'.$coo->coo_name.'</option>';
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
                      <input type="text" class="form-control" name="unit" placeholder="Unit No">
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
                      <input type="text" class="form-control reg-input"  data-formgroup="fg_emp_lic" name="emp_lic" placeholder="License Number">
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
                        <option value="R" id="1">Regular</option>
                        <option value="P" id="2">Professional</option>                        
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
                        <input type="text" class="form-control data-formgroup="fg_emp_lis" name="emp_lis" placeholder="License Issue Date">
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
                      <input type="text" class="form-control" name="emp_lix" placeholder="License Expiration Date">
                    </div>
                  </div>
                </div>';
    }
    elseif($_POST['position'] == 'C'){
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
                    $data .= '<option value="'.$loc->loc_no.'" id="nocooperative">'.$loc->loc_name.'</option>';
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