 <?php 
 $ci =&get_instance();
 $ci->load->model("AdminModel");

 ?>
 <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
 <script src="<?=base_url()?>js/util.js"></script>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo">
 	<h3>Working Time</h3><hr>
 </div>
 <div class="container">
 	<ul class="topMbar" id="topMbarWrap">
 		<li style="float:left">
 			<form> 
 				<input type="text" onkeyup=""  class="form-control" placeholder="&#xF002; Search" style="font-family:Lato, FontAwesome" />
 			</form>
 		</li>
 	</ul>
 	<div class="container-tabla">
 		<table class="table table-responsive table-striped" style="margin-top: 160px;">
 			<thead class="header-table-sessions">
 				<tr>
 					<th>Employee</th>
 					<th>Time</th>
 				</tr>
 			</thead>
 			<tbody class="body-table-sessions">
 				<?php
 				for ($i = 0; $i < count($users); $i++) {
 					$url = base_url()."Admin/Working_detail/".$users[$i]->Id;
 					?>
 					<tr>
 						<td><a class="session_user_link" href="<?=$url;?>"><?=$users[$i]->Name." ".$users[$i]->LastName?></a></td>
 						<td><?=$work_time[$i];?></td>
 					</tr>
 					<?php } ?>
 				</tbody>
 			</table>
 		</div>
 	</div>