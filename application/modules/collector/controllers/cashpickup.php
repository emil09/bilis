<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CashPickup extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_collector();

		$this->load->model('CashPickupModel','',TRUE);
	}

	public function index() {
		$data['module'] = 'collector';
		$data['view_file'] = 'cashpickup_view';
		$data['sidebar'] = 'collector/collector_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, CashPickupJS, Sweetalert2));
		$alllocations = $this->CashPickupModel->all_locs('loc_no, loc_name');
		$data['locations'] = $alllocations;
		echo Modules::run('templates/bilis_noside', $data);
	}

	public function uncollected_sacks() {
		header('Content-Type: application/json');

		$select = 'ct_id, ct_date, t.loc_no, loc_name, ct_batch_fk, ct_sack, count(DISTINCT ct_id) as "total_bags"';
		if($_POST['loc_no'] == '') {
			$where = array();
		} else {
			$where = array(
				't.loc_no' => $_POST['loc_no']
			);
		}
		$this->db->where('is_collected',0);
		$results['sacks'] = $this->CashPickupModel->uncollected_list($select, $where);

		echo json_encode($results);
	}

	public function collected_sacks() {
		header('Content-Type: application/json');

		$select = 'ct_id, ct_date, t.loc_no, loc_name, ct_batch_fk, ct_sack, count(DISTINCT ct_id) as "total_bags"';
		if($_POST['loc_no'] == '') {
			$where = array();
		} else {
			$where = array(
				't.loc_no' => $_POST['loc_no']
			);
		}
		$this->db->where('emp_no_fk',$this->session->userdata('emp_no'));
		$this->db->where('is_collected',1);
		$results['sacks'] = $this->CashPickupModel->collected_list($select, $where);

		echo json_encode($results);
	}

	public function collect_sack() {
		if($this->input->is_ajax_request() == TRUE){
			$this->db->trans_start();
			$data = array(
				'ct_fk'			=> $_POST['ct_id'],
				'emp_no_fk'		=> $this->session->userdata('emp_no'),
				'cs_dt'			=> date('Y-m-d'),
				'cs_time'		=> date('H:i:s'),
				'is_accepted'	=> 0
			);
			
			$this->CashPickupModel->insert(13, $data);

			$data = array(
				'is_collected'	=>	1
			);
			
			$this->CashPickupModel->update(11, $data, array('ct_id'=>$_POST['ct_id']));


			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){
				$results = array('status' => 'error');
			}	
			else{
				$results = array('status' => 'success');	
			}
		}else{
			$results = array('status' => 'error');
		}
		header('Content-Type: application/json');
		echo json_encode($results);
	}

}