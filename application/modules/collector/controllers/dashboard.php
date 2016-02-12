<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_collector();
	}

	public function index()
	{
		$data['module'] = 'collector';
		$data['view_file'] = 'dashboard_view';	
		$data['sidebar'] = 'collector/collector_sidebar';
		echo Modules::run('templates/bilis_noside', $data);
	}
}