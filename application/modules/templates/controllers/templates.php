<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Templates extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('TemplateModel','',TRUE);
		
	}
	public function blank_template($data = ' '){
		$this->load->view('blank_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('blank_template/footer', $data);
	}

	public function bilis_template($data = array()){
		$css = $this->add_css(array(BootstrapCSS, FontAwesome, AdminLTE, Skins, Main, Media));
		$js = $this->add_js(array(JQuery, JQueryMigrate, BootstrapJS, SlimScroll, FastClick, App, Demo));

		if(isset($data['css'])){
			$css = $css . $data['css'];
		}
		if(isset($data['js'])){
			$js = $js . $data['js'];
		}
		
		$select = 'emp_fname, emp_lname, name as "position" ';
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$results = $this->TemplateModel->emp_data($select, $where);
		foreach ($results as $result) {
			$data['fname'] = $result->emp_fname;
			$data['lname'] = $result->emp_lname;
			$data['position'] = $result->position;
		}

		$data['css'] = $css;
		$data['js'] = $js;
		$this->load->view('bilis_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('bilis_template/footer', $data);
	}

	public function bilis_noside($data = array()){
		$css = $this->add_css(array(BootstrapCSS, FontAwesome, AdminLTE, Skins, Main, Media));
		$js = $this->add_js(array(JQuery, JQueryMigrate, BootstrapJS, SlimScroll, FastClick, App, Demo));

		if(isset($data['css'])){
			$css = $css . $data['css'];
		}
		if(isset($data['js'])){
			$js = $js . $data['js'];
		}
		$select = 'emp_fname, emp_lname, name as "position" ';
		$where = array('emp_no' => $this->session->userdata('emp_no'));
		$results = $this->TemplateModel->emp_data($select, $where);
		foreach ($results as $result) {
			$data['fname'] = $result->emp_fname;
			$data['lname'] = $result->emp_lname;
			$data['position'] = $result->position;
		}

		$data['css'] = $css;
		$data['js'] = $js;
		$this->load->view('bilis_noside/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('bilis_noside/footer', $data);
	}

}
