<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Scheduling extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('SchedulingModel','',TRUE);
	}

	public function index(){
		redirect('dispatcher/scheduling/next');
 	}

	public function previous(){
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulinglast_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(Select2CSS));
		$data['js'] = $this->add_js(array(Select2JS));		
		
		echo Modules::run('templates/bilis_noside', $data);
	}
	public function next(){
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulingnext_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(Select2CSS));
		$data['js'] = $this->add_js(array(Select2JS, ScheduleNextJS));		
		
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->SchedulingModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;

		echo Modules::run('templates/bilis_noside', $data);
	}

	public function get_driver(){

		header('Content-Type: application/json');

		// This query used to display all drivers per cooperative
		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, driver_no';
		$where = array('coo_no_fk' => $_POST['coo_no']);

		$results['driver'] = $this->SchedulingModel->get_driver($select, $where);
		
		for ($i=0; $i < count($results['driver']); $i++) { 

			// Getting the schedule of the driver, it is empty when the driver has no schedule
			$select2 = 'dsp_sched_no, sched_dt, sched_time, unt_lic, shift_name, sched_type, shift_code_fk';
			$where2 = array('driver_no_fk' => $results['driver'][$i]->driver_no);
			$this->db->where('sched_dt >', date('Y-m-d'));
			$this->db->where('sched_dt <', date("Y-m-d", strtotime('7 day')));
			$this->db->join('shift','shift_code = shift_code_fk', 'left');
			$this->db->join('vehicle','unt_no = unit_no_fk', 'left');
			$results['driver'][$i]->sched = $this->SchedulingModel->select_where(7, $select2, $where2);
		}
		

		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function get_driver_detail(){
		header('Content-Type: application/json');

		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, coo_name, driver_no';
		$where2 = array('employee.emp_no' => $_POST['emp_no']);
		$this->db->limit(1);
		$results = $this->SchedulingModel->get_driver($select, $where2);
		
		for ($i=1; $i <= 7; $i++) { 
			$data['date'][$i-1] =  date("Y-m-d", strtotime($i . ' days'));
		}
		// $data['date']= $date;
		$i = 0;
		foreach ($results as $result) {
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$data['driver'][$i]['coo_name'] = $result->coo_name;
			$data['driver'][$i]['coo_no_fk'] = $result->coo_no_fk;	
			$data['driver'][$i]['driver_no'] = $result->driver_no;		
		
			

			$i++;
		}

		$data['shift'] = $this->SchedulingModel->select_where(6, 'shift_code, shift_name');
		
		$select4 = 'rte_nam, rte_no';
		$where4 = array('coo_no_fk' => $result->coo_no_fk);
		$data['route'] = $this->SchedulingModel->select_where(4, $select4, $where4);
		
		echo json_encode($data, JSON_PRETTY_PRINT);

	}

	public function get_unit(){

		header('Content-Type: application/json');
		for ($i=0; $i < count($_POST['date']); $i++) { 
				
			$date = date_create($_POST['date'][$i]);
			$day =  date_format($date, 'N');
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
			$this->db->where('sched_dt', $_POST['date'][$i]);
			$this->db->where('shift_code_fk','N');
			$unt_scheds = $this->SchedulingModel->unit_avail('unit_no_fk, unt_lic, dsp_stat_fk, shift_code_fk');
			$x = 0;
			$unt_sched = array();
			foreach ($unt_scheds as $id)
		    {
		        $unt_sched[$x] = $id->unit_no_fk;
		        $x++;
		    }

			if(isset($c1, $c2)){
				$this->db->not_like('unt_lic', $c1, 'before');
				$this->db->not_like('unt_lic', $c2, 'before');
			}

			if(!empty($unt_sched)){
				$this->db->where_not_in('unt_no', $unt_sched);
			}
			$where = array('rte_no' => $_POST['route_no']);
			$results[$i]['unit'] = $this->SchedulingModel->select_where(5, $select, $where);
			$results[$i]['test'] = $unt_scheds;
		}
		
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

	public function save_sched(){

		header('Content-Type: application/json');
		$this->form_validation->set_rules('dates', 'Dates', 'required');
		$this->form_validation->set_rules('driver_no', 'Driver No', 'required');
		$this->form_validation->set_rules('emp_no', 'Employer Number', 'required');
		$this->form_validation->set_rules('shift[]', 'Shift', 'required');
		$this->form_validation->set_rules('unit[]', 'Unit', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['data'] = validation_errors();
		}
		else
		{
			for ($i=0; $i < count($_POST['unit']); $i++) { 
				if($_POST['unit'][$i] != ''){
					$rte = $this->SchedulingModel->select_where(5, 'rte_no', array('unt_no'=>$_POST['unit'][$i]));
					$insert_data[$i] = array(
						'driver_no_fk' 	=> $_POST['driver_no'],
						'shift_code_fk' => $_POST['shift'][$i],
						'sched_dt'	 	=> $_POST['dates'][$i],
						'unit_no_fk' 	=> $_POST['unit'][$i],
						'rte_no_fk'		=> $rte[0]->rte_no,
						'sched_time'	=> date('H:i:s'),
						'sched_type'	=> 'A'
					);
				}
			}
			$this->SchedulingModel->insert_batch(7, $insert_data);
			$data['data'] = $insert_data;
		}
		echo json_encode($data, JSON_PRETTY_PRINT);
	}
	public function test(){
		print_r($_SERVER['HTTP_HOST']);
	}

}