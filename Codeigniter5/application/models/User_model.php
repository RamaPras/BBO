<?php defined('BASEPATH') OR exit('No direct script access allowed');
    Class User_model extends CI_Model {
        
    public function getAll(){
        $this->db->select('user_id, npp, nama, category, status, expire_date');
        $this->db->from('dpk_map.user_test');
        $this->db->order_by('user_id', 'desc');
        $user = $this->db->get();
        return $user->result();
    }    
   
    public function save_data($data){
        return $this->db->insert('dpk_map.user_test',$data);
    } 
    public function get_user_id($id){
        $getid = array('user_id' => $id);
        return $this->db->get_where('dpk_map.user_test',$getid)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('dpk_map.user_test',$data, $where);
    }

    public function reset_pass($where, $data){
        $this->db->where($where);  
        $this->db->update('dpk_map.user_test',$data, $where); 
    }

    public function change_pass($where, $data){
        $this->db->where($where);  
        $this->db->update('dpk_map.user_test',$data, $where);
    }

 }
?>