<h4>&nbsp;&nbsp;Nilai</h4><hr />
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
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th bgcolor="#6A9EF2">Mata Pelajaran</th>
                    <th bgcolor="#6A9EF2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($mapel as $data_pelajaran){
                ?>
                <tr>
                    <td><?= $data_pelajaran['nama_mata_pelajaran']; ?></td>
                    <td><a href="<?= base_url("nilai/view_sk").'/'.$data_pelajaran['id_mata_pelajaran'].'/'.$data_pelajaran['id_kelas']; ?>">Lihat</a></td>
                </tr>
                <?php
                }
            ?>
                
            </tbody>
        </table>