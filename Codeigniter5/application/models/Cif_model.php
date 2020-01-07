<?php defined('BASEPATH') OR exit('No direct script access allowed');

    Class Cif_model extends CI_Model {
        var $column_order = array(null ,'NO_CIF', 'CUSTOMER_ID', 'CUSTOMER_NAME', 'grup','tgl_mulai', 'tgl_akhir'); //set column field database for datatable orderable
	    var $column_search = array('NO_CIF', 'grup', 'grp.nama'); //set column field database for datatable searchable 
	    var $order = array('tgl_mulai' => 'desc'); // default order 
    
        public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    private function _get_datatables_query()
	{	
		//add custom filter here
		
		if($this->input->post('CIF'))
		{
			$this->db->like('NO_CIF', $this->input->post('CIF'));
		}
		if($this->input->post('CUSTOMER_NAME'))
		{
			$this->db->like('grp.nama', $this->input->post('CUSTOMER_NAME'));
		}
		$this->db->select('map_cif.no_cif as NO_CIF,
		grp.cid as CUSTOMER_ID,
		grp.nama as CUSTOMER_NAME,
		grp.grup as grup,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir,
		rm.nama RM_NAME,
		unit.nama_unit DIVISI,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir');
		$this->db->from('a_nasabah.cid_test as grp');
		$this->db->join('a_nasabah.mapping_cid_cif_test as map_cif', 'grp.cid = map_cif.cid');
		$this->db->join('a_nasabah.mapping_cid_npp_test as map_rm', 'map_rm.cid = grp.cid');
         $this->db->join('a_pegawai.mapping_rm_unit_test as map_unit', 'map_unit.npp = map_rm.npp');
         $this->db->join('a_pegawai.p_rm_test as rm', 'rm.npp = map_unit.npp');
         $this->db->join('a_unit.p_unit_test as unit', 'unit.kode_unit = map_unit.kode_unit');
         $this->db->where(
             '(1=1) 
            and (map_cif.tgl_mulai <= sysdate() and map_cif.tgl_akhir >= sysdate())
            and (grp.tgl_mulai <= sysdate() and grp.tgl_akhir >= sysdate())
            and (map_rm.tgl_mulai <= sysdate() and map_rm.tgl_akhir >= sysdate())
            and (map_unit.tgl_mulai <= sysdate() and map_unit.tgl_akhir >= sysdate())
            and (unit.tgl_mulai <= sysdate() and unit.tgl_akhir >= sysdate())'
		 );
		 $this->db->order_by('map_cif.tgl_mulai', 'DESC');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }
        
    public function get_datatables(){
        $this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
    }
    public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->select('map_cif.no_cif as NO_CIF,
		grp.cid as CUSTOMER_ID,
		grp.nama as CUSTOMER_NAME,
		grp.grup as grup,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir,
		rm.nama RM_NAME,
		unit.nama_unit DIVISI,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir');
		$this->db->from('a_nasabah.cid_test as grp');
		$this->db->join('a_nasabah.mapping_cid_cif_test as map_cif', 'grp.cid = map_cif.cid');
		$this->db->join('a_nasabah.mapping_cid_npp_test as map_rm', 'map_rm.cid = grp.cid');
         $this->db->join('a_pegawai.mapping_rm_unit_test as map_unit', 'map_unit.npp = map_rm.npp');
         $this->db->join('a_pegawai.p_rm_test as rm', 'rm.npp = map_unit.npp');
         $this->db->join('a_unit.p_unit_test as unit', 'unit.kode_unit = map_unit.kode_unit');
         $this->db->where(
             '(1=1) 
            and (map_cif.tgl_mulai <= sysdate() and map_cif.tgl_akhir >= sysdate())
            and (grp.tgl_mulai <= sysdate() and grp.tgl_akhir >= sysdate())
            and (map_rm.tgl_mulai <= sysdate() and map_rm.tgl_akhir >= sysdate())
            and (map_unit.tgl_mulai <= sysdate() and map_unit.tgl_akhir >= sysdate())
            and (unit.tgl_mulai <= sysdate() and unit.tgl_akhir >= sysdate())'
		 );		 
		return $this->db->count_all_results();
	}
    public function getCID(){ 
		$this->db->select('grp.cid,
					grp.nama as CUSTOMER_NAME,
					grp.grup as grup,
					grp.flag as flag,
					grp.segmen as segmen,
					rm.nama as RM_NAME,
					unit.nama_unit as DIVISI,
					grp.tgl_mulai,
					grp.tgl_akhir');
		$this->db->from('a_nasabah.cid_test as grp');
		$this->db->join('a_nasabah.mapping_cid_npp_test as map_rm', 'map_rm.cid = grp.cid');
		$this->db->join('a_pegawai.mapping_rm_unit_test as map_unit', 'map_unit.npp = map_rm.npp');
		$this->db->join('a_pegawai.p_rm_test as rm', 'rm.npp = map_unit.npp');
		$this->db->join('a_unit.p_unit_test as unit', 'unit.kode_unit = map_unit.kode_unit');
		$this->db->where(
			'(1=1) 
		   and (grp.tgl_mulai <= "2019-10-31 00:00:00" and grp.tgl_akhir >= "2019-10-31 00:00:00")
		   and (map_rm.tgl_mulai <= "2019-10-31 00:00:00" and map_rm.tgl_akhir >= "2019-10-31 00:00:00")
		   and (map_unit.tgl_mulai <= "2019-10-31 00:00:00" and map_unit.tgl_akhir >= "2019-10-31 00:00:00")
		   and (unit.tgl_mulai <= "2019-10-31 00:00:00" and unit.tgl_akhir >= "2019-10-31 00:00:00")'
		);
		$this->db->order_by('grp.nama', 'asc');
		return $this->db->get()->result();
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
        $this->db->insert('a_nasabah.mapping_cid_cif_test',$data);
    }

    public function get_cif_id($no_cif, $tgl){
        $getId = "CALL a_nasabah.sp_map_cif_id(?, ?)";
        $nocif = array('NO_CIF' => $no_cif, 'tgl_mulai'=> $tgl );
        return $this->db->query($getId, $nocif)->row();
   }

    public function edit_data($where, $data){
        $this->db->where($where);  
        $this->db->update('a_nasabah.mapping_cid_cif_test',$data, $where);
    }
	
	public function delete_data($where){
        $this->db->where($where);
        $this->db->delete('a_nasabah.mapping_cid_cif_test', $where);
    }
	
	public function export()
	{
		$this->db->select('map_cif.no_cif as NO_CIF,
		grp.cid as CUSTOMER_ID,
		grp.nama as CUSTOMER_NAME,
		grp.grup as grup,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir,
		rm.nama RM_NAME,
		unit.nama_unit DIVISI,
		map_cif.tgl_mulai,
		map_cif.tgl_akhir');
		$this->db->from('a_nasabah.cid_test as grp');
		$this->db->join('a_nasabah.mapping_cid_cif_test as map_cif', 'grp.cid = map_cif.cid');
		$this->db->join('a_nasabah.mapping_cid_npp_test as map_rm', 'map_rm.cid = grp.cid');
         $this->db->join('a_pegawai.mapping_rm_unit_test as map_unit', 'map_unit.npp = map_rm.npp');
         $this->db->join('a_pegawai.p_rm_test as rm', 'rm.npp = map_unit.npp');
         $this->db->join('a_unit.p_unit_test as unit', 'unit.kode_unit = map_unit.kode_unit');
         $this->db->where(
             '(1=1) 
            and (map_cif.tgl_mulai <= sysdate() and map_cif.tgl_akhir >= sysdate())
            and (grp.tgl_mulai <= "2019-10-31 00:00:00" and grp.tgl_akhir >= "2019-10-31 00:00:00")
            and (map_rm.tgl_mulai <= "2019-10-31 00:00:00" and map_rm.tgl_akhir >= "2019-10-31 00:00:00")
            and (map_unit.tgl_mulai <= "2019-10-31 00:00:00" and map_unit.tgl_akhir >= "2019-10-31 00:00:00")
            and (unit.tgl_mulai <= "2019-10-31 00:00:00" and unit.tgl_akhir >= "2019-10-31 00:00:00")'
		 );
		 
		return $this->db->get()->result();
	}
	
 }

?>