<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dispatch extends MY_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('DispatchModel','',TRUE);
		$this->check_session_admin();
	}

	public function index() {
		$data['module'] = 'admin';
		$data['view_file'] = 'dashboard_view';

		echo Modules::run('templates/bilis_template', $data);
	}

	public function driver() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, DispatchByDriverJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'dispatch_driver';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->DispatchModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);	
	}
}