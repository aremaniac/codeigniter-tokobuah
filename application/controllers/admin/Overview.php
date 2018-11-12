<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

	public function __construct()
	 {
		 parent::__construct();
		 $this->load->library('form_validation', 'session');

		 // echo $this->session->userdata('login_status');
		 // die;

		 if($this->session->userdata('login_status') != 'logged_in'){
			 redirect(site_url('login'));
		 }
	 }

	public function index()
	{
		$this->load->view('admin/overview');
	}

	public function session_log()
	{
		echo json_encode($this->session->userdata());
	}

}
