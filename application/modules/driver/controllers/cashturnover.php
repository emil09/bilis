<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Cashturnover extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('CashturnoverModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'driver';
		$data['view_file'] = 'cashturnover_view';
		$data['sidebar'] = 'driver/driver_sidebar';
		$data['css'] = $this->add_css(array(Sweetalert2CSS));
		$data['js'] = $this->add_js(array(TurnoverJS, Sweetalert2));		

		echo Modules::run('templates/bilis_template', $data);
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
				'trp_id, dsp_no_fk, amt_in, trp_stat', 
				array('dsp_no_fk'=>$results['driver'][0]->dsp_unit_no)
			);
		}
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

			$turnover_data = array(
				'dsp_no_fk'	=>	$_POST['dsp_no'],
				'amt_in' 	=>	$_POST['amt'],
				'trp_stat'	=> 	'T'
			);

			$this->CashturnoverModel->insert(9, $turnover_data);
		}

		echo json_encode($data);
	}
}