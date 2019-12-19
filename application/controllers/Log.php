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
			'dd_tahun' => $this->m_log->dd_year_log(),
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

	public function delete_log(){
		$tahun = $this->input->post('tahun');
		if($tahun!='' || $tahun!=null){
			$delete = $this->m_app->delete_global('tb_log', array('YEAR(tanggal)'=>$tahun));
			if($delete>=0){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Delete Successfully',
					)
				);
				submit_log('Menghapus Log tahun '.$tahun);
			}else{
				echo json_encode(
					array(
						'code' => '500',
						'message' => 'Data Delete Failed',
					)
				);
			}
		}else{
			echo json_encode(array(
				'code' => 404,
				'message' => 'Data Not Valid',
			));
		}
	}
}
?>