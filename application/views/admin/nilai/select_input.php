<h3><u><?php echo $title; ?></u></h3><hr />

<?php 
    if($sk==null){
        ?>-- Data SK tidak ada, silahkan set SK terlebih dahulu --<?php
    }else{
        ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th bgcolor="#6A9EF2">Jenis SK</th>
                    <th bgcolor="#6A9EF2">Nilai</th>
                    <th bgcolor="#6A9EF2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($sk as $data){
                    ?>
                    <tr>
                        <td><?= strtoupper(substr($data['jenis_sk'],2,10)); ?></td>
                        <td>
                            <?php 
                                $a = $this->db->query("select count(*) as total_kd from kurikulum_kd where id_sk = $data[id_sk]")->result_array();
                                $total_kd = $a[0]['total_kd'];
                                
                                $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $data[id_sk]
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                $total_nilai = $b[0]['total'] ;
                                
                                $nilai_sk = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                echo ($nilai_sk==0)?"-":ceil($nilai_sk);
                            ?>
                        </td>
                        <td><a href="<?= base_url("admin/nilai/input")."/".$id_kelas."/".$id_siswa."/".$data['id_sk']; ?>" class="btn">Input Nilai KD</a></td>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
?>
<hr />
<a href="<?= base_url("admin/nilai/select")."/".$id_kelas; ?>"><i class="icon-arrow-left"></i> Kembali</a>