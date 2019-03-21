<!DOCTYPE html>

<html lang="en">
<head>
 <meta charset="UTF-8">
 <!-- Autor: Web-informatica SA DE CV -->
 <!-- Developer-Front end And Back End: Jose Enrique Lopez -->
 <title></title>
 
 <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
 <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet"> 

 <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>css/custom.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
 <link href="<?php echo base_url(); ?>css/set.css" rel="stylesheet" type="text/css">
 <link href="<?php echo base_url(); ?>css/tinymce_style.css" rel="stylesheet" type="text/css">
 <link href="<?php echo base_url(); ?>css/billingDashboard.css" rel="stylesheet" type="text/css">


<?php 
if(!$totOthersCont){ $totOthersCont="1";  }
?>
	<script>
		  var base_url="<?=base_url()?>";
		  var base_app="<?=base_app()?>";
		  var fieldContactID="";
		  var fieldContactName="";
		  var CountInput=<?=$totOthersCont?>;
		  
		  var CountAddAdress=1;
		  var CountAddPhone=1;
		  var totEmailCont=1;
		  var totWebsiteCont=1;
		  var refrr=0;
      var actualVal=0;
      var reloadAfterSave="";
      var typeDesc = "";
      var totalDesc = "";
      var totalDescEX="";
      var totalDescSE="";
      var totalFinal="";
      var taxEqui="";
      var totalParc="";
      var taxAplyTo="";
      var totserv="";
      var totexpen="";
       
       

	</script>
	<script src="<?=base_app()?>js/jquery-3.2.1.min.js"></script>



   

</head>







<body class="nav-md"  >

	<div id="newContactForm"></div>
	<div id="relContactForm"></div>
	<div id="taskForm"></div>
  <div id="atachTo"></div>
  <div id="prev_inv"></div>
  <div id="newFolder" class="ligtBox"></div>

  <div id="modal-event" class="modal fade modal-mira" role="dialog">
    <div class="loading-modal"></div>
  </div>
  
  <!-- <div id="AtachTo"></div> -->

 <div class="container body">
  <div class="main_container">
  
	<div id="fadeBlack"></div>

   <div class="col-md-3 left_col " id="mainMenuWrap">
		<div class="left_col scroll-view">

		 <div class="navbar nav_title" style="border: 0;">
             

                <div class="clearh20"></div>
		          <a href="<?=base_app()?>" class="site_title">
		              <img width="200"    src="<?=base_url()?>img/logo.png" />
		          </a>
                <div class="clearh20"></div>
		 </div>

		 <div class="clearfix"></div><br>

		 <!-- sidebar menu -->
		 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		  <div class="menu_section">

		   <ul class="nav side-menu  "  >
			 <?php $this->load->view("MainMenu"); ?>
			
		   </ul>
		  </div>
		 </div>
		 <!-- fin side menu -->
				
		</div>
   </div>

   

   <!-- top navigation -->
   <div class="top_nav" id="topWrap">
    <div class="nav_menu">
     
     <nav>


        <script>
                function toggleMenu() {   

                    if($("#mainMenuWrap").is( ":visible" )){
                        $("#mainMenuWrap").hide("fast");
                        $("#wrapContent").css({"margin-left":"0px"});
                        $("#topWrap").css({"margin-left":"0px"});

                         $(".matterContent").css({"margin-left":"10%","margin-right":"10%"});
                         $("#topMbarWrap").css({"margin-left":"9%","margin-right":"9%"});
                         

                        
                        
                    }else{
                        $("#mainMenuWrap").show( "fast" );
                        $("#wrapContent").css({"margin-left":"220px"});
                        $("#topWrap").css({"margin-left":"220px"});

                        $(".matterContent").css({"margin-left":"2%","margin-right":"2%"});
                         $("#topMbarWrap").css({"margin-left":"0%","margin-right":"0%"});
                    }

                     
                }   


        </script> 

        <div class="nav toggle" id="">
            <a id="menu_toggle" onclick="toggleMenu()"><i class="fa fa-bars"></i> </a>
        </div>


      <ul class="topMbar" id="topMbarWrap">

           <li>
                <a class="sig" href="<?=base_app()?>Secure/RemoveSession"> 
                    Sign Out
                </a>
           </li>


           <li>
                <a href=""> 
                 
                </a>
           </li>



           <li class="">
           
                <a href="">
                    
                    Welcome-<?=$this->session->userdata('Name')?> <?=$this->session->userdata('LastName')?>
                </a>
           </li>

           <li>
                 
                <img src="<?=base_app()?>/img/user.png" /> 
                 
           </li>


           <li>
                <a href="" >
                      
                </a>
           </li>


           <li>
               <form> 
                  
              </form>
           </li>

           <li style="float:left">
                <form> 
                    <input type="text" onkeyup="search(this.value,'_A')"  class="form-control" placeholder="&#xF002; Search" style="font-family:Lato, FontAwesome" />
                    <div class="   btn-group   searh_result ">
                        <div class="  dropdown-menu" id="searchResult">
                      

                      
                        </div>
                    </div>

                </form>
           </li>
           <div class="clearh1"></div>

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



	<div class="right_col wrapContent" id="wrapContent" role="main">

		<strong class="red"><?php if(isset($Wmessage)){ echo $Wmessage; } ?></strong>
        <strong ><?php  if(isset($message)){ echo $message; } ?></strong>
        <strong ><?php if($this->session->userdata('smessage')){ echo $this->session->userdata('smessage'); $this->session->unset_userdata('smessage'); } ?></strong> 

        <?php $this->load->view($vista); ?>

    </div>   

  	
<?php 
 $this->session->set_userdata('Wmessage','');
  $this->session->set_userdata('message','');

  
 $this->session->set_userdata('validation_errors','');
?>	
   <script src="<?=base_url()?>js/utilbilling.js"></script>
</body>
</html>
		
		
		
		
		




