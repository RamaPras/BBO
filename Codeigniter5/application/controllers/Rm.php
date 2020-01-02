<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Rm extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Rm_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
            $this->load->view('data/Rm_view');        
        }
        
        public function data_list(){
            $data = $this->Rm_model->getAll();
            echo json_encode($data); 
        }
        public function getCustomer(){
            $data = $this->Rm_model->getCID();
            echo json_encode($data);
        }
        public function getDataCID(){
            $cid= $this->input->post('cid');
            $data = $this->Rm_model->CIDbyID($cid);
            echo json_encode($data);
        }
        public function getRM(){
            $data = $this->Rm_model->getRM();
            echo json_encode($data);
        }
        public function getDataRM(){
            $rm= $this->input->post('rm');
            $data = $this->Rm_model->RMbyID($rm);
            echo json_encode($data);
        }
        public function save(){
            $data= array(
                'cid'    => $this->input->post('cid'),
                'npp'       => $this->input->post('npp'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Rm_model->save_data($data);
        echo json_encode($result);
        }        
        public function getbyId(){
           $cid = $this->input->post('cid');
           $tgl = $this->input->post('tgl');
           $getdata = $this->Rm_model->get_cif_id($cid, $tgl);
           echo json_encode($getdata);
        }
            
        public function edit(){          
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
            $data= array(
                'npp'    => $this->input->post('npp'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                        );
            $result = $this->Rm_model->edit_data($where, $data);
            echo json_encode($result);
        }
        
        public function delete(){
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
            $result= $this->Rm_model->delete_data($where);
          }

    }
?>