  <style>
    /* LESS CSS */
    .dropdown-menu.right {
    left:auto;
    right:0;
    &::before {left:auto !important; right:9px;}
    &::after {left:auto !important; right:10px;}
    }
    </style>

    <ul class="nav nav-list bs-docs-sidenav">
    <?php if($this->session->userdata("tipe")=="admin"){?>
                <li class="dropdown <?php echo ($menu == 'user_guru' or $menu == 'user_admin' or $menu == 'user_siswa' or $menu == 'user_wali') ? "active" : "" ; ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Kelola Akun</a></a>
                        <ul class="dropdown-menu right">
                            <li class="<?php echo ($menu == 'user_admin') ? "active" : "" ; ?>"><a href="<?= base_url('admin/user_admin'); ?>"><u>Admin</u></a></li>
                            <li class="<?php echo ($menu == 'user_siswa') ? "active" : "" ; ?>"><a href="<?= base_url('admin/user_siswa'); ?>"><u>Siswa</u></a></li>
                            <li class="<?php echo ($menu == 'user_guru') ? "active" : "" ; ?>"><a href="<?= base_url('admin/user_guru'); ?>"><u>Guru</u></a></li>
                            <li class="<?php echo ($menu == 'user_wali') ? "active" : "" ; ?>"><a href="<?= base_url('admin/user_wali'); ?>"><u>Wali Kelas</u></a></li>
                        </ul><!-- /.dropdown-menu.right -->
                </li><!-- /.dropdown -->
                
                <li class=""><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="icon-remove-circle"></i> Keluar</a></li>
                 
          <?php 
           }else{
            ?><li class=""><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="icon-remove-circle"></i> Keluar</a></li>
                 <?php
           }           
    ?>
    </ul><!-- /.nav -->
     
        <br />
        <div class="widget">
        <div id="datetimepicker"></div>
        </div>
        