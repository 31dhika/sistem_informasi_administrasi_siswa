<?php 

class m_user_wali extends CI_Model{
    
    public function add_wali($nama,$username,$password){
        $select = $this->db->query("select * from login_admin where username = '$username' and tipe = 'wali'")->result_array();
        
        if($nama=="" or $username=="" or $password==""){
            ?><script type="text/javascript">window.alert("Field tidak boleh ada yang kosong");history.back();</script><?php
        }
        elseif($select!=null){
            ?><script type="text/javascript">window.alert("Maaf Username Sudah Ada");history.back();</script><?php
        }
        elseif(strlen($password) <= 5){
            ?><script type="text/javascript">window.alert("Password minimal 6 Karakter");history.back();</script><?php
        }
        else{
            $p = md5($password);
            $this->db->query("insert into login_admin (id_admin,nama,username,password,tipe) values ('','$nama','$username','$p','wali')");
            redirect("admin/user_wali");
        }
    }
    
    public function update_wali($nama,$username,$password,$id){
        $select = $this->db->query("select * from login_admin where username = '$username' and tipe = 'wali' and id_admin != '$id'")->result_array();
        
        if($nama=="" or $username=="" or $password==""){
            ?><script type="text/javascript">window.alert("Field tidak boleh ada yang kosong");history.back();</script><?php
        }
        elseif($select!=null){
            ?><script type="text/javascript">window.alert("Maaf Username Sudah Ada");history.back();</script><?php
        }
        elseif(strlen($password) <= 5){
            ?><script type="text/javascript">window.alert("Password minimal 6 Karakter");history.back();</script><?php
        }
        else{
            $p = md5($password);
            $this->db->query("update login_admin set nama='$nama',username='$username',password='$p' where id_admin = $id");
            redirect('admin/user_wali');
        }
    }
}

?>