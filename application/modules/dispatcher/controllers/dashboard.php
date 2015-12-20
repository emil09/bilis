<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();
	}

	public function index()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'dashboard_view';	
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';
		echo Modules::run('templates/bilis_template', $data);
	}
}