<h3><u><?php echo $title; ?></u></h3>
<hr />
<a href="<?= base_url('admin/siswa/add_siswa'); ?>" class="btn"><i class="icon-plus"></i> Tambah Siswa</a>
<a href="<?= base_url('admin/rekap/rekap_all_siswa'); ?>" class="btn btn-primary">Rekap Data <img src="<?= base_url("images/component/excel.png") ?>" width="20"/></a>
<br /><br />

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr bgcolor="#6A9EF2">
			<th bgcolor="#6A9EF2">NIS</th>
			<th>NAMA SISWA</th>
            <th>KELAS</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
    <?php 
        foreach ($siswa as $data){
            
            ?>
            <tr class="odd gradeX">
    			<td><?= $data['nis']; ?></td>
    			<td><?= $data['nama_siswa']; ?></td>
                <td><?= $data['nama_kelas']; ?></td>
    			<td class="center">
                     <a href="<?php echo base_url('admin/siswa/view_siswa').'/'.$data['id_siswa']; ?>" class="btn btn-primary"><i class="icon-eye-open"></i> Lihat</a>
                     <a href="<?php echo base_url('admin/siswa/ubah_siswa').'/'.$data['id_siswa']; ?>" class="btn btn-success"><i class="icon-pencil"></i> Ubah</a> 
                     <a href="<?php echo base_url('admin/siswa/delete_siswa').'/'.$data['id_siswa']; ?>" onclick="return confirm('Anda yakin akan menghapus data <?= $data['nama_siswa']; ?>?')" class="btn btn-danger"><i class="icon-remove"></i> Hapus</a>
                </td>
            </tr>
            <?php
        }
    ?>
		
	</tbody>
</table>