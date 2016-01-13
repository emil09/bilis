<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_driver();
	}

	public function index()
	{
		$data['module'] = 'driver';
		$data['view_file'] = 'dashboard_view';	
		$data['sidebar'] = 'driver/driver_sidebar';
		echo Modules::run('templates/bilis_noside', $data);
	}
}