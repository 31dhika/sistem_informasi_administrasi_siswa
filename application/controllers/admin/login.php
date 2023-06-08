<?php 
class login extends CI_Controller{
        
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/m_login');
        define('ID_TAHUN',checkTahunAjaranActive());        
    }
    
    public function index(){
        $data['title'] = 'Login Administrator';        
        $this->load->view('admin/login/index',$data);
    }
    
    public function login_proses(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $id_tahun = ID_TAHUN;
        $this->m_login->proses($username,$password,$id_tahun);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/login/');
        
    } 
}
?>