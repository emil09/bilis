<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Logout extends MX_Controller {
	public function index()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
