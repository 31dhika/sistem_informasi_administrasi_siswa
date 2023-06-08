<?php 
class nilai extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->model('admin/m_nilai');
    }
    
    public function index(){
        $id_sess = $this->session->userdata('id');
        $tipe = $this->session->userdata('tipe');
        $data['title'] = ($tipe=="guru")?'Nilai ( '.$this->session->userdata('nama_mata_pelajaran').' )':'Nilai';
        $data['menu'] = 'nilai';
        $data['kelas'] = $this->m_nilai->cek_tipe($id_sess,$tipe);
        $this->template->view('admin/nilai/index',$data);
    }
    
    public function select(){
        $id_tipe = $this->session->userdata('tipe');
        $id_sess_kelas = $this->session->userdata("id_kelas");
        $id_kelas = $this->uri->segment(4);
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $this->m_nilai->cek_session_kelas($id_tipe,$id_sess_kelas,$id_kelas);
        
        $select = $this->db->query("select nama_kelas from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_kelas = $select[0]['nama_kelas'];
        $data['title'] = ($id_tipe=="guru")?'Nilai Kelas '.$nama_kelas.' ( '.
                            $this->session->userdata('nama_mata_pelajaran').' )'
                            :'Nilai Kelas '.$nama_kelas;
        $data['menu'] = 'nilai';
        $tahun_ajaran = ID_TAHUN;
        $semester = SEMESTER;
        $data['id_kelas'] = $id_kelas;
        $data['id_mapel'] = $id_mapel;
        $data['id_tahun'] = $tahun_ajaran;
        $data['semester'] = $semester;
          
        if($this->session->userdata('tipe') == "wali"){
            $data['siswa'] = $this->m_nilai->list_nilai_wali($tahun_ajaran,$id_kelas);
            $this->template->view('admin/nilai/select_wali',$data);
        }elseif($this->session->userdata('tipe') == "guru"){
            $data['siswa'] = $this->m_nilai->list_nilai_guru($tahun_ajaran,$id_kelas);
            $this->template->view('admin/nilai/select_guru',$data);
        }
    }
    
    public function select_wali(){
        $id_kelas = $this->uri->segment(4);
        $id_siswa = $this->uri->segment(5);
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        
        $a = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_kelas = $a[0]['nama_kelas'];
        $b = $this->db->query("select * from m_siswa where id_siswa = $id_siswa")->result_array();
        $nama_siswa = $b[0]['nama_siswa'];
        
        $pelajaran = $this->db->query("select 
                                            a.*,
                                            b.kkm,
                                            c.id_kelas 
                                            from
                                            m_mata_pelajaran as a
                                            join r_paket_pelajaran as b on b.id_mata_pelajaran = a.id_mata_pelajaran
                                            join r_siswa_kelas_paket as c on c.id_paket = b.id_paket and c.id_kelas = $id_kelas
                                            ")->result_array();
        
        $data['pelajaran'] = $pelajaran;                                    
        $data['total_pelajaran'] = count($data['pelajaran']);
        $data['id_siswa'] = $id_siswa;
        $data['id_kelas'] = $id_kelas;
        $data['id_tahun'] = $id_tahun;
        $data['semester'] = $semester;
        $data['menu'] = "nilai";
        $data['title'] = "Nilai kelas ".$nama_kelas." ( ".$nama_siswa." )";
        $this->template->view("admin/nilai/view_wali",$data);
        
    }
    
    public function kurikulum_sk(){
        $id_kelas = $this->uri->segment(4);
        $nama_kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $mapel = $this->session->userdata("nama_mata_pelajaran");
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $data['sk'] = $this->db->query("select * from kurikulum_sk where id_mapel=$id_mapel and 
                                                                            id_tahun_ajaran=$id_tahun and 
                                                                            semester=$semester
                                                                            and id_kelas=$id_kelas
                                                                            order by jenis_sk asc")->result_array();
        $data["menu"] = "nilai";
        $data["title"] = "Set (SK) ".$mapel." Kelas ".$nama_kelas[0]["nama_kelas"];
        $data['id_kelas'] = $id_kelas;
        $this->template->view("admin/nilai/kurikulum_sk",$data);
    }
    
    
    public function add_sk(){
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $id_kelas = $this->uri->segment(4);
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $sk = $this->input->post("sk");
        
        $this->m_nilai->validasi_sk($id_mapel,$id_kelas,$id_tahun,$semester,$sk);
        
        $this->db->query("insert into kurikulum_sk (id_sk,
                                                    id_mapel,
                                                    id_kelas,
                                                    id_tahun_ajaran,
                                                    semester,
                                                    jenis_sk)
                                                values 
                                                ('',
                                                '$id_mapel',
                                                '$id_kelas',
                                                '$id_tahun',
                                                '$semester',
                                                '$sk'
                                                )");
                                                
                                                
        redirect("admin/nilai/kurikulum_sk"."/".$id_kelas);
        
    }
    
    
    public function delete_sk(){
        $id_sk = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $this->db->query("delete from kurikulum_sk where id_sk = $id_sk");
        $this->db->query("delete from kurikulum_kd where id_sk = $id_sk");
        $this->db->query("delete from r_nilai_siswa where id_sk = $id_sk");
        redirect("admin/nilai/kurikulum_sk"."/".$id_kelas);
    }
    
    
    public function kurikulum_kd(){
        $data["menu"] = "nilai";
        $id_sk = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        
        $jenis_sk = $this->db->query("select * from kurikulum_sk where id_sk = $id_sk")->result_array();
        $nama_kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        
        $data['title'] = "Set (KD)(".strtoupper(substr($jenis_sk[0]['jenis_sk'],2,10)).") ".$this->session->userdata('nama_mata_pelajaran')." Kelas ".$nama_kelas[0]['nama_kelas'];
        $data['id_kelas'] = $id_kelas;
        $data['id_sk'] = $id_sk;
        $data['kd'] = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk order by jenis_kd asc")->result_array();
        $this->template->view("admin/nilai/kurikulum_kd",$data);
    }
    
    
    public function add_kd(){
        $id_sk = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $jenis_kd = $this->input->post('kd');
        
        $this->m_nilai->validasi_kd($id_sk,$jenis_kd,$id_kelas);
        
        $this->db->query("insert into kurikulum_kd (id_kd,id_sk,jenis_kd) values ('','$id_sk','$jenis_kd')");
        redirect("admin/nilai/kurikulum_kd"."/".$id_sk."/".$id_kelas);
    }
    
    
    public function delete_kd(){
        $id_kd = $this->uri->segment(4);
        $id_sk = $this->uri->segment(5);
        $id_kelas = $this->uri->segment(6);
        $this->db->query("delete from kurikulum_kd where id_kd = $id_kd");
        $this->db->query("delete from r_nilai_siswa where id_kd = $id_kd");
        redirect("admin/nilai/kurikulum_kd"."/".$id_sk."/".$id_kelas);
    }
    
    
    public function select_input(){
        $id_kelas = $this->uri->segment(4);
        $id_siswa = $this->uri->segment(5);
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        
        $nama_mapel = $this->session->userdata("nama_mata_pelajaran");
        $nama_kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_siswa = $this->db->query("select * from m_siswa where id_siswa = $id_siswa")->result_array();
        
        $data["menu"] = "nilai";
        $data["id_kelas"] = $id_kelas;
        $data["id_siswa"] = $id_siswa;
        $data["id_mapel"] = $id_mapel;
        $data["id_tahun"] = $id_tahun;
        $data["semester"] = $semester;
        $data["title"] = "Nilai (SK) Kelas ".$nama_kelas[0]['nama_kelas']." (".$nama_mapel.")"." <br/> ".$nama_siswa[0]['nama_siswa']."";
        $data["sk"] = $this->db->query("select * from kurikulum_sk where id_mapel=$id_mapel and id_kelas=$id_kelas and id_tahun_ajaran=$id_tahun and semester = $semester order by jenis_sk asc")->result_array();
        $this->template->view("admin/nilai/select_input",$data);
    }
    
    public function input(){
        $id_kelas = $this->uri->segment(4);
        $id_siswa = $this->uri->segment(5);
        $id_sk = $this->uri->segment(6);
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        
        $nama_mapel = $this->session->userdata("nama_mata_pelajaran");
        $nama_kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_siswa = $this->db->query("select * from m_siswa where id_siswa = $id_siswa")->result_array();
        $nama_sk = $this->db->query("select * from kurikulum_sk where id_sk = $id_sk")->result_array();
        
        $data["menu"] = "nilai";
        $data["id_sk"] = $id_sk;
        $data["id_siswa"] = $id_siswa;
        $data["id_kelas"] = $id_kelas;
        $data["kd"] = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array();
        $data["nilai_kd"] = $this->m_nilai->nilai_kd($id_sk,$id_siswa,$id_kelas,$id_mapel,$id_tahun,$semester);
        $data["title"] = "Input Nilai (KD - ".strtoupper(substr($nama_sk[0]['jenis_sk'],2,10)).") kelas ".$nama_kelas[0]['nama_kelas']."
                            (".$nama_mapel.") <br/> "." ".$nama_siswa[0]['nama_siswa']."";
        $this->template->view("admin/nilai/input",$data);
        
    }
    
    public function proses_input(){
        $id_kelas = $this->uri->segment(4);
        $id_siswa = $this->uri->segment(5);
        $id_sk = $this->uri->segment(6);
        $id_kd = $this->input->post("kd");
        $nilai = $this->input->post("nilai");
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        
        $this->m_nilai->cek_nilai($nilai,$id_kelas,$id_siswa,$id_sk,$id_kd,$id_mapel,$id_tahun,$semester);
        
        $this->db->query("insert into r_nilai_siswa (
                                                    id_nilai,
                                                    id_siswa,
                                                    id_kelas,
                                                    id_mapel,
                                                    id_tahun_ajaran,
                                                    semester,
                                                    id_sk,
                                                    id_kd,
                                                    nilai
                                                     )
                                                values (
                                                    '',
                                                    '$id_siswa',
                                                    '$id_kelas',
                                                    '$id_mapel',
                                                    '$id_tahun',
                                                    '$semester',
                                                    '$id_sk',
                                                    '$id_kd',
                                                    '$nilai'
                                                    )");
                                                    
        redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
    }
    
    public function update_nilai(){
        $id_nilai = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $id_siswa = $this->uri->segment(6);
        $id_sk = $this->uri->segment(7);
        $nilai = $this->input->post("nilai");
        
        if(!is_numeric($nilai)){
           redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk); 
        }elseif(strlen($nilai)==3){
            if($nilai!=100){
                redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
            }
        }
        
        
        $this->db->query("update r_nilai_siswa set nilai = $nilai where id_nilai = '$id_nilai'");
        redirect("admin/nilai/input"."/".$id_kelas."/".$id_siswa."/".$id_sk);
    }
    
}
?>