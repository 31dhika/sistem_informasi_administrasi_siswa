<?php 

class m_login extends CI_Model{
    
    public function proses($username,$password){
        
        if($username=="" or $password==""){
            $this->session->set_flashdata("login_error","Maaf Login Gagal");
            redirect('login');
        }
        
        $query = $this->db->query("select * from login_siswa where username = '$username' and password = '$password'")->result_array();
        
        if($query==null){
            $this->session->set_flashdata("login_error","Maaf Login Gagal");
            redirect('login');
        }else{
            $this->session->set_userdata("id_siswa",$query[0]['id_siswa']);
            redirect('beranda');
        }
    }
    
}

?>