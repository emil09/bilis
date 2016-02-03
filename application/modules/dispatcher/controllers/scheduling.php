<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Scheduling extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('SchedulingModel','',TRUE);
	}

	public function index(){
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulinglast_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, Select2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS, SchedulePrevJS));

		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->SchedulingModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		
		echo Modules::run('templates/bilis_noside', $data);
 	}

	// public function previous(){
	// 	$data['module'] = 'dispatcher';
	// 	$data['view_file'] = 'schedulinglast_view';
	// 	$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

	// 	$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, Select2CSS));
	// 	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS, SchedulePrevJS));

	// 	$where = array('emp_no' => $this->session->userdata('emp_no'));
	// 	$cooperatives = $this->SchedulingModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
	// 	$data['cooperatives'] = $cooperatives;
		
	// 	echo Modules::run('templates/bilis_noside', $data);
	// }
	public function next(){
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulingnext_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, Select2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS, ScheduleNextJS));		
		
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
			$this->db->where('sched_dt <', date("Y-m-d", strtotime('8 day')));
			$this->db->join('shift','shift_code = shift_code_fk', 'left');
			$this->db->join('vehicle','unt_no = unit_no_fk', 'left');
			$this->db->order_by('sched_dt');
			$results['driver'][$i]->sched = $this->SchedulingModel->select_where(7, $select2, $where2);
		}
		for ($i=1; $i <= 7; $i++) { 
			$results['date'][$i-1] =  date("Y-m-d", strtotime($i . ' days'));
		}
		

		echo json_encode($results);
	}

	public function get_driver_detail(){
		header('Content-Type: application/json');

		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, coo_name, driver_no';
		$where2 = array('employee.emp_no' => $_POST['emp_no']);
		$this->db->limit(1);
		$results = $this->SchedulingModel->get_driver($select, $where2);
		
		

		
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
		
		echo json_encode($data);

	}

	public function check_sched(){
		$select = 'unt_lic, unit_no_fk, sched_dt, sched_time, shift_code_fk';
		$this->db->join('driver','driver_no = driver_no_fk', 'left');
		$this->db->join('vehicle','unt_no = unit_no_fk', 'left');
		if ($_POST['rte_no']!=0) {
			$this->db->where('rte_no_fk',$_POST['rte_no']);
		}
		$where = array('emp_no_fk'=>$_POST['emp_no']);
		$this->db->where('sched_dt >=', $_POST['date'][0]);
		$this->db->where('sched_dt <=', end($_POST['date']));
		$data['schedule'] = $this->SchedulingModel->select_where(7, $select ,$where);

		header('Content-Type: application/json');
		echo json_encode($data);
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
					$c1 = '';
					$c2 = '';
					break;
			}
			$this->db->where(array('sched_dt' => $_POST['date'][$i], 'shift_code_fk'=>'D', 'shift_code_fk'=>'N'));

			// $this->db->where('shift_code_fk','D');
			// $this->db->where('shift_code_fk','N');
			$unt_scheds = $this->SchedulingModel->unit_avail('unit_no_fk, unt_lic, dsp_stat_fk, shift_code_fk, sched_dt');
			
			$unt_sched = array();
			for ($x = 0; $x < count($unt_scheds); $x++)
		    {
		        $unt_sched[$x] = $unt_scheds[$x]->unit_no_fk;
		        $x++;
		    }

			if(($c1!=='') && ($c2!=='')){
				$this->db->not_like('unt_lic', $c1, 'before');
				$this->db->not_like('unt_lic', $c2, 'before');
			}

			if(!empty($unt_sched)){
				$this->db->where_not_in('unt_no', $unt_sched);
			}
			if($_POST['route_no'] != 0){
				$this->db->where('rte_no', $_POST['route_no']);
			}

			$this->db->where('coo_no', $_POST['coo_no']);
			$results[$i]['unit'] = $this->SchedulingModel->select_where(5, $select);
			
		}
		
		echo json_encode($results);
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
			
				// insert
				$insert_data = '';
				$update_data = '';
				$update_id = '';
				for ($i=0; $i < count($_POST['unit']); $i++) { 
					if($_POST['unit'][$i] != ''){
						$select = 'sched_dt, sched_time, unit_no_fk, dsp_sched_no';
						$where = array(
							'sched_dt' => $_POST['dates'][$i],
							'shift_code_fk' => $_POST['shift'][$i],
							'sched_type'	=> 'A',
							'driver_no_fk' 	=> $_POST['driver_no']
						);
						$have_sched = $this->SchedulingModel->select_where(7, $select, $where);
						if(count($have_sched)>0){

							
								$rte = $this->SchedulingModel->select_where(5, 'rte_no', array('unt_no'=>$_POST['unit'][$i]));
								$update_data[$i] = array(
									'driver_no_fk' 	=> $_POST['driver_no'],
									'shift_code_fk' => $_POST['shift'][$i],
									'sched_dt'	 	=> $_POST['dates'][$i],
									'unit_no_fk' 	=> $_POST['unit'][$i],
									'rte_no_fk'		=> $rte[0]->rte_no,
									'sched_time'	=> date('H:i:s'),
									'sched_type'	=> 'A',
									'dsp_sched_no'=> $have_sched[0]->dsp_sched_no
								);
						}else{
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
					}else{
						$select = 'sched_dt, sched_time, unit_no_fk, dsp_sched_no';
						$where = array(
							'sched_dt' => $_POST['dates'][$i],
							'shift_code_fk' => $_POST['shift'][$i],
							'sched_type'	=> 'A',
							'driver_no_fk' 	=> $_POST['driver_no']
						);
						$h_sched = $this->SchedulingModel->select_where(7, $select, $where);
						if(count($h_sched)>0){
							$this->SchedulingModel->delete(7, array('dsp_sched_no'=> $h_sched[0]->dsp_sched_no));
						}
					}
					
				}	
				if($insert_data != ''){

					$this->SchedulingModel->insert_batch(7, $insert_data);
				}
				if($update_data != ''){
					
					$this->SchedulingModel->update_batch(7, $update_data, 'dsp_sched_no');
				}
				$data['data1'] = $insert_data;
				$data['data2'] = $_POST['unit'];
		}
		echo json_encode($data);
	}

	public function shift_avail(){
		$select = 'shift_code_fk';
		$where = array('sched_dt' => $_POST['date'], 'unit_no_fk' =>$_POST['unit_no']);
		$this->db->where('driver_no_fk !=', $_POST['driver_no']);
		$data = $this->SchedulingModel->select_where(7, $select, $where);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function test(){
		print_r($_SERVER['HTTP_HOST']);
	}

	// previous
	public function get_prev(){
		$init_d = $_POST['d'];
		for ($i=$init_d + 7, $j = 0; $i >$init_d -1; $i--, $j++) { 		
			$data['dates'][$j] = date('Y-m-d',strtotime('-'.$i.' day'));
		}

		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_prev_driver(){
		// This query used to display all drivers per cooperative
		$select = 'employee.emp_no, emp_fname, emp_lname, coo_no_fk, driver_no';
		$where = array('coo_no_fk' => $_POST['coo_no']);

		$results['driver'] = $this->SchedulingModel->get_driver($select, $where);
		
		for ($i=0; $i < count($results['driver']); $i++) { 

			// Getting the schedule of the driver, it is empty when the driver has no schedule
			$select2 = 'dsp_sched_no, sched_dt, sched_time, unt_lic, shift_name, sched_type, shift_code_fk';
		
			$where2 = array('driver_no_fk' => $results['driver'][$i]->driver_no);
			$this->db->where('sched_dt <=', end($_POST['dates']));
			$this->db->where('sched_dt >=', $_POST['dates'][0] );
			$this->db->join('shift','shift_code = shift_code_fk', 'left');
			$this->db->join('vehicle','unt_no = unit_no_fk', 'left');
			$this->db->order_by('sched_dt');
			$results['driver'][$i]->sched = $this->SchedulingModel->select_where(7, $select2, $where2);
		}
		

		header('Content-Type: application/json');
		echo json_encode($results);	
	}
}