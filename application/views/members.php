<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Members page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('bootstrap/css/custom.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('tipuesearch/css/normalize.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('tipuesearch/css/customize.css');?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <script src="<?php echo base_url('jquery/jquery-3.1.1.min.js');?>"></script>

  <script src="<?php echo base_url('tipuesearch/tipuesearch_set.js');?>"></script>
  <script src="<?php echo base_url('tipuesearch/tipuesearch_content.js');?>"></script>
  <script src="<?php echo base_url('tipuesearch/search.js');?>"></script>
 
  <style type="text/css">
  	body{
  		background:	#FFFAFA;
  	}
    .navbar-brand{
      font-size: 13px;
    }
  </style>
 
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">AUTH CI3</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url("main") ?>">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
      href="#"><?php 

      if($this->session->userdata('is_login'))
      {
      print_r($this->session->userdata('username'));
      }
      else
      {
        echo "Comments";
      }
      ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url("Main/profile") ?>">
      <?php
      if($this->session->userdata('is_login'))
      {
        echo "Profile";
      }
      else
      {
        echo "";
      }
      ?>
      </a></li>
          <li><a href="<?php echo base_url("main/comments") ?>">Comments Page</a></li>
        </ul>
        </li>
         <li>
          <a href="<?php echo base_url("main/logout") ?>">
          <?php 
          if(!$this->session->userdata('is_login'))
          {
          	echo "About";
          }
          else
          {
              echo "Logout";
          }
          ?>
          </a></li>
        <li>
            <a href="<?php echo base_url("main/login") ?>">
              <?php 
              if($this->session->userdata('is_login'))
              {
              	echo "";
              }
              else 
              {
                echo "Login";
              }
              ?>
            </a></li>
        <li>
            <a href="<?php echo base_url("main/signup") ?>">
              <?php 
              if($this->session->userdata('is_login'))
              {
              	echo "";
              }
              else 
              {
                echo "Sign Up";
              }
              ?>
            </a></li>
        </ul>
     <div class="col-lg-3 col-lg-offset-4">
        <form class="navbar-form" role="search" action="<?php echo base_url('main/search') ?>">
        <div class="input-group">
            <input type="text" class="form-control" name="q" id="tipue_search_input" pattern=".{3,}" title="At least 3 characters" placeholder="Type html" required>
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" onclick="this.form.submit();"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
     </div>
    </div>
   </div>
 </nav>

    <?php if ($this->session->flashdata('category_success')) { ?>
    <div style="paddingTop:0" class="col-lg-12 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>You are Logged In  <?php  print_r($this->session->userdata('username')); ?></div>
    <?php } ?>
    </div>



<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
</body>
</html>