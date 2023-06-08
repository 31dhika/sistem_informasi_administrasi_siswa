<h3><u><?php echo $title; ?></u></h3><hr />

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Nama Admin</th>
            <th bgcolor="#6A9EF2">Username</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($admin as $data){
            ?>
            <tr>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['username']; ?></td>
                <td>
                
                <a href="#edit-<?= $data['id_admin']; ?>" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-pencil"></i> Ubah  </a>
                <!-- Modal tambah_user-->
                <div id="edit-<?= $data['id_admin']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                <h3 id="myModal">Ubah Akun Admin</h3>
                </div>
                <div class="modal-body">
                <form action="<?= base_url("admin/user_admin/update_admin").'/'.$data['id_admin']; ?>" method="post">
                <p>
                Nama : <input type="text" class="input-block-level" name="nama" placeholder="<?= $data['nama']; ?>" />
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
                
                </td>
            </tr>
            <?php
            }
        ?>
        
    </tbody>
</table>