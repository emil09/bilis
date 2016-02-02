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
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, SalesByDriverJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'sales_driver';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);
		
	}
	public function unit() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, SalesByUnitJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'sales_unit';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);
		
	}

	public function sales_by_driver_list(){

		header('Content-Type: application/json');
		$select = 'd.emp_no_fk, emp_lname, emp_fname, rte_nam, unt_lic, start_dt, start_time, d.coo_no_fk, dsp_stat_fk, end_dt, end_time';
		if($_POST['coo_no'] == '' && $_POST['rte_no'] == '') {
			$where = array(
				'start_dt' 		=> date('Y-m-d'),
				'shift_code_fk'	=> $_POST['shift_code'],
				'start_dt'	=> $_POST['start_dt'],
			);
		} else {
			$where = array(
				'start_dt' 		=> date('Y-m-d'),
				'rte_no_fk'		=> $_POST['rte_no'],
				'shift_code_fk'	=> $_POST['shift_code'],
				'start_dt'	=> $_POST['start_dt'],
				'd.coo_no_fk'	=> $_POST['coo_no']	
				// 'c.emp_no_fk' => $this->session->userdata('emp_no')
			);
		}

		$results['sales_list'] = $this->SalesModel->sales_by_driver_list($select, $where);
		$select = 'd.emp_no_fk, unit_no_fk, trips_ctr, rte_nam, amt_in, to_dt, to_time';
		if($_POST['coo_no'] == '' && $_POST['rte_no'] == '') {
			$where = array(
				'start_dt' 		=> date('Y-m-d'),
				'shift_code_fk'	=> $_POST['shift_code'],
				'start_dt'	=> $_POST['start_dt'],
			);
		} else {
			$where = array(
				'start_dt' 		=> date('Y-m-d'),
				'rte_no_fk'		=> $_POST['rte_no'],
				'shift_code_fk'	=> $_POST['shift_code'],
				'start_dt'	=> $_POST['start_dt'],
				'd.coo_no_fk'	=> $_POST['coo_no']	
				// 'c.emp_no_fk' => $this->session->userdata('emp_no')
			);
		}
		
		$results['sales_cash'] = $this->SalesModel->sales_by_driver_list($select, $where);

		echo json_encode($results);
	}

	public function my_route_list() {
		header('Content-Type: application/json');
		$select = 'rte_no, rte_nam';
		$where	= array(
			'coo_no_fk' => $_POST['coo_no']
		);
		$results['route_list'] = $this->SalesModel->route_list($select, $where);
		echo json_encode($results);
	}
}