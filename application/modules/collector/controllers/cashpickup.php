<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CashPickup extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_collector();

		$this->load->model('CashPickupModel','',TRUE);
	}

	public function index()
	{
		$data['module'] = 'collector';
		$data['view_file'] = 'cashpickup_view';
		$data['sidebar'] = 'collector/collector_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Sweetalert2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, CashPickupJS, Sweetalert2));
		$alllocations = $this->CashPickupModel->all_locs('loc_no, loc_name');
		$data['locations'] = $alllocations;
		echo Modules::run('templates/bilis_noside', $data);
	}

}