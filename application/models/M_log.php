<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_log extends CI_Model
{
	
	public function get_all_log(){
		$this->db->select('tl.id, tl.aksi, tl.id_user, tl.tanggal, tu.user username, tu.nama');
		$this->db->from('tb_log tl');
		$this->db->join('tb_user tu','tl.id_user=tu.id');
		$this->db->order_by('tl.tanggal','desc');
		return $this->db->get();
	}
}
?>