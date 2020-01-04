<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_box');
		$this->load->model('m_document');
		$this->load->model('m_jenis_berkas');
		sudah_login();
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
		$data = $this->m_box->get_box($id_box);
		if($data->num_rows()==0){
			echo ("<script LANGUAGE='JavaScript'>
				    window.alert('Box tidak ditemukan');
				    window.location.href='".site_url('dashboard1')."';
				    </script>");
		}
		$data = $data->row_array();
		$data['title'] 		= 'View Documents';
		$data['id_box'] 	= $id_box;
		$data['lokasi'] 	= 'Blok '.$data['blok'].', Rak '.$data['rak'].', Lantai '.$data['lantai'];
		$data['level'] 		= $this->session->userdata('sip_level');
		$data['dd_jb'] 		= $this->m_jenis_berkas->dd_jenis_berkas();
		$data['dd_bulan']	= $this->m_app->dd_bulan();

		submit_log('Melihat Halaman Box '.$data['kode']);
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
			$data = $this->input->post();
			unset($data['id']);
			$kodebox = $this->m_app->select_global('tb_box', array('id'=>$data['id_box']))->row()->kode;
			$insert = $this->m_app->insert_global('tb_berkas',$data);
			$hasil = $this->upload_data($insert);
			if($insert>0){
				submit_log('Menambah Data Berkas di Box '.$kodebox);
				echo json_encode(array('code'=>200,'message'=>'<div class="alert alert-success" role="alert"> Data Saved successfully</div><br>'.$hasil['result'],'c_err'=>$hasil['c_err']));
			}else{
				echo json_encode(array('code'=>500,'message'=>'data save failed'));
			}
		}else{
			$data = $this->input->post();
			$kodebox = $this->m_app->select_global('tb_box', array('id'=>$data['id_box']))->row()->kode;
			unset($data['id']);
			unset($data['lampiran']);
			$update = $this->m_app->update_global('tb_berkas',array('id'=>$id),$data);
			if($update>=0){
				submit_log('Meng-update Data Berkas di Box '.$kodebox);
				echo json_encode(array('code'=>200,'message'=>'data save successfully','c_err'=>0));
			}else{
				echo json_encode(array('code'=>500,'message'=>'data save failed'));
			}
		}
		
	}

	public function delete_doc(){
		$id = $this->input->post('id');
		$data = array('deletedate'=>date('Y-m-d'));
		$id_box = $this->m_app->select_global('tb_berkas',array('id'=>$id))->row()->id_box;
		$kodebox = $this->m_app->select_global('tb_box',array('id'=>$id_box))->row()->kode;
		$delete = $this->m_app->update_global('tb_berkas',array('id'=>$id),$data);
		if($delete>0){
			submit_log('Menghapus Data Berkas di Box '.$kodebox);
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

	public function upload($id){
		$data = $this->m_document->get_document($id)->row_array();
		$data['title']	= 'Upload Dokumen';
		$data['lampiran'] = $this->m_app->select_global('tb_berkas_lampiran', array('id_berkas'=>$id));
		$data['level']	= $this->session->userdata('sip_level');
		submit_log('Melihat Isi Lampiran Berkas '.$data['jenis_berkas'].' di Box '.$data['kode_box']);
		$this->load->view('doc/master_lampiran',$data);
	}

	public function upload_data($id_document,$mode='2'){
		// Set preference
	    $config['upload_path'] = 'files/document/'; 
	    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
	    $config['max_size'] = '200000'; // max_size in kb

	    //Load upload library
	    $this->load->library('upload',$config); 

	    $result = '';
	    $c_err = 0;
	   	$files = $_FILES;
	   	for ($i=0; $i < sizeof($_FILES['lampiran']['name']); $i++) { 
	   		$_FILES ['multipleUpload'] ['name'] = $files ['lampiran'] ['name'] [$i];
            $_FILES ['multipleUpload'] ['type'] = $files ['lampiran'] ['type'] [$i];
            $_FILES ['multipleUpload'] ['tmp_name'] = $files ['lampiran'] ['tmp_name'] [$i];
            $_FILES ['multipleUpload'] ['error'] = $files ['lampiran'] ['error'] [$i];
            $_FILES ['multipleUpload'] ['size'] = $files ['lampiran'] ['size'] [$i];

			$this->upload->initialize($config);
			if($files['lampiran']['error'][$i]==4){
				continue;
			}
            if(!($this->upload->do_upload('multipleUpload')) || $files ['lampiran'] ['error'] [$i] !=0)
            {
                $error =  $this->upload->display_errors();
                $result .= "<div class='alert alert-danger' role='alert'> File ke - ".($i+1)." Gagal di upload : $error</div>";
                $c_err ++ ;
            }
            else
            {
                //insert ke database
                $data = $this->upload->data();
                $insert = $this->m_app->insert_global('tb_berkas_lampiran', array('id_berkas'=>$id_document, 'files'=>$data['file_name']));
                if($insert==0){
                	$file = $config['upload_path'] . $data['file_name'];
		          	if (file_exists($file)) {
		          		unlink($file);
		          		$result .= "<div class='alert alert-danger' role='alert'> File ke - $i Gagal input ke database</div>";
		          	}
                }
            }
	   	}
	   	if($mode=='1'){
	   		$datab = $this->m_document->get_document($id_document)->row_array();
	   		submit_log('Mengupload lampiran di Berkas '.$datab['jenis_berkas'].' Box '.$datab['kode_box']);
	   		echo json_encode(array('result'=>$result,'c_err'=>$c_err));
	   	}else{
	   		return array('result'=>$result,'c_err'=>$c_err);	
	   	}
	}

	public function delete_attach(){
		$id = $this->input->post('id');
		$data = $this->m_app->select_global('tb_berkas_lampiran',array('id'=>$id))->row_array();
		$datab = $this->m_document->get_document($data['id_berkas'])->row_array();
		$file = 'files/document/'. $data['files'];
      	if (file_exists($file)) {
      		unlink($file);
      		$update = $this->m_app->delete_global('tb_berkas_lampiran',array('id'=>$id));
      		if($update>=0){
				submit_log('Menghapus lampiran '.$data['files'].' di Berkas '.$datab['jenis_berkas'].' Box '.$datab['nama_box']);
				echo json_encode(array('code'=>200,'message'=>'data save successfully','c_err'=>0));
			}else{
				echo json_encode(array('code'=>500,'message'=>'data save failed'));
			}
      	}
	}
}
?>