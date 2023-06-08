<?php 
class semester extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
    }
    
    public function index(){
        $data['title'] = 'Semester';
        $data['menu'] = 'semester';
        $data['semester'] = $this->db->get('semester')->result_array();
        $this->template->view('admin/semester/index',$data);
        
    }
    
    public function aktif(){
        $this->db->query("update semester set status = 0");
        $id = $this->uri->segment(4);
        $this->db->query("update semester set status = 1 where id = $id");
        redirect('admin/semester/');
    }
    
    
}
?>