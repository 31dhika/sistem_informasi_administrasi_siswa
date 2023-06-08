<h3><u><?php echo $title; ?></u></h3>
<hr />
<form action="<?php echo base_url('admin/siswa/proses_ubah'); ?>" method="post" enctype="multipart/form-data">

<table class="table table-bordered">
    <tr>
        <td>NIS</td>
        <td>: <input type="text" name="nis"/></td>
    </tr>
    <tr>
        <td>Nama Siswa</td>
        <td>: <input type="text" name="nama_siswa"/></td>
    </tr>
    <tr>
        <td>Tempat Lahir</td>
        <td>: <input type="text" name="tempat_lahir"/></td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>: 
        <!--<input type="text" id="dp1"/>-->
        
            <div class="input-append date" id="dp3" data-date-format="dd-mm-yyyy">
            <input class="span2" size="105" type="text"  name="tanggal_lahir"/><span class="add-on"><i class="icon-th"></i></span>
            </div>
        
        
        </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: <select name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
            </select></td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>: <select name="agama">
                    <option value="">-- Pilih --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
            </select></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <textarea name="alamat"></textarea></td>
    </tr>
    <tr>
        <td>Photo</td>
        <td>: <input type="file" name="userfile" size="20"/></td>
    </tr>
    <tr>
        <td>Nama Ayah</td>
        <td>: <input type="text" name="nama_ayah"/></td>
    </tr>
    <tr>
        <td>Nama Ibu</td>
        <td>: <input type="text" name="nama_ibu"/></td>
    </tr>
    <tr>
        <td>Alamat Ayah</td>
        <td>: <textarea name="alamat_ayah"></textarea></td>
    </tr>
    <tr>
        <td>Alamat Ibu</td>
        <td>: <textarea name="alamat_ibu"></textarea></td>
    </tr>
    <tr>
        <td>No. Telepon Ayah</td>
        <td>: <input type="text" name="no_tlp_ayah"/></td>
    </tr>
    <tr>
        <td>No. Telepon Ibu</td>
        <td>: <input type="text" name="no_tlp_ibu"/></td>
    </tr>
    <tr>
        <td>Status Perwalian</td>
        <td>: 
            <select name="status_perwalian">
                <option value="">-- Pilih --</option>
                <option value="Wali">Wali</option>
                <option value="Kandung">Kandung</option>
            </select>
        </td>
    </tr>
</table>
<input type="submit" name="simpan" class="btn btn-primary" value="Simpan"/> <input type="reset" class="btn btn-info"/>
<a href="<?php echo base_url('admin/siswa/'); ?>" class="btn btn-danger">Kembali</a>
</form> 