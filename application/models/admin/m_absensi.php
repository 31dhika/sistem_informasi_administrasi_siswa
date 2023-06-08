<?php 

class m_absensi extends CI_Model{
    
    public function kelas($id_kelas){
        return $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
    }
    
    public function siswa($id_kelas,$semester,$tahun_ajaran){
        return $this->db->query("
                                SELECT t1.*,t2.id_status_absen
                                FROM m_siswa t1
                                INNER JOIN r_kelas_siswa t3 ON t1.id_siswa = t3.id_siswa
                                LEFT JOIN (
                                    select * FROM r_absen WHERE id_kelas = $id_kelas AND semester = $semester AND tgl = '".date("Y-m-d")."'
                                ) t2 ON t1.id_siswa = t2.id_siswa
                                WHERE t3.id_kelas = $id_kelas and t3.id_tahun_ajaran = $tahun_ajaran 
                                ORDER BY nama_siswa asc
                                ")->result_array();
    }
    
    public function cek_is_absen($id_kelas,$semester,$tahun_ajaran){
        return $this->db->query("
            select COUNT(*) as count,tgl FROM r_absen WHERE id_kelas = $id_kelas AND tgl = '".date('Y-m-d')."' AND id_tahun_ajaran = $tahun_ajaran AND semester = $semester
        ")->result_array();
    }
    
    public function get_kelas($id_kelas,$tahun_ajaran){
    return $this->db->query("select
                            a.*,b.id_kelas
                            from
                            m_siswa as a
                            join r_kelas_siswa as b on b.id_siswa = a.id_siswa and b.id_kelas = $id_kelas 
                            and id_tahun_ajaran = $tahun_ajaran")->result_array();

}
}

?>