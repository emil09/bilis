<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Cashturnover extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_driver();
		$this->load->model('CashturnoverModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'driver';
		$data['view_file'] = 'cashturnover_view';
		$data['sidebar'] = 'driver/driver_sidebar';
		$data['css'] = $this->add_css(array(Sweetalert2CSS));
		$data['js'] = $this->add_js(array(TurnoverJS, Sweetalert2));		

		echo Modules::run('templates/bilis_noside', $data);
	}

	public function active_trip(){

		header('Content-Type: application/json');
		$select = 'dsp_unit_no, dsp_stat_fk, emp_no_fk, rte_no_fk, unit_no_fk, start_dt, 
			start_time, shift_code_fk, shift_name, rte_nam, unt_lic';
		$where = array(
			'emp_no_fk' => $this->session->userdata('emp_no'),
			'dsp_stat_fk' => 'A',
		);
		$results['driver'] = $this->CashturnoverModel->active_trip($select, $where);
		if(count($results['driver'])>0){
			$results['trip'] = $this->CashturnoverModel->select_where(
				9, 
				'trp_id, dsp_no_fk, trips_ctr, amt_in, trp_stat', 
				array('dsp_no_fk'=>$results['driver'][0]->dsp_unit_no)
			);
		}
		echo json_encode($results);
	}

	public function turnover_location() {
		header('Content-Type: application/json');
		$select = 'dsp_stat_fk, d.emp_no_fk, c.loc_no, loc_name';
		$where = array(
			'd.emp_no_fk' => $this->session->userdata('emp_no'),
			'dsp_stat_fk' => 'A',
		);
		$results['location'] = $this->CashturnoverModel->turnover_location($select, $where);
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function save_turnover(){

		header('Content-Type: application/json');

		$this->form_validation->set_rules('dsp_no', 'Dispatch No', 'required');
		$this->form_validation->set_rules('amt', 'Amount', 'required');
		$this->form_validation->set_rules('loc_select', 'Location', 'required');
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

			$turnover_data = array(
				'dsp_no_fk'	=>	$_POST['dsp_no'],
				'amt_in' 	=>	$_POST['amt'],
				'trips_ctr' =>	$_POST['trip_ctr'],
				'loc_no'	=>	$_POST['loc_select'],
				'trp_stat'	=> 	'T',
				'to_dt'		=>  date('Y-m-d'), 
				'to_time'	=>	date('H:i:s')
			);

			$this->CashturnoverModel->insert(9, $turnover_data);
		}

		echo json_encode($data);
	}
}