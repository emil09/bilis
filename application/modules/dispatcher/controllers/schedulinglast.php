<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class SchedulingLast extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_dispatcher();
	}

	public function index()
	{
		$data['module'] = 'dispatcher';
		$data['view_file'] = 'schedulinglast_view';
		$data['sidebar'] = 'dispatcher/dispatcher_sidebar';

		$data['css'] = $this->add_css(array(Select2CSS));
		$data['js'] = $this->add_js(array(Select2JS));		
		
		echo Modules::run('templates/bilis_noside', $data);
	}

}