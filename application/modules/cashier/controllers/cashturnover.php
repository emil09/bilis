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

		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, rte_nam, unt_lic, emp_fname, emp_lname, amt_in, to_dt, to_time, trips_ctr, driver.emp_no_fk';
		$where = array('loc_no'=>$cashier[0]->loc_no_fk, 'trp_stat'=>'T');
		$results['cash_turnover'] = $this->CashturnoverModel->available_turnover($select, $where);

		header('Content-Type: application/json');
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function get_assigned_detail(){
		header('Content-Type: application/json');
		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, rte_nam, unt_lic, emp_fname, emp_lname, amt_in, to_dt, to_time, trips_ctr, driver.emp_no_fk, dsp_unit_no, start_dt, start_time';
		$where = array('loc_no'=>$cashier[0]->loc_no_fk, 'driver.emp_no_fk'=>$_POST['emp_no']);
		
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

	public function post_ct(){


		$this->form_validation->set_rules('bag_no', 'Bag No.', 'required');
		$this->form_validation->set_rules('batch', 'Batch', 'required');
		$this->form_validation->set_rules('trp_id', 'Trip ID', 'required');

		if ($this->form_validation->run($this) == FALSE){

			$data = array('status' => 'error');

		}else{

			$cashier = $this->CashturnoverModel->select_where(10, 'cashier_no', array('emp_no_fk'=>$this->session->userdata('emp_no')));
			$insert_data = array(
				'ct_cashier_fk' =>	$cashier[0]->cashier_no,
				'ct_bag'		=>	$_POST['bag_no'],
				'ct_batch_fk'	=>	$_POST['batch'],
				'ct_date'		=>	date('Y-m-d'),
				'ct_time'		=>	date('H:i:s'),
				'trp_id_fk'		=>	$_POST['trp_id']
			);
			$this->CashturnoverModel->insert(11, $insert_data);

			$this->CashturnoverModel->update(9, array('trp_stat'=>'C'), array('trp_id'=>$_POST['trp_id']));

			$data = array('status' => 'success');
		}

		header('Content-Type: application/json');
		echo json_encode($data);

	}

}