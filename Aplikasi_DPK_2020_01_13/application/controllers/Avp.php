<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Avp extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Avp_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              } 
        } 
        public function index(){
			$this->load->view('data/Avp_view');
        }
        public function data_list(){
            $data = $this->Avp_model->getAll();
            echo json_encode($data); 
        }

        public function getRM(){
            $data = $this->Avp_model->getRM();
            echo json_encode($data);
        }
        public function validrm(){
            $npp = $this->input->post('npp');
            $sql = $this->db->query("SELECT npp FROM a_pegawai.p_rm_test where npp='$npp'");
            $cek_npp = $sql->num_rows();
            echo json_encode($cek_npp);
        }
        public function saverm(){
            $data = array(
                'npp' => $this->input->post('npp'),
                'nama' => $this->input->post('namarm'),
            );
            $result = $this->Avp_model->save_rm($data);
            echo json_encode($result);
        }
        
        public function save(){
            $data= array(
                'npp'       => $this->input->post('npp'), 
                'avp'    => $this->input->post('avp'),
                'nama_avp' => $this->input->post('namaavp'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
            $result = $this->Avp_model->save_data($data);
            echo json_encode($result);
        }        
        public function getbyId(){
           $npp = $this->input->post('npp');
           $tgl = $this->input->post('tgl');
           $avp = $this->input->post('avp');
           $getdata = $this->Avp_model->get_npp_id($npp, $tgl, $avp);
           echo json_encode($getdata);
        }
            
        public function edit(){          
            $npp= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $avp= $this->input->post('idavp');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $tgl_waktu = new DateTime($tgl_akhir);
            $tgl_waktu->setTime(23, 59, 59);
            $data= array(
                'npp'    => $this->input->post('npp'),
                'avp'    => $this->input->post('avp'),
                'nama_avp' => $this->input->post('namaavp'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
            );
            $data2= array(
                'npp' => $this->input->post('npp'),
                'nama' => $this->input->post('namarm'),
            );
            $result = $this->Avp_model->edit_data($npp, $tgl, $avp, $data, $data2);
            echo json_encode($result);
        } 
        
        public function delete(){
            $npp = $this->input->post('npp');
            $avp = $this->input->post('avp');
            $tgl = $this->input->post('tgl');
            $result= $this->Avp_model->delete_data($npp, $avp, $tgl);
          }

    }
?>