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

	public function dd_year_log(){
		$this->db->select('YEAR(tanggal) tahun');
		$this->db->from('tb_log tl');
		$this->db->where('YEAR(tanggal)',date('Y'));
		$this->db->group_by('YEAR(tanggal)');
		$data = $this->db->get();
		$dd[''] = 'Select';
		foreach($data->result() as $row){
			$dd[$row->tahun] = $row->tahun;
		}
		return $dd;
	}
}
?>