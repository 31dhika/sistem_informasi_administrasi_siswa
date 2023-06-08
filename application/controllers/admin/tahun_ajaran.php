<?php 

class tahun_ajaran extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        $this->load->model('admin/m_tahun_ajaran');
    }
    
    public function index(){
        $data['title'] = "Tahun Ajaran" ;
        $data['menu'] = "tahun_ajaran" ;
        $data['tahun_ajaran'] = $this->db->query('select * from m_tahun_ajaran order by id_tahun_ajaran desc')->result_array();
        $this->template->view("admin/tahun_ajaran/index",$data);
    }
    
    public function add_tahun(){
        $this->m_tahun_ajaran->insert_tahun_ajaran();
        redirect('admin/tahun_ajaran/'); 
    }
    
    public function input_siswa(){
        $data['title'] = "Input Siswa ke Kelas" ;
        $data['menu'] = "tahun_ajaran" ;
        $id = $this->uri->segment(4);
        $data['id_tahun'] = $id;
        $data['select'] = $this->db->query("select * from m_kelas ")->result_array();
        $this->m_tahun_ajaran->cek_status_aktif($id);
        $this->template->view('admin/tahun_ajaran/pilih_kelas',$data);
    }
    
    public function input_siswa_kelas(){
        $id_tahun = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $query = $this->db->query("select nama_kelas from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_kelas = $query[0]['nama_kelas'];
        $data['title'] = "Input Siswa ke Kelas $nama_kelas" ;
        $data['menu'] = "tahun_ajaran" ;
        $data['id_kelas'] = $id_kelas;
        $data['id_tahun'] = $id_tahun;
        $data['select'] = $this->m_tahun_ajaran->select_siswa($id_tahun,$id_kelas);
        $this->template->view('admin/tahun_ajaran/form_input',$data);
    }
    
    public function proses_input_siswa(){
        $id_tahun = $this->input->post('id_tahun');
        $id_kelas = $this->input->post('id_kelas');
        $siswa = $this->input->post('siswa');
        $query = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $status = $query[0]['status'];
        
        foreach ($siswa as $data){
            $this->db->query("insert into r_kelas_siswa values ($data,$id_kelas,$id_tahun,$status)");
        }
        
        redirect('admin/tahun_ajaran/input_siswa/'.$id_tahun);
    }
    
    public function active(){
        $id = $this->uri->segment(4);
        $this->db->query("update m_tahun_ajaran set status = 0");
        $this->db->query("update m_tahun_ajaran set status = 1 where id_tahun_ajaran = $id");
        redirect('admin/tahun_ajaran/');
    }
    
}
?>