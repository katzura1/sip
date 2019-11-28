<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_jenis_berkas extends CI_Model
{
	
	public function get_all_jenis_berkas(){
		$this->db->select('id,kode,nama');
		$this->db->from('tb_jenis_berkas');
		$this->db->where('deletedate IS NULL');
		return $this->db->get();
	}

	public function get_jenis_berkas($id_jenis_berkas){
		$this->db->select('id,kode,nama');
		$this->db->from('tb_jenis_berkas');
		$this->db->where('deletedate IS NULL');
		$this->db->where('id',$id_jenis_berkas);
		return $this->db->get();
	}

	public function get_last_kode(){
		$this->db->select('kode');
		$this->db->from('tb_jenis_berkas');
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

	public function get_jenis_berkas_like($param){
		$this->db->select('id,kode,nama');
		$this->db->from('tb_jenis_berkas');
		$this->db->like('kode',$param);
		$this->db->or_like('nama',$param);
		$this->db->where('deletedate IS NULL');
		return $this->db->get();
	}

	public function dd_jenis_berkas(){
		$data = $this->get_all_jenis_berkas();
		$dd[''] = 'Silahkan pilih';
		foreach ($data->result() as $row) {
			$dd[$row->id] = $row->nama;
		}
		return $dd;
	}
}
?>