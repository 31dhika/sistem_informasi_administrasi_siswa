<?php
    function checkTahunAjaranActive()
    {
        $ci =& get_instance();
        $ci->load->database();
        $q = $ci->db->query("
            SELECT * FROM m_tahun_ajaran WHERE status = 1
        ")->result_array();
        return $q[0]['id_tahun_ajaran'];
    }
    
    function checkSemester()
    {
        $ci =& get_instance();
        $ci->load->database();
        $q = $ci->db->query("
            SELECT * FROM semester WHERE status = 1
        ")->result_array();
        return $q[0]['id'];
    }
