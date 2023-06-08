<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indonesia');
        $this->load->model("m_login");
    }
	
	public function index()
	{
        $data['title'] = 'Login';
        $data['menu'] = 'login';
        $this->frontpage->view('front/login/index',$data);
	}
    
    public function proses_login(){
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        $this->m_login->proses($username,$password);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
        
    } 
}
