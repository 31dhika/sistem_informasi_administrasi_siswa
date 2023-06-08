<h3><u><?php echo $title; ?></u></h3>
<hr />
<a href="<?= base_url('admin/tahun_ajaran/add_tahun'); ?>" role="button" class="btn" data-toggle="modal" onclick="return confirm('Anda ingin menambah Tahun Ajaran ?')"><i class="icon-plus"></i> Tambah Tahun Ajaran   </a>
 


<br /><br />

<?php 

if($tahun_ajaran==null){
    echo "-- Data Kosong --";
}else{
    ?>
    
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th bgcolor="#6A9EF2">Tahun Ajaran</th>
            <th bgcolor="#6A9EF2">Status Aktif</th>
			<th bgcolor="#6A9EF2">AKSI</th>
		</tr>
	</thead>
	<tbody>
    <?php 
        foreach ($tahun_ajaran as $data){
            
            ?>
            <tr >
    			<td><?= $data['tahun_ajaran']; ?></td>
    			<td><?= ($data['status'] == 1) ? '<i class="icon-ok"></i>' : '<i class="icon-remove"></i>'; ?></td>
    			<td>                
                <a href="<?php echo base_url('admin/tahun_ajaran/input_siswa').'/'.$data['id_tahun_ajaran']; ?>" ><button class="btn btn-primary" type="button">Input Siswa</button></a>
                
                <a href="<?php echo base_url('admin/tahun_ajaran/active').'/'.$data['id_tahun_ajaran']; ?>"><button class="btn btn-warning">Aktifkan Tahun Ajaran</button></a>
                </td>
            </tr>
            <?php
        }
    ?>
	</tbody>
</table>
    <?php
}

?>
