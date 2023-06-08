<?php 

class m_user_guru extends CI_Model{
    
    public function add($nama,$username,$password){
        $select = $this->db->query("select * from login_admin where username = '$username' and tipe = 'guru'")->result_array();
        
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
            $this->db->query("insert into login_admin (id_admin,nama,username,password,tipe) values ('','$nama','$username','$p','guru')");
            redirect("admin/user_guru");
        }
    }
    
    public function update($nama,$username,$password,$id){
        $select = $this->db->query("select * from login_admin where username = '$username' and tipe = 'guru' and id_admin != '$id'")->result_array();
        
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
            redirect('admin/user_guru');
        }
    }
    
    public function get_pelajaran($id_kelas,$id_tahun){
        return $this->db->query("select a.id_kelas,e.id_admin,d.id_mata_pelajaran,d.nama_mata_pelajaran,f.nama from
                                                r_siswa_kelas_paket as a
                                                join m_paket as b on b.id_paket = a.id_paket
                                                join r_paket_pelajaran as c on c.id_paket = b.id_paket
                                                join m_mata_pelajaran as d on d.id_mata_pelajaran = c.id_mata_pelajaran
                                                left join r_guru as e on e.id_kelas = $id_kelas and e.id_mata_pelajaran = d.id_mata_pelajaran and e.id_tahun_ajaran = $id_tahun
                                                left join login_admin as f on f.id_admin = e.id_admin
                                                where a.id_kelas = $id_kelas")->result_array();
    }
    
}

?>