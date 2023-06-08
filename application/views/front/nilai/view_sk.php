<h4>&nbsp;&nbsp;Nilai <i class="icon-arrow-right" style="margin-top: 3px;"></i></i> <?= $mapel[0]['nama_mata_pelajaran'] ?></h4><hr />
<table>
    <tr>
        <td>Tahun Ajaran</td>
        <td>&nbsp;&nbsp;:&nbsp;&nbsp;<?= $tahun[0]['tahun_ajaran']; ?></td>
    </tr>
    <tr>
        <td>Semester</td>
        <td>&nbsp;&nbsp;:&nbsp;&nbsp;<?= $semester; ?></td>
    </tr>
</table>
<br />
<?php 
if($jenis_nilai==null){
    echo "-- Data SK tidak ada --";
    echo "<br/>";
}else{
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Jenis Nilai</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($jenis_nilai as $data){
        ?>
        <tr>
            <td><?= strtoupper(substr($data['jenis_sk'],2,3)) ; ?></td>
            <td><a href="<?= base_url("nilai/view_kd").'/'.$data['id_sk'].'/'.$data['id_mapel'].'/'.$data['id_kelas']; ?>">lihat</a></td>
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
<a href="<?= base_url("nilai"); ?>"><i class="icon-arrow-left"></i> Kembali</a>
