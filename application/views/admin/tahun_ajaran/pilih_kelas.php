<h3><u><?php echo $title; ?></u></h3>
 <table class="table table-striped table-bordered">
 <thead>
    <tr>
        <th bgcolor="#6A9EF2">Kelas</th>
        <th bgcolor="#6A9EF2">Aksi</th>
    </tr>
 </thead>
 <tbody>
    <?php 
        foreach ($select as $data){
            ?>
            <tr>
                <td><?= $data['nama_kelas']; ?></td>
                <td><a href="<?= base_url('admin/tahun_ajaran/input_siswa_kelas/').'/'.$id_tahun.'/'.$data['id_kelas']; ?>" class="btn btn-primary">input siswa</a></td>
            </tr>
            <?php
        }
    ?>
 </tbody>
 </table>
 <hr />

<a href="<?= base_url('admin/tahun_ajaran'); ?>"><i class="icon-arrow-left"></i> Kembali</a>