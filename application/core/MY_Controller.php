<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class MY_Controller extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$data['js'] = '';
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

	public function check_session_cashier() {
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'C') {
				show_404();
			}
		}
		else{
			redirect('login');
		}
	}

	public function check_session_collector() {
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'B') {
				show_404();
			}
		}
		else{
			redirect('login');
		}
	}

	public function check_session_driver() {
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'D') {
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

	public function check_session_counter(){
		if($this->session->userdata('is_logged_in') == TRUE ){
			if ($this->session->userdata('position') != 'N') {
				show_404();
			}
		}
		else{
			redirect('login');
		}
	}

	public function add_css($file = array(), $str = ''){
		foreach($file as $item){
            $str .= '<link rel="stylesheet" href="'.base_url($item).'" type="text/css" />'."\n";  
        }
        return $str;
	}

	public function add_js($file = array(), $str = ''){     
        foreach($file as $item){
            $str .= '<script type="text/javascript" src="'.base_url($item).'"></script>'."\n";  
        }
        return $str;
   }

}