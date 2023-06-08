<h4>&nbsp;&nbsp;Selamat datang di halaman Student Portal SMPN 195 JAKARTA</h4><hr />
<?php 
    if ( $siswa[0]['photo'] == "" ){
        ?>
        <img src="<?php echo base_url().'images'.'/'.'siswa'.'/'.'no_photo.jpg'; ?>" width="200" />
        <?php
    }else{
        ?>
        <img src="<?php echo base_url().'images'.'/'.'siswa'.'/'.$siswa[0]['photo']; ?>" width="200" />
        <?php
    }
?>
<br /><br /> 
<table class="table table-striped table-bordered">
    <tr>
        <td>NIS</td>
        <td><?= $siswa[0]['nis']; ?></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><?= $siswa[0]['nama_siswa']; ?></td>
    </tr>
    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td><?= $siswa[0]['tempat_lahir'].', '.tgl_indo($siswa[0]['tgl_lahir']); ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td><?= $siswa[0]['jenis_kelamin']; ?></td>
    </tr>
    <tr>
        <td>Agama</td>
        <td><?= $siswa[0]['agama']; ?></td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td><?= $siswa[0]['nama_kelas']; ?></td>
    </tr>
</table>