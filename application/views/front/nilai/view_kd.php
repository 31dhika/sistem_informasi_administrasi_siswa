<h4>&nbsp;&nbsp;Nilai <i class="icon-arrow-right" style="margin-top: 3px;"></i></i> <?= $mapel[0]['nama_mata_pelajaran'] ?> <i class="icon-arrow-right" style="margin-top: 3px;"></i></i> <?= strtoupper(substr($nama_sk[0]['jenis_sk'],2,3)); ?></h4><hr />
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
if($nilai==null){
    echo "-- Data KD tidak ada --";
    echo "<br/>";
}else{
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Jenis Nilai</th>
            <th bgcolor="#6A9EF2">Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($nilai as $data){
        ?>
        <tr>
            <td><?= strtoupper(substr($data['jenis_kd'],2,3)); ?></td>
            <td><?= ($data['nilai']==null)?'-':$data['nilai']; ?></td>
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
<a href="<?= base_url("nilai/view_sk").'/'.$id_mapel.'/'.$id_kelas; ?>"><i class="icon-arrow-left"></i> Kembali</a>
