<?php 

class m_kelas extends CI_Model{
    
    
    public function index_kelas($id_tahun){
        return  $this->db->query("
                        select m_kelas.*,login_admin.* from m_kelas 
                        LEFT JOIN r_wali_kelas on m_kelas.id_kelas = r_wali_kelas.id_kelas
                        LEFT JOIN login_admin on r_wali_kelas.id_admin = login_admin.id_admin and id_tahun_ajaran = '$id_tahun'
                        ")->result_array();
    }
    
    public function update_kelas($id,$kelas){
        if ($kelas == ""){
                ?><script type="text/javascript">alert("Field Tidak Boleh Ada yang Kosong !!");window.location="index";</script><?php
            }else{
               $this->db->query("update m_kelas set nama_kelas = '$kelas' where id_kelas = $id");
               redirect('admin/kelas/'); 
            }
    }
    
    public function list_form_wali(){
        return $this->db->query("select * from login_admin where tipe = 'wali' and id_admin not in (select id_admin from r_wali_kelas)")->result_array();
    }
    
    public function view_siswa($id_kelas,$id_tahun){
       return $this->db->query("
                                select * from m_siswa WHERE id_siswa  IN 
                                (   
                                    select id_siswa FROM r_kelas_siswa 
                                    WHERE m_siswa.id_siswa = r_kelas_siswa.id_siswa
                                    AND r_kelas_siswa.id_kelas = $id_kelas AND id_tahun_ajaran=$id_tahun
                                )
                                ")->result_array();
    }
}

?>