<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Data extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Data_model");
            $this->load->library("form_validation");
        }
        public function index(){
            $this->load->view("data/cif");
        }
        public function data_list(){
            $data = $this->Data_model->getAll();
            echo json_encode($data); 
        }
        public function getCustomer(){
            $data = $this->Data_model->getCID();
            echo json_encode($data);
        }
        public function getDataCID(){
            $cid= $this->input->post('cid');
            $data = $this->Data_model->CIDbyID($cid);
            echo json_encode($data);
        }
        public function save(){
            $data= array(
                'no_cif'    => $this->input->post('no_cif'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Data_model->save_data($data);
        echo json_encode($result);
        }        
        public function getbyId(){
           $no_cif = $this->input->post('no_cif');
           $tgl = $this->input->post('tgl');
           $getdata = $this->Data_model->get_cif_id($no_cif, $tgl);
           echo json_encode($getdata);
        }
            
        public function edit(){          
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('no_cif' => $id, 'tgl_mulai' => $tgl) ;
            $data= array(
                'no_cif'    => $this->input->post('no_cif'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                        );
            $result = $this->Data_model->edit_data($where, $data);
            echo json_encode($result);
        }
        
        public function delete(){
            $no_cif = $this->input->post('id');
            $where = array('no_cif' => $no_cif);
            $result= $this->Data_model->delete_data($where);
          }

    }
?>