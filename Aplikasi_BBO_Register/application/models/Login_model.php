<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Login_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function isLogin($npp, $password){
            return $this->db->get_where('bbo_user.admin', array('npp'=>$npp,'password'=>$password, 'status'=> 1));
        }
    }
?>