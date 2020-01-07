<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Unit extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Unit_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        } 
        public function index(){
			$this->load->view('data/Unit_view');
        }
        public function data_list(){
            $data = $this->Unit_model->getAll();
            echo json_encode($data); 
        }
        public function getDivisi(){
            $data = $this->Unit_model->getDivisi();
            echo json_encode($data);
        }
        
        public function getRM(){
            $data = $this->Unit_model->getRM();
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
            $result = $this->Unit_model->save_rm($data);
            echo json_encode($result);
        }
        
        public function save(){
            $data= array(
                'npp'       => $this->input->post('npp'), 
                'kode_unit'    => $this->input->post('kode_unit'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
            $result = $this->Unit_model->save_data($data);
            echo json_encode($result);
        }        
        public function getbyId(){
           $npp = $this->input->post('npp');
           $tgl = $this->input->post('tgl');
           $getdata = $this->Unit_model->get_npp_id($npp, $tgl);
           echo json_encode($getdata);
        }
            
        public function edit(){          
            $npp= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $data= array(
                'npp'    => $this->input->post('npp'),
                'kode_unit' => $this->input->post('kode_unit'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
            );
            $data2= array(
                'npp' => $this->input->post('npp'),
                'nama' => $this->input->post('namarm'),
            );
            $result = $this->Unit_model->edit_data($npp, $tgl, $data, $data2);
            echo json_encode($result);
        } 
        
        public function delete(){
            $npp = $this->input->post('id');
            $tgl = $this->input->post('tgl');
            $result= $this->Unit_model->delete_data($npp, $tgl);
          }

    }
?>