<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Payroll extends MY_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('PayrollModel','',TRUE);
		$this->check_session_admin();
	}

	public function index() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, DataTablesButtonCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, DataTablesButtonJS, PrintJS, JSZip, PDFMakeJS, VFSFontsJS, DataTablesHTML5ButtonJS, Bootstrap3DateJS, Sweetalert2, PayrollJS));
		$data['module'] = 'admin';
		$data['view_file'] = 'payroll_view';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->PayrollModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);
	}

	public function filtered_report() {
		header('Content-Type: application/json');
		$data = array();
		$this->form_validation->set_rules('payroll_date', 'Date', 'required');
		$this->form_validation->set_rules('shift', 'Dispatched Shift', 'required');
		$this->form_validation->set_rules('coo_select', 'Cooperative', 'required');
		

		if ($this->form_validation->run($this) == FALSE){

			$data = array(
				'msg'		=> validation_errors(' ', ' '),
				'status' 	=> 'error');
		} else {
			$select = 'emp_no_fk, emp_lname, emp_mname, emp_fname, rte_nam, unt_lic';
			$where = array(
				'emp_pos' => 'D',
				'r.coo_no_fk' => $_POST['coo_select'],
				'start_dt' => $_POST['payroll_date'],
				'shift_code_fk' => $_POST['shift']
			);
			$data['payroll'] = $this->PayrollModel->payroll_list($select, $where);
			$data['payrollwithcash'] = $this->PayrollModel->payroll_list_with_cash('emp_no_fk, emp_lname, amt_in', $where);
		}
		echo json_encode($data);
	}

}