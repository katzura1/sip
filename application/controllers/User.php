<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		sudah_login();
	}

	public function index(){

		$data = array(
			'title' 	=> 'Master User',
			'dd_level' 	=> array('1'=>'User','2'=>'Admin','3'=>'Super Admin'),
			'level'		=> $this->session->userdata('sip_level'),
		);
		submit_log('Melihat halaman Database User');
		$this->load->view('user/index',$data);
	}

	public function ajax_dt_user(){
		$data = $this->m_user->get_all_user()->result_array();
		$final['draw']=1;
        $final['recordsTotal']=sizeof($data);
        $final['recordsFiltered']=sizeof($data);
        $final['data']=$data;
        echo json_encode($final);
	}

	public function submitForm(){
		$id_user = $this->input->post('id');

		$data_user = array(
			'user' 		=> $this->input->post('user'),
			'nama' 		=> $this->input->post('nama'),
			'password' 	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'level'		=> $this->input->post('level')
		);

		if($id_user=='' || $id_user == null){
			$insert = $this->m_app->insert_global('tb_user', $data_user);

			if($insert>1){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
				submit_log('Menambah Data User');
			}else{
				echo json_encode(
					array(
						'code' => '500',
						'message' => 'Data Saved Failed',
					)
				);
			}
		}else{
			if($this->input->post('password')==''){
				unset($data_user['password']);
			}
			$update = $this->m_app->update_global('tb_user', array('id'=>$id_user) ,$data_user);
			if($update>=0){
				echo json_encode(
					array(
						'code' => '200',
						'message' => 'Data Saved Successfully',
					)
				);
				submit_log('Meng-update Data User');
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

	public function delete_user(){
		$data = $this->input->post();
		$update = array('deletedate'=>date('Y-m-d'));
		$delete = $this->m_app->update_global('tb_user',$data,$update);
		if($delete>=0){
			echo json_encode(
				array(
					'code' => '200',
					'message' => 'Data Delete Successfully',
				)
			);
			submit_log('Menghapus Data User');
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
		$data = $this->m_user->get_user($id);
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