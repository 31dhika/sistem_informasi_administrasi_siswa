<h3><u><?php echo $title; ?></u></h3>
<hr />
<?php 
    if ( $view[0]['photo'] == "" ){
        ?>
        <img src="<?php echo base_url().'images'.'/'.'siswa'.'/'.'no_photo.jpg'; ?>" width="200" />
        <?php
    }else{
        ?>
        <img src="<?php echo base_url().'images'.'/'.'siswa'.'/'.$view[0]['photo']; ?>" width="200" />
        <?php
    }
?> 
<br /><br />
<table class="table table-striped">
    <tr>
        <td>NIS</td>
        <td>: <?= $view[0]['nis']; ?></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>: <?= $view[0]['nama_siswa']; ?></td>
    </tr>
    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>: <?= $view[0]['tempat_lahir'].','.$view[0]['tgl_lahir']; ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: <?= $view[0]['jenis_kelamin']; ?></td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>: <?= $view[0]['agama']; ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <?= $view[0]['alamat']; ?></td>
    </tr>
    <tr>
        <td>Nama Ayah</td>
        <td>: <?= $view[0]['nama_ayah']; ?></td>
    </tr>
    <tr>
        <td>Nama Ibu</td>
        <td>: <?= $view[0]['nama_ibu']; ?></td>
    </tr>
    <tr>
        <td>Alamat Ayah</td>
        <td>: <?= $view[0]['alamat_ayah']; ?></td>
    </tr>
    <tr>
        <td>Alamat Ibu</td>
        <td>: <?= $view[0]['alamat_ibu']; ?></td>
    </tr>
    <tr>
        <td>No. Telepon Ayah</td>
        <td>: <?= $view[0]['no_tlp_ayah']; ?></td>
    </tr>
    <tr>
        <td>No. Telepon Ibu</td>
        <td>: <?= $view[0]['no_tlp_ibu']; ?></td>
    </tr>
    <tr>
        <td>Status Perwalian</td>
        <td>: <?= $view[0]['status_perwalian']; ?></td>
    </tr>
</table>
<br /> 
<a href="<?php echo base_url('admin/siswa/'); ?>"><i class="icon-arrow-left"></i> Kembali</a>