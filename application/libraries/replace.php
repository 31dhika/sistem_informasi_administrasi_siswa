<?php
    class Replace {
        public $string = array(',','(',')',' ','^','$','*');
        public $string_back = '%20' ;
        
        public function bhoting_replace($kalimat)
        {
            $k = str_replace($this->string,'-',$kalimat);
            return $k;
        }
        
        public function bhoting_replace_back($kalimat){
            $k = str_replace($this->string_back,' ',$kalimat);
            return $k;
        }
    }
?>