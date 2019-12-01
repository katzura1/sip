<?php 

if(!function_exists('submit_log')) {
  function submit_log($aksi) {
	$CI = get_instance();
    $data_log = array(
		'tanggal' => date('Y-m-d H:i:s'),
		'id_user' => $CI->session->userdata('sip_id'),
		'aksi'	  => $aksi,
	);
	$CI->load->model('m_app');
	$CI->m_app->insert_global('tb_log',$data_log);
  }
}

?>