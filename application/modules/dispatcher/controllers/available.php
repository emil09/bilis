<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Available extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('AvailableModel','',TRUE);
	}

	public function index(){
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'available_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Select2CSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Select2JS, AvailableJS, Sweetalert2));			
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->AvailableModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_noside', $data);
	}

	public function get_driver(){
		header('Content-Type: application/json');

		$data = array();

		// This query used to display all drivers per cooperative
		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, driver_no';
		$where = array('coo_no_fk' => $_POST['coo_no']);
		$results = $this->AvailableModel->get_driver($select, $where);
		
		// The total no. of drivers
		$data['total'] = count($results);
		
		$i = 0;
		foreach ($results as $result) {
			
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$data['driver'][$i]['driver_no'] = $result->driver_no;
			$data['driver'][$i]['coo_no'] = $result->coo_no_fk;


			// Getting the schedule of the driver, it is empty when the driver has no schedule
			$select2 = 'dsp_sched_no, sched_dt, sched_time, unt_lic, shift_name, sched_type, unit_no_fk';
			$where2 = array('driver_no_fk' => $result->driver_no, 'sched_dt' => date('Y-m-d'));
			$this->db->join('shift','shift_code = shift_code_fk', 'left');
			$this->db->join('vehicle','unt_no = unit_no_fk', 'left');
			$data['driver'][$i]['sched'] = $this->AvailableModel->select_where(7, $select2, $where2);


			// If the driver having a schedule.. it is also checked if it is dispatched
			$data['driver'][$i]['dispatched'] = array();
			if($data['driver'][$i]['sched']){
				$select3 = 'dsp_unit_no, dsp_by, start_dt, start_time, dsp_stat_fk';
				$where3 =  array('driver_no_fk' => $result->driver_no, 'sched_dt' => date('Y-m-d'));
				$this->db->join('dispatch_sched','dsp_sched_no = sched_no_fk', 'left');
				$data['driver'][$i]['dispatched'] = $this->AvailableModel->select_where(8, $select3, $where3);
			}

			// Getting the available route for the driver
			$select4 = 'rte_nam, rte_no';
			$where4 = array('coo_no_fk' => $result->coo_no_fk);
			$data['driver'][$i]['route'] = $this->AvailableModel->select_where(4, $select4, $where4);

			$i++;
		}
		echo json_encode($data);
	}

	public function get_driver_detail(){

		header('Content-Type: application/json');
		$data = '';
		$where = array('driver_no_fk' => $_POST['dvr_no'], 
			'sched_dt' =>date('Y-m-d'), 'sched_type' => 'A' );
		$this->db->limit(1);
		$this->db->join('vehicle', 'unt_no = unit_no_fk', 'left');
		$results = $this->AvailableModel->select_where(7,'driver_no_fk, unt_lic, unt_no, shift_code_fk, rte_no_fk', $where);
		$data['sched_exist'] = $results;
		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, coo_name';
		$where2 = array('employee.emp_no' => $_POST['emp_no']);
		$results = $this->AvailableModel->get_driver($select, $where2);
		

		$date =  date('M j, Y');
		$data['date']= $date;
		$i = 0;
		foreach ($results as $result) {
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$data['driver'][$i]['coo_name'] = $result->coo_name;
			$data['driver'][$i]['coo_no_fk'] = $result->coo_no_fk;

			
			$i++;
		}
		$data['shift'] = $this->AvailableModel->select_where(6, 'shift_code, shift_name');

		
		echo json_encode($data);
	}

	public function get_unit(){
		header('Content-Type: application/json');
		$day =  date('N');
		$select = 'unt_lic, unt_no';
		
		switch ($day) {
			case '1':
				$c1 = 1; 
				$c2 = 2;
				break;
			case '2':
				$c1 = 3; 
				$c2 = 4;
				break;
			case '3':
				$c1 = 5; 
				$c2 = 6;
				break;
			case '4':
				$c1 = 7; 
				$c2 = 8;
				break;
			case '5':
				$c1 = 9; 
				$c2 = 0;
				break;
			
			default:
				break;
		}

		
		$this->db->where('shift_code_fk', 'D');
		$arr1 = $this->AvailableModel->unit_avail('unit_no_fk');

		$this->db->where('shift_code_fk', 'N');
		$arr2 = $this->AvailableModel->unit_avail('unit_no_fk');
		


		// if(count($arr1)>count($arr2)){
		// 	$res = array_intersect($arr1[0][0], $arr2[0][0]);
		// }

		$newarr1 = array();
		for ($i=0; $i < count($arr1); $i++) { 
			for ($j=0; $j < count($arr1[$i]); $j++) { 
				$newarr1[$i] = $arr1[$i]->unit_no_fk;
			}
		}

		$newarr2 = array();
		for ($i=0; $i < count($arr2); $i++) { 
			for ($j=0; $j < count($arr2[$i]); $j++) { 
				$newarr2[$i] = $arr2[$i]->unit_no_fk;
			}
		}
		$res = array_intersect($newarr1, $newarr2);

		if(!empty($res)){
			$this->db->where_not_in('unt_no', $res);
		}
		
		if($_POST['route_no'] != 0){
			$this->db->where('rte_no', $_POST['route_no']);
		}
		
		$this->db->where('coo_no', $_POST['coo_no']);


		if(isset($c1, $c2) && $_POST['shift_sel']=='D'){
			$this->db->not_like('unt_lic', $c1, 'before');
			$this->db->not_like('unt_lic', $c2, 'before');
		}
		$results['unit'] = $this->AvailableModel->select_where(5, $select);
		$results['shift']= $this->AvailableModel->select_where(6, 'shift_code, shift_name');


		echo json_encode($results);
	}


	
	
	public function save_sched(){

		header('Content-Type: application/json');
		if(isset($_POST['unit']) && isset($_POST['driver_no'])){


			$this->form_validation->set_rules('driver_no', 'Driver Number', 'required');
			$this->form_validation->set_rules('unit', 'Unit Number', 'required');
			$this->form_validation->set_rules('shift', 'Shift', 'required');
			

			if ($this->form_validation->run($this) == FALSE){

				$data = array(
					'msg' => validation_errors(' ', ' '), 
					'status' => 'error'
				);

			} 	
			else{
				$select = 'dsp_sched_no';
				$where = array(
					'driver_no_fk' => $_POST['driver_no'],
					'sched_dt' => date('Y-m-d'), 
					'sched_type' => 'A'
				);
				$results = $this->AvailableModel->get_driver_avail($select, $where);

				$rte = $this->AvailableModel->select_where(5, 'rte_no', array('unt_no'=>$_POST['unit']));
				if(count($results)>0){
					$update_data = array(
						'sched_dt' => date('Y-m-d'),
						'sched_time' => date('H:i:s'),
						'driver_no_fk' => $_POST['driver_no'],
						'unit_no_fk' => $_POST['unit'],
						'rte_no_fk' => $rte[0]->rte_no,
						'shift_code_fk' => $_POST['shift'],
						'emp_upb' => $this->session->userdata('emp_no')
					);
					$this->db->set('emp_udt', 'NOW()', FALSE);
					$id = array('dsp_sched_no'=> $results[0]->dsp_sched_no);
					$this->AvailableModel->update(7, $update_data, $id);
				}else{

					$insert_data = array(
						'sched_dt' => date('Y-m-d'),
						'sched_time' => date('H:i:s'),
						'driver_no_fk' => $_POST['driver_no'],
						'unit_no_fk' => $_POST['unit'],
						'rte_no_fk' => $rte[0]->rte_no,
						'shift_code_fk' => $_POST['shift'],
						'emp_cby' => $this->session->userdata('emp_no'),
						'sched_type' => 'A'
					);
					$this->AvailableModel->insert(7, $insert_data);
				}
				$data = array('msg' => $_POST, 'status' => 'success');
			}

		}
		else{

			$data = array('msg' => $_POST, 'status' => 'error');

		}
		echo json_encode($data);
	}

	public function dispatch_unit(){

		header('Content-Type: application/json');

		if(isset($_POST['sched_no'])){
			$where = array('unit_no_fk'=>$_POST['unit_no']);
			$scheds = $this->AvailableModel->select_where(7, 'dsp_sched_no', $where);
			$found = false;
			for ($i=0; $i < count($scheds) ; $i++) { 
				$where = array('sched_no_fk'=>$scheds[$i]->dsp_sched_no, 'dsp_stat_fk'=>'A');
				$results = $this->AvailableModel->select_where(8, 'sched_no_fk', $where);
				if(count($results)>0){
					$found = true;
				}
			}
		
			
			// // // dispatched unit
			if($found == false){
				$data = array(
					'dsp_by' => $this->session->userdata('emp_no'),
					'start_dt' => date('Y-m-d'),
					'start_time' => date('H:i:s'),
					'sched_no_fk' => $_POST['sched_no'],
					'dsp_stat_fk' => 'A'
				);
				$this->AvailableModel->insert(8, $data);
				$message = array('status'=>'success');
	
			}else{

				$message = array('status'=>'error');
			}
			echo json_encode($message);
		}

	}

	public function delete_sched(){

		header('Content-Type: application/json');

		$sched = array('dsp_sched_no'=>$_POST['sched_no']);
		$this->AvailableModel->delete(7, $sched);
		$data = array('status'=>'success', 'msg'=>'success');
		echo json_encode($data);
	}

	public function shift_avail(){
		$select = 'shift_code_fk,sched_type';
		$where = array('sched_dt' => date('Y-m-d'), 'unit_no_fk' =>$_POST['unit_no'], 'sched_type'=>'A');
		$this->db->where('driver_no_fk !=', $_POST['driver_no']);
		$data = $this->AvailableModel->select_where(7, $select, $where);
		header('Content-Type: application/json');
		echo json_encode($data);
	}


}