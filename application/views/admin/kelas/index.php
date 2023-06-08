<h3><u><?php echo $title; ?></u></h3>
<hr />


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th bgcolor="#6A9EF2">Kelas</th>
			<th bgcolor="#6A9EF2">Wali Kelas</th>
			<th bgcolor="#6A9EF2">AKSI</th>
		</tr>
	</thead>
	<tbody>
    <?php 
        foreach ($kelas as $data){
            
            ?>
            <tr >
    			<td><?= $data['nama_kelas']; ?></td>
    			<td><?= ($data['nama'] != null) ? $data['nama'] : 'Wali kelas belum ada'; ?></td>
    			
                <td>
                
                
                
                <a href="<?php echo base_url('admin/kelas/view_siswa').'/'.$data['id_kelas']; ?>" class="btn btn-primary"><i class="icon-eye-open"></i> Lihat Siswa</a>
                
                
                
                
                
                
                
                </td>
            </tr>
            <?php
        }
    ?>
		
	</tbody>
</table>

