<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_document extends CI_Model
{
	public function get_document_by_box($id_box){
		$this->db->select('td.id, td.nama_file, tb.nama nama_box, tb.kode kode_box, tb.id id_box');
		$this->db->from('tb_doc td');
		$this->db->join('tb_box tb','tb.id=td.id_box');
		$this->db->where('id_box',$id_box);
		$this->db->where('td.deletedate IS NULL');
		return $this->db->get();
	}

	public function get_document($id){
		$this->db->select('td.id, td.nama_file, tb.nama nama_box, tb.kode kode_box, tb.id id_box');
		$this->db->from('tb_doc td');
		$this->db->join('tb_box tb','tb.id=td.id_box');
		$this->db->where('td.id',$id);
		$this->db->where('td.deletedate IS NULL');
		return $this->db->get();
	}
}	
?>