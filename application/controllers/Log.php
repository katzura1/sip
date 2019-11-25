<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function insert_log(){
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'id_user' => $this->session->userdata('sip_id'),
			'aksi'	  => $this->input->post('aksi'),
		);
		$insert = $this->m_app->insert_global('tb_log',$data);
		echo 'result log : '.$insert;
	}
}
?>