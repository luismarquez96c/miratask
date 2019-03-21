





<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>MiraLaw | Login</title>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style2.css">
 <link href="<?php echo base_url(); ?>css/set.css" rel="stylesheet" type="text/css">
 <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

</head>

<body>
    

<section class="seccion-login mbr-section mbr-section-full" id="login">
 <div class="mbr-table-cell">

  <div class="container">
   <div class="row">


    <div class="mbr-section col-md-6 col-md-offset-3">
     <div class="panel panel-default">

      <div class="logo-img"> 
       <div class="row-fluid user-row">
        <img src="<?=base_url()?>img/logo.png" class="img-responsive" alt="MiraLaw">
       </div>
      </div>




		<div id="loginContent">
			<?php $this->load->view($vista); ?>
		</div>
		

      
   
      







     
     <div class="col-md-12" id="login-footer">
      <p> <br>Terms of Service I Terms of Conditions I Privacy Policy I Copyright © 2017 Mira Law.All rights reserved.</p>
     </div>
    </div>

   </div>
  </div>
 </div>
</section>



 <script type="text/javascript" src="js/bootstrap.min.js"></script>


</body>
</html>