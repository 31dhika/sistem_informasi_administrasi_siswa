<?php 

class m_aktifasi_siswa extends CI_Model{
    
    public function get_id_siswa($nis,$tanggal){
        $cek = $this->db->query("
                                select * from m_siswa where nis = '$nis' and tgl_lahir = '$tanggal'")->result_array();
        
        if($cek==null){
            $this->session->set_flashdata("error_data_siswa","Data yang anda masukan salah");
            redirect("aktifasi");
        }else{
            $cek_valid = $this->db->query("
                                select * from m_siswa where nis = '$nis' and tgl_lahir = '$tanggal' and id_siswa in(
                                select id_siswa from login_siswa
                                )
                                ")->result_array();
            if($cek_valid!=null){
                $this->session->set_flashdata("error_acc_siswa","Data yang anda masukan sudah memiliki akun");
                redirect("aktifasi");
            }else{
                return $cek[0]['id_siswa'];
            }
        }
    }
    
    public function create_account($id_siswa,$username,$pass_1,$pass_2){
        
        if($id_siswa==""){redirect("login");}
        
        $cek = $this->db->query("select * from login_siswa where username = '$username'")->result_array();
        
        if($username=="" or $pass_1=="" or $pass_2==""){
            $this->session->set_flashdata("error_field","Field tidak boleh ada yang kosong");
            $data['title'] = 'Aktifasi';
            $data['menu'] = 'aktifasi';
            $data['id_siswa'] = $id_siswa;
            redirect("aktifasi/form_2"."/".$id_siswa);
        }
        elseif($cek!=null){
            $this->session->set_flashdata("error_account_siswa","Maaf username sudah ada");
            $data['title'] = 'Aktifasi';
            $data['menu'] = 'aktifasi';
            $data['id_siswa'] = $id_siswa;
            redirect("aktifasi/form_2"."/".$id_siswa);
        }
        elseif($pass_1!=$pass_2){
            $this->session->set_flashdata("error_pass_siswa","Maaf password yang anda masukan tidak sama");
            $data['title'] = 'Aktifasi';
            $data['menu'] = 'aktifasi';
            $data['id_siswa'] = $id_siswa;
            redirect("aktifasi/form_2"."/".$id_siswa); 
        }
        elseif(strlen($pass_1)<=5){
            $this->session->set_flashdata("error_pass_karakter","Maaf password minimal 6 karakter");
            $data['title'] = 'Aktifasi';
            $data['menu'] = 'aktifasi';
            $data['id_siswa'] = $id_siswa;
            redirect("aktifasi/form_2"."/".$id_siswa); 
        }
        else{
            $created = date("Y-m-d H:m:s");
            $password = md5($pass_1);
            $this->db->query("insert into login_siswa (id_login_siswa,id_siswa,username,password,created)
                                            values ('','$id_siswa','$username','$password','$created')
                                            ");
            $data['title'] = 'Aktifasi';
            $data['menu'] = 'aktifasi';
            $data['username'] = $username;
            $data['password'] = $pass_1;
            $data['created'] = $created;
            $this->frontpage->view('front/aktifasi/success',$data);
        }
        
    }
    
}

?>