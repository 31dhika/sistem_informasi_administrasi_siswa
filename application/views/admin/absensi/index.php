<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-striped table-bordered">
<thead>
		<tr>
			<th bgcolor="#6A9EF2">Kelas</th>
            <th bgcolor="#6A9EF2">Status Absen</th>
			<th bgcolor="#6A9EF2">AKSI</th>
		</tr>
</thead>
<tbody>
        <?php 
            foreach($kelas as $data){
                ?>
                <tr>
                    <td><?= $data['nama_kelas']; ?></td>
                    <td>
                    <?php 
                    $query = $this->db->query("SELECT * FROM r_absen WHERE id_kelas = ".$data['id_kelas']." AND tgl = '".date("Y-m-d")."' AND id_tahun_ajaran = $id_tahun AND semester = $semester")->result_array();
                    if(!empty($query)){
                        ?><i class="icon-ok"></i><?php
                    } else {
                        ?><i class="icon-remove"></i><?php
                    }
                    ?>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/absensi/input_absen').'/'.$data['id_kelas']; ?>" class="btn btn-primary">Input Absen</a>
                        <a href="<?= base_url('admin/absensi/lihat_absen').'/'.$data['id_kelas']; ?>" class="btn btn-primary">Lihat Absen</a>
                    </td>
                </tr>
                <?php
            }
        ?>
</tbody>
</table>