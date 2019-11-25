<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}
        
	public function login()
	{
		$data = $this->input->post();

		$pass = $data['password'];
		unset($data['password']);

		$search = $this->m_app->select_global('tb_user', $data);
		if($search->num_rows()>0){
			$data_user = $search->row_array();
			if(password_verify($pass, $data_user['password'])){
				$data_session = array(
					'sip_id'	   => $data_user['id'],
					'sip_username' => $data_user['user'],
					'sip_nama'	   => $data_user['nama'],
					'sip_level'	   => $data_user['level'],
				);
				$data = $this->session->set_userdata($data_session);
				redirect('dashboard1');
			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("Wrong Password!");'; 
				echo 'window.location.href = "'.site_url('auth').'";';
				echo '</script>';
			}
		}else{
			echo '<script type="text/javascript">'; 
			echo 'alert("Username not found!");'; 
			echo 'window.location.href = "'.site_url('auth').'";';
			echo '</script>';
		}
	}
        
    public function logout()
	{
		$this->session->sess_destroy();\
		redirect('Auth');
	}
}
