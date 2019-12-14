<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_log');
		sudah_login();
	}

	public function index(){
		$data = array(
			'title' => 'Log',
			'level'	=> $this->session->userdata('sip_level'),
		);
		$this->load->view('log/index',$data);
	}

	public function insert_log(){
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'id_user' => $this->session->userdata('sip_id'),
			'aksi'	  => $this->input->post('aksi'),
		);
		$insert = $this->m_app->insert_global('tb_log',$data);
		echo 'result log : '.$insert;
	}

	public function list_ajax_dt(){
		$data = $this->m_log->get_all_log()->result_array();
		$final['draw']=1;
        $final['recordsTotal']=sizeof($data);
        $final['recordsFiltered']=sizeof($data);
        $final['data']=$data;
        echo json_encode($final);
	}
}
?>