<?php defined('BASEPATH') OR exit('No direct script access allowed');

    Class Avp_model extends CI_Model {
        
    public function getAll(){
        $this->db->select('rm.npp as INITIAL_RM, 
        rm.nama as RM_NAME,
        map_avp.avp,
        map_avp.nama_avp,
        map_avp.tgl_mulai,
        map_avp.tgl_akhir
        ');
        $this->db->from('a_pegawai.p_rm as rm');
        $this->db->join('a_pegawai.mapping_rm_avp as map_avp' , 'rm.npp = map_avp.npp');
        $this->db->order_by('map_avp.tgl_mulai' , 'desc');
        return $this->db->get()->result();
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
        $this->db->insert('a_pegawai.mapping_rm_avp',$data);
    }

    public function get_npp_id($npp, $tgl, $avp){
        $where = array('rm.npp' => $npp, 'tgl_mulai'=> $tgl, 'map_avp.avp' => $avp );
        $this->db->select('rm.npp as INITIAL_RM,
        rm.nama as RM_NAME,
        map_avp.avp,
        map_avp.nama_avp,
        map_avp.tgl_mulai,
        map_avp.tgl_akhir
        ');
        $this->db->from('a_pegawai.p_rm as rm');
        $this->db->join('a_pegawai.mapping_rm_avp as map_avp' , 'rm.npp = map_avp.npp');
        $this->db->where($where);
        return $this->db->get()->row();
   }

    public function edit_data($npp, $tgl, $avp, $data, $data2){
        $where = array('npp' => $npp, 'tgl_mulai' => $tgl, 'avp' => $avp) ;
        $this->db->where($where);  
        $this->db->update('a_pegawai.mapping_rm_avp',$data, $where);

            $where2 = array('npp' => $npp) ;
            $this->db->where($where2);
            $this->db->update('a_pegawai.p_rm', $data2, $where2);
    }
    public function delete_data($npp, $avp, $tgl){
        $where = array('npp' => $npp, 'tgl_mulai' => $tgl, 'avp' => $avp) ;
        $this->db->where($where);
        $this->db->delete('a_pegawai.mapping_rm_avp', $where);
    }
    
 }

?>