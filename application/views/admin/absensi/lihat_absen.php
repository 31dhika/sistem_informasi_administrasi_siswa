<h3><u><?php echo $title; ?></u></h3><hr />
<form action="<?= base_url("admin/absensi/lihat_absen")."/".$id_kelas; ?>" method="post">
<table>
    <tr>
        <td>Tanggal</td>
        <td>:
            <div class="input-append date" id="date1" data-date-format="dd-mm-yyyy">
            <input class="span2" size="105" type="text"  name="tgl1"/><span class="add-on"><i class="icon-th"></i></span>
            </div>
        </td>
    </tr>
    <tr>
        <td>Sampai</td>
        <td>:
            <div class="input-append date" id="date2" data-date-format="dd-mm-yyyy">
            <input class="span2" size="105" type="text"  name="tgl2"/><span class="add-on"><i class="icon-th"></i></span>
            </div>
        </td>
    </tr>
    <tr>
        <td><input type="submit" name="submit" value="Submit" class="btn"/> </td>
    </tr>
</table>
<br />
* jika ingin melihat absensi siswa per-semester, kosongkan form !!
</form>
<hr />

<?php 

if($submit){
    
    if($tgl1=="" or $tgl2==""){
       ?>
       <h5><u>Data Absensi Siswa Semester <?= $semester; ?></u></h5>
       <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th bgcolor="#6A9EF2">No</th>
                <th bgcolor="#6A9EF2">Nama</th>
                <th bgcolor="#6A9EF2">Masuk</th>
                <th bgcolor="#6A9EF2">Izin</th>
                <th bgcolor="#6A9EF2">Sakit</th>
                <th bgcolor="#6A9EF2">Tanpa Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach($get_kelas as $siswa){
        
            $masuk = $this->db->query("select count(*) as total from r_absen where id_status_absen = 1
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester")->result_array();
                                                                                    
            $izin = $this->db->query("select count(*) as total from r_absen where id_status_absen = 2
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester")->result_array();
                                                                                    
            $sakit = $this->db->query("select count(*) as total from r_absen where id_status_absen = 3
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester")->result_array();
                                                                                    
            $tanpa_keterangan = $this->db->query("select count(*) as total from r_absen where id_status_absen = 4
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester")->result_array();
        ?>
        
        <tr>
            <td><?= $n; $n++; ?></td>
            <td><?= $siswa["nama_siswa"]; ?></td>
            <td><?= $masuk[0]["total"]; ?></td>
            <td><?= $izin[0]["total"]; ?></td>
            <td><?= $sakit[0]["total"]; ?></td>
            <td><?= $tanpa_keterangan[0]["total"]; ?></td>
        </tr>
        
        <?php
        }
        ?>
            </tbody>
        </table>
       
       <?php
    }else{
        ?>
    <h5>Data absensi tanggal <u><?= ($tgl1=="")?"( - )":tgl_indo($tgl1); ?></u> s/d <u><?= ($tgl2=="")?"( - )":tgl_indo($tgl2); ?></u></h5>
    
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th bgcolor="#6A9EF2">No</th>
            <th bgcolor="#6A9EF2">Nama</th>
            <th bgcolor="#6A9EF2">Masuk</th>
            <th bgcolor="#6A9EF2">Izin</th>
            <th bgcolor="#6A9EF2">Sakit</th>
            <th bgcolor="#6A9EF2">Tanpa Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $dateFilter = " AND tgl BETWEEN '".$tgl1."' AND '".$tgl2."'";
        $n = 1;
        foreach($get_kelas as $siswa){
        
            $masuk = $this->db->query("select count(*) as total from r_absen where id_status_absen = 1
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester
                                                                                    ".$dateFilter." ")->result_array();
                                                                                    
            $izin = $this->db->query("select count(*) as total from r_absen where id_status_absen = 2
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester
                                                                                    ".$dateFilter." ")->result_array();
                                                                                    
            $sakit = $this->db->query("select count(*) as total from r_absen where id_status_absen = 3
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester
                                                                                    ".$dateFilter." ")->result_array();
                                                                                    
            $tanpa_keterangan = $this->db->query("select count(*) as total from r_absen where id_status_absen = 4
                                                                                    and id_siswa = $siswa[id_siswa]
                                                                                    and id_kelas = $siswa[id_kelas]
                                                                                    and id_tahun_ajaran = $id_tahun
                                                                                    and semester = $semester
                                                                                    ".$dateFilter." ")->result_array();
        ?>
        
        <tr>
            <td><?= $n; $n++; ?></td>
            <td><?= $siswa["nama_siswa"]; ?></td>
            <td><?= $masuk[0]["total"]; ?></td>
            <td><?= $izin[0]["total"]; ?></td>
            <td><?= $sakit[0]["total"]; ?></td>
            <td><?= $tanpa_keterangan[0]["total"]; ?></td>
        </tr>
        
        <?php
        }
        ?>
        </tbody>
    </table>
    
    
    
    
<?php }}
?>

<hr />

<a href="<?= base_url("admin/absensi/index") ?>"><i class="icon-arrow-left"></i> Kembali</a>





