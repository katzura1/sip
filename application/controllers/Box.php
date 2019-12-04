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
		submit_log('Melihat Halaman Database Box');
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
		$this->load->library('ciqrcode'); //load library qrcode
		$config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './files/'; //string, the default is application/cache/
        $config['errorlog']     = './files/'; //string, the default is application/logs/
        $config['imagedir']     = './files/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

		$id_box = $this->input->post('id');

		$data_box = array(
			'kode' 		=> $this->input->post('kode'),
			'npwp' 		=> str_replace('.','',str_replace('-','',$this->input->post('npwp'))),
			'nama' 		=> $this->input->post('nama'),
			'alamat' 	=> $this->input->post('alamat'),
			'blok' 		=> $this->input->post('blok'),
			'rak' 		=> $this->input->post('rak'),
			'lantai' 	=> $this->input->post('lantai'),
		);

		if($id_box=='' || $id_box == null){
			$data_box['kode'] = $this->m_box->get_last_kode();

			$image_name = $data_box['kode'].'.png'; //buat name dari qr code sesuai dengan nim
	        $params['data'] = $data_box['kode']; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

	        $data_box['qrcode'] = $image_name;
			$insert = $this->m_app->insert_global('tb_box', $data_box);
			if($insert>=1){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
				submit_log('Menambah Data Box :'.$data_box['kode']);
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
				submit_log('Meng-update Data Box '.$data_box['kode']);
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
		$data_box = $this->m_app->select_global('tb_box',$data)->row_array();
		$update = array('deletedate'=>date('Y-m-d'));
		$delete = $this->m_app->update_global('tb_box',$data,$update);
		if($delete>=0){
			echo json_encode(
				array(
					'code' => '200',
					'message' => 'Data Delete Successfully',
				)
			);
			submit_log('Menghapus Data Box '.$data_box['kode']);		
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

	public function get_qr(){
		$id = $this->input->get('id');
		$data = $this->m_app->select_global('tb_box',array('id'=>$id));
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

	public function search_box(){
		$param = $this->input->post('param');

		$data = $this->m_box->get_box_like($param);
		if($data->num_rows()>0){
			echo json_encode(array('code'=>'200','message'=>'Found','id_box'=>$data->row()->id));
		}else{
			echo json_encode(array('code'=>'404','message'=>'Not Found!','id_box'=>''));
		}
	}

	public function get_box_id(){
		$kode = $this->input->post('kode');
		$data = $this->m_app->select_global('tb_box',array('kode'=>$kode));
		if($data->num_rows()>0){
			echo $data->row()->id;
		}else{
			echo 0;
		}
	}
}
