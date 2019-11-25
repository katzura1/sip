<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_user extends CI_Model
{
	
	public function get_all_user(){
		$this->db->select('id,user,nama,level');
		$this->db->from('tb_user');
		$this->db->where('deletedate IS NULL');
		return $this->db->get();
	}

	public function get_user($id_user){
		$this->db->select('id,user,nama,level');
		$this->db->from('tb_user');
		$this->db->where('deletedate IS NULL');
		$this->db->where('id',$id_user);
		return $this->db->get();
	}
}
?>