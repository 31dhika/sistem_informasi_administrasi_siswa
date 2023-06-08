<?php 

class user_guru extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        $this->load->model('admin/m_user_guru');
        $this->load->library("pagination");
    }
    
    public function index(){
        $data['title'] = "Akun Guru";
        $data['menu'] = "user_guru";
        $data['id_tahun'] = ID_TAHUN;
        $search = $this->input->post("search");
        
        if($search){
            $a = $this->db->query("select * from login_admin where tipe = 'guru' and nama like '%$search%' order by nama asc")->result_array();
        }else{
            $a = $this->db->query("select * from login_admin where tipe = 'guru' order by nama asc")->result_array();
        }
        
        if($a==null){
            ?><script type="text/javascript">window.alert("Data '<?= $search ?>' tidak ada");history.back();</script><?php
        }
        
        $config['base_url'] = base_url('admin/user_guru/index');
        $config['total_rows'] = count($a);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $limit = ($this->uri->segment(4)=="")?0:$this->uri->segment(4);
        $offset = $config['per_page'];
        
        if($search){
            $data['guru'] = $this->db->query("select * from login_admin where tipe = 'guru' and nama like '%$search%' order by nama asc limit $limit,$config[per_page]")->result_array();
        }else{
            $data['guru'] = $this->db->query("select * from login_admin where tipe = 'guru' order by nama asc limit $limit,$offset")->result_array();
        }
        
        $this->template->view('admin/user_guru/index',$data);
    
    }
    
    public function add_guru(){
        $nama = $this->input->post("nama");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->m_user_guru->add($nama,$username,$password);
    }
    
    public function delete(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from login_admin where id_admin = $id");
        $this->db->query("delete from r_guru where id_admin = $id");
        redirect('admin/user_guru');
    }
    
    public function update_guru(){
        $id = $this->uri->segment(4);
        $nama = $this->input->post("nama");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->m_user_guru->update($nama,$username,$password,$id);
    }
    
    public function kelas(){
        $data['title'] = "Set Akun Guru";
        $data['menu'] = "user_guru";
        $data['kelas'] = $this->db->query("select * from m_kelas")->result_array();
        $this->template->view('admin/user_guru/kelas',$data);
    }
    
    public function pelajaran(){
        $id_kelas = $this->uri->segment(4);
        $kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $data['title'] = "Set Akun Guru Kelas ( ".$kelas[0]['nama_kelas']." )";
        $data['menu'] = "user_guru";
        $id_tahun = ID_TAHUN;
        $data['id_tahun'] = $id_tahun;
        $data['pelajaran'] = $this->m_user_guru->get_pelajaran($id_kelas,$id_tahun);
        $data['guru'] = $this->db->query("select * from login_admin where tipe = 'guru' and id_admin not in (select id_admin from r_guru)")->result_array();
        $this->template->view('admin/user_guru/pelajaran',$data);
    }
    
    public function remove(){
        $id_admin = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $id_tahun = ID_TAHUN;
        $this->db->query("delete from r_guru where id_admin = $id_admin and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun");
        redirect("admin/user_guru/pelajaran".'/'.$id_kelas);
    }

    public function proses_input(){
        $id_kelas = $this->uri->segment(4);
        $id_mata_pelajaran = $this->input->post('id_mapel');
        $id_admin = $this->input->post('guru');
        $tahun = ID_TAHUN;
        $this->db->query("insert into r_guru (id_admin,id_kelas,id_mata_pelajaran,id_tahun_ajaran) values ('$id_admin','$id_kelas','$id_mata_pelajaran','$tahun')");
        redirect("admin/user_guru/pelajaran".'/'.$id_kelas);
    }
}
?>