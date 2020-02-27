<?php defined('BASEPATH') OR exit('No direct script access allowed');
    Class User_model extends CI_Model {
        
    public function getAll(){
        $this->db->select('user.UserID as id,
        user.NPP as npp, 
        user.Nama as nama,
        user.Email as email,
        user.Ktgri as kategori,
        user.SentraCode as sentracode,
        user.HandlingCode as handlingcode,
        user.Statusnya as status,
        user.Update,
        user.Expire ');
        $this->db->from('bbo_user.user as user');
        $this->db->order_by('Expire', 'desc');
        $this->db->order_by('id', 'asc');
        $user = $this->db->get();
        return $user->result();
    }    
    public function dataRole(){
        $this->db->select('role');
        $this->db->from('bbo_user.user_role');
        $this->db->group_by('role');
        $this->db->order_by('role', 'asc');
        $user = $this->db->get();
        return $user->result();
    }  
    public function save_data($data){
        $this->db->insert('bbo_user.user',$data);
    } 
    public function get_user_id($id){
        $getid = array('UserID' => $id);
        return $this->db->get_where('bbo_user.user',$getid)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('bbo_user.user',$data, $where);
    }
 }
?>