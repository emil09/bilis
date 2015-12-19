<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Templates extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
		
	}
	public function blank_template($data = ' '){
		$this->load->view('blank_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('blank_template/footer', $data);
	}

	public function bilis_template($data = array()){
		$css = $this->add_css(array(BootstrapCSS, FontAwesome, AdminLTE, Skins, Main));
		$js = $this->add_js(array(JQuery, JQueryMigrate, BootstrapJS, SlimScroll, FastClick, App, Demo));

		if(isset($data['css'])){
			$css = $css . $data['css'];
		}
		if(isset($data['js'])){
			$js = $js . $data['js'];
		}
		

		$data['css'] = $css;
		$data['js'] = $js;
		$this->load->view('bilis_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('bilis_template/footer', $data);
	}


}
