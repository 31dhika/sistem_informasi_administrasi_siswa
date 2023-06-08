<?php 

class paket_pelajaran extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        $this->load->model('admin/m_paket');
    }
    
    public function index(){
       $data['title'] = 'Paket Pelajaran';
       $data['menu'] = 'paket_pelajaran';
       $data['paket'] = $this->db->get('m_paket')->result_array();
       $this->template->view('admin/paket_pelajaran/index',$data);
    }
    
    public function view(){
        $id = $this->uri->segment(4);
        $select = $this->db->query("select * from m_paket where id_paket = $id")->result_array();
        $data['title'] = 'Daftar Pelajaran di '.$select[0]['nama_paket'];
        $data['menu'] = 'paket_pelajaran';
        $data['pelajaran'] = $this->m_paket->view($id);
        $data['id_paket'] = $id;
        $this->template->view('admin/paket_pelajaran/view',$data);
    }
    
    public function input(){
        $id = $this->uri->segment(4);
        $select = $this->db->query("select * from m_paket where id_paket = $id")->result_array();
        $data['id_paket'] = $id;
        $data['title'] = 'Input Paket Pelajaran ke '.$select[0]['nama_paket'];
        $data['menu'] = 'paket_pelajaran';
        $data['pelajaran'] = $this->m_paket->daftar_pelajaran($id);
        $this->template->view('admin/paket_pelajaran/input_pelajaran',$data);
    }
    
    public function proses_input(){
        $id_paket = $this->input->post('id_paket');
        $pelajaran = $this->input->post('pelajaran');
        foreach($pelajaran as $data){
            $this->db->query("insert into r_paket_pelajaran values ($data,$id_paket,'')");
        };
        redirect('admin/paket_pelajaran/');
    }
    
    public function delete(){
        $id_paket = $this->uri->segment(4);
        $id_mata_pelajaran = $this->uri->segment(5);
        $this->db->query("delete from r_paket_pelajaran where id_mata_pelajaran = $id_mata_pelajaran and id_paket = $id_paket");
        redirect('admin/paket_pelajaran/view/'.$id_paket);
    }
    
    public function edit_kkm(){
        $id_paket = $this->uri->segment(4);
        $id_mata_pelajaran = $this->uri->segment(5);
        $kkm = $this->input->post("kkm");
        
        $this->db->query("update r_paket_pelajaran set kkm = $kkm where id_mata_pelajaran = $id_mata_pelajaran and id_paket = $id_paket");
        redirect('admin/paket_pelajaran/view/'.$id_paket);
    }
}

?>