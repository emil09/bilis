<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Scheduling extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();

		$this->load->model('SchedulingModel','',TRUE);
	}

	public function index()
	{
		redirect('dispatcher/scheduling/next');
	}
	public function previous()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulinglast_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(Select2CSS));
		$data['js'] = $this->add_js(array(Select2JS));		
		
		echo Modules::run('templates/bilis_noside', $data);
	}
	public function next()
	{
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
		$results = $this->SchedulingModel->get_driver($select, $where);
		
		echo json_encode($results, JSON_PRETTY_PRINT);
	}

}