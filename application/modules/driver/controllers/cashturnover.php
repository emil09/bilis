<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CashTurnover extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data['module'] = 'driver';
		$data['view_file'] = 'cashturnover_view';
		$data['sidebar'] = 'driver/driver_sidebar';

		// $data['css'] = $this->add_css(array());
		$data['js'] = $this->add_js(array(TurnoverJS));		

		echo Modules::run('templates/bilis_template', $data);
	}

}