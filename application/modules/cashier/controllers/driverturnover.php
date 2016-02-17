<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class DriverTurnover extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();
		$this->load->model('DriverTurnoverModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'driverturnover_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, DataTablesFixedColumnCSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, DataTablesFixedColumnJS, Sweetalert2, DriverTurnoverJS));
		
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$this->db->distinct();
		$cooperatives = $this->DriverTurnoverModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, loc_no, loc_name, emp_lname', $where);
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
		$results = $this->DriverTurnoverModel->get_active_trips_list($select, $where);
		echo json_encode($results);
	}

	public function driver_turnover_details() {
		header('Content-Type: application/json');
		$select = 'unt_lic,emp_fname, emp_lname, employee.emp_no, trips_ctr, start_dt, start_time, shift_name, route.rte_nam, dsp_unit_no';
		$where = array('dsp_stat_fk'=> 'A', 'employee.emp_no'=> $_POST['emp_no']);
		$this->db->order_by('trips_ctr','desc');
		$this->db->limit(1);
		$results['details'] = $this->DriverTurnoverModel->get_active_trips_list($select, $where);
		echo json_encode($results);
	}

	public function save_turnover(){

		header('Content-Type: application/json');

		$this->form_validation->set_rules('dsp_no', 'Dispatch No', 'required');
		$this->form_validation->set_rules('amt', 'Amount', 'required');
		if ($this->form_validation->run($this) == FALSE){

			$data = array(
				'msg' => validation_errors(' ', ' '), 
				'status' => 'error'
			);

		}else{
			$data = array(
				'msg' => $_POST, 
				'status' => 'success'
			);
			$where = array('emp_no' => $this->session->userdata('emp_no'));
			$this->db->distinct();
			$cooperatives = $this->DriverTurnoverModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, loc_no, loc_name, emp_lname', $where);

			$turnover_data = array(
				'dsp_no_fk'	=>	$_POST['dsp_no'],
				'amt_in' 	=>	$_POST['amt'],
				'trips_ctr' =>	$_POST['trip_ctr'],
				'loc_no'	=>	$cooperatives[0]->loc_no,
				'trp_stat'	=> 	'T',
				'to_dt'		=>  date('Y-m-d'), 
				'to_time'	=>	date('H:i:s'),
				'encode_by' =>	$this->session->userdata('emp_no')
			);

			$this->DriverTurnoverModel->insert(9, $turnover_data);
		}

		echo json_encode($data);
	}
}