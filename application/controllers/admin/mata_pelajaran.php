<?php 

class mata_pelajaran extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
    }

    public function index(){
        $data['title'] = "Daftar Mata Pelajaran" ;
        $data['menu'] = "pelajaran" ;
        $data['pelajaran'] = $this->db->get('m_mata_pelajaran')->result_array();
        $this->template->view('admin/paket_pelajaran/mata_pelajaran',$data);
    }
    
    public function add_pelajaran(){
        $pelajaran = $this->input->post('pelajaran');
        $select = $this->db->query("select * from m_mata_pelajaran where nama_mata_pelajaran = '$pelajaran' ")->result_array();
        
        if ($pelajaran == ""){
                ?><script type="text/javascript">alert("Field Tidak Boleh Kosong !!");window.location="index";</script><?php
            }elseif($pelajaran == $select[0]['nama_mata_pelajaran']){
                ?><script type="text/javascript">alert("Maaf, nama pelajaran yang anda masukan sudah ada, mohon periksa kembali !!");window.location="index";</script><?php
            }else{
               $table_pelajaran = array(
                                    'id_mata_pelajaran' => '',
                                    'nama_mata_pelajaran' => $pelajaran
                );
                $this->db->insert('m_mata_pelajaran',$table_pelajaran);
                redirect('admin/mata_pelajaran/'); 
            }
    }
    
    public function update_pelajaran(){
        $id = $this->input->post('id');
        $pelajaran = $this->input->post('pelajaran');
        
            if ($pelajaran == ""){
                ?><script type="text/javascript">alert("Field Tidak Boleh Kosong !!");window.location="index";</script><?php
            }else{
               $this->db->query("update m_mata_pelajaran set nama_mata_pelajaran = '$pelajaran' where id_mata_pelajaran = $id");
               redirect('admin/mata_pelajaran/'); 
            }
    }
    
    public function delete_pelajaran(){
        $id = $this->uri->segment(4);
        $this->db->query("delete from m_mata_pelajaran where id_mata_pelajaran = $id");
        redirect('admin/mata_pelajaran/');
    } 

}

?>