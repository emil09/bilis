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

		$data['css'] = $this->add_css(array(FooTableCSS, Select2CSS));
		$data['js'] = $this->add_js(array(FooTableJS, FooTableSortJS, FooTableFilterJS, Select2JS, AvailableJS));		
		
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$cooperatives = $this->AvailableModel->dispatcher_detail('emp_no, coo_no, coo_name, emp_lname', $where);
		$data['cooperatives'] = $cooperatives;
		echo Modules::run('templates/bilis_template', $data);
	}

	public function get_driver(){
		header('Content-Type: application/json');
		// $_POST['coo_no'] = 1;
		$select = 'emp_no, emp_fname, emp_lname, coo_no_fk';
		$where = array('coo_no_fk' => $_POST['coo_no']);
		$results = $this->AvailableModel->get_driver($select, $where);
		$data = '';
		
		$i = 0;
		$data['total'] = count($results);
		foreach ($results as $result) {
			
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$i++;
		}
		echo json_encode($data);
	}

	public function get_driver_by_empno(){
		header('Content-Type: application/json');
		// $_POST['coo_no'] = 1;
		$select = 'emp_no, emp_fname, emp_lname, coo_no_fk, coo_name';
		$where = array('emp_no' => $_POST['emp_no']);
		$results = $this->AvailableModel->get_driver($select, $where);
		$data = '';

		$date =  date('M j, Y');
		$data['date']= $date;
		$i = 0;
		foreach ($results as $result) {
			$data['driver'][$i]['lname'] = $result->emp_lname;
			$data['driver'][$i]['fname'] = $result->emp_fname;
			$data['driver'][$i]['emp_no'] = $result->emp_no;
			$data['driver'][$i]['coo_name'] = $result->coo_name;
			$data['driver'][$i]['coo_no_fk'] = $result->coo_no_fk;
			$select2 = 'rte_nam, rte_no';
			$where2 = array('coo_no_fk' => $result->coo_no_fk);
			$data['driver'][$i]['route'] = $this->AvailableModel->select_where(4, $select2, $where2);
			$i++;
		}
		
		echo json_encode($data);
	}

	public function get_unit(){

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
				# code...
				break;
		}
		$this->db->not_like('unt_lic', $d1, 'before');
		$this->db->not_like('unt_lic', $d2, 'before');
		$where = array('rte_no' => $_POST['route_no']);
		$results = $this->AvailableModel->select_where(5, $select, $where);
	
		echo json_encode($results);
	
	}

}