<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class beranda extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id_siswa')){
            redirect(base_url());
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->helper("tgl_indonesia");
    }
	
	public function index()
	{
        $data['title'] = 'Beranda';
        $data['menu'] = 'beranda';
        $id_siswa = $this->session->userdata('id_siswa');
        $id_tahun = ID_TAHUN;
        $data['siswa'] = $this->db->query("select * from
                                                m_siswa as a
                                                left join r_kelas_siswa as b on b.id_siswa = a.id_siswa and b.id_tahun_ajaran = $id_tahun
                                                left join m_kelas as c on c.id_kelas = b.id_kelas 
                                            where
                                                a.id_siswa = $id_siswa")->result_array();
        $this->frontpage->view('front/beranda/index',$data);
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */