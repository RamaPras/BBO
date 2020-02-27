<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class User_Role extends CI_Controller{  
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("User_Role_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
            // if($this->session->userdata('category')==='ADM'){
                $this->load->view('user_role_view');
            // }else{
            //     echo "Access Denied";
            // }
        }
        public function data_list(){
            $data = $this->User_Role_model->getAll();
            echo json_encode($data);
        }

        public function getUser(){
            $data = $this->User_Role_model->dataUser();
            echo json_encode($data);            
        }
        public function getRole(){
            $data = $this->User_Role_model->dataRole();
            echo json_encode($data);            
        }

        public function save(){    
            $data = array(
                'UserID' => $this->input->post('id'),
                'role'   => $this->input->post('role'),
                'Unit'   => $this->input->post('unit'),
            ); 
        $result = $this->User_Role_model->save_data($data);
        echo json_encode($result);
        }

        public function getbyId(){
           $id = $this->input->post('id');
           $role = $this->input->post('role');
           $unit = $this->input->post('unit');
           $getdata = $this->User_Role_model->get_user_id($id, $role, $unit);
           echo json_encode($getdata);
        }

        public function edit(){
            $id= $this->input->post('id');
            $role = $this->input->post('role_upd');
            $unit = $this->input->post('unit_upd');
            $where = array('UserID' => $id, 'role' => $role, 'unit' => $unit) ;
            $update = date('Y-m-d');
            $data = array(
                'UserID' => $this->input->post('user'),
                'role' => $this->input->post('role'),
                'unit' => $this->input->post('unit'), 
                'update' => $update,
                'expiry_date'  => $this->input->post('expire'),
            );
            $result = $this->User_Role_model->edit_data($where, $data);
            echo json_encode($result);
        }
    }
?>