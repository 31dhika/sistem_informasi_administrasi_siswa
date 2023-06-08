<?php 

class kelas extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
        $this->load->model("admin/m_kelas");
    }
    
    public function index(){
        $id_tahun = ID_TAHUN;
        $data['title'] = "Daftar Kelas" ;
        $data['menu'] = "kelas" ;
        $data['kelas'] = $this->m_kelas->index_kelas($id_tahun);
        $data['wali'] = $this->m_kelas->list_form_wali();
        $this->template->view("admin/kelas/index",$data);
    }
    
            
    public function update_kelas(){
        $id = $this->input->post('id');
        $kelas = $this->input->post('kelas');
        $this->m_kelas->update_kelas($id,$kelas);
            
    }
        
    public function delete_kelas(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from m_kelas where id_kelas = $id");
        redirect('admin/kelas/');
    }    
    
    public function view_siswa(){
        $id_kelas = $this->uri->segment(4);
        $id_tahun = ID_TAHUN;
        $select = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $kelas = $select[0]['nama_kelas'];
        $data['title'] = "Daftar Siswa Kelas $kelas" ;
        $data['menu'] = "kelas" ;
        $data['id_kelas'] = $id_kelas;
        $data['siswa'] = $this->m_kelas->view_siswa($id_kelas,$id_tahun);
        $this->template->view('admin/kelas/view_siswa',$data);
    }
    
    public function remove_siswa(){
        $id_tahun = ID_TAHUN;
        $id_kelas = $this->uri->segment(4);
        $id_siswa = $this->uri->segment(5);
        $this->db->query("DELETE from r_kelas_siswa where id_siswa = $id_siswa AND id_tahun_ajaran = $id_tahun");
        redirect('admin/kelas/view_siswa/'.$id_kelas);
        
    }
    
}
?>