<?php 

class m_nilai extends CI_Model{
    
    public function cek_tipe($id_sess,$tipe){
        
        if($tipe=="guru"){//guru
            return $this->db->query("SELECT a.id_kelas, a.nama_kelas
                                            FROM m_kelas a, r_guru b
                                            WHERE a.id_kelas = b.id_kelas
                                            AND b.id_admin =$id_sess")->result_array();
        }elseif($tipe=="wali"){//wali
            return $this->db->query("SELECT a.nama_kelas,b.id_kelas
                                        FROM m_kelas a,r_wali_kelas b
                                        WHERE a.id_kelas = b.id_kelas and b.id_admin = $id_sess")->result_array();
        }
    }
    
    
    
    public function cek_session_kelas($id_tipe,$id_sess_kelas,$id_kelas){
        if($id_tipe=="guru"){
            
            if($id_kelas == ""){
            redirect("admin/nilai");
            }
            
            if(!in_array($id_kelas,$id_sess_kelas)){
                redirect("admin/nilai");
                }
                
        }elseif($id_tipe=="wali"){
            
            if($id_kelas == ""){
            redirect("admin/nilai");
            }
                        
            if($id_kelas!=$id_sess_kelas){
                redirect("admin/nilai");
            }
           
        }    
         
    }
    
    
    
    public function list_nilai_wali($tahun_ajaran,$id_kelas){
        return $this->db->query("
            select * FROM m_siswa t1 
                INNER JOIN r_kelas_siswa t2 
                ON t1.id_siswa = t2.id_siswa 
                WHERE t2.id_tahun_ajaran = $tahun_ajaran and t2.id_kelas = $id_kelas")->result_array();
    }
    
    
    
    public function list_nilai_guru($tahun_ajaran,$id_kelas){
        return $this->db->query("select 
                                    a.id_siswa,
                                    a.nama_siswa
                                from
                                    m_siswa a
                                left join r_kelas_siswa as b on b.id_siswa = a.id_siswa and b.id_tahun_ajaran = $tahun_ajaran
                                where  b.id_kelas = $id_kelas
                                order by a.nama_siswa asc")->result_array();
    }
    
    
    public function validasi_sk($id_mapel,$id_kelas,$id_tahun,$semester,$sk){
        $cek = $this->db->query("select * from kurikulum_sk where id_mapel = $id_mapel and
                                                                    id_kelas = $id_kelas and
                                                                    id_tahun_ajaran = $id_tahun and
                                                                    semester = $semester and
                                                                    jenis_sk = '$sk'")->result_array();
        if($cek != null){
            $this->session->set_flashdata('error_sk', '<div class="alert alert-error">Jenis SK yang anda pilih sudah ada.</div>');
            redirect("admin/nilai/kurikulum_sk"."/".$id_kelas);
        }
    }
    
    public function validasi_kd($id_sk,$jenis_kd,$id_kelas){
        $cek = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk and jenis_kd = '$jenis_kd'")->result_array();
        
        if($cek != null){
            $this->session->set_flashdata('error_kd', '<div class="alert alert-error">Jenis KD yang anda pilih sudah ada.</div>');
            redirect("admin/nilai/kurikulum_kd"."/".$id_sk."/".$id_kelas);
        }
    }
    
    public function cek_nilai($nilai,$id_kelas,$id_siswa,$id_sk,$id_kd,$id_mapel,$id_tahun,$semester){
        
                                                              
        if($id_kd==""){
            $this->session->set_flashdata("error_kd",'<div class="alert alert-error">Jenis KD tidak ada / belum di-set </div>');
            redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
        }
        elseif($nilai==""){
            $this->session->set_flashdata("error_null",'<div class="alert alert-error">Nilai tidak boleh kosong</div>');
            redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
        }
        elseif(!is_numeric($nilai)){
            $this->session->set_flashdata("error_format",'<div class="alert alert-error">Format nilai salah</div>');
            redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
        }
        elseif(strlen($nilai)==3){
            if($nilai!=100){
                $this->session->set_flashdata("error_lenght",'<div class="alert alert-error">Nilai tidak boleh lebih dari 100</div>');
                redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
            }
        }
        
        $cek = $this->db->query("select * from r_nilai_siswa where id_sk = $id_sk 
                                                                and id_kd = $id_kd 
                                                                and id_siswa = $id_siswa 
                                                                and id_kelas = $id_kelas 
                                                                and id_mapel = $id_mapel 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester")->result_array();
        
        if($cek!=null){
            $this->session->set_flashdata("error_nilai",'<div class="alert alert-error">Nilai yang anda masukan sudah ada.</div>');
            redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
        } 
        
    }
    
    public function nilai_kd($id_sk,$id_siswa,$id_kelas,$id_mapel,$id_tahun,$semester){
          return $this->db->query("select
                                *
                                from
                                kurikulum_sk as a
                                join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                c.id_kd = b.id_kd and
                                                                c.id_siswa = $id_siswa and
                                                                c.id_kelas = $id_kelas and
                                                                c.id_mapel = $id_mapel and
                                                                c.id_tahun_ajaran = $id_tahun and
                                                                c.semester = $semester")->result_array();
    }
    
}
?>