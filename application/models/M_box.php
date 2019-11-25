<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_box extends CI_Model
{
	
	public function get_all_box(){
		$this->db->select('id,kode,nama');
		$this->db->from('tb_box');
		$this->db->where('deletedate IS NULL');
		return $this->db->get();
	}

	public function get_box($id_box){
		$this->db->select('id,kode,nama');
		$this->db->from('tb_box');
		$this->db->where('deletedate IS NULL');
		$this->db->where('id',$id_box);
		return $this->db->get();
	}

	public function get_last_kode(){
		$this->db->select('kode');
		$this->db->from('tb_box');
		$this->db->order_by('kode','desc');
		$data = $this->db->get();
		if($data->num_rows()==0){
			return 'B001';
		}else{
			$kode = $data->row()->kode;
			$number = substr($kode, 1)+1;
			return 'B'.sprintf('%03d', $number);
		}
	}

	public function dd_box(){
		$this->db->select('id, kode, nama');
		$this->db->from('tb_box');
		$this->db->where('deletedate IS NULL');
		$data = $this->db->get();
		$dd[''] = "Select Box";
		foreach ($data->result() as $row) {
			$dd[$row->id] = $row->kode.'-'.$row->nama;
		}
		return $dd;
	}
}
?>