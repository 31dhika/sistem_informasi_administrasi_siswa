<?php 

class m_nilai extends CI_Model{
    
    public function mapel($id_siswa,$id_tahun){
        return $this->db->query("select 
                                *
                                from
                                    r_kelas_siswa as a
                                    left join r_siswa_kelas_paket as b on b.id_kelas = a.id_kelas 
                                    left join r_paket_pelajaran as c on c.id_paket = b.id_paket
                                    left join m_mata_pelajaran as d on d.id_mata_pelajaran = c.id_mata_pelajaran
                                where
                                    a.id_siswa = $id_siswa  and a.id_tahun_ajaran = $id_tahun")->result_array();
    }
    
    public function nilai($id_siswa,$id_kelas,$id_mapel,$id_tahun,$semester,$id_sk){
        return $this->db->query("select
                                a.jenis_kd,
                                b.nilai
                                from kurikulum_kd as a
                                left join r_nilai_siswa as b on b.id_sk = a.id_sk and 
                                                                b.id_kd = a.id_kd and
                                                                b.id_siswa = $id_siswa and
                                                                b.id_kelas = $id_kelas and
                                                                b.id_mapel = $id_mapel and
                                                                b.id_tahun_ajaran = $id_tahun and
                                                                b.semester = $semester
                                where a.id_sk = $id_sk")->result_array();
    }
    
}

?>