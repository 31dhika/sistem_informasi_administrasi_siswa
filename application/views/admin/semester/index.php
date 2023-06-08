<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-bordered">
    <thead>
        <tr> 
            <th bgcolor="#6A9EF2">Semester</th>
            <th bgcolor="#6A9EF2">Status Aktif</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($semester as $data){
            ?>
            <tr>
                <td><?= $data['nama_semester']; ?></td>
                <td><?= ($data['status']==1)?'<i class="icon-ok"></i>':'<i class="icon-remove"></i>';?></td>
                <td><a href="<?= base_url('admin/semester/aktif').'/'.$data['id']; ?>"><button class="btn btn-warning">Aktifkan Semester</button>  </a></td>
            </tr>
            <?php
            }
        ?>
        
    </tbody>
</table>