<h3><u><?php echo $title; ?></u></h3><hr />

<?php 
    if($siswa==null){
        echo 'Tidak ada siswa di kelas ini';
    }else{
        ?>
        
        <table class="table table-striped table-bordered">
        <thead>
        		<tr>
                    <th bgcolor="#6A9EF2" width="40">No.</th>
        			<th bgcolor="#6A9EF2">Nama Siswa</th>
        			<th bgcolor="#6A9EF2">AKSI</th>
        		</tr>
        </thead>
        <tbody>
                <?php 
                $no =1;
                foreach($siswa as $data){
                ?>
                <tr>
                    <td><?= $no; $no++; ?></td>
                    <td><?= $data['nama_siswa']; ?></td>
                    <td><a href="<?= base_url("admin/nilai/select_wali").'/'.$id_kelas.'/'.$data['id_siswa']; ?>" class="btn">Lihat Nilai</a></td>
                </tr>
                <?php
                }
                
                            
                ?>
        </tbody>
        </table>
        <?php
    }
    
?>
<hr />

<a href="<?= base_url('admin/nilai/') ?>"><i class="icon-arrow-left"></i> Kembali</a>

