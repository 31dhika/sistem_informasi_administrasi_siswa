<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?= $this->load->view('component_frontend/tag_head'); ?>

<body>
<div class="pembatas">

  <?= $this->load->view('component_frontend/menu'); ?>  
    
    <div class="container-fluid" 
    style="background: white;
     padding: 10px;
     margin-top: 5px;
     text-align: justify;
     padding-bottom: 35px;
     -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    ">
    
    <div class="row-fluid">
        
    
        <div class="span12" >


         <?= $isi; ?>

        </div>
        
    </div>
    
    </div>
    
    
    
    <div class="container-fluid">
        
    </div>
    
    <?= $this->load->view('component_frontend/footer'); ?>
    
</div>





</body>
</html>