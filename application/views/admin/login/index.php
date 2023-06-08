<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="bhoting" />

	<title><?php echo $title; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="<?php echo base_url().'bootstrap'; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="<?php echo base_url().'bootstrap'; ?>/css/style.css" rel="stylesheet" media="screen"/>
</head>

<body style="background-color: #D7E1EA;">

<div class="container">
      <form class="form-signin" action="<?php echo base_url('admin/login/login_proses'); ?>" method="post">
      <div class="login">
        <center><img src="<?= base_url('images/component/tut-wuri-handayani.png'); ?>" width="150"/></center>
        <center><h2 class="form-signin-heading">Login Staff <br/> SMPN 195 Jakarta</h2></center>
        <hr />
      <div class="form_login">
        <input type="text" class="input-block-level" name="username" placeholder="Username" />
        <input type="password" class="input-block-level" name="password" placeholder="Password" />
        <button class="btn btn-large btn-primary" type="submit" >Login</button>
      </div>
      </form>
      
      <?php if($this->session->flashdata('login_gagal')){
        ?><div class="alert alert-error"><center><?php
        echo $this->session->flashdata('login_gagal');
        ?></center></div><?php
    } elseif($this->session->flashdata('account_expired')){
        ?><div class="alert alert-error"><center><?php
        echo $this->session->flashdata('account_expired');
        ?></center></div><?php
    } ?>
    </div>
    
</div>

<script src="<?php echo base_url().'bootstrap'; ?>/js/jquery.js"></script>
<script src="<?php echo base_url().'bootstrap'; ?>/js/bootstrap.min.js"></script>
</body>
</html>