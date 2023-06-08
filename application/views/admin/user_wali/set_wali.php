<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Kelas</th>
            <th bgcolor="#6A9EF2">Wali Kelas</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach($kelas as $data){
        ?>
            <tr>
                <td><?= $data['nama_kelas']; ?></td>
                <td><?= ($data['nama']==null)?"-- Belum Ada --":$data['nama']; ?></td>
                <td>
                    <?php 
                    if($data['nama']==null){
                        ?>
                        
                        <a href="#set-<?= $data['id_kelas']; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-edit"></i> Set Wali Kelas  </a>
                        
                        <div id="set-<?= $data['id_kelas']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                        <h3 id="myModal">Set Wali Kelas <?= $data['nama_kelas'] ?></h3>
                        </div>
                        <div class="modal-body">
                        <form action="<?= base_url('admin/user_wali/save_wali'); ?>" method="post">
                        
                        <p>
                        <select name="wali">
                            <?php 
                                $query = $this->db->query("select * from login_admin where tipe = 'wali' and id_admin not in (select id_admin from r_wali_kelas where id_tahun_ajaran = $id_tahun)")->result_array();
                                foreach($query as $result){
                                ?><option value="<?= $result['id_admin']; ?>"><?= $result['nama']; ?></option><?php
                                }
                            ?>
                        </select>
                        <input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>"/>
                        </p>
                        </div>
                        
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="save" value="Simpan"/>
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                        </div>
                        </form>
                        </div>
                        
                        <?php
                    }else{
                        ?><a href="<?= base_url('admin/user_wali/remove').'/'.$data['id_admin']; ?>" onclick="return confirm('Anda yakin akan menghapus wali kelas <?= $data['nama_kelas']; ?>?')"><button class="btn btn-danger"><i class="icon-remove"></i> Hapus</button></a><?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
    ?>
    </tbody>
</table>
<hr />
<a href="<?= base_url('admin/user_wali') ?>"><i class="icon-arrow-left"></i> Kembali</a>