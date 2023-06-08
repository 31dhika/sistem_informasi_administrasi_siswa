<h3><u><?php echo $title; ?></u></h3>
<hr />
<?php 
    if(empty($siswa)){
        echo "<strong>-- Tidak Ada Siswa di Kelas ini --</strong>";
    }else{
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th bgcolor="#6A9EF2">No.</th>
                <th bgcolor="#6A9EF2">NIS</th>
                <th bgcolor="#6A9EF2">Nama Siswa</th>
                <th bgcolor="#6A9EF2">Jenis Kelamin</th>
                <th bgcolor="#6A9EF2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $lelaki = 0;
            $perempuan = 0;
            $no = 1;
            foreach($siswa as $data){
                ?>
                <tr>
                    <td><?= $no; $no++;?></td>
                    <td><?= $data['nis']; ?></td>
                    <td><?= $data['nama_siswa']; ?></td>
                    <td><?= $data['jenis_kelamin']; ?></td>
                    <td><a href="<?= base_url('admin/kelas/remove_siswa').'/'.$id_kelas.'/'.$data['id_siswa']; ?>" onclick="return confirm('Anda yakin akan menghapus <?= $data['nama_siswa']; ?> ?')" class="btn btn-danger"><i class="icon-remove"></i> Hapus</a></td>
                </tr>
                <?php
                ($data['jenis_kelamin'] == 'Laki-laki') ? $lelaki += 1 : 0;
                ($data['jenis_kelamin'] == 'Perempuan') ? $perempuan += 1 : 0;
                
            }
            ?>
            </tbody>
        </table>
        
        <a href="<?= base_url("admin/rekap/rekap_kelas").'/'.$id_kelas; ?>" class="btn btn-primary">Rekap Data <img src="<?= base_url("images/component/excel.png") ?>" width="20"/></a>
        <br />
        <br />
        
        <table>   
            <tr>
                <td>Laki-Laki</td>
                <td>&nbsp;: <?php echo $lelaki; ?></td>
            </tr>
            <tr>
                <td>Perempuan</td>
                <td>&nbsp;: <?php echo $perempuan; ?></td>
            </tr>
            <tr>
                <td>Total Siswa</td>
                <td>&nbsp;: <?php echo count($siswa); ?></td>
            </tr>
        </table>
        <?php
    }
?>


<hr />
<a href="<?= base_url('admin/kelas'); ?>"><i class="icon-arrow-left"></i> Kembali</a>
