<h3><u><?php echo $title; ?></u></h3><hr />
<form action="<?= base_url('admin/paket_pelajaran/proses_input'); ?>" method="post">
<table class="table table-bordered table-striped">
    <tr>
        <th>#</th>
        <th>Mata Pelajaran</th>
    </tr>
    <?php 
    foreach($pelajaran as $data){
        ?>
        <tr>
            <td><input type="checkbox" name="pelajaran[]" value="<?= $data['id_mata_pelajaran']; ?>"/></td>
            <td><?= $data['nama_mata_pelajaran']; ?></td>
        </tr>
        <?php 
    }
    ?>
</table>
<input type="hidden" name="id_paket" value="<?= $id_paket; ?>"/>
<button class="btn">simpan</button>
</form>
<hr />
<a href="<?= base_url('admin/paket_pelajaran/') ?>"><i class="icon-arrow-left"></i> Kembali</a>