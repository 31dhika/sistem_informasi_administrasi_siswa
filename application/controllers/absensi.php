<?php 

class absensi extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id_siswa')){
            redirect(base_url());
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->model("m_absensi");
    }
    
    public function index(){
        $id_siswa = $this->session->userdata("id_siswa");
        $tahun = ID_TAHUN;
        $semester = SEMESTER;
        $data['menu'] = 'absensi';
        $data['title'] = "Absensi";   
        $data['semester'] = $semester;
        $data['tahun'] = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $tahun")->result_array();
        $data['izin'] = $this->m_absensi->izin($id_siswa,$tahun,$semester);
        $data['sakit'] = $this->m_absensi->sakit($id_siswa,$tahun,$semester);
        $data['tanpa_keterangan'] = $this->m_absensi->tanpa_keterangan($id_siswa,$tahun,$semester);
        $this->frontpage->view("front/absensi/index",$data);
    }
}

?>