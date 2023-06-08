<?php 
class beranda extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
    }
    
    public function index(){
        $data['title'] = 'Beranda';
        $data['menu'] = 'beranda';
        $this->template->view('admin/beranda/index',$data);
        
    }
    
    
}
?>