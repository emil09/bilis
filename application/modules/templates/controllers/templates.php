<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Templates extends MX_Controller {
	
	public function blank_template($data = ' '){
		$this->load->view('blank_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('blank_template/footer', $data);
	}

	public function bilis_template($data = ' '){
		$this->load->view('bilis_template/header', $data);
		$this->load->view($data['module'] . '/' . $data['view_file'], $data);
		$this->load->view('bilis_template/footer', $data);
	}


}
