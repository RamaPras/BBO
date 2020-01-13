<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Login extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model('Login_model');
        }
        public function index(){
            $this->load->library('session');

		//restrict users to go back to login if session has been set
		if($this->session->userdata('logged_in') == TRUE){
			redirect('Login/home');
		}
		else{
			$this->load->view('admin/login');
		}
		
        }
        public function check_login(){ 
            $npp = $_POST['npp'];
            $password = MD5($_POST['pwd']); 
            $res= $this->Login_model->isLogin($npp, $password);
            if($res->num_rows() > 0){
                $data  = $res->row_array();
                $user_id  = $data['user_id'];
                $npp = $data['npp'];
                $nama = $data['nama'];
                $password = $data['password'];
                $category = $data['category'];
                $sesdata = array(
                    'user_id'   => $user_id,
                    'npp'       => $npp,
                    'nama'      => $nama,
                    'password'  => $password,
                    'category'  => $category,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($sesdata);
                echo site_url()."Cid/";
            }else {
                echo 0;
            }
        }


        public function logout(){
            $this->session->sess_destroy();
            redirect('Login');
        }

        public function home(){
            $this->load->library('session');
		if($this->session->userdata('logged_in') == TRUE){
			$this->load->view('overview');
		} else{
			redirect('Login');
		    }
        }  
}
?>