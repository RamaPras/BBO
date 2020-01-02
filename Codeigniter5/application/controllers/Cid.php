<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Cid extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Cid_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
                $this->load->view('data/Cid_view');
        }
        public function data_list(){
            $data = $this->Cid_model->getAll();
            echo json_encode($data); 
        }
        public function getcid(){
            $getdata = $this->Cid_model->getcid();
            echo json_encode($getdata);  
        }
        public function save(){
            $flag = $this->input->post('flag');
            $nilai = 0;
            if($flag == 'Tidak'){
                    $nilai = 0;
            } else {
                $nilai = 1;
            }
            //data yg terdapat pada tabel cid
            $data= array(
                'cid' => $this->input->post('cid'),
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'grup' => $this->input->post('grup'),
                'segmen' => $this->input->post('segmen'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Cid_model->save_data($data);
        echo json_encode($result);
        }        

        public function getbyId(){
           $cid = $this->input->post('cid');
           $tgl = $this->input->post('tgl');
           $getdata = $this->Cid_model->get_cid_id($cid, $tgl);
           echo json_encode($getdata);
        }

        // public function tgl_akhir(){
        //     $id= $this->input->post('id');
        //     $tgl= $this->input->post('tgl');
        //     $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
        //     $data= array(
        //         'tgl_akhir' => $this->input->post('tgl_akhir'),
        //                 );
        //     $result = $this->Cid_model->tgl_akhir($where, $data);
        //     echo json_encode($result);
        // }
            
        public function edit(){          
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
            $flag = $this->input->post('flag');
            $nilai = 0;
            if($flag == 'Tidak'){
                    $nilai = 0;
            } else {
                $nilai = 1;
            }
            $data= array(
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'grup' => $this->input->post('grup'),
                'segmen' => $this->input->post('segmen'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                        );
            $result = $this->Cid_model->edit_data($where, $data);
            echo json_encode($result);
        }
        
        public function delete(){
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
            $result= $this->Cid_model->delete_data($where);
          }

    }
?>