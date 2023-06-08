<h3><u><?php echo $title; ?></u></h3><hr />
<?php 
    if($this->session->flashdata('error_kd')){
        echo $this->session->flashdata('error_kd');
    }
?>
<a href="#tambah_kd" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah KD </a>
<!-- Modal tambah ekskul-->
<div id="tambah_kd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<h3 id="myModal">Tambah KD</h3>
</div>
<div class="modal-body">
<form action="<?= base_url("admin/nilai/add_kd")."/".$id_sk."/".$id_kelas; ?>" method="post">
<p>
<select name="kd">
    <option value="a_kd1">KD1</option>
    <option value="b_kd2">KD2</option>
    <option value="c_kd3">KD3</option>
    <option value="d_kd4">KD4</option>
    <option value="e_kd5">KD5</option>
    <option value="f_kd6">KD6</option>
    <option value="g_kd7">KD7</option>
    <option value="h_kd8">KD8</option>
    <option value="i_kd9">KD9</option>
    <option value="j_kd10">KD10</option>
</select>
</p>
</div>
<div class="modal-footer">
<button class="btn btn-primary">Simpan</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
</div>
</form>
</div>
<br />
<br />
<?php 
    if($kd == null){
        echo "-- Data KD tidak ada --";
        echo "<br/>";
    }else{
        ?>
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th bgcolor="#6A9EF2">Jenis KD</th>
                <th bgcolor="#6A9EF2">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($kd as $data){
                ?>
                <tr>
                    <td><?= strtoupper(substr($data['jenis_kd'],2,10)); ?></td>
                    <td><a href="<?= base_url("admin/nilai/delete_kd").'/'.$data['id_kd'].'/'.$id_sk.'/'.$id_kelas; ?>" class="btn" onclick="return confirm('Anda yakin akan menghapus data <?= strtoupper(substr($data['jenis_kd'],2,10)); ?> ?')"><i class="icon-trash"></i> Hapus</a></td>
                </tr>
                <?php
            }
        ?>
        </tbody>
        </table>
        <?php
    }
?>
<br />
<a href="<?= base_url("admin/nilai/kurikulum_sk")."/".$id_kelas; ?>" ><i class="icon-arrow-left"></i> Kembali</a>