
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title></title>
 <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>css/custom.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
</head>


<body class="nav-md">
 <div class="container body">
  <div class="main_container">

   <div class="col-md-3 left_col">
    <div class="left_col scroll-view">

     <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title">
       <img src="img/img1.png"><img src="img/img2.png">
      </a>
     </div>

     <div class="clearfix"></div><br>

     <!-- sidebar menu -->
     <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">

       <ul class="nav side-menu">
        <li><a><i class="fa fa-home"></i> Home</a></li>
        <li><a><i class="fa fa-balance-scale"></i> Matters</a></li>
        <li><a><i class="fa fa-users"></i> Contacts</a></li>
        <li><a><i class="fa fa-calendar"></i> Calendar</a></li>
        <li><a><i class="fa fa-list-alt"></i> Task</a></li>
        <li><a><i class="fa fa-files-o"></i> Documents</a></li>
        <li><a><i class="fa fa-clone"></i> Billindg</a></li>
       </ul>
      </div>
     </div>
            
    </div>
   </div>

   

   <!-- top navigation -->
   <div class="top_nav">
    <div class="nav_menu">
     
     <nav>
      <div class="nav toggle">
       <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>


      <ul class="nav navbar-nav navbar-right">

       <li>
        <a href=""> Sign Out</a>
       </li>


       <li>
        <a href=""> Help &ensp;<i class="fa fa-question-circle" aria-hidden="true"></i></a>
       </li>

       <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
         <i class="fa fa-user" aria-hidden="true"></i> &ensp;Nombre_Usuario
        </a>
       </li>

       <li role="presentation" class="dropdown">
        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
         <i class="fa fa-bell" aria-hidden="true"></i>
        </a>
       </li>

       <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-left top_search" style="padding-top: 10px;">
        <div class="input-group">
         <input type="text" class="form-control" placeholder="Quick Links">
         <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
         </span>
        </div>
       </div>

       <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search" style="padding-top: 10px; width: 32rem; ">
        <div class="input-group">
         <input type="text" class="form-control" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome">
         <span class="input-group-btn"> 
          <button class="btn btn-default" type="button"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
         </span>
        </div>
       </div>

      </ul>

     </nav>
    </div>
   </div>


<!-- script's -->

    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    <script src="<?php echo base_url(); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.smartWizard.js"></script>
    <script src="<?php echo base_url(); ?>js/my.js"></script>