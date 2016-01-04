<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTrips extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();
	}

	public function index()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'activetrips_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(DataTablesCSS, Select2CSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, Select2JS));		
		
		echo Modules::run('templates/bilis_template', $data);
	}

}