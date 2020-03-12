<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller{ 
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->model("User_model");
            $this->load->library("form_validation");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
            if($this->session->userdata('category')==='ADM'){
                $this->load->view('user_view');
            }else{
                $this->load->view('errors/error_404');
            }
        }
        public function Email(){
            if($this->session->userdata('category')==='ADM'){
                $this->load->view('Email_view');
            }else{
                $this->load->view('errors/error_404');
            }
        }
        public function send_email(){
            $from_email = $this->input->post('myemail');
            $from_name = $this->input->post('myname'); 
            $to_email = $this->input->post('email');
            $cc = $this->input->post('cc');
            $bcc = $this->input->post('bcc');
            $subjek = $this->input->post('subjek');
            $pesan = $this->input->post('pesan'); 
        
            $config = Array(
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => $from_email,  // Email gmail
                'smtp_pass'   => 'Ramadhan12',  // Password gmail
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
        );

            $this->load->library('email', $config);   

         $this->email->from($from_email, $from_name); 
         $this->email->to($to_email);
         $this->email->subject($subjek); 
         $this->email->message($pesan); 
            if($this->email->send()){
                echo 'Sukses! email berhasil dikirim.';
            }else {
                echo 'Gagal! email tidak dapat dikirim.';
     } 

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
            $sts = 1;
            $npp = $this->input->post('npp');
            $id = substr($npp,2);
            $nama = $this->input->post('nama');
            $password = 'BNI46';
            //data yg terdapat pada tabel cid
            $data= array(
                'UserID'        => $id,
                'NPP'           => $npp,
                'Nama'          => $nama,
                'Password'      => MD5($password),
                'Email'         => $this->input->post('email'),
                'ParentKtgri'   => $this->input->post('kategori'),
                'Ktgri'         => $this->input->post('kategori'),
                'SentraCode'    => $this->input->post('sc'),
                'HandlingCode'  => $this->input->post('hc'),
                'HakAdmin'      => 0,
                'HakUpdate'      => 0,
                'Statusnya'     => $sts,
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
            $id= $this->input->post('id');
            $where = array('UserID' => $id) ;
            $expire = $this->input->post('expire');
            $status = $this->input->post('status');
            if($status == 'Aktif'){
                $st = 1; 
            } else {
                $st = 0;
            }
            $update = date('Y-m-d');
            $npp = $this->input->post('npp');
            $id = substr($npp,2);
            $data= array(
                'UserID'       => $id,
                'NPP'          => $npp,
                'Nama'         => $this->input->post('nama'),
                'Email'        => $this->input->post('email'),
                'ParentKtgri'  => $this->input->post('kategori'),
                'Ktgri'        => $this->input->post('kategori'),
                'SentraCode'   => $this->input->post('sc'),
                'HandlingCode' => $this->input->post('hc'),
                'Statusnya'    => $st,
                'Update'       => $update,
                'Expire'       => $expire,
            );
            $result = $this->User_model->edit_data($where, $data);
            echo json_encode($result);
        }

    }
?>