<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard1 extends CI_Controller {

	public function index()
	{
		$data = array(
			'level' => $this->session->userdata('sip_level'),
		);
		$this->load->view('dashboard1',$data);
	}
}
