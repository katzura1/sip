<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_berkas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_jenis_berkas');
		$this->load->model('m_document');
		$this->load->model('m_jenis_berkas');
	}

	public function index()
	{
		$data = array(
			'title' => 'Document Type Master',
			'level' => $this->session->userdata('sip_level'),
		);
		submit_log('Melihat Halaman Database Jenis Berkas');
		$this->load->view('jenis_berkas/index',$data);
	}

	public function ajax_dt_jenis_berkas(){
		$data = $this->m_jenis_berkas->get_all_jenis_berkas()->result_array();
		$final['draw']=1;
        $final['recordsTotal']=sizeof($data);
        $final['recordsFiltered']=sizeof($data);
        $final['data']=$data;
        echo json_encode($final);
	}

	public function submitForm(){
		$id_jenis_berkas = $this->input->post('id');

		$data_jenis_berkas = $this->input->post();
		unset($data_jenis_berkas['id']);

		if($id_jenis_berkas=='' || $id_jenis_berkas == null){
			$insert = $this->m_app->insert_global('tb_jenis_berkas', $data_jenis_berkas);

			if($insert>1){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
				submit_log('Menambah Data Jenis Berkas');
			}else{
				echo json_encode(
					array(
						'code' => '500',
						'message' => 'Data Saved Failed',
					)
				);
			}
		}else{
			$update = $this->m_app->update_global('tb_jenis_berkas', array('id'=>$id_jenis_berkas) ,$data_jenis_berkas);
			if($update>=0){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
				submit_log('Meng-update Data Jenis Berkas');
			}else{
				echo json_encode(
					array(
						'code' => '500',
						'message' => 'Data Saved Failed',
					)
				);
			}
		}

	}

	public function delete_jenis_berkas(){
		$data = $this->input->post();
		$update = array('deletedate'=>date('Y-m-d'));
		$delete = $this->m_app->update_global('tb_jenis_berkas',$data,$update);
		if($delete>=0){
			echo json_encode(
				array(
					'code' => '200',
					'message' => 'Data Delete Successfully',
				)
			);
			submit_log('Menghapus Data Jenis Berkas');
		}else{
			echo json_encode(
				array(
					'code' => '500',
					'message' => 'Data Delete Failed',
				)
			);
		}
	}

	public function get_info(){
		$id = $this->input->get('id');
		$data = $this->m_jenis_berkas->get_jenis_berkas($id);
		if($data->num_rows()>0){
			echo json_encode(
				$data->row_array()
			);
		}else{
			echo json_encode(array());
		}
	}
}
?>