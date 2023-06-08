<?php 

class user_wali extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        define('ID_TAHUN',checkTahunAjaranActive());
        $this->load->model('admin/m_user_wali');
        $this->load->library("pagination");
    }
    
    public function index(){
        $data['menu'] = "user_wali";
        $data['title'] = "Akun Wali Kelas";
        $data['id_tahun'] = ID_TAHUN;
        $data['id_tahun'] = ID_TAHUN;
        $search = $this->input->post("search");
        
        if($search){
            $a = $this->db->query("select * from login_admin where tipe = 'wali' and nama like '%$search%' order by nama asc")->result_array();
        }else{
            $a = $this->db->query("select * from login_admin where tipe = 'wali' order by nama asc")->result_array();
        }
        
        if($a==null){
            ?><script type="text/javascript">window.alert("Data '<?= $search ?>' tidak ada");history.back();</script><?php
        }
        
        $config['base_url'] = base_url('admin/user_wali/index');
        $config['total_rows'] = count($a);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $limit = ($this->uri->segment(4)=="")?0:$this->uri->segment(4);
        $offset = $config['per_page'];
        
        if($search){
            $data['wali'] = $this->db->query("select * from login_admin where tipe = 'wali' and nama like '%$search%' order by nama asc limit $limit,$config[per_page]")->result_array();
        }else{
            $data['wali'] = $this->db->query("select * from login_admin where tipe = 'wali' order by nama asc limit $limit,$offset")->result_array();
        }
        $this->template->view("admin/user_wali/index",$data);
    }
    
    public function add_wali(){
        $nama = $this->input->post("nama");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->m_user_wali->add_wali($nama,$username,$password);
    }
    
    public function update_wali(){
        $id = $this->uri->segment(4);
        $nama = $this->input->post("nama");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->m_user_wali->update_wali($nama,$username,$password,$id);
    }
    
    public function delete(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from login_admin where id_admin = $id");
        $this->db->query("delete from r_wali_kelas where id_admin = $id");
        redirect('admin/user_wali');
    }
    
    public function set_wali(){
        $data['menu'] = "user_wali";
        $data['title'] = "Set Akun Kelas";
        $id_tahun = ID_TAHUN;
        $data['id_tahun'] = $id_tahun;
        $data['kelas'] = $this->db->query("select 
                                            a.id_kelas,a.nama_kelas,   
                                            c.nama,c.id_admin
                                            from
                                            m_kelas as a
                                            left join r_wali_kelas as b on b.id_kelas = a.id_kelas and b.id_tahun_ajaran = $id_tahun
                                            left join login_admin as c on c.id_admin = b.id_admin")->result_array();
        $this->template->view("admin/user_wali/set_wali",$data);
    }
    
    public function save_wali(){
        $id_admin = $this->input->post('wali');
        $id_kelas = $this->input->post('id_kelas');
        $id_tahun_ajaran = ID_TAHUN;
        if($id_admin==""){
            redirect('admin/user_wali/set_wali');
        }else{
            $this->db->query("insert into r_wali_kelas (id_admin,id_kelas,id_tahun_ajaran)
                            values ($id_admin,$id_kelas,$id_tahun_ajaran)");
            redirect('admin/user_wali/set_wali');
        }
    }
    
    public function remove(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from r_wali_kelas where id_admin = $id");
        redirect('admin/user_wali/set_wali');
    }
        
}

?>