<?php 

class m_login extends CI_Model{
    
    public function proses($username,$password,$id_tahun){
        
        if($username == "" or $password == ""){
            $this->session->set_flashdata('login_gagal', 'Maaf Login Gagal !!');
            redirect('admin/login/');
        }
        
        $query = $this->db->query("select * from login_admin where username='$username' and password='$password'")->result_array();
        
        if(!empty($query)){
            
            if($query[0]['tipe']=="guru"){// SESSION BUAT GURU //
            
                $id_admin = $query[0]['id_admin'];
                
                $cek_tahun = $this->db->query("select * from r_guru where id_admin = $id_admin and id_tahun_ajaran = $id_tahun")->result_array();
                
                if($cek_tahun == null){
                    $this->session->set_flashdata('account_expired', 'Maaf account anda telah expired !!');
                    redirect('admin/login/');
                }
                
                $mata_pelajaran = $this->db->query("SELECT
                                                        a.id_mata_pelajaran,
                                                        a.nama_mata_pelajaran
                                                        FROM
                                                        m_mata_pelajaran a,
                                                        r_guru b
                                                        WHERE
                                                        a.id_mata_pelajaran = b.id_mata_pelajaran 
                                                        AND
                                                        b.id_admin = $id_admin")->result_array();
                
                $kelas = $this->db->query("select id_kelas from r_guru where id_admin = $id_admin")->result_array();
                
                foreach($kelas as $data){
                    $array_kelas[] = $data['id_kelas'];
                }
                
                $data_session = array(
                            'nama'=>$query[0]['nama'],
                            'id'=>$query[0]['id_admin'],
                            'username'=>$query[0]['username'],
                            'tipe'=>$query[0]['tipe'],
                            'id_mata_pelajaran'=>$mata_pelajaran[0]['id_mata_pelajaran'],
                            'nama_mata_pelajaran'=>$mata_pelajaran[0]['nama_mata_pelajaran'],
                            'id_kelas'=>$array_kelas
                            );
                $this->session->set_userdata($data_session);
                redirect('admin/beranda/');
                
            }elseif($query[0]['tipe']=="wali"){// SESSION BUAT WALI KELAS //
            
                $id_admin = $query[0]['id_admin'];
                
                $cek_tahun = $this->db->query("select * from r_wali_kelas where id_admin = $id_admin and id_tahun_ajaran = $id_tahun")->result_array();
                
                if($cek_tahun == null){
                    $this->session->set_flashdata('account_expired', 'Maaf account anda telah expired !!');
                    redirect('admin/login/');
                }
                
                $kelas = $this->db->query("select id_kelas from r_wali_kelas where id_admin = $id_admin")->result_array();
                
                $data_session = array(
                            'nama'=>$query[0]['nama'],
                            'id'=>$query[0]['id_admin'],
                            'username'=>$query[0]['username'],
                            'tipe'=>$query[0]['tipe'],
                            'id_kelas'=>$kelas[0]['id_kelas']
                            );
                $this->session->set_userdata($data_session);
                redirect('admin/beranda/');
                
            }elseif($query[0]['tipe']=="admin"){// SESSION BUAT ADMIN //
                $data_session = array(
                            'nama'=>$query[0]['nama'],
                            'id'=>$query[0]['id_admin'],
                            'username'=>$query[0]['username'],
                            'tipe'=>$query[0]['tipe']
                            );
                $this->session->set_userdata($data_session);
                redirect('admin/beranda/');
            }
            
         
        }else{
            $this->session->set_flashdata('login_gagal', 'Maaf Login Gagal !!');
            redirect('admin/login/');
        }
    }
    
}

?>