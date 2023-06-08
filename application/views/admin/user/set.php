<h3><u><?php echo $title; ?></u></h3>
<hr />
<?php 
$arr = array();
$id_matpel = 0;
foreach($get_selected as $selected){
    $arr[] = $selected['id_kelas'];
    $id_matpel = $selected['id_mata_pelajaran'];
}
?>
<form action="<?= base_url("admin/user/proses_set"); ?>" method="post">
<table>
    <tr>
        <td>Mata Pelajaran</td>
        <td>: 

        <select name="mata_pelajaran">
        <option>-- Pilih --</option>
        <?php 
        foreach($get_data as $keys=>$matpel){ ?>
        <?php if($id_matpel == $keys){ ?>
        <option selected="" value="<?= $keys; ?>"><?= $matpel ?></option>
        
        <?php } else { ?>
        <option value="<?= $keys; ?>"><?= $matpel ?></option>
        
        <?php } ?>
        <?php } ?>    
        </select>
        </td>
    </tr>
        
</table>
<table class="table table-striped table-bordered">
<tr>
    <th>Nama kelas</th>
    <th>Action</th>
</tr>

<?php 
        foreach($kelas as $key=>$kls){ ?>
        <tr>
            <td><?= $kls; ?></td>
            <td>
            <?php if(in_array($key,$arr)){ ?>
            <input checked="" type="checkbox" value="<?= $key; ?>" name="kelas[]"/>
            <?php } else { ?>
            <input type="checkbox" value="<?= $key; ?>" name="kelas[]"/>
            <?php } ?>            
            </td>
        </tr>
        <?php } ?>
</table>
<input type="hidden" name="id_admin" value="<?= $id_admin; ?>"/>
<input type="submit" name="submit" value="submit"/> <a href="<?= base_url("admin/user/index"); ?>">kembali</a>
</form>