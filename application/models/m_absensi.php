<?php 

class m_absensi extends CI_Model{
    
    public function izin($id_siswa,$tahun,$semester){
        $q = $this->db->query("select * from r_absen as a
                                join m_status_absen as b on b.id_status_absen = a.id_status_absen
                                where a.id_siswa = $id_siswa and a.id_status_absen = 2 and a.id_tahun_ajaran = $tahun and a.semester = $semester")->result_array();
        return count($q);
    }
    
    public function sakit($id_siswa,$tahun,$semester){
        $q = $this->db->query("select * from r_absen as a
                                join m_status_absen as b on b.id_status_absen = a.id_status_absen
                                where a.id_siswa = $id_siswa and a.id_status_absen = 3 and a.id_tahun_ajaran = $tahun and a.semester = $semester")->result_array();
        return count($q);
    }
    
    public function tanpa_keterangan($id_siswa,$tahun,$semester){
        $q = $this->db->query("select * from r_absen as a
                                join m_status_absen as b on b.id_status_absen = a.id_status_absen
                                where a.id_siswa = $id_siswa and a.id_status_absen = 4 and a.id_tahun_ajaran = $tahun and a.semester = $semester")->result_array();
        return count($q);
    }
    
}

?>