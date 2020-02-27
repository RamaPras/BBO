<?php defined('BASEPATH') OR exit('No direct script access allowed');
    Class User_Role_model extends CI_Model {
        
    public function getAll(){
        $this->db->select('ur.UserID as id,
        ur.role as role,
        ur.unit as unit,
        ur.update as update,
        us.Nama as nama,
        us.NPP as npp,
        ur.expiry_date as expiry'); 
        $this->db->from('bbo_user.user_role as ur');
        $this->db->join('bbo_user.user as us', 'ur.UserID = us.UserID');
        $this->db->order_by('id', 'asc');
        $user = $this->db->get();
        return $user->result();
    }    
    public function dataUser(){
        $this->db->select('UserID, Nama, NPP');
        $this->db->from('bbo_user.user');
        $this->db->order_by('Nama', 'asc');
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
        $this->db->insert('bbo_user.user_role',$data);
    } 
    public function get_user_id($id, $role, $unit){
        $getid = array('UserID' => $id, 'role' => $role, 'unit' => $unit);
        return $this->db->get_where('bbo_user.user_role',$getid)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);   
        $this->db->update('bbo_user.user_role',$data, $where);
    }

 }
?>