<h3><u><?php echo $title; ?></u></h3><hr />

<?php 
    if($this->session->flashdata("error_nilai")){
        echo $this->session->flashdata("error_nilai");
    }
    elseif($this->session->flashdata("error_kd")){
        echo $this->session->flashdata("error_kd");
    }
    elseif($this->session->flashdata("error_null")){
        echo $this->session->flashdata("error_null");
    }
    elseif($this->session->flashdata("error_format")){
        echo $this->session->flashdata("error_format");
    }
    elseif($this->session->flashdata("error_lenght")){
        echo $this->session->flashdata("error_lenght");
    }
?>

<form action="<?= base_url("admin/nilai/proses_input")."/".$id_kelas."/".$id_siswa."/".$id_sk; ?>" method="post">
    <table>
        <tr>
            <td>Jenis KD&nbsp;&nbsp;</td>
            <td>: 
                <select name="kd" style="margin-top: 10px;">
                    <?php 
                        foreach($kd as $data){
                            ?><option value="<?= $data["id_kd"]; ?>"><?= strtoupper(substr($data['jenis_kd'],2,10)); ?></option><?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nilai&nbsp;&nbsp;</td>
            <td>: <input type="text" name="nilai" style="margin-top: 10px;" maxlength="3"/></td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;&nbsp;<input type="submit" name="submit"  value="Submit" class="btn"/></td>
        </tr>
    </table>
</form>
<hr />
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th bgcolor="#6A9EF2">Jenis KD</th>
            <th bgcolor="#6A9EF2">Nilai</th>
            <th bgcolor="#6A9EF2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($nilai_kd as $data){
                ?>
                <tr>
                    <td><?= strtoupper(substr($data['jenis_kd'],2,10)); ?></td>
                    <td><?= ($data["nilai"]==null)?"-": $data["nilai"]; ?></td>
                    <td>
                        <?php if($data['nilai']==null){echo "-";}else{?>
                                <a href="#edit_nilai_<?= $data['id_nilai']; ?>" role="button" class="btn" data-toggle="modal">Edit Nilai</a>
                                <!-- Modal tambah ekskul-->
                                <div id="edit_nilai_<?= $data['id_nilai']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                <h3 id="myModal">Edit Nilai <?= strtoupper(substr($data['jenis_kd'],2,10)); ?></h3>
                                </div>
                                <div class="modal-body">
                                <form action="<?= base_url("admin/nilai/update_nilai")."/".$data['id_nilai'].'/'.$id_kelas.'/'.$id_siswa.'/'.$id_sk; ?>" method="post">
                                <p>
                                <input type="text" name="nilai" value="<?= $data["nilai"]; ?>" maxlength="3"/>
                                </p>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                                </div>
                                </form>
                                </div>
                        <?php } ?>
                    
                    </td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<hr />
<a href="<?= base_url("admin/nilai/select_input")."/".$id_kelas."/".$id_siswa; ?>"><i class="icon-arrow-left"></i> Kembali</a> 