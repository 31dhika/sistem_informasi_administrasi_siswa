<?php 
class absensi extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->helper("tgl_indonesia");
        $this->load->model("admin/m_absensi");
    }
    
    public function index(){
        $id_kelas = $this->session->userdata('id_kelas');   
        $data['title'] = 'Absensi';
        $data['menu'] = 'absensi';
        $data['kelas'] = $this->m_absensi->kelas($id_kelas);
        $data['semester'] = SEMESTER;
        $data['id_tahun'] = ID_TAHUN;
        $this->template->view('admin/absensi/index',$data);
    }
    
    public function input_absen(){
        $id_kelas = $this->uri->segment(4);
        $nama_kelas = $this->m_absensi->kelas($id_kelas);
        $data['title'] = 'Absensi kelas '.$nama_kelas[0]['nama_kelas'];
        $data['menu'] = 'absensi';
        $tahun_ajaran = ID_TAHUN;
        $semester = SEMESTER;
        $data['id_kelas'] = $id_kelas;
        $data['siswa'] = $this->m_absensi->siswa($id_kelas,$semester,$tahun_ajaran);
        $data['cek_is_absen'] = $this->m_absensi->cek_is_absen($id_kelas,$semester,$tahun_ajaran);
        $this->template->view('admin/absensi/input_absen',$data);
    }
    
    public function proses_absen(){
        $id_kelas = $this->input->post('id_kelas');
        $status_absen = $this->input->post('status');
        $id_tahun_ajaran = ID_TAHUN;
        $id_semester = SEMESTER;
        $tgl = date("Y-m-d");
        $cek_status_absen = $this->input->post('cek_status_absen');
        if(isset($cek_status_absen)){
            $this->db->delete('r_absen',array('id_kelas'=>$id_kelas,'tgl'=>$this->input->post('tanggal_exists'),'semester'=>SEMESTER,'id_tahun_ajaran'=>ID_TAHUN));   
        }
        foreach($status_absen as $id_siswa => $status){
            $data = array(
                            'id_absen'=>"",
                            'id_siswa'=>$id_siswa,
                            'id_kelas'=>$id_kelas,
                            'id_tahun_ajaran'=>$id_tahun_ajaran,
                            'semester'=>$id_semester,
                            'tgl'=>$tgl,
                            'id_status_absen'=>$status
                            );
            $this->db->insert('r_absen',$data);
        }
        
        redirect('admin/absensi/index');
    }
    
    public function lihat_absen(){
        $id_kelas = $this->uri->segment(4);
        $data['menu'] = 'absensi';
        $nama_kelas = $this->m_absensi->kelas($id_kelas);
        $data['title'] = 'Absensi kelas '.$nama_kelas[0]['nama_kelas'];
        $tahun_ajaran = ID_TAHUN;
        $data['tgl1'] = $this->input->post("tgl1");
        $data['tgl2'] = $this->input->post("tgl2");
        $data['submit'] = $this->input->post("submit");
        $data['semester'] = SEMESTER;
        $data['id_tahun'] = $tahun_ajaran;
        $data['id_kelas'] = $id_kelas;
        $data['get_kelas'] = $this->m_absensi->get_kelas($id_kelas,$tahun_ajaran);
        $this->template->view("admin/absensi/lihat_absen",$data);
    }
    
       
    
}
?>