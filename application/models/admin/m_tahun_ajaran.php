<?php

class m_tahun_ajaran extends CI_Model{
    
    public function insert_tahun_ajaran(){
        
        $cek_table = $this->db->query("select * from m_tahun_ajaran")->result_array();
        
        if($cek_table==null){
            
            $tahun = date("Y");
            $tahun_ajaran = $tahun." / ".($tahun+1);
            $table_tahun_ajaran = array(
                                'id_tahun_ajaran' => '',
                                'tahun_ajaran' => $tahun_ajaran,
                                'status' => 1,
                                'tahun' => $tahun
                                );
            $this->db->insert('m_tahun_ajaran',$table_tahun_ajaran);
            
        }else{
            
            $cek_tahun = $this->db->query("SELECT MAX(tahun) as cek from m_tahun_ajaran")->result_array();
            $tahun = $cek_tahun[0]['cek'] + 1;
            $tahun_ajaran = $tahun." / ".($tahun+1);
            $table_tahun_ajaran = array(
                                'id_tahun_ajaran' => '',
                                'tahun_ajaran' => $tahun_ajaran,
                                'status' => 0,
                                'tahun' => $tahun
                                );
            $this->db->insert('m_tahun_ajaran',$table_tahun_ajaran);
        }
    }
    
    
    public function cek_status_aktif($id){
        
        $cek_tahun_ajaran = $this->db->query("select * from m_tahun_ajaran WHERE id_tahun_ajaran=$id")->result_array();
        if($cek_tahun_ajaran[0]['status'] == 0){
            ?><script type="text/javascript">alert("Status belum di Aktifkan !!");history.go(-1);</script><?php
        }
        
    }
    
    public function select_siswa($id_tahun,$id_kelas){
        
        $queryActive = $this->db->query("select * from m_tahun_ajaran WHERE status = 1")->result_array();    
        $queryMinYear = $this->db->query("select MIN(tahun) as years from m_tahun_ajaran")->result_array();    
        
        if($queryMinYear[0]['years'] == $queryActive[0]['tahun']){ // ini untuk tahun ajaran yang baru dibuat //
              return $this->db->query("
                                    select * from m_siswa WHERE id_siswa 
                                    NOT IN (
                                                select id_siswa FROM r_kelas_siswa 
                                                WHERE id_tahun_ajaran = $id_tahun 
                                             )
                                    ")->result_array();
            
        } else {
            
            $query = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
            
            $getActiveTahun = $this->db->query("select * from m_tahun_ajaran WHERE id_tahun_ajaran=$id_tahun AND status = 1")->result_array();
            $tahunSebelumnya = $getActiveTahun[0]['tahun']-1;
            $getTahunAjaranSebelumna = $this->db->query("select * from m_tahun_ajaran WHERE tahun=$tahunSebelumnya")->result_array();
            $idTahunSebelumnya = $getTahunAjaranSebelumna[0]['id_tahun_ajaran'];
            
            if($query[0]['status'] == 1){ //kelas 1 baru dan ajaran baru diambil siswa yg belum punya kelas //
                return $this->db->query("
                    select * from m_siswa WHERE id_siswa 
                        NOT IN (
                                select id_siswa FROM r_kelas_siswa 
                                )
                ")->result_array();
                
            } elseif($query[0]['status'] == 2){ // daftar siswa kelas 2 diambil dari kelas 1 sebelumnya
            
                $q1 = $this->db->query("
                                        select * from m_siswa WHERE id_siswa 
                                            IN (
                                                select id_siswa FROM r_kelas_siswa WHERE id_tahun_ajaran = $idTahunSebelumnya
                                                AND status = 1 AND id_siswa 
                                                        NOT IN(
                                                                select id_siswa FROM r_kelas_siswa WHERE id_tahun_ajaran = $id_tahun AND status = 2
                                                            )
                                               )
                                        ")->result_array();     
                
                $mergeArray = array();
                
                foreach($q1 as $value1){
                    $mergeArray[] = array(
                                            'id_siswa'=>$value1['id_siswa'],
                                            'nis'=>$value1['nis'],
                                            'nama_siswa'=>$value1['nama_siswa'],
                                            'jenis_kelamin'=>$value1['jenis_kelamin'],
                                         );
                }
                
                $q2 = $this->db->query("
                                        select * from m_siswa WHERE id_siswa 
                                        NOT IN (
                                                select id_siswa FROM r_kelas_siswa 
                                               )
                                        ")->result_array(); // query untuk mengambil siswa yang belum punya kelas //
                
                foreach($q2 as $value2){
                    $mergeArray[] = array(
                                            'id_siswa'=>$value2['id_siswa'],
                                            'nis'=>$value2['nis'],
                                            'nama_siswa'=>$value2['nama_siswa'],
                                            'jenis_kelamin'=>$value2['jenis_kelamin'],
                                        );
                }
                
                return $mergeArray; 
                
            }elseif($query[0]['status'] == 3){ // daftar siswa kelas 3 diambil dari kelas 2 sebelumnya
                
                $q1 = $this->db->query("
                                        select * from m_siswa WHERE id_siswa 
                                        IN (
                                            select id_siswa FROM r_kelas_siswa WHERE id_tahun_ajaran = $idTahunSebelumnya
                                            AND status = 2 AND id_siswa 
                                                NOT IN(
                                                    select id_siswa FROM r_kelas_siswa WHERE id_tahun_ajaran = $id_tahun AND status = 3
                                                )
                                           )
                                        ")->result_array();
                                        
                $mergeArray = array(); 
                
                foreach($q1 as $value1){
                    $mergeArray[] = array(
                        'id_siswa'=>$value1['id_siswa'],
                        'nis'=>$value1['nis'],
                        'nama_siswa'=>$value1['nama_siswa'],
                        'jenis_kelamin'=>$value1['jenis_kelamin'],
                    );
                }
                
                $q2 = $this->db->query("
                                        select * from m_siswa WHERE id_siswa 
                                        NOT IN (
                                                select id_siswa FROM r_kelas_siswa 
                                                )
                                        ")->result_array(); 
                
                foreach($q2 as $value2){
                    $mergeArray[] = array(
                        'id_siswa'=>$value2['id_siswa'],
                        'nis'=>$value2['nis'],
                        'nama_siswa'=>$value2['nama_siswa'],
                        'jenis_kelamin'=>$value2['jenis_kelamin'],
                    );
                }
                
                return $mergeArray; 
            }
        }
    }
    
    
}

?> 