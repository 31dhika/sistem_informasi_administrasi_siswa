<?php 

class user_siswa extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        $this->load->helper("tgl_indonesia");
        $this->load->library("pagination");
    }
    
    public function index(){
        $data['title'] = "Akun Siswa";
        $data['menu'] = "user_siswa";
        $search = $this->input->post("search");
        if($search){
            $a = $this->db->query("select
                                        b.nama_siswa,b.id_siswa,a.username,a.created
                                    from
                                    login_siswa as a
                                    join m_siswa as b on b.id_siswa = a.id_siswa
                                    where b.nama_siswa like '%$search%'
                                    order by b.nama_siswa asc ")->result_array();
        }else{
             $a = $this->db->query("select
                                        b.nama_siswa,b.id_siswa,a.username,a.created
                                    from
                                    login_siswa as a
                                    join m_siswa as b on b.id_siswa = a.id_siswa
                                    order by b.nama_siswa asc ")->result_array();
        }
        
        if($a==null){
            ?><script type="text/javascript">window.alert("Data '<?= $search ?>' tidak ada");history.back();</script><?php
        }
        
        $config['base_url'] = base_url('admin/user_siswa/index');
        $config['total_rows'] = count($a);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $limit = ($this->uri->segment(4)=="")?0:$this->uri->segment(4);
        $offset = $config['per_page'];
        
        if($search){
            $data['siswa'] = $this->db->query("select
                                        b.nama_siswa,b.id_siswa,a.username,a.created
                                    from
                                    login_siswa as a
                                    join m_siswa as b on b.id_siswa = a.id_siswa
                                    where b.nama_siswa like '%$search%'
                                    order by b.nama_siswa asc limit $limit,$offset")->result_array();
        }else{
            $data['siswa'] = $this->db->query("select
                                        b.nama_siswa,b.id_siswa,a.username,a.created
                                    from
                                    login_siswa as a
                                    join m_siswa as b on b.id_siswa = a.id_siswa
                                    order by b.nama_siswa asc limit $limit,$offset")->result_array();
        }
        
        $this->template->view("admin/user_siswa/index",$data);
    }
    
    public function delete(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from login_siswa where id_siswa = $id");
        redirect("admin/user_siswa/");
    }
    
    public function update_siswa(){
        $id = $this->uri->segment(4);
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        
        $select = $this->db->query("select * from login_siswa where username = '$username' and id_siswa != $id")->result_array();
        
        if($username=="" or $password==""){
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
            $this->db->query("update login_siswa set username='$username',password='$p' where id_siswa = $id");
            redirect("admin/user_siswa/");
        }
        
        
    }
    
}

?>