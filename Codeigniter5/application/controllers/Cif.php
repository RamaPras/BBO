<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Cif extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Cif_model");
            $this->load->library("form_validation");
            $this->load->library("Datatables");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
			$this->load->view('data/Cif_view'); 
        }
        public function ajax_list()
        {
            $list = $this->Cif_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $customers) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $customers->NO_CIF;
                $row[] = $customers->CUSTOMER_NAME;
                $row[] = $customers->grup;
                $row[] = $customers->DIVISI;
                $row[] = $customers->RM_NAME;
                $row[] =  ' <a href="#formcif" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit('."'".$customers->NO_CIF."'".','."'".$customers->tgl_mulai."'".')"><i class="fas fa-edit"></i> Edit</a> <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="deleteConfirm('."'".$customers->NO_CIF."'".','."'".$customers->tgl_mulai."'".')"><i class="fas fa-trash"></i> Delete</a>';        
                $data[] = $row;
            }
    
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Cif_model->count_all(),
                            "recordsFiltered" => $this->Cif_model->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
        public function getCustomer(){
            $data = $this->Cif_model->getCID();
            echo json_encode($data);
        }
        public function getDataCID(){
            $cid= $this->input->post('cid');
            $data = $this->Cif_model->CIDbyID($cid);
            echo json_encode($data);
        }
        public function save(){ 
            $data= array(
                'no_cif'    => $this->input->post('no_cif'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Cif_model->save_data($data);
        echo json_encode($result);
        }        
        public function getbyId(){  
           $no_cif = $this->input->post('x');
           $tgl = $this->input->post('y');
           $getdata = $this->Cif_model->get_cif_id($no_cif, $tgl);
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
            $result = $this->Cif_model->edit_data($where, $data);
            echo json_encode($result);
        }
        
        public function delete(){
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('no_cif' => $id, 'tgl_mulai' => $tgl) ;
            $result= $this->Cif_model->delete_data($where);
          }

    }
?>