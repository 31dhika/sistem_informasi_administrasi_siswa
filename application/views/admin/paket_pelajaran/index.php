<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-bordered table-striped">
<thead>
    <tr >
        <th bgcolor="#6A9EF2">Paket</th>
        <th bgcolor="#6A9EF2">Aksi</th>
    </tr>
</thead>
<?php 
    foreach($paket as $data){
       ?>
    <tr>
        <td><?= $data['nama_paket']; ?></td>
        <td>
            <a href="<?= base_url('admin/paket_pelajaran/view/').'/'.$data['id_paket']; ?>" class="btn btn-primary"><i class="icon-eye-open"></i> Lihat</a>
            <a href="<?= base_url('admin/paket_pelajaran/input/').'/'.$data['id_paket']; ?>"><button class="btn"><i class="icon-plus"></i> Input Pelajaran</button></a>
        </td>
    </tr>
       <?php
    }
?>
</table>