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

	public function get_dispatch_list() {
		$_POST['coo_no'] = 6;
		$ctr = 0;
		header('Content-Type: application/json');
		$select = 'rte_no, rte_nam';
		$where = array(
			'rte_sta'	=> 'A',
			// 'coo_no_fk' => '$_POST['coo_no']'
		);
		$results['route_list_result'] = $this->DispatchModel->route_list($select, $where);

		for ($i=0; $i < count($results['route_list_result']); $i++) {
			$select2 = 'count(unt_no) as unit_no';
			$where2 = array('rte_no' => $results['route_list_result'][$i]->rte_no);
		}
		// for($day = 6; $day >= 0; $day--) {
		// 	$select = 'r.rte_no, rte_nam, count(dsp_unit_no) as dsp_unit, (select count(unt_no) from vehicle v where v.rte_no = r.rte_no) - count(dsp_unit_no) as udsp_unit, start_dt';
		// 	$where = array(
		// 		'start_dt' => date('Y-m-d',strtotime(-$day." days"))
		// 	);
		// 	$ctr+=1;
		// 	$results['dispatch_list_result'][$ctr] = $this->DispatchModel->dispatch_list($select, $where);
		// }
		
		// if($_POST['coo_no'] == '' && $_POST['rte_no'] == '') {
		// 	$where = array(
		// 		'start_dt' => date('Y-m-d')
		// 	);
		// } else {
		// 	$where = array(
		// 		// 'coo_no_fk'	=> $_POST['coo_no'],
		// 		'start_dt' 	=> date('Y-m-d')
		// 	);
		// }
		


		echo json_encode($results, JSON_PRETTY_PRINT);
	}
}