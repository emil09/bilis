<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Cashturnover extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();

		$this->load->model('CashturnoverModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'cashturnover_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, CashTurnoverJS, Sweetalert2));

		echo Modules::run('templates/bilis_noside', $data);
	}

	public function available_turnover(){

		header('Content-Type: application/json');
		$select = 'd.emp_no_fk, emp_lname, emp_fname, unit_no_fk, trips_ctr, t.loc_no, rte_nam, unt_lic, amt_in, to_dt, to_time';
		$where = array(
			'dsp_stat_fk' => 'A',
			'c.emp_no_fk' => $this->session->userdata('emp_no')
		);

		$results['cash_turnover'] = $this->CashturnoverModel->available_turnover($select, $where);
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function get_assigned_detail(){
		header('Content-Type: application/json');
		$select = 'dsp_unit_no, dsp_stat_fk, d.emp_no_fk, emp_fname, emp_lname, rte_no_fk, unit_no_fk, start_dt, 
			start_time, shift_code_fk, shift_name, rte_nam, unt_lic';
		$where = array(
			'd.emp_no_fk' => $_POST['emp_no'],
			'trips_ctr' => $_POST['trip_ctr'],
			'dsp_stat_fk' => 'A',
		);
		$results['driver'] = $this->CashturnoverModel->available_turnover($select, $where);
		if(count($results['driver'])>0){
			$results['trip'] = $this->CashturnoverModel->select_where(
				9, 
				'trp_id, dsp_no_fk, trips_ctr, amt_in, trp_stat', 
				array('dsp_no_fk'=>$results['driver'][0]->dsp_unit_no, 'trips_ctr' => $_POST['trip_ctr'])
			);
		}
		echo json_encode($results);
	}

	public function turnover_details() {
		header('Content-Type: application/json');
		$this->form_validation->set_rules('bag_no', 'Bag Number', 'required|integer|callback__check_bag');
		$this->form_validation->set_rules('batch', 'Batch', 'required');
		if ($this->form_validation->run($this) == FALSE){

			$data = array(
				'msg' => validation_errors(' ', ' '), 
				'status' => 'error'
			);
		}
		else {
			$insert_data = array(
				'ct_cashier_fk' => 1,
				'ct_bag'		=> $_POST['bag_no'],
				'ct_batch_fk'	=> $_POST['batch'],
				'ct_date' => date('Y-m-d'),
				'ct_time' => date('H:i:s'),
				'trp_id_fk'		=> 2
				// 'rte_no_fk' => $rte[0]->rte_no,
			);
			$this->CashturnoverModel->insert(11, $insert_data);

			$data = array('msg' => $_POST, 'status' => 'success');
		}

		
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public function _check_bag($str){
		if($str==''){
			$this->form_validation->set_message('_check_bag', 'Bag Number required');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}