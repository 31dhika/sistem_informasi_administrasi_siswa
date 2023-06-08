<?php 

class m_siswa extends CI_Model{
    
    public function proses_add($nis,
                                $nama_siswa,
                                $tempat_lahir,
                                $tanggal_lahir,
                                $jenis_kelamin,
                                $agama,
                                $alamat,
                                $nama_ayah,
                                $nama_ibu,
                                $alamat_ayah,
                                $alamat_ibu,
                                $no_tlp_ayah,
                                $no_tlp_ibu,
                                $status_perwalian){
        
        $cek = $this->db->query("select * from m_siswa where nis = '$nis'")->result_array();
                                    
        if ( $nis == "" or 
             $nama_siswa == "" or 
             $tempat_lahir == "" or
             $tanggal_lahir == "" or
             $jenis_kelamin == "" or
             $agama == "" or
             $alamat == "" or
             $nama_ayah == "" or
             $nama_ibu == "" or
             $alamat_ayah == "" or
             $alamat_ibu == "" or
             $no_tlp_ayah == "" or
             $no_tlp_ibu == "" or
             $status_perwalian == ""){
             ?>
             <script type="text/javascript">alert("Field Tidak Boleh Ada yang Kosong !!");history.go(-1);</script>
             <?php
        }elseif($cek!=null){
             ?>
             <script type="text/javascript">alert("NIS yang anda masukan sudah ada");history.go(-1);</script>
             <?php
        } else {
            $config['upload_path'] = './images/siswa';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['max_size']	= '100000';
    		$config['max_width']  = '10000';
    		$config['max_height']  = '10000';
    
    		$this->load->library('upload', $config);
            $this->upload->do_upload();
            
            $data = $this->upload->data();
            $photo = $data['file_name'];
           
            
            $table_siswa = array(
                                'id_siswa' => '',
                                'nis' => $nis,
                                'nama_siswa' => $nama_siswa,
                                'tempat_lahir' => $tempat_lahir,
                                'tgl_lahir' => date("Y-m-d",strtotime($tanggal_lahir)),
                                'jenis_kelamin' => $jenis_kelamin,
                                'agama' => $agama,
                                'alamat' => $alamat,
                                'photo' => $photo
                                );
            
            $this->db->insert('m_siswa',$table_siswa);
            $id_siswa = $this->db->insert_id();
            
            $table_ortu = array(
                                'id_ortu' => '',
                                'nama_ayah' => $nama_ayah,
                                'nama_ibu' => $nama_ibu,
                                'alamat_ayah' => $alamat_ayah,
                                'alamat_ibu' => $alamat_ibu,
                                'no_tlp_ayah' => $no_tlp_ayah,
                                'no_tlp_ibu' => $no_tlp_ibu,
                                'status_perwalian' => $status_perwalian,
                                'id_siswa' => $id_siswa
                                );
                                
            $this->db->insert('m_orang_tua',$table_ortu);
            ?><script type="text/javascript">alert("Data Siswa Berhasi di Tambah !!");window.location="<?= base_url("admin/siswa"); ?>";</script><?php
        }
    }

    public function ubah_siswa($nis,
                                $nama_siswa,
                                $tempat_lahir,
                                $tanggal_lahir,
                                $jenis_kelamin,
                                $agama,
                                $alamat,
                                $nama_ayah,
                                $nama_ibu,
                                $alamat_ayah,
                                $alamat_ibu,
                                $no_tlp_ayah,
                                $no_tlp_ibu,
                                $status_perwalian){
        
        $cek = $this->db->query("select * from m_siswa where nis = '$nis'")->result_array();
                                    
        if ( $nis == "" or 
             $nama_siswa == "" or 
             $tempat_lahir == "" or
             $tanggal_lahir == "" or
             $jenis_kelamin == "" or
             $agama == "" or
             $alamat == "" or
             $nama_ayah == "" or
             $nama_ibu == "" or
             $alamat_ayah == "" or
             $alamat_ibu == "" or
             $no_tlp_ayah == "" or
             $no_tlp_ibu == "" or
             $status_perwalian == ""){
             ?>
             <script type="text/javascript">alert("Field Tidak Boleh Ada yang Kosong !!");history.go(-1);</script>
             <?php
        }elseif($cek!=null){
             ?>
             <script type="text/javascript">alert("NIS yang anda masukan sudah ada");history.go(-1);</script>
             <?php
        } else {
            $config['upload_path'] = './images/siswa';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['max_size']	= '100000';
    		$config['max_width']  = '10000';
    		$config['max_height']  = '10000';
    
    		$this->load->library('upload', $config);
            $this->upload->do_upload();
            
            $data = $this->upload->data();
            $photo = $data['file_name'];
           
            
            $table_siswa = array(
                                'id_siswa' => '',
                                'nis' => $nis,
                                'nama_siswa' => $nama_siswa,
                                'tempat_lahir' => $tempat_lahir,
                                'tgl_lahir' => date("Y-m-d",strtotime($tanggal_lahir)),
                                'jenis_kelamin' => $jenis_kelamin,
                                'agama' => $agama,
                                'alamat' => $alamat,
                                'photo' => $photo
                                );
            
            $this->db->insert('m_siswa',$table_siswa);
            $id_siswa = $this->db->insert_id();
            
            $table_ortu = array(
                                'id_ortu' => '',
                                'nama_ayah' => $nama_ayah,
                                'nama_ibu' => $nama_ibu,
                                'alamat_ayah' => $alamat_ayah,
                                'alamat_ibu' => $alamat_ibu,
                                'no_tlp_ayah' => $no_tlp_ayah,
                                'no_tlp_ibu' => $no_tlp_ibu,
                                'status_perwalian' => $status_perwalian,
                                'id_siswa' => $id_siswa
                                );
                                
            $this->db->insert('m_orang_tua',$table_ortu);
            ?><script type="text/javascript">alert("Data Siswa Berhasi di Tambah !!");window.location="<?= base_url("admin/siswa"); ?>";</script><?php
        }
    }
    
    public function delete_siswa($id){
        $this->db->query("delete from m_siswa where id_siswa = $id");
        $this->db->query("delete from m_orang_tua where id_siswa = $id");
        $this->db->query("delete from r_kelas_siswa where id_siswa = $id");
        $this->db->query("delete from r_nilai_siswa where id_siswa = $id");
        $this->db->query("delete from r_absen where id_siswa = $id");
    }
    
}

?>