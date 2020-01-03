<?php defined('BASEPATH') OR exit('No direct script access allowed');

    Class Rm_model extends CI_Model {
        //private $table = "CALL a_nasabah.sp_map_rm";
        //private $getrm = "CALL a_pegawai.sp_rm";

    public function getAll(){ 
        $this->db->select('map_rm.cid as CUSTOMER_ID,
        grp.nama as CUSTOMER_NAME,
        grp.flag as flag,
        grp.segmen as segmen,
        grp.grup as grup,
        map_rm.npp as INITIAL_RM,
        rm.nama as RM_NAME,
        map_unit.kode_unit as KODE_DIVISI,
        unit.nama_unit as DIVISI,
        map_rm.tgl_mulai,
        map_rm.tgl_akhir');
        $this->db->from('a_nasabah.mapping_cid_npp_test as map_rm');
        $this->db->join('a_nasabah.cid_test as grp', 'map_rm.cid = grp.cid');
        $this->db->join('a_pegawai.mapping_rm_unit_test as map_unit', 'map_unit.npp = map_rm.npp');
        $this->db->join('a_pegawai.p_rm_test as rm' , 'rm.npp = map_unit.npp');
        $this->db->join('a_unit.p_unit_test as unit' , 'unit.kode_unit = map_unit.kode_unit');
        $this->db->where('(1=1)
        and (map_rm.tgl_mulai <= sysdate() and map_rm.tgl_akhir >= sysdate())
        and (grp.tgl_mulai <= "2019-10-31 00:00:00" and grp.tgl_akhir >= "2019-10-31 00:00:00")
        and (map_unit.tgl_mulai <= "2019-10-31 00:00:00" and map_unit.tgl_akhir >= "2019-10-31 00:00:00")
        and (unit.tgl_mulai <= "2019-10-31 00:00:00" and unit.tgl_akhir >= "2019-10-31 00:00:00")');
        $this->db->order_by('map_rm.tgl_mulai' , 'desc');
        return $this->db->get()->result();
    }
    public function getCID(){
        $this->db->from('a_nasabah.cid_test');
        $this->db->order_by("nama", "asc");
        $query = $this->db->get(); 
        return $query->result();
    }
    public function CIDbyID($cid){
        $data = array('cid' => $cid);
        $this->db->where($data);
        $query = $this->db->get('a_nasabah.cid_test', $data);
       if($query->num_rows()>0){
           foreach ($query->result() as $data) {
               $hasil=array(
                   'cid' => $data->cid,
                   'grup' => $data->grup,
                   'flag' => $data->flag,
                   'segmen' => $data->segmen,
               );
           }
       }
       return $hasil; 
    }
    public function getRM(){
        $this->db->select('map_unit.npp as INITIAL_RM,
        rm.nama as RM_NAME,
        map_unit.kode_unit as KODE_DIVISI,
        unit.nama_unit as DIVISI,
        map_unit.tgl_mulai,
        map_unit.tgl_akhir');
        $this->db->from('a_pegawai.mapping_rm_unit_test as map_unit');
        $this->db->join('a_pegawai.p_rm_test as rm', 'rm.npp = map_unit.npp');
        $this->db->join('a_unit.p_unit_test as unit' , 'unit.kode_unit = map_unit.kode_unit');
        $this->db->where('(1=1)
        and (map_unit.tgl_mulai <= "2019-10-31 00:00:00" and map_unit.tgl_akhir >= "2019-10-31 00:00:00")
        and (unit.tgl_mulai <= "2019-10-31 00:00:00" and unit.tgl_akhir >= "2019-10-31 00:00:00")');
        $this->db->order_by('rm.nama', 'asc');
        return $this->db->get()->result();
    }
    public function RMbyID($rm){
        $rmbyid = "CALL a_pegawai.sp_rm_id(?)";
        $data = array('INITIAL_RM' => $rm);
        $query = $this->db->query($rmbyid, $data);
       if($query->num_rows()>0){
           foreach ($query->result() as $data) {
               $hasil=array(
                   'DIVISI' => $data->DIVISI,
               );
           }
       }
       return $hasil; 
    } 
    
    public function save_data($data){
        $this->db->insert('a_nasabah.mapping_cid_npp_test',$data);
    }

    public function get_cif_id($cid, $tgl){
        $getId = "CALL a_nasabah.sp_map_rm_id(?, ?)";
        $nocif = array('map_rm.cid' => $cid, 'tgl_mulai'=> $tgl );
        return $this->db->query($getId, $nocif)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('a_nasabah.mapping_cid_npp_test',$data, $where);
    }
    public function delete_data($where){
        $this->db->where($where);
        $this->db->delete('a_nasabah.mapping_cid_npp_test', $where);
    }
    
 }

?>