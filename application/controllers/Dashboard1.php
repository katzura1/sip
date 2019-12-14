<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard1 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		sudah_login();
	}

	public function index()
	{
		$data = array(
			'title' => 'Search Box',
			'level' => $this->session->userdata('sip_level'),
		);
		$this->load->view('dashboard1',$data);
	}
}
