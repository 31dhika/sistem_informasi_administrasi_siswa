<h3><u><?php echo $title; ?></u></h3><hr />
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Mata Pelajaran</th>
            <th bgcolor="#6A9EF2">Nama Guru</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
        
    </thead>
    <tbody>
    <?php 
        foreach($pelajaran as $data){
            ?>
            
            <tr>
                <td><?= $data['nama_mata_pelajaran']; ?></td>
                <td><?= ($data['nama']==null)?"--belum ada--":$data['nama'];?></td>
                <td>
                    
                    <?php 
                        if($data['nama']==null){
                            ?><a href="#tambah_user-<?= $data['id_mata_pelajaran']; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-pencil"></i> Set Guru</a><?php
                        }else{
                            ?><a href="<?= base_url('admin/user_guru/remove').'/'.$data['id_admin'].'/'.$data['id_kelas']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus guru <?= $data['nama']; ?>?')"><i class="icon-remove"></i> Hapus</a><?php
                        }
                    ?>
                  
                    <!-- Modal tambah_user-->
                    <div id="tambah_user-<?= $data['id_mata_pelajaran']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                    <h3 id="myModal">Set Guru <?= $data['nama_mata_pelajaran']; ?></h3>
                    </div>
                    <div class="modal-body">
                    <form action="<?= base_url("admin/user_guru/proses_input").'/'.$data['id_kelas']; ?>" method="post">
                    <p>
                    <select name="guru">
                    <?php
                        
                            $query1 = $this->db->query("select * from login_admin 
                                                        where tipe = 'guru' and id_admin not in 
                                                        (select id_admin from r_guru where id_tahun_ajaran = $id_tahun)")->result_array();
                            foreach($query1 as $result1){
                            ?><option value="<?= $result1['id_admin']; ?>"><?= $result1['nama']; ?></option><?
                            }
                            
                            $query2 = $this->db->query("select
                                                        distinct b.id_admin,b.nama
                                                        from 
                                                        r_guru as a
                                                        inner join login_admin as b on b.id_admin = a.id_admin 
                                                        where a.id_mata_pelajaran = $data[id_mata_pelajaran] and a.id_tahun_ajaran = $id_tahun)")->result_array();
                            foreach($query2 as $result2){
                                ?><option value="<?= $result2['id_admin']; ?>"><?= $result2['nama']; ?></option><?php
                            }
                             
                    ?>
                    
                    </select>
                    <br />
                    <input type="hidden" name="id_mapel" value="<?= $data['id_mata_pelajaran']; ?>"/>
                    </p>
                    
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                    </div>
                    </form> 
                </td>
            </tr>
            <?php
        }
    ?>
        
    </tbody>
</table><hr />
<a href="<?= base_url("admin/user_guru/kelas"); ?>"><i class="icon-arrow-left"></i> Kembali</a>