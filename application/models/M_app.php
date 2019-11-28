<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app extends CI_Model {
  public function select_global($table,$key=array(),$ordercol="", $sorter="asc"){
      $this->db->where($key);
      $this->db->from($table);
      if(!empty($ordercol)){
          $this->db->order_by($ordercol, $sorter);
      }
      $result = $this->db->get();
      return $result;
  }

  public function insert_global($table,$data=array()){
      $this->db->insert($table,$data);
      return $this->db->insert_id();
  }

  public function insert_batch_global($table, $data=array()){
    return $this->db->insert_batch($table,$data);
  }

  public function delete_global($table,$key=array()){
      $this->db->where($key);
      $this->db->delete($table);
      return $this->db->affected_rows();
  }

  public function update_global($table,$key=array(),$field=array()){
      $this->db->where($key);
      $this->db->update($table,$field);
      //echo $this->db->last_query();
      return $this->db->affected_rows();
  }

  public function dd_bulan(){
    $dd_bulan['1']  = 'Januari';
    $dd_bulan['2']  = 'Febuari';
    $dd_bulan['3']  = 'Maret';
    $dd_bulan['4']  = 'April';
    $dd_bulan['5']  = 'Mei';
    $dd_bulan['6']  = 'Juni';
    $dd_bulan['7']  = 'Juli';
    $dd_bulan['8']  = 'Agustus';
    $dd_bulan['9']  = 'September';
    $dd_bulan['10'] = 'Oktober';
    $dd_bulan['11'] = 'November';
    $dd_bulan['12'] = 'Desember';
    return $dd_bulan;
  }
}
