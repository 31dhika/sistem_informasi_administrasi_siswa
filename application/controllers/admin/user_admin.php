<?php 

class user_admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['menu'] = "user_admin";
        $data['title'] = "Akun Admin";
        $data['admin'] = $this->db->query("select * from login_admin where tipe = 'admin'")->result_array();
        $this->template->view('admin/user_admin/index',$data);
    }
    
    public function update_admin(){
        $nama = $this->input->post("nama");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $id = $this->uri->segment(4);
        
        if($username=="" or $password==""){
            ?><script type="text/javascript">window.alert("Field tidak boleh ada yang kosong");history.back();</script><?php
        }
        elseif(strlen($password) <= 5){
            ?><script type="text/javascript">window.alert("Password minimal 6 Karakter");history.back();</script><?php
        }
        else{
            $p = md5($password);
            $this->db->query("update login_admin set nama='$nama',username='$username',password='$p' where id_admin = $id");
            redirect('admin/user_admin');
        }
    }
}

?>