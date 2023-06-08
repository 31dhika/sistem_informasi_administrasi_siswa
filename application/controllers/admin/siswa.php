<?php 

class siswa extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        $this->load->model("admin/m_siswa");
    }
    
    public function index(){
        $data['title'] = 'Daftar Siswa';
        $data['menu'] = 'siswa';
        $data['siswa'] = $this->db->query("
                                            select t1.*,t2.nama_kelas,t2.id_kelas from m_siswa t1
                                            LEFT JOIN (
                                            select a.id_siswa,a.id_kelas,b.nama_kelas from r_kelas_siswa a
                                            INNER JOIN m_kelas b ON a.id_kelas = b.id_kelas
                                            WHERE a.id_tahun_ajaran = ".ID_TAHUN."
                                            ) 
                                            t2 ON t1.id_siswa = t2.id_siswa
                                            ")->result_array();

        $this->template->view('admin/siswa/index',$data);
    }
    
    public function add_siswa(){
        $data['title'] = 'Tambah Siswa';
        $data['menu'] = 'siswa';
        $this->template->view('admin/siswa/add_siswa',$data);
    }
    
    public function proses_add(){
        
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa'); 
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $agama = $this->input->post('agama');
        $alamat = $this->input->post('alamat');
        /*$photo = $this->input->post('photo');*/
        $nama_ayah = $this->input->post('nama_ayah');
        $nama_ibu = $this->input->post('nama_ibu');
        $alamat_ayah = $this->input->post('alamat_ayah');
        $alamat_ibu = $this->input->post('alamat_ibu');
        $no_tlp_ayah = $this->input->post('no_tlp_ayah');
        $no_tlp_ibu = $this->input->post('no_tlp_ibu');
        $status_perwalian = $this->input->post('status_perwalian');
        
        $this->m_siswa->proses_add($nis,
                                    $nama_siswa,
                                    $tempat_lahir,
                                    $tanggal_lahir,
                                    $jenis_kelamin,
                                    $agama,
                                    $alamat,
                                    $nama_ayah,
                                    $nama_ibu,
                                    $alamat_ayah,
                                    $alamat_ibu,
                                    $no_tlp_ayah,
                                    $no_tlp_ibu,
                                    $status_perwalian);
         
    }

    public function ubah_siswa(){
        $data['title'] = 'Ubah Siswa';
        $data['menu'] = 'siswa';
        $this->template->view('admin/siswa/ubah_siswa',$data);
    }

    public function proses_ubah(){
        
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa'); 
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $agama = $this->input->post('agama');
        $alamat = $this->input->post('alamat');
        /*$photo = $this->input->post('photo');*/
        $nama_ayah = $this->input->post('nama_ayah');
        $nama_ibu = $this->input->post('nama_ibu');
        $alamat_ayah = $this->input->post('alamat_ayah');
        $alamat_ibu = $this->input->post('alamat_ibu');
        $no_tlp_ayah = $this->input->post('no_tlp_ayah');
        $no_tlp_ibu = $this->input->post('no_tlp_ibu');
        $status_perwalian = $this->input->post('status_perwalian');
        
        $this->m_siswa->proses_add($nis,
                                    $nama_siswa,
                                    $tempat_lahir,
                                    $tanggal_lahir,
                                    $jenis_kelamin,
                                    $agama,
                                    $alamat,
                                    $nama_ayah,
                                    $nama_ibu,
                                    $alamat_ayah,
                                    $alamat_ibu,
                                    $no_tlp_ayah,
                                    $no_tlp_ibu,
                                    $status_perwalian);
         
    }
    
    public function view_siswa(){
        $data['title'] = 'Lihat Data Siswa';
        $data['menu'] = 'siswa';
        $id = $this->uri->segment(4);
        $data['view'] = $this->db->query("select * from m_siswa,m_orang_tua where m_siswa.id_siswa = m_orang_tua.id_siswa and m_siswa.id_siswa = $id")->result_array();
        $this->template->view('admin/siswa/view_siswa',$data);
        
    }
    
    public function delete_siswa(){
        $id = $this->uri->segment(4);
        $select = $this->db->query("select * from m_siswa where id_siswa = $id")->result_array();
        unlink("./images/siswa/".$select[0]['photo']);
        
        $this->m_siswa->delete_siswa($id);
        redirect('admin/siswa/');
    }
     
}
?>  
