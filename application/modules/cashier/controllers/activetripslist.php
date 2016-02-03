<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTripsList extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();
		$this->load->model('ActiveTripsListModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'activetripslist_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, DataTablesFixedColumnCSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, DataTablesFixedColumnJS, ActiveTripsListJS));
		
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$this->db->distinct();
		$cooperatives = $this->ActiveTripsListModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_noside', $data);
	}

	public function active_trips_list(){
		header('Content-Type: application/json');
		$select = 'sched_no_fk, shift_code_fk, driver.coo_no_fk, coo_name, 
		unt_lic,emp_fname, emp_lname, employee.emp_no, trips_ctr, start_dt, start_time, shift_name, 
		dsp_unit_no, dispatch_sched.rte_no_fk, route.rte_nam, driver_no, count(trp_id) as count_trp';
		$where = array('dsp_stat_fk'=> 'A', 'driver.coo_no_fk' => $_POST['coo_no']);

		$this->db->group_by('driver_no');

		$this->db->order_by('count_trp','desc');
		$results = $this->ActiveTripsListModel->get_active_trips_list($select, $where);
		echo json_encode($results);
	}
}