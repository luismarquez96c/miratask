 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 $ci->load->model("MatterModel");
 ?>


 <!-- CONTENIDO MATTERS -->

 <?php if(isset($message)){ echo $message; }  ?>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
 	<h3><?=$this->lang->line('main_11')?></h3><hr>
 </div>

 <div class="row">

 	<div class="matterContent">
 		<div class="centerMeessage">
 			<!-- MATTERS delete confirm -->
 			<BR>
 			<BR>
 			<BR>

 			<h3><?=$this->lang->line('main_12')?> <?=$nameObject?>?</h3>
 			<BR>
 			<BR>
 			<BR>

 			<?php 

			//echo "<pre>";
			//print_r($ObjectNomb);
			//echo "</pre>";

 			if(count($ObjectNomb)>0){
 				foreach ($ObjectNomb as $value){ 

 					echo "<li>".$value."</li>";
 				}

 			}
 			?>
 			<BR>
 			<BR>
 			<BR>

 			<a href="<?=$linkSi?>"  class="btn btn-default  btn-block btn-lg" style="width:100px;"><?=$this->lang->line('session_3')?></a>
 			<a href="<?=$linkNo?>" class="btn btn-default  btn-block btn-lg" style="width:100px;"><?=$this->lang->line('session_2')?></a> 

 			<BR>
 			<BR>
 			<BR>
 		</div>
 	</div><!-- fin clase maters content -->

 </div>
 