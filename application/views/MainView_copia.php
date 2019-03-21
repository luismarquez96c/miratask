<?php 
$ci =&get_instance();
$ci->load->model("AdminModel");

$ci->load->model('AdminModel');

$url = $ci->AdminModel->get_url();

$url = $url->url;

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Autor: Web-informatica SA DE CV -->
	<title>Miratask</title>

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

	<script src="<?=base_url()?>js/jquery-3.2.1.min.js"></script>

  <!-- <link  href="<?=base_url()?>js/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  	<script src="<?=base_url()?>js/perfect-scrollbar/dist/perfect-scrollbar.js"></script> -->





  </head>







  <body class="nav-md"  >
  	<!-- Modal para inicio de correo -->
  	<div class="modal fade" id="modal-correo">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  					<h4 class="modal-title">Email Login</h4>
  				</div>
  				<div class="modal-body">
  					<div class="col-md-10 col-md-offset-1">
  						<form action="#" method="POST" role="form" id="form-email">
  							<div class="form-group">
  								<label for="">Email</label>
  								<input type="email" name="email" id="email" required="" class="form-control">
  							</div>
  							<div class="form-group">
  								<label for="">Password</label>
  								<input type="password" name="pass" id="pass" required="" class="form-control" placeholder="Password">
  							</div>

  						</div>
  					</div>
  					<div class="modal-footer" style="border-top: none;">
  						<button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 0;padding: 8px 19px;font-size: 15px;">Close</button>
  						<button type="submit" class="btn btn-primary" id="save-form" style="border-radius: 0;padding: 8px 19px;font-size: 15px;">Save</button>
  					</form>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- Fin de login para correo -->   

  	<?php $this->load->view('lightbox'); ?>

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
              <?php if (empty($url) or $url ==" ") {

              }else{
                echo '<img src="'.$url.'" alt="" style="width:60%;">';
                
              }

              ?>
              
  						<!--<a href="<?=base_app()?>" class="site_title">
  							<img width="200"    src="<?=base_url()?>img/logo.png" />
  						</a>-->
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
  								<?php if ($this->session->userdata('email_unread')) {
  									echo '<a data-toggle="modal" href="#">Welcome- '.$this->session->userdata('Name')." ".$this->session->userdata('LastName').'</a>';
  								}else{ ?>
                    <a data-toggle="modal" href='#modal-correo'>

                     Welcome-<?=$this->session->userdata('Name')?> <?=$this->session->userdata('LastName')?>
                   </a>
                   <?php } ?>
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
                   <div class="   btn-group   searh_result " id="searh_result_wrap">
                    <div class="close" onclick="switchx('searh_result_wrap')">
                     x
                   </div>

                   <div class="MainsearchMenu" id="searchResult">



                   </div>
                 </div>

               </form>
             </li>
             <div class="clearh1"></div>

           </ul>

         </nav>
       </div>
     </div>



     <!-- script's en-algdp 3 4 4 -->
     <!-- script's mld  4 8 8 4 -->

     <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
     <script src="<?php echo base_url(); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> 
     <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
     <script src="<?php echo base_url(); ?>js/jquery.smartWizard.js"></script> 
     <script src="<?=base_url();?>js/FileSaver.min.js"></script>
     <script src="<?=base_url();?>js/tableexport.min.js"></script>
     <script src="<?= base_url();?>js/timesheet.js"></script>
     <script src="<?=base_url();?>js/email_vinculate.js"></script>


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
    <footer class="col-xs-10" style="background: #0055a5;font-size: 12px;">
      <p class="text-center" style="color:#fff;">Powered by <img style="width: 10%" src="<?=base_url();?>img/logo/logo5.png" alt=""><br>Copyright <?=date('Y');?></p>
      <p class="text-right">
        <?php 
        if ($this->session->userdata('Role')==1){
          if (empty($url) or $url ==" ") {
            echo '<a style="font-size: 12px;text-align: right;padding-right: 20px;" href="'.base_url().'Admin/changeLogo" class="site_title">Change Logo</a>';
          }else{
            echo '<br><a style="font-size: 12px;text-align: right;padding-right: 20px;color:#fff;padding-top:20px;" href="'.base_url().'Admin/changeLogo" class="">Change Logo</a>';
          }
        }
        else{

        }

        ?>
      </p>
    </footer>

  </body>
  </html>
