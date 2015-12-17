<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Register extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_admin();
	}

	public function index()
	{
		if($this->session->userdata('is_logged_in') == TRUE){
			$data['module'] = 'admin';
			$data['view_file'] = 'dashboard_view';	
			echo Modules::run('templates/bilis_template', $data);
		}else{
			redirect('login');
		}	
	}
	
}