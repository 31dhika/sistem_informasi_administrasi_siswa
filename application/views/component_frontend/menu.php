<div class="menu">
    <!-- INI MENU UTAMANYA -->
   <div id='cssmenu'>
    <ul>
        <?php 
            if(!$this->session->userdata("id_siswa")){
                ?>
                <li class='<?= ($menu=='login')? 'active': ''; ?>'><a href='<?= base_url(); ?>'><span>Login</span></a></li>
                <li class='<?= ($menu=='aktifasi')? 'active': ''; ?>'><a href='<?= base_url('aktifasi'); ?>'><span>Aktifasi</span></a></li>
                <?php
            }else{
                ?>
                <li class='<?= ($menu=='beranda')? 'active': ''; ?>'><a href='<?= base_url('beranda'); ?>'><span>Beranda</span></a></li>
                <li class='<?= ($menu=='nilai')? 'active': ''; ?>'><a href='<?= base_url('nilai'); ?>'><span>Nilai</span></a></li>
                <li class='<?= ($menu=='absensi')? 'active': ''; ?>'><a href='<?= base_url('absensi'); ?>'><span>Absensi</span></a></li>
                <li><a href='<?= base_url('login/logout'); ?>'><span>Keluar</span></a></li>
                <?php
            }
        ?>
       </ul>
    </div>
    <!-- END INI MENU UTAMANYA -->
    
    </div>
    
    
    <br style="margin-top: -10px;" />
    <!-- <div class="tag_line"><marquee onmouseover="this.stop()" onmouseout="this.start()" scrolldelay="150" scrollamount="6">dummy text of the printing and typesetting industry. Lorem dummy text of the printing and typesetting industry. Lorem dummy text of the printing and typesetting industry. Lorem </marquee></div> -->
    