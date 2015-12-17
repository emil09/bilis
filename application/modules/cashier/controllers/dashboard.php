<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard extends MX_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('is_logged_in') == TRUE){
			$data['module'] = 'dispatcher';
			$data['view_file'] = 'dashboard_view';	
			echo Modules::run('templates/bilis_template', $data);
		}else{
			redirect('login');
		}
		
	}
}