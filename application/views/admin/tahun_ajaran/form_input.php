<h3><u><?php echo $title; ?></u></h3>
<form action="<?php echo base_url('admin/tahun_ajaran/proses_input_siswa'); ?>" method="post">
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th bgcolor="#6A9EF2">#</th>
        <th bgcolor="#6A9EF2">NIS</th>
        <th bgcolor="#6A9EF2">Nama Siswa</th>
        <th bgcolor="#6A9EF2">Jenis Kelamin</th>
    </tr>
    </thead>
    <tbody>
    <?php 
        foreach($select as $data){
            ?>
            <tr >
                <td><input type="checkbox" name="siswa[]" value="<?= $data['id_siswa']; ?>"/></td>
                <td><?= $data['nis']; ?></td>
                <td><?= $data['nama_siswa']; ?></td>
                <td><?= $data['jenis_kelamin']; ?></td>
                <input type="hidden" name="id_tahun" value="<?= $id_tahun; ?>"/>
                <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>"/>
            </tr>
            <?php
        }            
    ?>
    </tbody>
</table>
<a href=""><button class="btn" >Simpan</button></a>
</form>
<hr />
<a href="<?= base_url('admin/tahun_ajaran/input_siswa').'/'.$id_tahun; ?>"><i class="icon-arrow-left"></i> Kembali</a>