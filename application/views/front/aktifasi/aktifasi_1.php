<h3><u>Aktifasi</u></h3>
<hr />
<?php 
    if($this->session->flashdata("error_data_siswa")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_data_siswa") ?></div>
        <?php
    }elseif($this->session->flashdata("error_acc_siswa")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_acc_siswa") ?></div>
        <?php
    }
?>
Silahkan masukkan data anda pada form dibawah ini, untuk di-validasi
<br /><br />
<form action="<?= base_url("aktifasi/proses_form_1"); ?>" method="post">
    <table>
        <tr>
            <td>NIS &nbsp;</td>
            <td>: &nbsp;<input type="text" name="nis" style="width: 195px !important;"/></td>
        </tr>
        <tr>
            <td>Tanggal Lahir &nbsp;</td>
            <td>:&nbsp;
                <select name="hari" style="width: 60px !important;">
                    <option value="">Tgl</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <?php 
                    for($i=10;$i<=31;$i++){
                        ?><option value="<?= $i; ?>"><?= $i; ?></option><?php
                    }
                    ?>
                </select>
                <select name="bulan" style="width: 60px !important;">
                    <option value="">Bln</option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">Mar</option>
                    <option value="04">Apr</option>
                    <option value="05">Mei</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Ags</option>
                    <option value="09">Sep</option>
                    <option value="10">Okt</option>
                    <option value="11">Nov</option>
                    <option value="12">Des</option>
                </select>
                <select name="tahun" style="width: 80px !important;">
                    <option value="">Thn</option>
                    <?php 
                    for($i=1995;$i<=2005;$i++){
                        ?><option value="<?= $i; ?>"><?= $i; ?></option><?php
                    }
                    ?>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" class="btn"/></td>
        </tr>
    </table>
</form>