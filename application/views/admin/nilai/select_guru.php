<h3><u><?php echo $title; ?></u></h3><hr />

<?php 
    if($siswa==null){
        echo 'Tidak ada siswa di kelas ini';
    }else{
        ?>
        <a href="<?= base_url("admin/nilai/kurikulum_sk/")."/".$id_kelas; ?>" class="btn"><i class="icon-wrench"></i> Set Kompetensi</a><br /><br />
        
        Total Jenis Nilai : <?php 
                            $jumlah_sk = count($this->db->query("select * from kurikulum_sk where id_mapel = $id_mapel 
                                                                                                            and id_kelas = $id_kelas 
                                                                                                            and id_tahun_ajaran = $id_tahun 
                                                                                                            and semester = $semester")->result_array());
                                echo $jumlah_sk;
                            ?>
        <br /><br />
        <style type="text/css">
            table thead tr th.valign {
                text-align: center;
                vertical-align: middle;
            }
        </style>
        <table class="table table-striped table-bordered">
        <thead>
                <tr>
                    <th bgcolor="#6A9EF2" rowspan="2" class="valign">No.</th>
        			<th bgcolor="#6A9EF2" rowspan="2" class="valign">Nama Siswa</th>
                    <th bgcolor="#6A9EF2" colspan="12"><center>Jenis Nilai</center></th>
                    <th bgcolor="#6A9EF2" rowspan="2" class="valign">Nilai Rapor</th>
        			<th bgcolor="#6A9EF2" rowspan="2" class="valign" width="90">AKSI</th>
                </tr>
        		<tr>
                    <th bgcolor="#6A9EF2" >SK1</th>
                    <th bgcolor="#6A9EF2" >SK2</th>
                    <th bgcolor="#6A9EF2" >SK3</th>
                    <th bgcolor="#6A9EF2" >SK4</th>
                    <th bgcolor="#6A9EF2" >SK5</th>
                    <th bgcolor="#6A9EF2" >SK6</th>
                    <th bgcolor="#6A9EF2" >SK7</th>
                    <th bgcolor="#6A9EF2" >SK8</th>
                    <th bgcolor="#6A9EF2" >SK9</th>
                    <th bgcolor="#6A9EF2" >SK10</th>
                    <th bgcolor="#6A9EF2" >UTS</th>
                    <th bgcolor="#6A9EF2" >UAS</th>
        		</tr>
        </thead>
        <tbody>
                <?php 
                $no =1;
                foreach($siswa as $data){
                ?>
                <tr>
                    <td><center><?= $no; $no++; ?></center></td>
                    <td><?= strtoupper($data['nama_siswa']) ; ?></td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'a_sk1' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk1 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk1==0)?"0":ceil($nilai_sk1);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'b_sk2' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk2 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk2==0)?"0":ceil($nilai_sk2);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'c_sk3' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk3 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk3==0)?"0":ceil($nilai_sk3);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'd_sk4' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk4 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk4==0)?"0":ceil($nilai_sk4);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'e_sk5' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk5 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk5==0)?"0":ceil($nilai_sk5);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'f_sk6' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk6 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk6==0)?"0":ceil($nilai_sk6);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'g_sk7' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk7 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk7==0)?"0":ceil($nilai_sk7);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'h_sk8' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk8 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk8==0)?"0":ceil($nilai_sk8);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'i_sk9' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk9 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk9==0)?"0":ceil($nilai_sk9);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'j_sk10' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_sk10 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_sk10==0)?"0":ceil($nilai_sk10);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'k_uts' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_uts = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_uts==0)?"0":ceil($nilai_uts);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'l_uas' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
                                if($sk==null){
                                    echo "-";
                                }else{
                                    $id_sk = $sk[0]['id_sk'];
                                    $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                                    
                                    $b = $this->db->query("select
                                                        sum(nilai) as total
                                                        from
                                                        kurikulum_sk as a
                                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                                        c.id_kd = b.id_kd and
                                                                                        c.id_siswa = $data[id_siswa] and
                                                                                        c.id_kelas = $id_kelas and
                                                                                        c.id_mapel = $id_mapel and
                                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                                        c.semester = $semester")->result_array();
                                    $total_nilai = $b[0]['total'] ;
                                    $nilai_uas = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                                    echo ($nilai_uas==0)?"0":ceil($nilai_uas);
                                }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php 
                                $jumlah_sk = count($this->db->query("select * from kurikulum_sk where id_mapel = $id_mapel 
                                                                                                            and id_kelas = $id_kelas 
                                                                                                            and id_tahun_ajaran = $id_tahun 
                                                                                                            and semester = $semester")->result_array());
                                
                                $sk1 = (empty($nilai_sk1))?0:$nilai_sk1;
                                $sk2 = (empty($nilai_sk2))?0:$nilai_sk2;
                                $sk3 = (empty($nilai_sk3))?0:$nilai_sk3;
                                $sk4 = (empty($nilai_sk4))?0:$nilai_sk4;
                                $sk5 = (empty($nilai_sk5))?0:$nilai_sk5;
                                $sk6 = (empty($nilai_sk6))?0:$nilai_sk6;
                                $sk7 = (empty($nilai_sk7))?0:$nilai_sk7;
                                $sk8 = (empty($nilai_sk8))?0:$nilai_sk8;
                                $sk9 = (empty($nilai_sk9))?0:$nilai_sk9;
                                $sk10 = (empty($nilai_sk10))?0:$nilai_sk10;
                                $uts = (empty($nilai_uts))?0:$nilai_uts;
                                $uas = (empty($nilai_uas))?0:$nilai_uas;
                                
                                if($jumlah_sk!=0){
                                    $rapor = ($sk1+$sk2+$sk3+$sk4+$sk5+$sk6+$sk7+$sk8+$sk9+$sk10+$uts+$uas)/$jumlah_sk;
                                    echo (empty($rapor))?"0":ceil($rapor);
                                }else{
                                    echo "-";
                                }
                                
                                
                                
                                
                            ?>
                        </center>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/nilai/select_input/').'/'.$id_kelas.'/'.$data['id_siswa']; ?>" class="btn ">Input Nilai</a>
                    </td>  
                </tr>
                
                <?php
                $arr_sk1[] = (empty($nilai_sk1))?0:$nilai_sk1;
                $arr_sk2[] = (empty($nilai_sk2))?0:$nilai_sk2;
                $arr_sk3[] = (empty($nilai_sk3))?0:$nilai_sk3;
                $arr_sk4[] = (empty($nilai_sk4))?0:$nilai_sk4;
                $arr_sk5[] = (empty($nilai_sk5))?0:$nilai_sk5;
                $arr_sk6[] = (empty($nilai_sk6))?0:$nilai_sk6;
                $arr_sk7[] = (empty($nilai_sk7))?0:$nilai_sk7;
                $arr_sk8[] = (empty($nilai_sk8))?0:$nilai_sk8;
                $arr_sk9[] = (empty($nilai_sk9))?0:$nilai_sk9;
                $arr_sk10[] = (empty($arr_sk10))?0:$arr_sk10;
                $arr_uts[] = (empty($nilai_uts))?0:$nilai_uts;
                $arr_uas[] = (empty($nilai_uas))?0:$nilai_uas;
                $arr_rapor[] = (empty($rapor))?0:$rapor;
                }           
                ?>
        </tbody>
        </table>
        <?php
        
        $total_siswa = count($siswa);
        $r_sk1 = array_sum($arr_sk1)/$total_siswa;
        $r_sk2 = array_sum($arr_sk2)/$total_siswa;
        $r_sk3 = array_sum($arr_sk3)/$total_siswa;
        $r_sk4 = array_sum($arr_sk4)/$total_siswa;
        $r_sk5 = array_sum($arr_sk5)/$total_siswa;
        $r_sk6 = array_sum($arr_sk6)/$total_siswa;
        $r_sk7 = array_sum($arr_sk7)/$total_siswa;
        $r_sk8 = array_sum($arr_sk8)/$total_siswa;
        $r_sk9 = array_sum($arr_sk9)/$total_siswa;
        $r_sk10 = array_sum($arr_sk10)/$total_siswa;
        $r_uts = array_sum($arr_uts)/$total_siswa;
        $r_uas = array_sum($arr_uas)/$total_siswa;
        $r_rapor = array_sum($arr_rapor)/$total_siswa;
        
        ?>
        <hr />
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th bgcolor="#6A9EF2" colspan="13"><center>Nilai rata-rata kelas</center></th>
                </tr>
                <tr>
                    <th bgcolor="#6A9EF2" ><center>SK1</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK2</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK3</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK4</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK5</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK6</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK7</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK8</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK9</center></th>
                    <th bgcolor="#6A9EF2" ><center>SK10</center></th>
                    <th bgcolor="#6A9EF2" ><center>UTS</center></th>
                    <th bgcolor="#6A9EF2" ><center>UAS</center></th>
                    <th bgcolor="#6A9EF2" ><center>Rapor</center></th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><center><?= ($r_sk1==0)?"-":ceil($r_sk1); ?></center></td>
                    <td><center><?= ($r_sk2==0)?"-":ceil($r_sk2); ?></center></td>
                    <td><center><?= ($r_sk3==0)?"-":ceil($r_sk3); ?></center></td>
                    <td><center><?= ($r_sk4==0)?"-":ceil($r_sk4); ?></center></td>
                    <td><center><?= ($r_sk5==0)?"-":ceil($r_sk5); ?></center></td>
                    <td><center><?= ($r_sk6==0)?"-":ceil($r_sk6); ?></center></td>
                    <td><center><?= ($r_sk7==0)?"-":ceil($r_sk7); ?></center></td>
                    <td><center><?= ($r_sk8==0)?"-":ceil($r_sk8); ?></center></td>
                    <td><center><?= ($r_sk9==0)?"-":ceil($r_sk9); ?></center></td>
                    <td><center><?= ($r_sk10==0)?"-":ceil($r_sk10); ?></center></td>
                    <td><center><?= ($r_uts==0)?"-":ceil($r_uts); ?></center></td>
                    <td><center><?= ($r_uas==0)?"-":ceil($r_uas); ?></center></td>
                    <td><center><?= ($r_rapor==0)?"-":ceil($r_rapor); ?></center></td>
                </tr>
            </tbody>
        </table>
        <br />
        <a href="<?= base_url("admin/rekap/rekap_nilai_guru").'/'.$id_kelas; ?>" class="btn btn-primary">Rekap <img src="<?= base_url();?>/images/component/excel.png" width="20"/></a>
        <?php
        
    }
?>
<hr />
<a href="<?= base_url('admin/nilai/') ?>"><i class="icon-arrow-left"></i> Kembali</a>
