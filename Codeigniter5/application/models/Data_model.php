<?php defined('BASEPATH') OR exit('No direct script access allowed');

    Class Data_model extends CI_Model {
        private $table = "CALL a_nasabah.sp_map_cif";
        private $customer = "CALL a_nasabah.sp_cid";
    public function getAll(){
        return $this->db->query($this->table)->result();
    }
    public function getCID(){
        return $this->db->query($this->customer)->result();
    }
    public function CIDbyID($cid){
        $customerbyid = "CALL a_nasabah.sp_cid_id(?)";
        $data = array('cid' => $cid);
        $query = $this->db->query($customerbyid, $data);
       if($query->num_rows()>0){
           foreach ($query->result() as $data) {
               $hasil=array(
                   'cid' => $data->cid,
                   'grup' => $data->grup,
                   'flag' => $data->flag,
                   'segmen' => $data->segmen,
                   'DIVISI' =>$data->DIVISI,
               );
           }
       }
       return $hasil; 
    }
    public function save_data($data){
        $this->db->insert('a_nasabah.mapping_cid_cif',$data);
    }

    public function get_cif_id($no_cif, $tgl){
        $getId = "CALL a_nasabah.sp_map_cif_id(?, ?)";
        $nocif = array('No_CIF' => $no_cif, 'tgl_mulai'=> $tgl );
        return $this->db->query($getId, $nocif)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('a_nasabah.mapping_cid_cif',$data, $where);
    }
    public function delete_data($where){
        $this->db->where($where);
        $this->db->delete('a_nasabah.mapping_cid_cif', $where);
    }
    
 }

?>