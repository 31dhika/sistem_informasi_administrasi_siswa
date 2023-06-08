<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aktifasi extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indonesia');
        $this->load->model("m_aktifasi_siswa");
    }
	
	public function index()
	{
        $data['title'] = 'Aktifasi';
        $data['menu'] = 'aktifasi';
        $this->frontpage->view('front/aktifasi/aktifasi_1',$data);
	}
    
    public function proses_form_1(){
        $nis = $this->input->post("nis");
        $hari = $this->input->post("hari");
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        $tanggal = $tahun.'-'.$bulan.'-'.$hari;
        $id_siswa = $this->m_aktifasi_siswa->get_id_siswa($nis,$tanggal);
        redirect("aktifasi/form_2"."/".$id_siswa);
    }
    
    public function form_2(){
        $data['title'] = 'Aktifasi';
        $data['menu'] = 'aktifasi';
        $data['id_siswa'] = ($this->uri->segment(3)=="")?redirect("login"):$this->uri->segment(3);
        $this->frontpage->view('front/aktifasi/aktifasi_2',$data);
    }
    
    public function proses_form_2(){
        $id_siswa = $this->input->post('id_siswa');
        $username = $this->input->post('username');
        $pass_1 = $this->input->post('pass_1');
        $pass_2 = $this->input->post('pass_2');
        $this->m_aktifasi_siswa->create_account($id_siswa,$username,$pass_1,$pass_2);
    }
}

