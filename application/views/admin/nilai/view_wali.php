<h3><u><?php echo $title; ?></u></h3><hr />

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th bgcolor="#6A9EF2"><center>No.</center></th>
        <th bgcolor="#6A9EF2">Mata Pelajaran</th>
        <th bgcolor="#6A9EF2"><center>KKM</center></th>
        <th bgcolor="#6A9EF2"><center>Nilai</center></th>
        <th bgcolor="#6A9EF2">Deskripsi Kemajuan Belajar</th>
    </tr>
    </thead>
    <tbody>
        <?php 
            $no = 0;
            foreach($pelajaran as $data){
                $no++;
                ?>
                <tr>
                    <td><center><?= $no; ?></center>  </td>
                    <td><?= $data['nama_mata_pelajaran']; ?></td>
                    <td><center><?= $data['kkm']; ?></center></td>
                    <td>
                        <?php 
                        
                            $sk1 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'a_sk1'")->result_array();
                            $id_sk1 = ($sk1==null)?0:$sk1[0]['id_sk'];
                            $kd1 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk1")->result_array();
                            $jumlah_kd_sk1 = count($kd1);
                            $jumlah_nilai_sk1 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk1
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk1 = (empty($jumlah_nilai_sk1[0]['total']))?"0":$jumlah_nilai_sk1[0]['total'];
                            $nilai_sk1 = ($hasil_sk1==0)?0:($hasil_sk1/$jumlah_kd_sk1);
                            
                            
                            
                            
                            
                            $sk2 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'b_sk2'")->result_array();
                            $id_sk2 = ($sk2==null)?0:$sk2[0]['id_sk'];
                            $kd2 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk2")->result_array();
                            $jumlah_kd_sk2 = count($kd2);
                            $jumlah_nilai_sk2 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk2
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk2 = (empty($jumlah_nilai_sk2[0]['total']))?"0":$jumlah_nilai_sk2[0]['total'];
                            $nilai_sk2 = ($hasil_sk2==0)?0:($hasil_sk2/$jumlah_kd_sk2);
                            
                            
                            
                            
                            
                            $sk3 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'c_sk3'")->result_array();
                            $id_sk3 = ($sk3==null)?0:$sk3[0]['id_sk'];
                            $kd3 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk3")->result_array();
                            $jumlah_kd_sk3 = count($kd3);
                            $jumlah_nilai_sk3 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk3
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk3 = (empty($jumlah_nilai_sk3[0]['total']))?"0":$jumlah_nilai_sk3[0]['total'];
                            $nilai_sk3 = ($hasil_sk3==0)?0:($hasil_sk3/$jumlah_kd_sk3);
                            
                            
                            
                            
                            
                            $sk4 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'd_sk4'")->result_array();
                            $id_sk4 = ($sk4==null)?0:$sk4[0]['id_sk'];
                            $kd4 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk4")->result_array();
                            $jumlah_kd_sk4 = count($kd4);
                            $jumlah_nilai_sk4 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk4
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk4 = (empty($jumlah_nilai_sk4[0]['total']))?"0":$jumlah_nilai_sk4[0]['total'];
                            $nilai_sk4 = ($hasil_sk4==0)?0:($hasil_sk4/$jumlah_kd_sk4);
                            
                            
                            
                            
                            
                            $sk5 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'e_sk5'")->result_array();
                            $id_sk5 = ($sk5==null)?0:$sk5[0]['id_sk'];
                            $kd5 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk5")->result_array();
                            $jumlah_kd_sk5 = count($kd5);
                            $jumlah_nilai_sk5 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk5
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk5 = (empty($jumlah_nilai_sk5[0]['total']))?"0":$jumlah_nilai_sk5[0]['total'];
                            $nilai_sk5 = ($hasil_sk5==0)?0:($hasil_sk5/$jumlah_kd_sk5);
                            
                            
                            
                            
                            
                            $sk6 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'f_sk6'")->result_array();
                            $id_sk6 = ($sk6==null)?0:$sk6[0]['id_sk'];
                            $kd6 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk6")->result_array();
                            $jumlah_kd_sk6 = count($kd6);
                            $jumlah_nilai_sk6 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk6
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk6 = (empty($jumlah_nilai_sk6[0]['total']))?"0":$jumlah_nilai_sk6[0]['total'];
                            $nilai_sk6 = ($hasil_sk6==0)?0:($hasil_sk6/$jumlah_kd_sk6);
                            
                            
                            
                            
                            
                            $sk7 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'g_sk7'")->result_array();
                            $id_sk7 = ($sk7==null)?0:$sk7[0]['id_sk'];
                            $kd7 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk7")->result_array();
                            $jumlah_kd_sk7 = count($kd7);
                            $jumlah_nilai_sk7 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk7
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk7 = (empty($jumlah_nilai_sk7[0]['total']))?"0":$jumlah_nilai_sk7[0]['total'];
                            $nilai_sk7 = ($hasil_sk7==0)?0:($hasil_sk7/$jumlah_kd_sk7);
                            
                            
                            
                            
                            
                            $sk8 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'k_sk8'")->result_array();
                            $id_sk8 = ($sk8==null)?0:$sk8[0]['id_sk'];
                            $kd8 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk8")->result_array();
                            $jumlah_kd_sk8 = count($kd8);
                            $jumlah_nilai_sk8 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk8
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk8 = (empty($jumlah_nilai_sk8[0]['total']))?"0":$jumlah_nilai_sk8[0]['total'];
                            $nilai_sk8 = ($hasil_sk8==0)?0:($hasil_sk8/$jumlah_kd_sk8);
                            
                            
                            
                            
                            
                            $sk9 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'i_sk9'")->result_array();
                            $id_sk9 = ($sk9==null)?0:$sk9[0]['id_sk'];
                            $kd9 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk9")->result_array();
                            $jumlah_kd_sk9 = count($kd9);
                            $jumlah_nilai_sk9 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk9
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk9 = (empty($jumlah_nilai_sk9[0]['total']))?"0":$jumlah_nilai_sk9[0]['total'];
                            $nilai_sk9 = ($hasil_sk9==0)?0:($hasil_sk9/$jumlah_kd_sk9);
                            
                            
                            
                            
                            
                            $sk10 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'j_sk10'")->result_array();
                            $id_sk10 = ($sk10==null)?0:$sk10[0]['id_sk'];
                            $kd10 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk10")->result_array();
                            $jumlah_kd_sk10 = count($kd10);
                            $jumlah_nilai_sk10 = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk10
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_sk10 = (empty($jumlah_nilai_sk10[0]['total']))?"0":$jumlah_nilai_sk10[0]['total'];
                            $nilai_sk10 = ($hasil_sk10==0)?0:($hasil_sk10/$jumlah_kd_sk10);
                            
                            
                            
                            
                            
                            $uts = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'k_uts'")->result_array();
                            $id_uts = ($uts==null)?0:$uts[0]['id_sk'];
                            $kd_uts = $this->db->query("select * from kurikulum_kd where id_sk = $id_uts")->result_array();
                            $jumlah_kd_uts = count($kd_uts);
                            $jumlah_nilai_uts = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_uts
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_uts = (empty($jumlah_nilai_uts[0]['total']))?"0":$jumlah_nilai_uts[0]['total'];
                            $nilai_uts = ($hasil_uts==0)?0:($hasil_uts/$jumlah_kd_uts);
                            
                            
                            
                            
                            $uas = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'l_uas'")->result_array();
                            $id_uas = ($uas==null)?0:$uas[0]['id_sk'];
                            $kd_uas = $this->db->query("select * from kurikulum_kd where id_sk = $id_uas")->result_array();
                            $jumlah_kd_uas = count($kd_uas);
                            $jumlah_nilai_uas = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_uas
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $id_siswa and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                            $hasil_uas = (empty($jumlah_nilai_uas[0]['total']))?"0":$jumlah_nilai_uas[0]['total'];
                            $nilai_uas = ($hasil_uas==0)?0:($hasil_uas/$jumlah_kd_uas);
                            
                            
                            
                            
                            $jumlah_sk = count($this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester")->result_array());
                                                                                
                            $rumus_rapor = (($nilai_sk1+$nilai_sk2+$nilai_sk3+$nilai_sk4+$nilai_sk5+$nilai_sk6+$nilai_sk7+$nilai_sk8+$nilai_sk9+$nilai_sk10+$nilai_uts+$nilai_uas)==0)?"0":($nilai_sk1+$nilai_sk2+$nilai_sk3+$nilai_sk4+$nilai_sk5+$nilai_sk6+$nilai_sk7+$nilai_sk8+$nilai_sk9+$nilai_sk10+$nilai_uts+$nilai_uas)/$jumlah_sk;
                            $nilai_rapor = ceil($rumus_rapor);
                            echo $nilai_rapor;
                            
                            $arr_rapor[] = $nilai_rapor;
                            
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($nilai_rapor<$data['kkm']){
                                echo "Tidak tercapai";
                            }elseif($nilai_rapor==$data['kkm']){
                                echo "Tercapai";
                            }else{
                                echo "Terlampaui";
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
&nbsp;Nilai rata-rata : <?php 
                                $total_rapor = array_sum($arr_rapor);
                                $rata2_nilai_rapor = ceil($total_rapor/$total_pelajaran);
                                echo $rata2_nilai_rapor;
                                ?>
<br /><br />
<a href="<?= base_url("admin/rekap/rekap_rapor").'/'.$id_siswa.'/'.$id_kelas.'/'.$id_tahun.'/'.$semester; ?>" class="btn btn-primary">Rekap <img src="<?= base_url();?>/images/component/excel.png" width="20"/></a>
<hr />
<a href="<?= base_url('admin/nilai/select').'/'.$id_kelas; ?>"><i class="icon-arrow-left"></i> Kembali</a>