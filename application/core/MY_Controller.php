<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class MY_Controller extends MX_Controller {
	public function __construct(){
		parent::__construct();
	}
		

	public function check_session_dispatcher(){
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'P') {
				show_404();
			}
		}
		else{
			redirect('login');
		}
	}

	public function check_session_admin(){
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'S') {
				show_404();
			}
		}
		else{
			redirect('login');
		}
	}


}