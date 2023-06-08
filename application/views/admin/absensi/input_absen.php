<h3><u><?php echo $title; ?></u></h3><hr />
<?php if($cek_is_absen[0]['count'] > 0){ ?>
<div class="alert alert-success">
    Siswa di kelas ini sudah di absen
</div>
<?php } ?>

<?php 
    if($siswa==null){
        echo 'Tidak ada siswa di kelas ini';
    }else{
        ?>
        <style type="text/css">
            table thead tr th.valign {
                text-align: center;
                vertical-align: middle;
            }
        </style>
        <form action="<?= base_url('admin/absensi/proses_absen'); ?>" method="post">
        <table class="table table-striped table-bordered">
        <thead>
        		<tr>
                    <th bgcolor="#6A9EF2" rowspan="2" width="40" class="valign">No.</th>
        			<th bgcolor="#6A9EF2" rowspan="2" class="valign">Nama Siswa</th>
                    <th bgcolor="#6A9EF2" colspan="4" style="text-align: center;">Status Absen</th>
        		</tr>
                <tr>
                    <th bgcolor="#6A9EF2">Masuk</th>
                    <th bgcolor="#6A9EF2">Izin</th>
                    <th bgcolor="#6A9EF2">Sakit</th>
                    <th bgcolor="#6A9EF2">Tanpa Keterangan</th>
                </tr>
        </thead>
        <tbody>
                <?php 
                $no =1;
                foreach($siswa as $data){
                ?>
                <tr>
                    <td><?= $no; $no++; ?></td>
                    <td><?= $data['nama_siswa']; ?></td>
                    <td>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="1" checked="" />
                    </td>
                    <td>
                        <?php if($data['id_status_absen'] == 2){ ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="2" checked=""/>
                        <?php } else { ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="2"/>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($data['id_status_absen'] == 3){ ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="3" checked=""/>
                        <?php } else { ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="3"/>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($data['id_status_absen'] == 4){ ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="4" checked=""/>
                        <?php } else { ?>
                        <input type="radio" name="status[<?= $data['id_siswa']; ?>]" value="4"/>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                }
                      
                ?>
        </tbody>
        </table>
        <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>"/>
        <?php if($cek_is_absen[0]['count'] > 0){ ?>
            <input type="hidden" name="cek_status_absen" value="1"/>
            <input type="hidden" name="tanggal_exists" value="<?= $cek_is_absen[0]['tgl'] ?>" />
        <?php } ?>
        <button type="submit" class="btn">Submit</button>
        </form>
        <?php
    }
    
?>
<hr />

<a href="<?= base_url('admin/absensi/index') ?>"><i class="icon-arrow-left"></i> Kembali</a>
