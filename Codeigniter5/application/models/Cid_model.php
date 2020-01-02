<?php defined('BASEPATH') OR exit('No direct script access allowed');
    Class Cid_model extends CI_Model {
        
    public function getAll(){
        $this->db->select('cid, nama, flag, grup, segmen, tgl_mulai, tgl_akhir');
        $this->db->from('a_nasabah.cid');
        $this->db->order_by('cid', 'desc');
        $cid = $this->db->get();
        return $cid->result();
    }    
    public function getcid(){
        return $this->db->query("SELECT MAX(cid)+1 as cid FROM a_nasabah.cid")->row();
    }
    public function save_data($data){
        return $this->db->insert('a_nasabah.cid',$data);
    } 
    public function get_cid_id($cid, $tgl){
        $getcid = array('cid' => $cid, 'tgl_mulai'=> $tgl );
        return $this->db->get_where('a_nasabah.cid',$getcid)->row();
   }
//    public function tgl_akhir($where, $data){
//     $this->db->where($where);  
//     $this->db->update('a_nasabah.cid',$data, $where);
//    }
   
    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('a_nasabah.cid',$data, $where);
    }

    public function delete_data($where){
        $this->db->where($where);
        $this->db->delete('a_nasabah.cid', $where);
    
    }
 }
?>