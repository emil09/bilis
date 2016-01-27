<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Sales extends MY_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('SalesModel','',TRUE);
		$this->check_session_admin();
	}

	public function index() {
		$data['module'] = 'admin';
		$data['view_file'] = 'dashboard_view';	
		echo Modules::run('templates/bilis_template', $data);
	}

	public function driver() {
		$data['css'] = $this->add_css(array(DatePicker3, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(BootstrapDate , Sweetalert2, RegisterJS));    
    
		$data['module'] = 'admin';
		$data['view_file'] = 'sales_driver';	
    	$data['sidebar'] = 'admin/admin_sidebar';
		echo Modules::run('templates/bilis_template', $data);
		
	}
}