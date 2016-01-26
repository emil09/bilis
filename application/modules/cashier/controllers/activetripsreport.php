<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTripsReport extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();
		$this->load->model('ActiveTripsModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'activetripsreport_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, DataTablesFixedColumnCSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, DataTablesFixedColumnJS, ActiveTripsReportJS));
		
		$where = array('emp_no' => $this->session->userdata('emp_no'),);
		$cooperatives = $this->ActiveTripsModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_noside', $data);
	}

	public function active_list(){

		header('Content-Type: application/json');
		$select = 'd.emp_no_fk, emp_lname, emp_fname, rte_nam, unt_lic, start_dt, start_time, d.coo_no_fk';
		$where = array(
			'dsp_stat_fk' => 'A',
			'd.coo_no_fk'	=> $_POST['coo_no']	
			// 'c.emp_no_fk' => $this->session->userdata('emp_no')
		);

		$results['active_list'] = $this->ActiveTripsModel->active_list($select, $where);
		$select = 'd.emp_no_fk, unit_no_fk, trips_ctr, rte_nam, amt_in, to_dt, to_time';
		// $select = 'd.emp_no_fk, unit_no_fk, trips_ctr, t.loc_no, rte_nam, amt_in, to_dt, to_time';
		$where = array(
			'dsp_stat_fk' => 'A',
			'd.coo_no_fk'	=> $_POST['coo_no']	
			// 'c.emp_no_fk' => $this->session->userdata('emp_no')
		);
		$results['active_cash'] = $this->ActiveTripsModel->active_list($select, $where);

		echo json_encode($results, JSON_PRETTY_PRINT);
	}
}