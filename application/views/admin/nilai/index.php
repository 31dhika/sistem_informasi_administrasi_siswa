<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-striped table-bordered">
<thead>
		<tr>
			<th bgcolor="#6A9EF2">Kelas</th>
			<th bgcolor="#6A9EF2">AKSI</th>
		</tr>
</thead>
<tbody>
        <?php 
            foreach($kelas as $data){?>
                <tr>
                    <td><?= $data['nama_kelas']; ?></td>
                    <td><a href="<?= base_url('admin/nilai/select').'/'.$data['id_kelas']; ?>" class="btn btn-primary">Pilih</a>        
                    </td>
                </tr>
                <?php }
        ?>
</tbody>
</table>

