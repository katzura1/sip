<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_box');
		$this->load->model('m_document');
	}

	public function index(){
		$data = array(
			'title' => 'Document Master',
			'level' => $this->session->userdata('sip_level'),
			'dd_box' => $this->m_box->dd_box(),
		);
		$this->load->view('doc/index',$data);
	}

	public function view($id_box){
		$data = $this->m_box->get_box($id_box)->row_array();
		$data['title'] = 'View Documents';
		$data['lokasi'] = 'Blok '.$data['blok'].', Rak '.$data['rak'].', Lantai '.$data['lantai'];
		$data['level'] = $this->session->userdata('sip_level');
		$this->load->view('doc/master',$data);
	}

	public function ajax_dt_document(){
		$id_box = $this->input->post('kodebox');
		$data = $this->m_document->get_document_by_box($id_box)->result_array();
		$final['draw']=1;
        $final['recordsTotal']=sizeof($data);
        $final['recordsFiltered']=sizeof($data);
        $final['data']=$data;
        echo json_encode($final);
	}

	public function upload_docs(){
		$config['upload_path']          = './files/documents/';
		$config['allowed_types']        = 'pdf|doc|docx|gif|jpg|png';
		$config['max_size']             = 5000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('file_doc')){
			$error = array(
				'error' => $this->upload->display_errors(), 
				'upload_data'=>''
			);
			return $error;
		}else{
			$data = array(
				'error'=>'',
				'upload_data' => $this->upload->data()
			);
			return $data;
		}
	}

	public function submitForm(){
		$id = $this->input->post('id');

		if($id=='' || $id==null){
			$data = array(
				'id_box' 	=> $this->input->post('id_box'),
				'nama_file'	=> $this->input->post('nama_file'),
			);
			$insert = $this->m_app->insert_global('tb_doc',$data);
			if($insert>0){
				echo json_encode(array('code'=>200,'message'=>'data save successfully'));
			}else{
				echo json_encode(array('code'=>500,'message'=>'data save failed'));
			}
		}else{
			$data = array(
				'id_box'	=> $this->input->post('id_box'),
				'nama_file' => $this->input->post('nama_file'),
			);
			$update = $this->m_app->update_global('tb_doc',array('id'=>$id),$data);
			if($update>=0){
				echo json_encode(array('code'=>200,'message'=>'data save successfully'));
			}else{
				echo json_encode(array('code'=>500,'message'=>'data save failed'));
			}
		}
		
	}

	public function delete_doc(){
		$id = $this->input->post('id');
		$data = array('deletedate'=>date('Y-m-d'));
		$delete = $this->m_app->update_global('tb_doc',array('id'=>$id),$data);
		if($delete>0){
			echo json_encode(array('code'=>200,'message'=>'data deleted successfully'));
		}else{
			echo json_encode(array('code'=>500,'message'=>'data delete failed'));
		}
	}

	public function get_info(){
		$id = $this->input->get('id');
		$data = $this->m_document->get_document($id)->row_array();
		echo json_encode($data);
	}
}
?>