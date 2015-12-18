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
		
		$data['module'] = 'admin';
		$data['view_file'] = 'register_employee';	
		echo Modules::run('templates/bilis_template', $data);
		
	}

	public function save_employee(){

		$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('position', 'Position', 'required|xss_clean');
		$this->form_validation->set_rules('sapno', 'SAP No.', 'xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
 

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
			$msg = array('status'=>'success', 'msg' => $_POST);
		}
		echo json_encode($msg);
	}
	
}