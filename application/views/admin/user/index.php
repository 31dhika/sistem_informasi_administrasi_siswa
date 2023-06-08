<h3><u><?php echo $title; ?></u></h3><hr />
<a href="#tambah_user" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah User   </a>
 
<!-- Modal tambah_user-->
<div id="tambah_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<h3 id="myModal">Tambah User</h3>
</div>
<div class="modal-body">
<form action="<?= base_url("admin/user/proses_input"); ?>" method="post">
<p>
<input type="text" class="input-block-level" name="nama" placeholder="Nama" />
<input type="text" class="input-block-level" name="username" placeholder="Username" />
<input type="text" class="input-block-level" name="password" placeholder="Password" />
<select name="tipe">
    <option value="">-- Tipe --</option>
    <option value="guru">Guru</option>
    <option value="wali">Wali Kelas</option>
    <option value="admin">Admin</option>
</select>
</p>
</div>

<div class="modal-footer">
<button class="btn btn-primary">Simpan</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
</div>
</form>
</div>

<br /><br />


<table class="table table-striped table-bordered">
    <thead>
    <tr >
        <th bgcolor="#6A9EF2">Nama</th>
        <th bgcolor="#6A9EF2">Username</th>
        <th bgcolor="#6A9EF2">Tipe</th>
        <th bgcolor="#6A9EF2">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php 
        foreach($content as $data){
            ?>
            <tr>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['tipe']; ?>
                </td>
                            
                            
                <td><a href="" class="btn btn-success">Edit</a>  <a href="<?= base_url("admin/user/delete").'/'.$data['id_admin']; ?>" class="btn btn-danger">Delete</a> 
                <?php 
                    if($data['tipe']== "guru"){
                        ?>
                        <a href="<?= base_url("admin/user/set").'/'.$data['id_admin'].'/'.$data['nama']; ?>" class="btn btn-primary">Set</a>
                        <?php
                    }
                ?>
                </td>
            </tr>  
            <?php
        }
    ?>
    </tbody>
</table>
