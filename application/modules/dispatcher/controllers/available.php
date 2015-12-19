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
		$data['css'] = $this->add_css(array(dataTablesCSS, dataTablesResCSS, Select2CSS));
		$data['js'] = $this->add_js(array(dataTablesJS, dataTablesJSBoot, dataTablesResJS, Select2JS, AvailableJS));		
		echo Modules::run('templates/bilis_template', $data);
	}

	public function get_driver(){
		// header('Content-Type: application/json');
		$select = 'emp_no, emp_fname, emp_lname, coo_no_fk';
		$where = array('coo_no_fk' => 1);
		$results = $this->AvailableModel->get_driver($select, $where);
		
		foreach ($results as $result) {
			echo '
			<tr>
				<td><input type="checkbox"></td>
				<td>' . $result->emp_fname . ' ' . $result->emp_lname . '</td>
				<td></td>
				<td>
					<button class="btn btn-warning editModal" id="editModal">
					<i class="fa fa-edit"></i> Edit</button>
				</td>
				<td></td>
				<td></td>
	        </tr>';
		}
		
		
		// echo $data['data'];


	}

}