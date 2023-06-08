<h3><u><?php echo $title; ?></u></h3><hr />
    <?php 
        if($siswa==null){
            echo "-- Data Masih Kosong --";
        }else{
            ?>
            <div style="float: right;">
            <form action="<?= base_url("admin/user_siswa/index") ?>" method="post">
            Search : <input type="text" name="search" placeholder="Nama Siswa"/>
            </form>
            </div>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th bgcolor="#6A9EF2">Nama Siswa</th>
                    <th bgcolor="#6A9EF2">Username</th>
                    <th bgcolor="#6A9EF2">Tanggal Pembuatan</th>
                    <th bgcolor="#6A9EF2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
        foreach($siswa as $data){
        ?>
        <tr>
            <td><?= $data['nama_siswa']; ?></td>
            <td><?= $data['username']; ?></td>
            <td>
                <?php
                $tgl = substr($data['created'],0,10);
                $waktu = substr($data['created'],10,10);
                echo tgl_indo($tgl).$waktu; 
                ?>
            </td>
            <td>
            
                <a href="#edit-<?= $data['id_siswa']; ?>" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-pencil"></i> Ubah  </a>
                <!-- Modal tambah_user-->
                <div id="edit-<?= $data['id_siswa']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                <h3 id="myModal">Ubah Akun Siswa</h3>
                </div>
                <div class="modal-body">
                <form action="<?= base_url("admin/user_siswa/update_siswa").'/'.$data['id_siswa']; ?>" method="post">
                <p>
                Username :<input type="text" class="input-block-level" name="username" placeholder="<?= $data['username']; ?>" />
                Password : <input type="text" class="input-block-level" name="password" placeholder="Password" />
                </p>
                </div>
                
                <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
                </form>
                </div>
             
                <a href="<?= base_url("admin/user_siswa/delete").'/'.$data['id_siswa']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus account siswa <?= $data['nama_siswa']; ?>?')">Hapus</a>
            </td>
        </tr>
        <?php
        }
        }
    ?>
        
    </tbody>
</table>
<?= $this->pagination->create_links(); ?>