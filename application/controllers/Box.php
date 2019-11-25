<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Box extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_box');
		$this->load->model('m_document');
	}

	public function index()
	{
		$data = array(
			'title' => 'Box Master',
			'level' => $this->session->userdata('sip_level'),
		);
		$this->load->view('box/index',$data);
	}

	public function ajax_dt_box(){
		$data = $this->m_box->get_all_box()->result_array();
		$final['draw']=1;
        $final['recordsTotal']=sizeof($data);
        $final['recordsFiltered']=sizeof($data);
        $final['data']=$data;
        echo json_encode($final);
	}

	public function submitForm(){
		$id_box = $this->input->post('id');

		$data_box = array(
			'kode' 		=> $this->input->post('kode'),
			'nama' 		=> $this->input->post('nama'),
		);

		if($id_box=='' || $id_box == null){
			$data_box['kode'] = $this->m_box->get_last_kode();
			$insert = $this->m_app->insert_global('tb_box', $data_box);

			if($insert>1){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
			}else{
				echo json_encode(
					array(
						'code' => '500',
						'message' => 'Data Saved Failed',
					)
				);
			}
		}else{
			$update = $this->m_app->update_global('tb_box', array('id'=>$id_box) ,$data_box);
			if($update>=0){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
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

	public function delete_box(){
		$data = $this->input->post();
		$update = array('deletedate'=>date('Y-m-d'));
		$delete = $this->m_app->update_global('tb_box',$data,$update);
		if($delete>=0){
			echo json_encode(
				array(
					'code' => '200',
					'message' => 'Data Delete Successfully',
				)
			);
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
		$data = $this->m_box->get_box($id);
		if($data->num_rows()>0){
			echo json_encode(
				$data->row_array()
			);
		}else{
			echo json_encode(array());
		}
	}

	public function get_document(){
		$id_box = $this->input->get('id');
		$data_doc = $this->m_document->get_document_by_box($id_box);
		$tr = '';
		$i = 1;
		foreach ($data_doc->result() as $row) {
			$tr.= '<tr>';
			$tr.= '<td>'.$i.'</td>';
			$tr.= '<td>'.$row->nama_file.'</td>';
			$tr.= '</tr>';
			$i++;
		}
		echo $tr;
	}
}
