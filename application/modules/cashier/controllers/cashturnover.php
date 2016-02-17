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
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$this->db->distinct();
		$cooperatives = $this->CashturnoverModel->cashier_detail('emp_no_fk, location.coo_no_fk, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_noside', $data);
	}

//-------------------------------------------------- UNASSIGNED -----------------------------------------------

	public function unassigned_bags(){
		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, rte_nam, unt_lic, emp_fname, emp_lname, amt_in, to_dt, to_time, trips_ctr, driver.emp_no_fk';

		$where = array('loc_no'=>$cashier[0]->loc_no_fk, 'trp_stat'=>'T', 'driver.coo_no_fk'=>$_POST['coo_no']);

		$results['unassigned_list'] = $this->CashturnoverModel->unassigned_list($select, $where);

		header('Content-Type: application/json');
		echo json_encode($results);
	}

	public function get_unassigned_detail(){
		header('Content-Type: application/json');
		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, rte_nam, unt_lic, emp_fname, emp_lname, amt_in, trips_ctr, driver.emp_no_fk, dsp_unit_no';
		$where = array('loc_no'=>$cashier[0]->loc_no_fk, 'driver.emp_no_fk'=>$_POST['emp_no'], 'trp_stat'=>'T');
		
		$results['driver'] = $this->CashturnoverModel->unassigned_list($select, $where);
		if(count($results['driver'])>0){
			$results['trip'] = $this->CashturnoverModel->select_where(
				9, 
				'trp_id, dsp_no_fk, trips_ctr, amt_in, trp_stat, to_dt, to_time', 
				array('dsp_no_fk'=>$results['driver'][0]->dsp_unit_no, 'trips_ctr' => $_POST['trip_ctr'])
			);
		}
		echo json_encode($results);
	}

	public function post_ct(){


		$this->form_validation->set_rules('bag_no', 'Bag No.', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('sack', 'Sack', 'required');
		$this->form_validation->set_rules('batch', 'Batch', 'required');
		$this->form_validation->set_rules('trp_id', 'Trip ID', 'required');

		if ($this->form_validation->run($this) == FALSE){

			$data = array('status' => 'error');

		}else{
			$cashier = $this->CashturnoverModel->select_where(10, 'cashier_no', array('emp_no_fk'=>$this->session->userdata('emp_no')));
			$where = array(
					'ct_bag' 		=> $_POST['bag_no'],
					'ct_date'		=>	date('Y-m-d'),
					'ct_cashier_fk' =>	$cashier[0]->cashier_no
				);
			$bag = $this->CashturnoverModel->select(11, 'ct_bag, ct_batch_fk', $where);
			if(count($bag)>0){
				$data = array('status' => 'bag_error');
			} else {
				$insert_data = array(
					'ct_cashier_fk' =>	$cashier[0]->cashier_no,
					'ct_bag'		=>	$_POST['bag_no'],
					'ct_sack'		=>	$_POST['sack'],
					'ct_batch_fk'	=>	$_POST['batch'],
					'ct_date'		=>	date('Y-m-d'),
					'ct_time'		=>	date('H:i:s'),
					'trp_id_fk'		=>	$_POST['trp_id']
				);
				$this->CashturnoverModel->insert(11, $insert_data);

				$this->CashturnoverModel->update(9, array('trp_stat'=>'C'), array('trp_id'=>$_POST['trp_id']));

				$data = array('status' => 'success');
			}
		}

		header('Content-Type: application/json');
		echo json_encode($data);

	}


//-------------------------------------------------- ASSIGNED -----------------------------------------------

	public function assigned_bags(){
		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, unt_lic, dsp_no_fk, emp_fname, emp_lname, amt_in, ct_bag, ct_batch_fk, ct_sack, ct_date, ct_time, trips_ctr, driver.emp_no_fk';
		$where = array(
			'loc_no'=>$cashier[0]->loc_no_fk, 
			'trp_stat'=>'C',
			'ct_date' => date('Y-m-d'),
			'driver.coo_no_fk'=> $_POST['coo_no']
		);

		$results['assigned_list'] = $this->CashturnoverModel->assigned_list($select, $where);
		$results['datetoday'] = date('Y-m-d');

		header('Content-Type: application/json');
		echo json_encode($results);
	}

	public function get_reviewed_detail(){
		header('Content-Type: application/json');
		$cashier = $this->CashturnoverModel->select_where(10, 'loc_no_fk', array('emp_no_fk'=>$this->session->userdata('emp_no')));
		$select = 'trp_id, rte_nam, unt_lic, emp_fname, emp_lname, amt_in, to_dt, to_time, trips_ctr, driver.emp_no_fk, dsp_unit_no, start_dt, start_time';
		$where = array('loc_no'=>$cashier[0]->loc_no_fk, 'dsp_no_fk'=>$_POST['dsp_no']);
		
		$results['driver'] = $this->CashturnoverModel->assigned_list($select, $where);
		if(count($results['driver'])>0){
			$select2 = 'trp_id, dsp_no_fk, trips_ctr, amt_in, trp_stat, ct_date, ct_time';
			$where2 = array(
					'dsp_no_fk'=>$_POST['dsp_no'], 
					'trips_ctr' => $_POST['trip_ctr']
			);
			$results['trip'] = $this->CashturnoverModel->selectedtrip_details($select2, $where2); 
		}
		$results['bagbatch'] = array(
									'bag_no' => $_POST['bag_no'], 
									'batch' => $_POST['batch_no'],
									'sack2' => $_POST['sack2']
								);
		echo json_encode($results);
	}

	public function update_ct(){


		$this->form_validation->set_rules('bag_no2', 'Bag No.', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('sack2', 'Sack', 'required');
		$this->form_validation->set_rules('batch2', 'Batch', 'required');
		$this->form_validation->set_rules('trp_id', 'Trip ID', 'required');

		if ($this->form_validation->run($this) == FALSE){
			$data = array('status' => 'error');

		}else{
			$cashier = $this->CashturnoverModel->select_where(10, 'cashier_no', array('emp_no_fk'=>$this->session->userdata('emp_no')));
			$where = array(
					'ct_bag' 		=> $_POST['bag_no2'],
					'ct_date'		=>	date('Y-m-d'),
					'ct_cashier_fk' =>	$cashier[0]->cashier_no
				);
			$bag = $this->CashturnoverModel->select(11, 'ct_bag, ct_batch_fk', $where);
			if(count($bag)>0){
				$data = array('status' => 'bag_error');
			} else {
				$update_data = array(
					'ct_bag'		=>	$_POST['bag_no2'],
					'ct_sack'		=>	$_POST['sack2'],
					'ct_batch_fk'	=>	$_POST['batch2']
				);
				$this->CashturnoverModel->update(11, $update_data, array('trp_id_fk'=>$_POST['trp_id']));

				$data = array('status' => 'success');
			}
		}

		header('Content-Type: application/json');
		echo json_encode($data);

	}

}