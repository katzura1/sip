<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_document extends CI_Model
{
	public function get_document_by_box($id_box){
		$this->db->select('td.id, td.masa_pajak, td.tahun_pajak, td.status_pembetulan, td.keterangan, td.status_pinjam, tb.id id_box, tb.kode kode_box, tb.nama nama_box, tjb.id id_jenis, tjb.nama jenis_berkas');
		$this->db->from('tb_berkas td');
		$this->db->join('tb_box tb','tb.id=td.id_box');
		$this->db->join('tb_jenis_berkas tjb','tjb.id=td.id_jenis');
		$this->db->where('id_box',$id_box);
		$this->db->where('td.deletedate IS NULL');
		return $this->db->get();
	}

	public function get_document($id){
		$this->db->select('td.id, td.masa_pajak, td.tahun_pajak, td.status_pembetulan, td.keterangan, td.status_pinjam, tb.id id_box, tb.kode kode_box, tb.nama nama_box, tjb.id id_jenis, tjb.nama jenis_berkas');
		$this->db->from('tb_berkas td');
		$this->db->join('tb_box tb','tb.id=td.id_box');
		$this->db->join('tb_jenis_berkas tjb','tjb.id=td.id_jenis');
		$this->db->where('td.id',$id);
		$this->db->where('td.deletedate IS NULL');
		return $this->db->get();
	}
}	
?>