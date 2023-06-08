<h3><u><?php echo $title; ?></u></h3><hr />
<?php 
    if($this->session->flashdata('error_sk')){
        echo $this->session->flashdata('error_sk');
    }
?>
<a href="#tambah_sk" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah SK </a>
<!-- Modal tambah ekskul-->
<div id="tambah_sk" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<h3 id="myModal">Tambah SK</h3>
</div>
<div class="modal-body">
<form action="<?= base_url("admin/nilai/add_sk")."/".$id_kelas; ?>" method="post">
<p>
<select name="sk">
    <option value="a_sk1">SK1</option>
    <option value="b_sk2">SK2</option>
    <option value="c_sk3">SK3</option>
    <option value="d_sk4">SK4</option>
    <option value="e_sk5">SK5</option>
    <option value="f_sk6">SK6</option>
    <option value="g_sk7">SK7</option>
    <option value="h_sk8">SK8</option>
    <option value="i_sk9">SK9</option>
    <option value="j_sk10">SK10</option>
    <option value="k_uts">UTS</option>
    <option value="l_uas">UAS</option>
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

if($sk==null){
    echo "-- Data SK tidak ada --";
    echo "<br/>";
}else{
    ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th bgcolor="#6A9EF2">Jenis SK</th>
                <th bgcolor="#6A9EF2">Jumlah KD</th>
                <th bgcolor="#6A9EF2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($sk as $data){?>
            <tr>
                <td>
                    
                    <?= strtoupper(substr($data['jenis_sk'],2,10)); ?>
                </td>
                <td>
                    <?php 
                        $total_kd = $this->db->query("select * from kurikulum_kd where id_sk = $data[id_sk]")->result_array();
                        echo count($total_kd);
                    ?>
                </td>
                <td>
                    <a href="<?= base_url("admin/nilai/kurikulum_kd").'/'.$data['id_sk']."/".$id_kelas; ?>" class="btn"><i class="icon-wrench"></i> Set KD</a>
                    <a href="<?= base_url("admin/nilai/delete_sk").'/'.$data['id_sk']."/".$id_kelas; ?>" class="btn" onclick="return confirm('Anda yakin akan menghapus data <?= strtoupper(substr($data['jenis_sk'],2,10)); ?> ?')"><i class="icon-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
    
    <?php
}

?>
<br />
<a href="<?= base_url("admin/nilai/select")."/".$id_kelas; ?>" ><i class="icon-arrow-left"></i> Kembali</a>