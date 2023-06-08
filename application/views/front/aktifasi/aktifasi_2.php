<h3><u>Aktifasi</u></h3>
<hr />
<?php 
    if($this->session->flashdata("error_account_siswa")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_account_siswa") ?></div>
        <?php
    }elseif($this->session->flashdata("error_pass_siswa")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_pass_siswa") ?></div>
        <?php
    }elseif($this->session->flashdata("error_field")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_field") ?></div>
        <?php
    }
    elseif($this->session->flashdata("error_pass_karakter")){
        ?>
        <div class="alert alert-error"><?= $this->session->flashdata("error_pass_karakter") ?></div>
        <?php
    }
?>
Silahkan isi form dibawah ini untuk membuat account baru
<br /><br />
<form action="<?= base_url("aktifasi/proses_form_2"); ?>" method="post">
<table>
    <tr>
        <td>Username &nbsp;</td>
        <td>: <input type="text" name="username"/></td>
    </tr>
    <tr>
        <td>Password &nbsp;</td>
        <td>: <input type="password" name="pass_1"/></td>
    </tr>
    <tr>
        <td>Ulangi Password &nbsp;</td>
        <td>: <input type="password" name="pass_2"/></td>
    </tr>
    <tr>
        <td></td>
        <td>&nbsp;&nbsp;<input type="submit" value="Submit" class="btn"/></td>
    </tr>
</table>
    <input type="hidden" name="id_siswa" value="<?= $id_siswa; ?>"/>
</form>