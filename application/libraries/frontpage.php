<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class frontpage {
    
	var $template_data = array();
	
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function view($view = '' , $view_data = array(), $return = FALSE) {
        $this->CI =& get_instance();
        $this->set('isi', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view('front_layout', $this->template_data, $return);
    }
    
}