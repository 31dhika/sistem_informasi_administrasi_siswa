<br /><br />

<?php 
    if($this->session->userdata('tipe')=='admin'){
        ?>
        <h4>
        Selamat datang <u><?= $this->session->userdata('nama'); ?></u> , <br /><br />
        Silahkan pilih menu untuk mengelola Sistem Infromasi Administrasi Siswa SMPN 195 Jakarta
        </h4>
        <?php
    }elseif($this->session->userdata('tipe')=='guru'){
        ?>
        <h4>
        Selamat datang <u><?= $this->session->userdata('nama'); ?></u> , <br /><br />
        Anda adalah guru mata pelajaran <u><?= $this->session->userdata('nama_mata_pelajaran'); ?></u><br /><br />
        Silahkan pilih menu kesiswaan untuk mengelola nilai siswa SMPN 195 Jakarta
        </h4>
        <?php
    }elseif($this->session->userdata('tipe')=='wali'){
        $id = $this->session->userdata('id_kelas');
        $kelas = $this->db->query("select * from m_kelas where id_kelas = $id")->result_array();
        ?>
        <h4>
        Selamat datang <u><?= $this->session->userdata('nama'); ?></u> , <br /><br />
        Anda adalah wali kelas <u><?= $kelas[0]['nama_kelas']; ?></u> SMPN 195 Jakarta<br /><br />
        Silahkan pilih menu kesiswaan mengelola rapor dan absensi siswa 
        </h4>
        <?php
    }
?>


<hr />
