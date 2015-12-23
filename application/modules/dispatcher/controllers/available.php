<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Available extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('AvailableModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'available_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(FooTableCSS, Select2CSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(FooTableJS, FooTableSortJS, FooTableFilterJS, Select2JS, AvailableJS, Sweetalert2));		
		
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->AvailableModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_template', $data);
	}

	public function get_driver(){
		// $_POST['coo_no'] = 6;

		header('Content-Type: application/json');
		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, driver_no, 
		sched_dt, dsp_sched_no, shift_code_fk, unit_no_fk, unt_lic, shift_name,sched_dt';
		$where = array('coo_no_fk' => $_POST['coo_no']);
		$results = $this->AvailableModel->get_driver($select, $where);
		$data = '';
		
		$i = 0;
		$data['total'] = count($results);
		foreach ($results as $result) {
			
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$data['driver'][$i]['driver_no'] = $result->driver_no;
			$data['driver'][$i]['dsp_sched_no'] = $result->dsp_sched_no;
			$data['driver'][$i]['unit_no'] = $result->unt_lic;
			$data['driver'][$i]['shift_name'] = $result->shift_name;
			$data['driver'][$i]['coo_no'] = $result->coo_no_fk;
			if($result->sched_dt == date('Y-m-d')){
				$data['driver'][$i]['is_today'] = true;
			}

			$select2 = 'rte_nam, rte_no';
			$where2 = array('coo_no_fk' => $result->coo_no_fk);
			$data['driver'][$i]['route'] = $this->AvailableModel->select_where(4, $select2, $where2);
			
			$i++;
		}
		echo json_encode($data);
	}

	public function get_driver_detail(){

		header('Content-Type: application/json');
		$data = '';
		$where = array('driver_no_fk' => $_POST['dvr_no'], 'sched_dt' =>date('Y-m-d') );
		// $this->db->limit(1);
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
		$data['shift']= $this->AvailableModel->select_where(6, 'shift_code, shift_name');

		
		echo json_encode($data);
	}

	public function get_unit(){
		$_POST['route_no'] = 8;
		header('Content-Type: application/json');
		$day =  date('N');
		$select = 'unt_lic, unt_no';
		
		switch ($day) {
			case '1':
				$d1 = 1; 
				$d2 = 2;
				break;
			case '2':
				$d1 = 3; 
				$d2 = 4;
				break;
			case '3':
				$d1 = 5; 
				$d2 = 6;
				break;
			case '4':
				$d1 = 7; 
				$d2 = 8;
				break;
			case '5':
				$d1 = 9; 
				$d2 = 0;
				break;
			
			default:
				break;
		}
		$unt_scheds = $this->AvailableModel->select_where(7, 'unit_no_fk', array('sched_dt' =>date('Y-m-d')));
		$x = 0;
		$unt_sched = array();
		foreach ($unt_scheds as $id)
	    {
	        $unt_sched[$x] = $id->unit_no_fk;
	        $x++;
	    }

		if(isset($d1, $d2)){
			$this->db->not_like('unt_lic', $d1, 'before');
			$this->db->not_like('unt_lic', $d2, 'before');
		}

		if(!empty($unt_sched)){
			$this->db->where_not_in('unt_no', $unt_sched);
		}
		$where = array('rte_no' => $_POST['route_no']);
		$results['unit'] = $this->AvailableModel->select_where(5, $select, $where);
		$results['shift']= $this->AvailableModel->select_where(6, 'shift_code, shift_name');


		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function save_sched(){

		header('Content-Type: application/json');
		if(isset($_POST['route']) && isset($_POST['unit']) && isset($_POST['driver_no'])){


			$this->form_validation->set_rules('driver_no', 'Driver Number', 'required');
			$this->form_validation->set_rules('unit', 'Unit Number', 'required');
			$this->form_validation->set_rules('shift', 'Shift', 'required');
			$this->form_validation->set_rules('route', 'Route', 'required');
			

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
					'sched_dt' => date('Y-m-d')
				);
				$results = $this->AvailableModel->select_where(7, $select, $where);
				if(count($results)>0){
					$update_data = array(
						'sched_dt' => date('Y-m-d'),
						'sched_time' => date('H:i:s'),
						'driver_no_fk' => $_POST['driver_no'],
						'unit_no_fk' => $_POST['unit'],
						'rte_no_fk' => $_POST['route'],
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
						'rte_no_fk' => $_POST['route'],
						'shift_code_fk' => $_POST['shift'],
						'emp_cby' => $this->session->userdata('emp_no')
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


}