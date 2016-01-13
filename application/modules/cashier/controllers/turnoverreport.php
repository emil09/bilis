<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Turnoverreport extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_session_cashier();
	}

	public function index()
	{
		$data['module'] = 'cashier';
		$data['view_file'] = 'turnoverreport_view';
		$data['sidebar'] = 'cashier/cashier_sidebar';
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS));
		$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, MomentJS, Bootstrap3DateJS, TurnoverReportJS));

		echo Modules::run('templates/bilis_noside', $data);
	}
}