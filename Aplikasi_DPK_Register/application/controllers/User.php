<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("User_model");
            $this->load->library("form_validation");
            // if($this->session->userdata('logged_in') !== TRUE){
            //     redirect('login');
            //   }
        }
        public function index(){
            // if($this->session->userdata('category')==='ADM'){
                $this->load->view('user_view');
            // }else{
            //     echo "Access Denied";
            // }
        }
        public function data_list(){
            $data = $this->User_model->getAll();
            echo json_encode($data);
        }

        public function getRole(){
            $data = $this->User_model->dataRole();
            echo json_encode($data);            
        }

        public function validnpp(){
            $npp = $this->input->post('npp');
            $sql = $this->db->query("SELECT NPP FROM bbo_user.user where NPP='$npp'");
            $cek_npp = $sql->num_rows();
            echo json_encode($cek_npp);
        }

        public function save(){
            $hakadm = $this->input->post('HakAdm');
            $adm = 0;
            if($hakadm == 'Aktif'){
                    $adm = 1;
            } else {
                $adm = 0;
            }
            $hakupd = $this->input->post('HakUpd');
            $upd = 0;
            if($hakupd == 'Aktif'){
                    $upd = 1;
            } else {
                $upd = 0;
            } 
            $npp = $this->input->post('npp');
            $id = substr($npp,2);
            $nama = $this->input->post('nama');
            $nama4 = substr($nama,0,4);
            $id3 = substr($id,2);
            $password = $nama4.$id3;
            $date = strtotime('12/31/9999');
            $expire = date('Y-m-d',$date);
            //data yg terdapat pada tabel cid
            $data= array(
                'UserID' => $id,
                'NPP' => $npp,
                'Nama'  => $nama,
                'Password' => MD5($password),
                'Email' => $this->input->post('email'),
                'ParentKtgri' => $this->input->post('kategori'),
                'Ktgri' => $this->input->post('kategori'),
                'SentraCode' => $this->input->post('sc'),
                'HandlingCode' => $this->input->post('hc'),
                'HakAdmin' => $adm,
                'HakUpdate' => $upd,
                'Expire' => $expire,
            );
        $result = $this->User_model->save_data($data);
        echo json_encode($result);
        }

        public function getbyId(){
           $id = $this->input->post('id');
           $getdata = $this->User_model->get_user_id($id);
           echo json_encode($getdata);
        }

        public function edit(){
            // $id= $this->input->post('id');
            // $where = array('user_id' => $id) ;
            // $category = $this->input->post('category');
            // $cat = '';
            // if($category == 'Admin'){
            //         $cat = 'ADM';
            // } else {
            //         $cat = 'USR';
            // }
            // $expire = $this->input->post('expire');
            // $st = 0;
            // if($expire == '9999-12-31'){
            //     $st = 1;
            // } else {
            //     $st = 0;
            // }
            // $npp = $this->input->post('npp');
            // $id = substr($npp,2);
            // $data= array(
            //     'user_id'      => $id,
            //     'npp'          => $npp,
            //     'nama'         => $this->input->post('nama'),
            //     'expire_date'  => $this->input->post('expire'),
            //     'category'     => $cat,
            //     'status'       => $st,
            // );
            // $result = $this->User_model->edit_data($where, $data);
            // echo json_encode($result);
        }

    public function reset_password(){
            // $id= $this->input->post('id');
            // $where = array('user_id' => $id) ;
            // $nama = $this->input->post('nama');
            // $nama4 = substr($nama,0,4);
            // $id3 = substr($id,2);
            // $password = $nama4.$id3;
            // $data = array(
            //     'password' => MD5($password),
            // );
            // $result = $this->User_model->reset_pass($where, $data);
            // echo json_encode($result);
        }

    public function oldpass(){
        // $id = $this->input->post('id');
        // $pass =MD5($this->input->post('oldpass'));
        // $sql = $this->db->query("SELECT user_id FROM dpk_map.user where user_id = '$id' AND password ='$pass'");
        // $cek_npp = $sql->num_rows();
        // echo json_encode($cek_npp);
    }

    public function Change(){
        // $id= $this->input->post('id');
        // $where = array('user_id' => $id);
        // $data = array(
        //     'password' => MD5($this->input->post('newpass')),
        // );
        // $result = $this->User_model->change_pass($where, $data);
        // echo json_encode($result);
    }

    }
?>