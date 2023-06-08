<h3><u><?php echo $title; ?></u></h3><hr />
<a href="#tambah_user" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Akun Guru  </a> <a href="<?= base_url("admin/user_guru/kelas"); ?>" class="btn"><i class="icon-edit"></i> Set Guru</a>
<!-- Modal tambah_user-->
<div id="tambah_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<h3 id="myModal">Tambah Akun Guru</h3>
</div>
<div class="modal-body">
<form action="<?= base_url("admin/user_guru/add_guru"); ?>" method="post">
<p>
<input type="text" class="input-block-level" name="nama" placeholder="Nama" />
<input type="text" class="input-block-level" name="username" placeholder="Username" />
<input type="text" class="input-block-level" name="password" placeholder="Password" />
</p>
</div>

<div class="modal-footer">
<button class="btn btn-primary">Simpan</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
</div>
</form>
</div>


    <?php 
        if($guru == null){
            echo br(2);
            echo "-- Data Masih Kosong --";
        }else{
            ?>
            <div style="float: right;">
            <form action="<?= base_url("admin/user_guru/index") ?>" method="post">
            Search : <input type="text" name="search" placeholder="Nama Guru"/>
            </form>
            </div>
            
            <br /><br />
            <table class="table table-bordered table-striped">
            <thead>
                <tr >
        			<th bgcolor="#6A9EF2">Nama Guru</th>
                    <th bgcolor="#6A9EF2">Username</th>
        			<th bgcolor="#6A9EF2">Mata Pelajaran</th>
                    <th bgcolor="#6A9EF2">Kelas</th>
                    <th bgcolor="#6A9EF2">Aksi</th>
        		</tr>
            </thead>
            <tbody>
            <?php
        foreach($guru as $data){
            ?>
            <tr>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['username']; ?></td>
                <td>
                    <?php 
                        $qw_1 = $this->db->query("select
                                                b.nama_mata_pelajaran
                                                from
                                                    r_guru as a
                                                left join m_mata_pelajaran as b on b.id_mata_pelajaran = a.id_mata_pelajaran
                                                where
                                                a.id_admin = $data[id_admin] and a.id_tahun_ajaran = $id_tahun")->result_array();
                        if($qw_1==null){
                            echo "-- Belum di-Set --";
                        }else{
                            echo $qw_1[0]['nama_mata_pelajaran'];
                        }
                    ?> 
                </td>
                <td>
                    <?php 
                        $qw_2 = $this->db->query("select
                                                    b.nama_kelas
                                                    from
                                                    r_guru as a
                                                    left join m_kelas as b on b.id_kelas = a.id_kelas
                                                    where
                                                    a.id_admin = $data[id_admin] and a.id_tahun_ajaran = $id_tahun")->result_array();
                        
                        if($qw_2==null){
                            echo "-- Belum di-Set --";
                        }else{
                           foreach($qw_2 as $d){
                            echo $d['nama_kelas']."<br/>"; 
                            } 
                        }
                        
                        
                    ?>
                </td>
                <td style="vertical-align: middle;">
                
                <a href="#edit-<?= $data['id_admin']; ?>" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-pencil"></i> Ubah  </a>
                <!-- Modal tambah_user-->
                <div id="edit-<?= $data['id_admin']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                <h3 id="myModal">Ubah Akun Guru</h3>
                </div>
                <div class="modal-body">
                <form action="<?= base_url("admin/user_guru/update_guru").'/'.$data['id_admin']; ?>" method="post">
                <p>
                Nama : <input type="text" class="input-block-level" name="nama" placeholder="<?= $data['nama']; ?>" />
                Username :<input type="text" class="input-block-level" name="username" placeholder="<?= $data['username']; ?>" />
                Password : <input type="text" class="input-block-level" name="password" placeholder="Password" />
                </p>
                </div>
                
                <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                </div>
                </form>
                </div>
                
                <a href="<?= base_url('admin/user_guru/delete').'/'.$data['id_admin']; ?>" onclick="return confirm('Anda yakin akan menghapus account wali kelas <?= $data['nama']; ?>?')"><button class="btn btn-danger"><i class="icon-remove"></i> Hapus</button></a>
                </td>
            </tr>
            <?php
        }
        }
    ?>
        
    </tbody>
</table>

<?= $this->pagination->create_links(); ?>