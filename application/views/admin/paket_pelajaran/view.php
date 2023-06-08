<h3><u><?php echo $title; ?></u></h3><hr />
<?php 
    if($pelajaran==null){
        echo "Data belum Ada";
    }else{
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th bgcolor="#6A9EF2">Mata Pelajaran</th>
                <th bgcolor="#6A9EF2">KKM</th>
                <th bgcolor="#6A9EF2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach($pelajaran as $data){
            ?>
            <tr>
                <td><?= $data['nama_mata_pelajaran']; ?></td>
                <td><?= $data['kkm']; ?></td>
                <td><a href="<?= base_url('admin/paket_pelajaran/delete').'/'.$id_paket.'/'.$data['id_mata_pelajaran']; ?>" onclick="return confirm('Anda yakin ingin menghapus Pelajaran <?= $data['nama_mata_pelajaran']; ?> ?')"><button class="btn btn-danger"><i class="icon-remove"></i> Hapus</button></a>
                
                    <a href="#edit_kkm<?= '-'.$id_paket.'-'.$data['id_mata_pelajaran']; ?>" role="button" class="btn" data-toggle="modal"> Edit KKM   </a>
 
                    <!-- Modal edit kkm-->
                    <div id="edit_kkm<?= '-'.$id_paket.'-'.$data['id_mata_pelajaran']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                    <h3 id="myModal">Edit KKM</h3>
                    </div>
                    <div class="modal-body">
                    <form action="<?= base_url("admin/paket_pelajaran/edit_kkm").'/'.$id_paket.'/'.$data['id_mata_pelajaran']; ?>" method="post">
                    <p>
                    <input type="text" class="input-block-level" name="kkm" placeholder="KKM" />
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
        <?php
    }
?>
<hr />
<a href="<?= base_url('admin/paket_pelajaran/') ?>"><i class="icon-arrow-left"></i> Kembali</a>
