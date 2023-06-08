<!-- LAYOUT NAVIGASI ATAS -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <div class="brand" style="color: white;">SMPN 195 JAKARTA</div>
          
          <!-- MENU NAVIGASI ATAS -->
          <div class="nav-collapse collapse">
            <ul class="nav">
            
            <?php 
                if($this->session->userdata("tipe")=="guru"){
                ?>
                <li class="<?php if($menu == 'beranda'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/beranda/'); ?>"><i class="icon-home"></i> Beranda</a>
                </li>
                <li class="dropdown <?php if($menu == 'nilai' or $menu == 'absensi'){echo 'active';} ?>">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> Kesiswaan <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li class="<?php if($menu == 'nilai'){echo 'active';} ?>"><a href="<?= base_url('admin/nilai'); ?>"><i class="icon-tasks"></i> Nilai</a></li>
                    </ul>
                </li>
                <?php
                }elseif($this->session->userdata("tipe")=="wali"){
                ?>
                <li class="<?php if($menu == 'beranda'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/beranda/'); ?>"><i class="icon-home"></i> Beranda</a>
                </li>
                <li class="dropdown <?php if($menu == 'nilai' or $menu == 'absensi'){echo 'active';} ?>">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> Kesiswaan <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li class="<?php if($menu == 'nilai'){echo 'active';} ?>"><a href="<?= base_url('admin/nilai'); ?>"><i class="icon-tasks"></i> Nilai</a></li>
                        <li class="<?php if($menu == 'absensi'){echo 'active';} ?>"><a href="<?= base_url('admin/absensi'); ?>"><i class="icon-book"></i> Absensi</a></li>
                    </ul>
                </li>
                <?php
                }elseif($this->session->userdata("tipe")=="admin"){
                ?>
                <li class="<?php if($menu == 'beranda'){echo 'active';} ?>">
                <a href="<?php echo base_url('admin/beranda/'); ?>"><i class="icon-home"></i> Beranda</a>
                </li>
                <!--<li class="dropdown <?php if($menu == 'nilai' or $menu == 'absensi'){echo 'active';} ?>">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> Kesiswaan <b class="caret"></b> </a>
                <ul class="dropdown-menu">
                    <li class="<?php if($menu == 'nilai'){echo 'active';} ?>"><a href="<?= base_url('admin/nilai'); ?>"><i class="icon-tasks"></i> Nilai</a></li>
                    <li class="<?php if($menu == 'absensi'){echo 'active';} ?>"><a href="<?= base_url('admin/absensi'); ?>"><i class="icon-book"></i> Absensi</a></li>
                </ul>
                </li> -->
                <li class="dropdown <?php if($menu == 'pelajaran'){echo 'active';} ?>">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-file"></i> Mata Pelajaran <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <li class="<?php if($menu == 'pelajaran'){echo 'active';} ?>"><a href="<?php echo base_url('admin/mata_pelajaran'); ?>">Daftar Mata Pelajaran</a></li>
                  <li class="<?php if($menu == 'paket_pelajaran'){echo 'active';} ?>"><a href="<?php echo base_url('admin/paket_pelajaran'); ?>">Paket Pelajaran</a></li>
                  </ul>
                </li>
                <li class="dropdown <?php if($menu == 'tahun_ajaran' or $menu == 'semester' or $menu == 'siswa' or $menu == 'kelas'){echo 'active';} ?>">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-wrench"></i> Pengaturan <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="<?php if($menu == 'siswa'){echo 'active';} ?>"><a href="<?php echo base_url('admin/siswa/'); ?>">Daftar Siswa</a></li>
                  <li class="<?php if($menu == 'kelas'){echo 'active';} ?>"><a href="<?php echo base_url('admin/kelas/'); ?>">Daftar Kelas</a></li>
                  <li class="<?php if($menu == 'tahun_ajaran'){echo 'active';} ?>"><a href="<?php echo base_url('admin/tahun_ajaran/'); ?>">Tahun Ajaran</a></li>
                  <li class="<?php if($menu == 'semester'){echo 'active';} ?>"><a href="<?php echo base_url('admin/semester/'); ?>">Semester</a></li>
                    </ul>
                </li>
                <?php
                }
            ?>
              
              
              
              </ul>
          </div>
          
          <?php 
            $tahun = $this->db->query("select * from m_tahun_ajaran where status = 1")->result_array();
            $semester = $this->db->query("select * from semester where status = 1")->result_array();
          ?>
          
          <?php 
            if ($tahun==null){
                echo "";
            }else{
              ?><div class="brand" style="color: white; float: right;"><font size="2">Tahun Ajaran : <?= $tahun[0]['tahun_ajaran']; ?> ( <?= $semester[0]['nama_semester']; ?> ) ( Login as : 
              <?= $this->session->userdata('tipe');?> )</font></div><?php  
            }
          ?>
           
          <!-- END MENU NAVIGASI ATAS -->
          
        </div>
      </div>
    </div>
    <!-- END LAYOUT NAVIGASI ATAS -->