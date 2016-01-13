<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Login extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('LoginModel','',TRUE);
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->session->userdata('is_logged_in') == TRUE){
			redirect($this->session->userdata('url')  . '/dashboard');
		}else{
			$this->load->view('loginview');
		}
	}

	public function postlogin(){

		if(isset($_POST['emp_no']) && isset($_POST['password'])){


			$this->form_validation->set_rules('emp_no', 'Emp Number', 'required|integer|callback__check_emp');
			$this->form_validation->set_rules('password', 'Password', 'integer');

			if ($this->form_validation->run($this) == FALSE){
				

				$data = array(
					'msg' => validation_errors(' ', ' '), 
					'status' => 'error'
				);

			}
			else{

				$this->create_session($_POST['emp_no']);
				switch ($this->session->userdata('position')) {
					case "C":
						$url = 'cashier';
						break;

					case "P":
						$url = 'dispatcher';
						break;

					case "D":
						$url = 'driver';
						break;
					
					case "S":
						$url = 'admin';
						break;
					
					default:
						$url = '';
						
				}

				$this->session->set_userdata('url', $url);
				$data = array('msg' => $_POST, 'url'=> $url, 'status' => 'success');
			}

		}
		else{

			$data = array('msg' => $_POST, 'status' => 'error');

		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function _check_emp($str){
		$where = array(
			'emp_no' => $str,
			'emp_pwd' => $_POST['password']
		);
		$results = $this->LoginModel->select_where(0, 'emp_no', $where);
		if(count($results)==0){
			$this->form_validation->set_message('_check_emp', 'User is not exist');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	private function create_session($emp_no){

		$results = $this->LoginModel->select_where(0, 'emp_no, emp_pos, emp_pos', array('emp_no' => $emp_no));
		
		if(count($results)>0){
			$emp = array(
	           'emp_no'  => $results[0]->emp_no,
	           'position' => $results[0]->emp_pos,
	           'is_logged_in' => 'true'
			);	
			$this->session->set_userdata($emp);
		}

	}

	
}
