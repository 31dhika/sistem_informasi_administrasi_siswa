<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php echo $this->load->view("component_backend/tag_head"); ?>

<body>

<?php echo $this->load->view("component_backend/navigasi_atas"); ?>
    

<div class="body-container">
<div class="container">
    <div class="row-fluid">
    
    <div class="span3 ">
    <?php echo $this->load->view("component_backend/navigasi_kiri"); ?>
    </div>    
        
    <div class="span9">
        <?php echo $contents; ?>
    </div>
    
    </div>
</div>

</div>
<div style="height: 120px;"></div>
<?php echo $this->load->view("component_backend/footer"); ?>
                
</body>
</html>