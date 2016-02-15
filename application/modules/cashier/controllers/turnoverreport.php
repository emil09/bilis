<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class TurnoverReport extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();
		$this->load->model('TurnoverReportModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'turnoverreport_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, TurnoverReportJS));
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$this->db->distinct();
		$cooperatives = $this->TurnoverReportModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_noside', $data);
	}

	public function turnovered_list(){
		$cashier = $this->TurnoverReportModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, unt_lic, emp_fname, emp_lname, amt_in, ct_bag, ct_batch_fk, ct_sack, ct_date, ct_time, trips_ctr, driver.emp_no_fk';
		$where = array(
			'loc_no'=>$cashier[0]->loc_no_fk, 
			'trp_stat'=>'C',
			'ct_date' => $_POST['ct_date'],
			'driver.coo_no_fk'=> $_POST['coo_no']
		);
	
		
		$results['turnover_report'] = $this->TurnoverReportModel->turnovered_list($select, $where);
		$results['datetoday'] = date('Y-m-d');
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->TurnoverReportModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;

		header('Content-Type: application/json');
		echo json_encode($results);
	}
}