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
            $segmen = $this->input->post('segmen');
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

            $data2 = array(
                'cid' => $this->input->post('cid'),
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'grup' => $this->input->post('grup'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Cid_model->save_data($data, $data2, $segmen);
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
            $tgl_akhir = $this->input->post('tgl_akhir');
            $tgl_waktu = new DateTime($tgl_akhir);
            $tgl_waktu->setTime(23, 59, 59);
            $where = array('cid' => $id, 'tgl_mulai' => $tgl) ;
            $flag = $this->input->post('flag');
            $nilai = 0;
            $grup = $this->input->post('grup');
            $segmen = $this->input->post('segmen');
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
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
            );
            $no_segmen= array(
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'grup' => $this->input->post('grup'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
            );
            $no_grup= array(
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'segmen' => $this->input->post('segmen'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
            );
            $data2= array(
                'nama'  => $this->input->post('nama'),
                'flag' => $nilai,
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
            );
            $result = $this->Cid_model->edit_data($where, $data, $no_segmen, $no_grup, $data2, $grup, $segmen);
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