<?php 

class nilai extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id_siswa')){
            redirect(base_url());
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->model("m_nilai");
    }
    
    public function index(){
        $id_siswa = $this->session->userdata("id_siswa");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $data['mapel'] = $this->m_nilai->mapel($id_siswa,$id_tahun);
        $data['menu'] = 'nilai';
        $data['title'] = "Nilai";
        $data['id_siswa'] = $id_siswa;
        $data['tahun'] = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $id_tahun")->result_array();
        $data['semester'] = $semester;
        $this->frontpage->view("front/nilai/index",$data);
    }
    
    public function view_sk(){
        $id_siswa = $this->session->userdata("id_siswa");
        $id_mapel = $this->uri->segment(3);
        $id_kelas = $this->uri->segment(4);
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $data['mapel'] = $this->db->query("select * from m_mata_pelajaran where id_mata_pelajaran = $id_mapel")->result_array();
        $data['menu'] = 'nilai';
        $data['title'] = "Nilai";
        $data['jenis_nilai'] = $this->db->query("select * from kurikulum_sk where id_mapel = $id_mapel and id_kelas = $id_kelas")->result_array();
        $data['tahun'] = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $id_tahun")->result_array();
        $data['semester'] = $semester;
        $this->frontpage->view("front/nilai/view_sk",$data);
    }
    
    public function view_kd(){
        $id_siswa = $this->session->userdata("id_siswa");
        $id_sk = $this->uri->segment(3);
        $id_mapel = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $data['menu'] = 'nilai';
        $data['title'] = "Nilai";
        $data['mapel'] = $this->db->query("select * from m_mata_pelajaran where id_mata_pelajaran = $id_mapel")->result_array();
        $data['nama_sk'] = $this->db->query("select * from kurikulum_sk where id_sk = $id_sk")->result_array();
        $data['nilai'] = $this->m_nilai->nilai($id_siswa,$id_kelas,$id_mapel,$id_tahun,$semester,$id_sk);
        $data['id_mapel'] = $id_mapel;
        $data['id_kelas'] = $id_kelas;
        $data['tahun'] = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $id_tahun")->result_array();
        $data['semester'] = $semester;
        $this->frontpage->view("front/nilai/view_kd",$data);
    }
}

?>