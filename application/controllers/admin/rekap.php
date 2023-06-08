<?php 

class rekap extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('admin/login/');
        }
        define('ID_TAHUN',checkTahunAjaranActive());
        define('SEMESTER',checkSemester());
    }
    
    public function rekap_kelas(){
        $id_kelas = $this->uri->segment(4);
        $id_tahun = ID_TAHUN;
        $id_semester = SEMESTER;
        
        $query_kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $kelas = $query_kelas[0]['nama_kelas'];
        
        $query_tahun = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran=$id_tahun")->result_array();
        $tahun_ajaran = $query_tahun[0]['tahun_ajaran'];
        
        $query_semester = $this->db->query("select * from semester where id=$id_semester")->result_array();
        $semester = $query_semester[0]['nama_semester'];
        
        $query_data_kelas = $this->db->query("
                                            select * from m_siswa WHERE id_siswa  IN 
                                            (   
                                                select id_siswa FROM r_kelas_siswa 
                                                WHERE m_siswa.id_siswa = r_kelas_siswa.id_siswa
                                                AND r_kelas_siswa.id_kelas = $id_kelas AND id_tahun_ajaran=$id_tahun
                                            )
                                            ")->result_array();
        
        
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Daftar siswa kelas ('.$kelas.')');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Daftar siswa kelas ('.$kelas.')');
        $this->excel->getActiveSheet()->setCellValue('A2', 'Tahun Ajaran : '.$tahun_ajaran.'');
        $this->excel->getActiveSheet()->setCellValue('A3', $semester);
        
        $this->excel->getActiveSheet()->setCellValue('A5', 'No');
        $this->excel->getActiveSheet()->setCellValue('B5', 'NIS');
        $this->excel->getActiveSheet()->setCellValue('C5', 'Nama Siswa');
        $this->excel->getActiveSheet()->setCellValue('D5', 'Jenis Kelamin');
        
        $lelaki = 0;
        $perempuan = 0; 
        $total_siswa = count($query_data_kelas);
        
        $no_table = 6;
        $no = 1;
        foreach ($query_data_kelas as $data){
            $this->excel->getActiveSheet()->setCellValue('A'.$no_table, $no);
            $this->excel->getActiveSheet()->setCellValue('B'.$no_table, $data['nis']);
            $this->excel->getActiveSheet()->setCellValue('C'.$no_table, $data['nama_siswa']);
            $this->excel->getActiveSheet()->setCellValue('D'.$no_table, $data['jenis_kelamin']);
            
            $this->excel->getActiveSheet()->getStyle('A'.$no_table.':'.'B'.$no_table)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            
            ($data['jenis_kelamin'] == 'Laki-laki') ? $lelaki += 1 : 0;
            ($data['jenis_kelamin'] == 'Perempuan') ? $perempuan += 1 : 0;
            
            $no++;
            $no_table++;
            }
            
        $tambahan = ($no_table) + 1;
        $this->excel->getActiveSheet()->setCellValue('A'.$tambahan,'Laki - laki : '.$lelaki);
        $this->excel->getActiveSheet()->setCellValue('A'.($tambahan+1),'Perempuan : '.$perempuan);
        $this->excel->getActiveSheet()->setCellValue('A'.($tambahan+2),'Total siswa : '.$total_siswa);
        
           
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('B5')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('D5')->getFont()->setSize(12);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:E1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         
        $filename='daftar siswa kelas ('.$kelas.').xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
    }
    
    public function rekap_all_siswa(){
        $id_tahun = ID_TAHUN;
        $id_semester = SEMESTER;
        
        $query_tahun = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran=$id_tahun")->result_array();
        $tahun_ajaran = $query_tahun[0]['tahun_ajaran'];
        
        $query_semester = $this->db->query("select * from semester where id=$id_semester")->result_array();
        $semester = $query_semester[0]['nama_semester'];
        
        $query = $this->db->query("select * from m_siswa order by nama_siswa asc")->result_array();
        
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Daftar Nama Siswa');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Daftar Nama Siswa');
        $this->excel->getActiveSheet()->setCellValue('A2', 'Tahun Ajaran : '.$tahun_ajaran.'');
        $this->excel->getActiveSheet()->setCellValue('A3', $semester);
        
        $this->excel->getActiveSheet()->setCellValue('A5', 'NIS');
        $this->excel->getActiveSheet()->setCellValue('B5', 'Nama Siswa');
        $this->excel->getActiveSheet()->setCellValue('C5', 'Jenis Kelamin');
        
        $lelaki = 0;
        $perempuan = 0; 
        $total_siswa = count($query);
        
        $no_table = 6;
        $no = 1;
        foreach ($query as $data){
            $this->excel->getActiveSheet()->setCellValue('A'.$no_table, $data['nis']);
            $this->excel->getActiveSheet()->setCellValue('B'.$no_table, $data['nama_siswa']);
            $this->excel->getActiveSheet()->setCellValue('C'.$no_table, $data['jenis_kelamin']);
            
            $this->excel->getActiveSheet()->getStyle('A'.$no_table.':'.'B'.$no_table)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            
            ($data['jenis_kelamin'] == 'Laki-laki') ? $lelaki += 1 : 0;
            ($data['jenis_kelamin'] == 'Perempuan') ? $perempuan += 1 : 0;
            
            $no++;
            $no_table++;
            }
            
        $tambahan = ($no_table) + 1;
        $this->excel->getActiveSheet()->setCellValue('A'.$tambahan,'Laki - laki : '.$lelaki);
        $this->excel->getActiveSheet()->setCellValue('A'.($tambahan+1),'Perempuan : '.$perempuan);
        $this->excel->getActiveSheet()->setCellValue('A'.($tambahan+2),'Total siswa : '.$total_siswa);
        
           
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('B5')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:E1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         
        $filename='daftar nama siswa.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function rekap_rapor(){
        $id_siswa = $this->uri->segment(4);
        $id_kelas = $this->uri->segment(5);
        $id_tahun = $this->uri->segment(6);
        $semester = $this->uri->segment(7);
        
        $a = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $nama_kelas = $a[0]['nama_kelas'];
        $b = $this->db->query("select * from m_siswa where id_siswa = $id_siswa")->result_array();
        $nama_siswa = $b[0]['nama_siswa'];
        $nis = $b[0]['nis'];
        $c = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $id_tahun")->result_array();
        $tahun_ajaran = $c[0]['tahun_ajaran'];
        
        
        $pelajaran = $this->db->query("select 
                                            a.*,
                                            b.kkm,
                                            c.id_kelas 
                                            from
                                            m_mata_pelajaran as a
                                            join r_paket_pelajaran as b on b.id_mata_pelajaran = a.id_mata_pelajaran
                                            join r_siswa_kelas_paket as c on c.id_paket = b.id_paket and c.id_kelas = $id_kelas
                                            ")->result_array();
        
        
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('NIlai Rapor Siswa ');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'NIlai Rapor Siswa SMPN 195 Jakarta');
        $this->excel->getActiveSheet()->setCellValue('A3', 'Nama Siswa : '.$nama_siswa.'');
        $this->excel->getActiveSheet()->setCellValue('A4', 'NIS : '.$nis.'');
        $this->excel->getActiveSheet()->setCellValue('A5', 'Kelas : '.$nama_kelas.'');
        $this->excel->getActiveSheet()->setCellValue('A6', 'Tahun Ajaran : '.$tahun_ajaran.'');
        $this->excel->getActiveSheet()->setCellValue('A7', 'Semester : '.$semester.'');      
        $this->excel->getActiveSheet()->setCellValue('A9', 'No.');
        $this->excel->getActiveSheet()->setCellValue('B9', 'Mata Pelajaran');
        $this->excel->getActiveSheet()->setCellValue('G9', 'KKM');
        $this->excel->getActiveSheet()->setCellValue('H9', 'Nilai');
        $this->excel->getActiveSheet()->setCellValue('I9', 'Deskripsi');
        
        $no_table = 10;
        $no = 1;
        foreach($pelajaran as $data){
            $this->excel->getActiveSheet()->setCellValue('A'.$no_table.'',$no);
            $this->excel->getActiveSheet()->setCellValue('B'.$no_table.'',$data['nama_mata_pelajaran']);
            $this->excel->getActiveSheet()->setCellValue('G'.$no_table.'',$data['kkm']);
            
            
            $sk1 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester 
                                                                                and jenis_sk = 'a_sk1'")->result_array();
            $id_sk1 = ($sk1==null)?0:$sk1[0]['id_sk'];
            $kd1 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk1")->result_array();
            $jumlah_kd_sk1 = count($kd1);
            $jumlah_nilai_sk1 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk1
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk1 = (empty($jumlah_nilai_sk1[0]['total']))?"0":$jumlah_nilai_sk1[0]['total'];
            $nilai_sk1 = ($hasil_sk1==0)?0:($hasil_sk1/$jumlah_kd_sk1);
            
            
            
            
            
            $sk2 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'b_sk2'")->result_array();
            $id_sk2 = ($sk2==null)?0:$sk2[0]['id_sk'];
            $kd2 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk2")->result_array();
            $jumlah_kd_sk2 = count($kd2);
            $jumlah_nilai_sk2 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk2
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk2 = (empty($jumlah_nilai_sk2[0]['total']))?"0":$jumlah_nilai_sk2[0]['total'];
            $nilai_sk2 = ($hasil_sk2==0)?0:($hasil_sk2/$jumlah_kd_sk2);
            
            
            
            
            
            $sk3 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'c_sk3'")->result_array();
            $id_sk3 = ($sk3==null)?0:$sk3[0]['id_sk'];
            $kd3 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk3")->result_array();
            $jumlah_kd_sk3 = count($kd3);
            $jumlah_nilai_sk3 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk3
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk3 = (empty($jumlah_nilai_sk3[0]['total']))?"0":$jumlah_nilai_sk3[0]['total'];
            $nilai_sk3 = ($hasil_sk3==0)?0:($hasil_sk3/$jumlah_kd_sk3);
            
            
            
            
            
            $sk4 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'd_sk4'")->result_array();
            $id_sk4 = ($sk4==null)?0:$sk4[0]['id_sk'];
            $kd4 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk4")->result_array();
            $jumlah_kd_sk4 = count($kd4);
            $jumlah_nilai_sk4 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk4
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk4 = (empty($jumlah_nilai_sk4[0]['total']))?"0":$jumlah_nilai_sk4[0]['total'];
            $nilai_sk4 = ($hasil_sk4==0)?0:($hasil_sk4/$jumlah_kd_sk4);
            
            
            
            
            
            $sk5 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'e_sk5'")->result_array();
            $id_sk5 = ($sk5==null)?0:$sk5[0]['id_sk'];
            $kd5 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk5")->result_array();
            $jumlah_kd_sk5 = count($kd5);
            $jumlah_nilai_sk5 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk5
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk5 = (empty($jumlah_nilai_sk5[0]['total']))?"0":$jumlah_nilai_sk5[0]['total'];
            $nilai_sk5 = ($hasil_sk5==0)?0:($hasil_sk5/$jumlah_kd_sk5);
            
            
            
            
            
            $sk6 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'f_sk6'")->result_array();
            $id_sk6 = ($sk6==null)?0:$sk6[0]['id_sk'];
            $kd6 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk6")->result_array();
            $jumlah_kd_sk6 = count($kd6);
            $jumlah_nilai_sk6 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk6
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk6 = (empty($jumlah_nilai_sk6[0]['total']))?"0":$jumlah_nilai_sk6[0]['total'];
            $nilai_sk6 = ($hasil_sk6==0)?0:($hasil_sk6/$jumlah_kd_sk6);
            
            
            
            
            
            $sk7 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'g_sk7'")->result_array();
            $id_sk7 = ($sk7==null)?0:$sk7[0]['id_sk'];
            $kd7 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk7")->result_array();
            $jumlah_kd_sk7 = count($kd7);
            $jumlah_nilai_sk7 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk7
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk7 = (empty($jumlah_nilai_sk7[0]['total']))?"0":$jumlah_nilai_sk7[0]['total'];
            $nilai_sk7 = ($hasil_sk7==0)?0:($hasil_sk7/$jumlah_kd_sk7);
            
            
            
            
            
            $sk8 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'k_sk8'")->result_array();
            $id_sk8 = ($sk8==null)?0:$sk8[0]['id_sk'];
            $kd8 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk8")->result_array();
            $jumlah_kd_sk8 = count($kd8);
            $jumlah_nilai_sk8 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk8
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk8 = (empty($jumlah_nilai_sk8[0]['total']))?"0":$jumlah_nilai_sk8[0]['total'];
            $nilai_sk8 = ($hasil_sk8==0)?0:($hasil_sk8/$jumlah_kd_sk8);
            
            
            
            
            
            $sk9 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'i_sk9'")->result_array();
            $id_sk9 = ($sk9==null)?0:$sk9[0]['id_sk'];
            $kd9 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk9")->result_array();
            $jumlah_kd_sk9 = count($kd9);
            $jumlah_nilai_sk9 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk9
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk9 = (empty($jumlah_nilai_sk9[0]['total']))?"0":$jumlah_nilai_sk9[0]['total'];
            $nilai_sk9 = ($hasil_sk9==0)?0:($hasil_sk9/$jumlah_kd_sk9);
            
            
            
            
            
            $sk10 = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'j_sk10'")->result_array();
            $id_sk10 = ($sk10==null)?0:$sk10[0]['id_sk'];
            $kd10 = $this->db->query("select * from kurikulum_kd where id_sk = $id_sk10")->result_array();
            $jumlah_kd_sk10 = count($kd10);
            $jumlah_nilai_sk10 = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk10
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_sk10 = (empty($jumlah_nilai_sk10[0]['total']))?"0":$jumlah_nilai_sk10[0]['total'];
            $nilai_sk10 = ($hasil_sk10==0)?0:($hasil_sk10/$jumlah_kd_sk10);
            
            
            
            
            
            $uts = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'k_uts'")->result_array();
            $id_uts = ($uts==null)?0:$uts[0]['id_sk'];
            $kd_uts = $this->db->query("select * from kurikulum_kd where id_sk = $id_uts")->result_array();
            $jumlah_kd_uts = count($kd_uts);
            $jumlah_nilai_uts = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_uts
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_uts = (empty($jumlah_nilai_uts[0]['total']))?"0":$jumlah_nilai_uts[0]['total'];
            $nilai_uts = ($hasil_uts==0)?0:($hasil_uts/$jumlah_kd_uts);
            
            
            
            
            $uas = $this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester 
                                                                and jenis_sk = 'l_uas'")->result_array();
            $id_uas = ($uas==null)?0:$uas[0]['id_sk'];
            $kd_uas = $this->db->query("select * from kurikulum_kd where id_sk = $id_uas")->result_array();
            $jumlah_kd_uas = count($kd_uas);
            $jumlah_nilai_uas = $this->db->query("select
                                        sum(nilai) as total
                                        from
                                        kurikulum_sk as a
                                        join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_uas
                                        left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                        c.id_kd = b.id_kd and
                                                                        c.id_siswa = $id_siswa and
                                                                        c.id_kelas = $id_kelas and
                                                                        c.id_mapel = $data[id_mata_pelajaran] and
                                                                        c.id_tahun_ajaran = $id_tahun and
                                                                        c.semester = $semester")->result_array();
            $hasil_uas = (empty($jumlah_nilai_uas[0]['total']))?"0":$jumlah_nilai_uas[0]['total'];
            $nilai_uas = ($hasil_uas==0)?0:($hasil_uas/$jumlah_kd_uas);
            
            
            
            
            $jumlah_sk = count($this->db->query("select * from kurikulum_sk where id_mapel = $data[id_mata_pelajaran] 
                                                                and id_kelas = $id_kelas 
                                                                and id_tahun_ajaran = $id_tahun 
                                                                and semester = $semester")->result_array());
                                                                
            $rumus_rapor = (($nilai_sk1+$nilai_sk2+$nilai_sk3+$nilai_sk4+$nilai_sk5+$nilai_sk6+$nilai_sk7+$nilai_sk8+$nilai_sk9+$nilai_sk10+$nilai_uts+$nilai_uas)==0)?"0":($nilai_sk1+$nilai_sk2+$nilai_sk3+$nilai_sk4+$nilai_sk5+$nilai_sk6+$nilai_sk7+$nilai_sk8+$nilai_sk9+$nilai_sk10+$nilai_uts+$nilai_uas)/$jumlah_sk;
            $nilai_rapor = ceil($rumus_rapor);
            
            if($nilai_rapor<$data['kkm']){
                $status = "Tidak tercapai";
            }elseif($nilai_rapor==$data['kkm']){
                $status = "Tercapai";
            }else{
                $status = "Terlampaui";
            }
            
            $arr_rapor[] = $nilai_rapor;
            
            $this->excel->getActiveSheet()->mergeCells('B'.$no_table.':'.'F'.$no_table.'');
            
            $this->excel->getActiveSheet()->setCellValue('H'.$no_table.'',$nilai_rapor);
            $this->excel->getActiveSheet()->setCellValue('I'.$no_table.'',$status);
            
            
            
            $this->excel->getActiveSheet()->getStyle('A'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $this->excel->getActiveSheet()->getStyle('B'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $this->excel->getActiveSheet()->getStyle('G'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $this->excel->getActiveSheet()->getStyle('H'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $this->excel->getActiveSheet()->getStyle('I'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $no++;
            $no_table++;
            
        }
        $total_rapor = array_sum($arr_rapor);
            $total_pelajaran = count($pelajaran);
            $rata2_nilai_rapor = ceil($total_rapor/$total_pelajaran);
        
        
        $n = $no_table+1;
        
        $this->excel->getActiveSheet()->setCellValue('A'.$n.'', 'Nilai rata-rata :');
        $this->excel->getActiveSheet()->setCellValue('C'.$n.'', $rata2_nilai_rapor);
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I9')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:G1');
        $this->excel->getActiveSheet()->mergeCells('B9:F9');
        $this->excel->getActiveSheet()->mergeCells('A'.$n.':'.'B'.$n.'');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $this->excel->getActiveSheet()->getStyle('C'.$n.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         
         
        $filename='Rapor kelas '.$nama_kelas.' ('.$nama_siswa.').xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    
    public function rekap_nilai_guru(){
        $id_tahun = ID_TAHUN;
        $semester = SEMESTER;
        $id_kelas = $this->uri->segment(4);
        $id_mapel = $this->session->userdata("id_mata_pelajaran");
        
        $mapel = $this->db->query("select * from m_mata_pelajaran where id_mata_pelajaran = $id_mapel")->result_array();
        $kelas = $this->db->query("select * from m_kelas where id_kelas = $id_kelas")->result_array();
        $tahun_ajaran = $this->db->query("select * from m_tahun_ajaran where id_tahun_ajaran = $id_tahun")->result_array();
        
        $siswa = $this->db->query("select 
                                    a.id_siswa,
                                    a.nama_siswa
                                from
                                    m_siswa a
                                left join r_kelas_siswa as b on b.id_siswa = a.id_siswa and b.id_tahun_ajaran = $id_tahun
                                where  b.id_kelas = $id_kelas 
                                order by a.nama_siswa asc")->result_array();
                                
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Nilai Siswa SMPN 195 Jakarta'); 
                                
        $this->excel->getActiveSheet()->setCellValue('A1','Nilai Siswa SMPN 195 Jakarta');
        
        $this->excel->getActiveSheet()->setCellValue('A3','Mata Pelajaran');
        $this->excel->getActiveSheet()->setCellValue('A4','Kelas');
        $this->excel->getActiveSheet()->setCellValue('A5','Tahun Ajaran');
        $this->excel->getActiveSheet()->setCellValue('A6','Semester');
        
        $this->excel->getActiveSheet()->setCellValue('C3',': '.$mapel[0]['nama_mata_pelajaran'].'');
        $this->excel->getActiveSheet()->setCellValue('C4',': '.$kelas[0]['nama_kelas'].'');
        $this->excel->getActiveSheet()->setCellValue('C5',': '.$tahun_ajaran[0]['tahun_ajaran'].'');
        $this->excel->getActiveSheet()->setCellValue('C6',': '.$semester.'');
        
        $this->excel->getActiveSheet()->setCellValue('A8','No');
        $this->excel->getActiveSheet()->setCellValue('B8','Nama');
        $this->excel->getActiveSheet()->setCellValue('E8','SK1');
        $this->excel->getActiveSheet()->setCellValue('F8','SK2');
        $this->excel->getActiveSheet()->setCellValue('G8','SK3');
        $this->excel->getActiveSheet()->setCellValue('H8','SK4');
        $this->excel->getActiveSheet()->setCellValue('I8','SK5');
        $this->excel->getActiveSheet()->setCellValue('J8','SK6');
        $this->excel->getActiveSheet()->setCellValue('K8','SK7');
        $this->excel->getActiveSheet()->setCellValue('L8','SK8');
        $this->excel->getActiveSheet()->setCellValue('M8','SK9');
        $this->excel->getActiveSheet()->setCellValue('N8','SK10');
        $this->excel->getActiveSheet()->setCellValue('O8','UTS');
        $this->excel->getActiveSheet()->setCellValue('P8','UAS');
        $this->excel->getActiveSheet()->setCellValue('Q8','Nilai Rapor');
        
        $jumlah_sk = count($this->db->query("select * from kurikulum_sk where id_mapel = $id_mapel 
                                                                                and id_kelas = $id_kelas 
                                                                                and id_tahun_ajaran = $id_tahun 
                                                                                and semester = $semester")->result_array());
        $no = 0;
        $no_table = 8;
        foreach($siswa as $data){
            $no++; $no_table++;
            
            $this->excel->getActiveSheet()->setCellValue('A'.$no_table.'',$no);
            $this->excel->getActiveSheet()->getStyle('A'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        
            $this->excel->getActiveSheet()->setCellValue('B'.$no_table.'',strtoupper($data['nama_siswa']));
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'a_sk1' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('E'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk1 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                
                $this->excel->getActiveSheet()->setCellValue('E'.$no_table.'',($nilai_sk1==0)?"0":ceil($nilai_sk1));
            }   $this->excel->getActiveSheet()->getStyle('E'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'b_sk2' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('F'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk2 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                
                $this->excel->getActiveSheet()->setCellValue('F'.$no_table.'',($nilai_sk2==0)?"0":ceil($nilai_sk2));
            }   $this->excel->getActiveSheet()->getStyle('F'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'c_sk3' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('G'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk3 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                
                $this->excel->getActiveSheet()->setCellValue('G'.$no_table.'',($nilai_sk3==0)?"0":ceil($nilai_sk3));
            }   $this->excel->getActiveSheet()->getStyle('G'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'd_sk4' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('H'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk4 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('H'.$no_table.'',($nilai_sk4==0)?"0":ceil($nilai_sk4));
            }   $this->excel->getActiveSheet()->getStyle('H'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'e_sk5' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('I'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk5 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('I'.$no_table.'',($nilai_sk5==0)?"0":ceil($nilai_sk5));
            }   $this->excel->getActiveSheet()->getStyle('I'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'f_sk6' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                 $this->excel->getActiveSheet()->setCellValue('J'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk6 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('J'.$no_table.'',($nilai_sk6==0)?"0":ceil($nilai_sk6));
            }   $this->excel->getActiveSheet()->getStyle('J'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'g_sk7' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('K'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk7 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('K'.$no_table.'',($nilai_sk7==0)?"0":ceil($nilai_sk7));
            }   $this->excel->getActiveSheet()->getStyle('K'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'h_sk8' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
               $this->excel->getActiveSheet()->setCellValue('L'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk8 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('L'.$no_table.'',($nilai_sk8==0)?"0":ceil($nilai_sk8));
            }   $this->excel->getActiveSheet()->getStyle('L'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'i_sk9' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('M'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk9 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('M'.$no_table.'',($nilai_sk9==0)?"0":ceil($nilai_sk9));
            }   $this->excel->getActiveSheet()->getStyle('M'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'j_sk10' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('N'.$no_table.'','-');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_sk10 = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('N'.$no_table.'',($nilai_sk10==0)?"0":ceil($nilai_sk10));
            }   $this->excel->getActiveSheet()->getStyle('N'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'k_uts' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('O'.$no_table.'','');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_uts = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('O'.$no_table.'',($nilai_uts==0)?"0":ceil($nilai_uts));
            }   $this->excel->getActiveSheet()->getStyle('O'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
            $sk = $this->db->query("select * from kurikulum_sk where jenis_sk = 'l_uas' and id_mapel = $id_mapel and id_kelas = $id_kelas and id_tahun_ajaran = $id_tahun and semester = $semester")->result_array();
            if($sk==null){
                $this->excel->getActiveSheet()->setCellValue('P'.$no_table.'','');
            }else{
                $id_sk = $sk[0]['id_sk'];
                $total_kd = count($this->db->query("select * from kurikulum_kd where id_sk = $id_sk")->result_array());
                
                $b = $this->db->query("select
                                    sum(nilai) as total
                                    from
                                    kurikulum_sk as a
                                    join kurikulum_kd as b on b.id_sk = a.id_sk and b.id_sk = $id_sk
                                    left join r_nilai_siswa as c on c.id_sk = b.id_sk and 
                                                                    c.id_kd = b.id_kd and
                                                                    c.id_siswa = $data[id_siswa] and
                                                                    c.id_kelas = $id_kelas and
                                                                    c.id_mapel = $id_mapel and
                                                                    c.id_tahun_ajaran = $id_tahun and
                                                                    c.semester = $semester")->result_array();
                $total_nilai = $b[0]['total'] ;
                $nilai_uas = ($total_kd==0) ? 0 : ($total_nilai/$total_kd);
                $this->excel->getActiveSheet()->setCellValue('P'.$no_table.'',($nilai_uas==0)?"0":ceil($nilai_uas));
            }   $this->excel->getActiveSheet()->getStyle('P'.$no_table.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            
                      
            $sk1 = (empty($nilai_sk1))?0:$nilai_sk1;
            $sk2 = (empty($nilai_sk2))?0:$nilai_sk2;
            $sk3 = (empty($nilai_sk3))?0:$nilai_sk3;
            $sk4 = (empty($nilai_sk4))?0:$nilai_sk4;
            $sk5 = (empty($nilai_sk5))?0:$nilai_sk5;
            $sk6 = (empty($nilai_sk6))?0:$nilai_sk6;
            $sk7 = (empty($nilai_sk7))?0:$nilai_sk7;
            $sk8 = (empty($nilai_sk8))?0:$nilai_sk8;
            $sk9 = (empty($nilai_sk9))?0:$nilai_sk9;
            $sk10 = (empty($nilai_sk10))?0:$nilai_sk10;
            $uts = (empty($nilai_uts))?0:$nilai_uts;
            $uas = (empty($nilai_uas))?0:$nilai_uas;
            
            if($jumlah_sk!=0){
                $rapor = ($sk1+$sk2+$sk3+$sk4+$sk5+$sk6+$sk7+$sk8+$sk9+$sk10+$uts+$uas)/$jumlah_sk;
                $this->excel->getActiveSheet()->setCellValue('Q'.$no_table.'',(empty($rapor))?"0":ceil($rapor));
            }else{
                $this->excel->getActiveSheet()->setCellValue('Q'.$no_table.'','');
            }
            
            $arr_sk1[] = (empty($nilai_sk1))?0:$nilai_sk1;
            $arr_sk2[] = (empty($nilai_sk2))?0:$nilai_sk2;
            $arr_sk3[] = (empty($nilai_sk3))?0:$nilai_sk3;
            $arr_sk4[] = (empty($nilai_sk4))?0:$nilai_sk4;
            $arr_sk5[] = (empty($nilai_sk5))?0:$nilai_sk5;
            $arr_sk6[] = (empty($nilai_sk6))?0:$nilai_sk6;
            $arr_sk7[] = (empty($nilai_sk7))?0:$nilai_sk7;
            $arr_sk8[] = (empty($nilai_sk8))?0:$nilai_sk8;
            $arr_sk9[] = (empty($nilai_sk9))?0:$nilai_sk9;
            $arr_sk10[] = (empty($arr_sk10))?0:$arr_sk10;
            $arr_uts[] = (empty($nilai_uts))?0:$nilai_uts;
            $arr_uas[] = (empty($nilai_uas))?0:$nilai_uas;
            $arr_rapor[] = (empty($rapor))?0:$rapor;
            $arr_no_table = count($data['nama_siswa']);
            
        }
        
        $no_next_table = $no_table + $arr_no_table + 1;
        
        $this->excel->getActiveSheet()->setCellValue('A'.$no_next_table.'','Nilai Rata-rata Kelas');
        $this->excel->getActiveSheet()->getStyle('A'.$no_next_table.'')->getFont()->setBold(true);
        
        $this->excel->getActiveSheet()->setCellValue('A'.($no_next_table + 2).'','SK1');
        $this->excel->getActiveSheet()->getStyle('A'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('B'.($no_next_table + 2).'','SK2');
        $this->excel->getActiveSheet()->getStyle('B'.($no_next_table + 2).'','SK2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('C'.($no_next_table + 2).'','SK3');
        $this->excel->getActiveSheet()->getStyle('C'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('D'.($no_next_table + 2).'','SK4');
        $this->excel->getActiveSheet()->getStyle('D'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('E'.($no_next_table + 2).'','SK5');
        $this->excel->getActiveSheet()->getStyle('E'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('F'.($no_next_table + 2).'','SK6');
        $this->excel->getActiveSheet()->getStyle('F'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('G'.($no_next_table + 2).'','SK7');
        $this->excel->getActiveSheet()->getStyle('G'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('H'.($no_next_table + 2).'','SK8');
        $this->excel->getActiveSheet()->getStyle('H'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('I'.($no_next_table + 2).'','SK9');
        $this->excel->getActiveSheet()->getStyle('I'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('J'.($no_next_table + 2).'','SK10');
        $this->excel->getActiveSheet()->getStyle('J'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('J'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('K'.($no_next_table + 2).'','UTS');
        $this->excel->getActiveSheet()->getStyle('K'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('L'.($no_next_table + 2).'','UAS');
        $this->excel->getActiveSheet()->getStyle('L'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('L'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('M'.($no_next_table + 2).'','Rapor');
        $this->excel->getActiveSheet()->getStyle('M'.($no_next_table + 2).'')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M'.($no_next_table + 2).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        
        $total_siswa = count($siswa);
        $r_sk1 = array_sum($arr_sk1)/$total_siswa;
        $r_sk2 = array_sum($arr_sk2)/$total_siswa;
        $r_sk3 = array_sum($arr_sk3)/$total_siswa;
        $r_sk4 = array_sum($arr_sk4)/$total_siswa;
        $r_sk5 = array_sum($arr_sk5)/$total_siswa;
        $r_sk6 = array_sum($arr_sk6)/$total_siswa;
        $r_sk7 = array_sum($arr_sk7)/$total_siswa;
        $r_sk8 = array_sum($arr_sk8)/$total_siswa;
        $r_sk9 = array_sum($arr_sk9)/$total_siswa;
        $r_sk10 = array_sum($arr_sk10)/$total_siswa;
        $r_uts = array_sum($arr_uts)/$total_siswa;
        $r_uas = array_sum($arr_uas)/$total_siswa;
        $r_rapor = array_sum($arr_rapor)/$total_siswa;
        
        $this->excel->getActiveSheet()->setCellValue('A'.($no_next_table + 3).'',($r_sk1==0)?"-":ceil($r_sk1));
        $this->excel->getActiveSheet()->getStyle('A'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('B'.($no_next_table + 3).'',($r_sk2==0)?"-":ceil($r_sk2));
        $this->excel->getActiveSheet()->getStyle('B'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('C'.($no_next_table + 3).'',($r_sk3==0)?"-":ceil($r_sk3));
        $this->excel->getActiveSheet()->getStyle('C'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('D'.($no_next_table + 3).'',($r_sk4==0)?"-":ceil($r_sk4));
        $this->excel->getActiveSheet()->getStyle('D'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('E'.($no_next_table + 3).'',($r_sk5==0)?"-":ceil($r_sk5));
        $this->excel->getActiveSheet()->getStyle('E'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('F'.($no_next_table + 3).'',($r_sk6==0)?"-":ceil($r_sk6));
        $this->excel->getActiveSheet()->getStyle('F'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('G'.($no_next_table + 3).'',($r_sk7==0)?"-":ceil($r_sk7));
        $this->excel->getActiveSheet()->getStyle('G'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('H'.($no_next_table + 3).'',($r_sk8==0)?"-":ceil($r_sk8));
        $this->excel->getActiveSheet()->getStyle('H'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('I'.($no_next_table + 3).'',($r_sk9==0)?"-":ceil($r_sk9));
        $this->excel->getActiveSheet()->getStyle('I'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('J'.($no_next_table + 3).'',($r_sk10==0)?"-":ceil($r_sk10));
        $this->excel->getActiveSheet()->getStyle('J'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('K'.($no_next_table + 3).'',($r_uts==0)?"-":ceil($r_uts));
        $this->excel->getActiveSheet()->getStyle('K'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('L'.($no_next_table + 3).'',($r_uas==0)?"-":ceil($r_uas));
        $this->excel->getActiveSheet()->getStyle('L'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->setCellValue('M'.($no_next_table + 3).'',($r_rapor==0)?"-":ceil($r_rapor));
        $this->excel->getActiveSheet()->getStyle('M'.($no_next_table + 3).'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('J8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('L8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('N8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('O8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('P8')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('Q8')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:M1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $this->excel->getActiveSheet()->getStyle('E8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('I8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('J8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('K8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('L8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('N8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('O8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('P8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $this->excel->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS); 
              
        $filename='nilai.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
        
    }
    
    
    
    public function contoh(){
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Nilai Sisawa');                         
        $this->excel->getActiveSheet()->setCellValue('A1','NILAI SISWA KELAS TAI');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:G1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $filename='nilai.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    
    
    
    
}

?>