<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Kelas</th>
            <th bgcolor="#6A9EF2">aksi</th>
        </tr>
        
    </thead>
    <tbody>
    <?php 
        foreach($kelas as $data){
            ?>
            <tr>
                <td><?= $data['nama_kelas']; ?></td>
                <td><a href="<?= base_url("admin/user_guru/pelajaran").'/'.$data['id_kelas']; ?>" class="btn">Pilih</a></td>
            </tr>
            <?php
        }
    ?>
        
    </tbody>
</table>
<hr />
<a href="<?= base_url('admin/user_guru'); ?>"><i class="icon-arrow-left"></i> Kembali</a>