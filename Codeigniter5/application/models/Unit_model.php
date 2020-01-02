<?php defined('BASEPATH') OR exit('No direct script access allowed');

    Class Unit_model extends CI_Model {
        //private $table = "CALL a_pegawai.sp_map_npp";

    public function getAll(){
        $this->db->select('map_unit.npp as INITIAL_RM,
        rm.nama as RM_NAME,
        map_unit.kode_unit as KODE_DIVISI,
        unit.nama_unit as DIVISI,
        map_unit.tgl_mulai,
        map_unit.tgl_akhir
        ');
        $this->db->from('a_pegawai.p_rm as rm');
        $this->db->join('a_pegawai.mapping_rm_unit as map_unit' , 'rm.npp = map_unit.npp');
        $this->db->join('a_unit.p_unit as unit' , 'unit.kode_unit = map_unit.kode_unit');
        $this->db->where('(1=1)
        and (map_unit.tgl_mulai <= sysdate() and map_unit.tgl_akhir >= sysdate())
        and (unit.tgl_mulai <= "2019-10-31 00:00:00" and unit.tgl_akhir >= "2019-10-31 00:00:00")');
        $this->db->order_by('map_unit.tgl_mulai' , 'desc');
        return $this->db->get()->result();
    } 
    public function getDivisi(){
        $this->db->from('a_unit.p_unit');
        $this->db->order_by("nama_unit", "asc");
        $query = $this->db->get(); 
        return $query->result();
    }
      public function getRM(){
        $this->db->from('a_pegawai.p_rm');
        $this->db->order_by("nama", "asc");
        $query = $this->db->get(); 
        return $query->result();
    }
    public function save_rm($data){
        $this->db->insert('a_pegawai.p_rm',$data);
    }
    
    public function save_data($data){
        $this->db->insert('a_pegawai.mapping_rm_unit',$data);
    }

    public function get_npp_id($npp, $tgl){
        $getId = "CALL a_pegawai.sp_map_npp_id(?, ?)";
        $npp = array('map_unit.npp' => $npp, 'tgl_mulai'=> $tgl );
        return $this->db->query($getId, $npp)->row();
   }

    public function edit_data($npp, $tgl, $data, $data2 ){
        $where = array('npp' => $npp, 'tgl_mulai' => $tgl) ;
        $this->db->where($where);  
        $this->db->update('a_pegawai.mapping_rm_unit',$data, $where);

            $where2 = array('npp' => $npp) ;
            $this->db->where($where2);
            $this->db->update('a_pegawai.p_rm', $data2, $where2);
    }
    public function delete_data($npp, $tgl){
        $where = array('npp' => $npp, 'tgl_mulai' => $tgl);
        $this->db->where($where);
        $this->db->delete('a_pegawai.mapping_rm_unit', $where);
    }
    
 }

?>