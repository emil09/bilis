<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTrips extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('ActiveTripsModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'activetrips_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, Select2CSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS, ActiveTripsJS, Sweetalert2));		

		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->ActiveTripsModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_template', $data);
	}

	public function dsp_driver(){
		
		header('Content-Type: application/json');
		$select = 'sched_no_fk, shift_code_fk, coo_no_fk, coo_name, 
		unt_lic,emp_fname, emp_lname, employee.emp_no, start_dt, start_time, shift_name, dsp_unit_no';
		$where = array('dsp_stat_fk'=> 'A', 'coo_no_fk' => $_POST['coo_no']);
		$this->db->order_by('start_dt desc , start_time desc');
		// $this->db->order_by("start_time"); 
		$results = $this->ActiveTripsModel->get_dspdriver($select, $where);
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function end_day(){

		header('Content-Type: application/json');

		$update_data = array(
			'end_dt' => date('Y-m-d'),
			'end_time' => date('H:i:s'),
			'end_by' => $this->session->userdata('emp_no'),
			'dsp_stat_fk' => 'F'
		);

		$id = array('dsp_unit_no'=> $_POST['dsp_no']);
		$this->ActiveTripsModel->update(8, $update_data, $id);


		$sched = $this->ActiveTripsModel->select_where(8,'sched_no_fk',array('dsp_unit_no'=>$_POST['dsp_no']));
		

		$update_sched = array(
			'sched_type' => 'F'
		);

		$id = array('dsp_sched_no'=> $sched[0]->sched_no_fk);
		$this->ActiveTripsModel->update(7, $update_sched, $id);
		$data = array('status'=>'success', 'msg'=>'success');
		echo json_encode($data);
	}


}