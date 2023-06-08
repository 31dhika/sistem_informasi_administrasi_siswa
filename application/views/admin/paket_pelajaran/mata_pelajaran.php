<h3><u><?php echo $title; ?></u></h3>
<hr />
<a href="#tambah_kelas" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pelajaran   </a>
 
<!-- Modal tambah kelas-->
<div id="tambah_kelas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<h3 id="myModal">Tambah Pelajaran</h3>
</div>
<div class="modal-body">
<form action="<?= base_url("admin/mata_pelajaran/add_pelajaran"); ?>" method="post">
<p>
<input type="text" class="input-block-level" name="pelajaran" placeholder="Nama Mata Pelajaran" />
</p>
</div>
<div class="modal-footer">
<button class="btn btn-primary">Simpan</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
</div>
</form>
</div>

<br /><br />

<table class="table table-striped table-bordered">
	<thead >
		<tr >
			<th bgcolor="#6A9EF2">Nama Mata Pelajaran</th>
			<th bgcolor="#6A9EF2">AKSI</th>
		</tr>
	</thead>
	<tbody>
    <?php 
        foreach ($pelajaran as $data){
            
            ?>
            <tr >
    			<td><?= $data['nama_mata_pelajaran']; ?></td>
                
                
    			<td class="center">
                <a href="#ubah_kelas-<?= $data['id_mata_pelajaran']; ?>" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-pencil"></i> Ubah</a>
                
                <!-- Modal ubah kelas-->
                <div id="ubah_kelas-<?= $data['id_mata_pelajaran']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                <h3 id="myModal">Ubah Mata Pelajaran</h3>
                </div>
                <div class="modal-body">
                <form action="<?= base_url("admin/mata_pelajaran/update_pelajaran"); ?>" method="post">
                <p>
                <table class="table table-bordered">
                    <tr>
                        <td>Nama Pelajaran</td>
                        <td>: <input type="text" name="pelajaran" value="<?= $data['nama_mata_pelajaran']; ?>" /></td>
                    </tr>
                </table>
                <br /><br /><input type="hidden" name="id" value="<?= $data['id_mata_pelajaran']; ?>"/>
                </p>
                </div>
                
                <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
                </form>
                </div>
                
                
                <a href="<?php echo base_url('admin/mata_pelajaran/delete_pelajaran').'/'.$data['id_mata_pelajaran']; ?>" onclick="return confirm('Anda yakin akan menghapus data <?= $data['nama_mata_pelajaran']; ?>?')"><button class="btn btn-danger"><i class="icon-remove"></i> Hapus</button></a>
                
                </td>
            </tr>
            <?php
        }
    ?>
		
	</tbody>
</table>
