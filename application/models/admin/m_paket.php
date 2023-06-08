<?php

class m_paket extends CI_Model{
    public function daftar_pelajaran($id){
        return $this->db->query("select * from m_mata_pelajaran where id_mata_pelajaran NOT IN(
                                select id_mata_pelajaran from r_paket_pelajaran where id_paket = $id
                            )")->result_array();
        
    }
    
    public function view($id){
        return $this->db->query("select
                                    a.nama_mata_pelajaran,
                                    b.*
                                from
                                    m_mata_pelajaran a
                                left join r_paket_pelajaran as b on b.id_mata_pelajaran = a.id_mata_pelajaran and id_paket = $id
                                where a.id_mata_pelajaran IN(
                                                            select id_mata_pelajaran from r_paket_pelajaran where id_paket = $id
                                 )")->result_array();
    }
}

 ?>