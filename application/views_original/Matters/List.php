 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 $ci->load->model("MatterModel");
 ?>

 <script src="<?=base_url()?>js/util.js"></script>
 <!-- CONTENIDO MATTERS -->

 <?php if(isset($message)){ echo $message; }  ?>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
 	<h3>Matters</h3><hr>
 </div>

 <div class="row">

 	<div class="matterContent">
 		<!-- MATTERS -->


 		<!-- Menu de categorias  -->
 		<div class="col-xs-3 panel_cat">
 			<div class="x_panel">

 				<div id="matters" class="x_title">
 					<h2><i class="fa fa-balance-scale"></i> &ensp;All Matters</h2>
 					<div class="clearfix"></div>
 				</div>

 				<!-- matter cat  -->
 				<div id="content-matters" class="matCat">

 					<a href="<?=base_app()."Matters/ChangeArea/ALL"?>"> 
 						All Matters
 					</a>	

 					<?php 

 					foreach ($Areas as $row)
 					{

 						$totalMatterCat=$ci->MatterModel->totalMatterArea($row->Id);	
 						?>

 						<a href="<?=base_app()."Matters/ChangeArea/".$row->Id?>">
 							<?=$row->Name?> <span>(<?=$totalMatterCat->total?>)</span>
 						</a>

 						<?php 

 					}

 					?>
 				</div>
 			</div>
 		</div><!-- fin menu de categorias -->



 		<div class="col-xs-9 ListWrap">
 			<form name ="listForm" id="listForm" action="<?=base_app()?>Matters/eraseListConfirm" method="POST"  >

 				<div class="col-xs-12  buttWrap">
 					<!-- boton " + add Matters"-->

 					<div class="col-md-3 pl0">
 						<a id="add_matters" href="<?=base_app()?>Matters/CreateNew" class="btn btn-primary btn-lg btn-block" >
 							<i class="fa fa-plus"></i> &nbsp; Add Matters
 						</a>
 					</div>
 					<!-- boton " Desactivar Matters" --> 
 					<div class="btn-group ml-2 listButtWrap">

 						<button id="abc" type="button" class="btn btn-lg btn-secondary">Disable</button>
 						<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" aria-expanded="false">
 							<span class="caret"></span>
 						</button>
 						<ul class="dropdown-menu btn-block" role="menu" style="">
 							<li><a class="dropdown-item" onclick="AtachList('Matters/DesactivarList/1')">Active</a></li>
 							<li><a class="dropdown-item" onclick="AtachList('Matters/DesactivarList/2')">Desactive</a></li>
 						</ul>
 					</div>

 					<!-- boton " Delete Matters" -->
 					<div class="col-md-3">
 						<input type="submit" id="delete_matters"   class="btn fa-trash btn-block" value="&#xf1f8; Delete Matters" style="font-family:Arvo, FontAwesome" />
 					</div>

 					<div class="col-md-3">



 						<div class="btn-group ml-2 listButtWrap">

 							<button id="abc" type="button" class="btn btn-lg btn-secondary">ABC</button>
 							<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >

 								<span class="caret"></span>

 							</button>
 							<ul class="dropdown-menu btn-block listABC" role="menu">
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/A">A</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/B">B</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/C">C</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/D">D</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/E">E</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/F">F</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/G">G</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/H">H</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/I">I</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/J">J</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/K">K</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/L">L</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/M">M</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/N">N</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/Ñ">Ñ</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/O">O</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/P">P</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/Q">Q</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/R">R</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/S">S</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/T">T</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/U">U</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/V">V</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/W">W</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/X">X</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/Y">Y</a></li>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/Z">Z</a></li>

 								<div class="dropdown-divider"></div>
 								<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/ALL">All</a>
 								</ul>
 							</div>

 						</div><!-- fin col md 3 -->



 					</div><!-- fin  col-xs-12 -->

 					<div class="col-xs-12 wrapMess">
 						<?php 
 						echo $this->session->userdata("Wmessage");
 						$this->session->set_userdata("Wmessage","");

 						$selected = $this->session->userdata("Class");
 						?>

 					</div>

 					<!-- all matters title yelllow-->

 					<div class="col-xs-12">
 						<div class="container container-tabs" style="padding: 0px 0px">
 							<div class="col-lg-3" style="padding: 0px 0px">
 								<a href="<?=base_app().'Matters/ChangeArea/ALL'?>" class="btn btn-primary btn-lg btn-block tabs ALL">All Maters</a>
 							</div>
 							<div class="col-lg-3" style="padding: 0px 0px">
 								<a href="<?=base_app().'Matters/ChangeArea/Actived'?>" class="btn btn-primary btn-lg btn-block tabs Actived" >Active</a>
 							</div>
 							<div class="col-lg-3" style="padding: 0px 0px">
 								<a href="<?=base_app().'Matters/ChangeArea/Desactivated'?>" class="btn btn-primary btn-lg btn-block tabs Desactivated">Desactivated</a>
 							</div>
 							<div class="col-lg-3" style="padding: 0px 0px">
 								<a href="<?=base_app().'Matters/ChangeArea/Overdue'?>" class="btn btn-primary btn-lg btn-block tabs Overdue">Overdue</a>
 							</div>
 						</div>
 						<script type="text/javascript">
 							function printTMatters() {
 								var divToPrint = document.getElementById('resultTable');
 								var htmlToPrint = '' +
 								'<style type="text/css">' +
 								'table th, table td {' +
 								'border:1px solid #000;' +
 								'padding;0.5em;' +
 								'}' +
 								'</style>';
 								htmlToPrint += divToPrint.outerHTML;
 								newWin = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
 								newWin.document.write(htmlToPrint);
 								newWin.print();
 								newWin.open();
 								newWin.close(); 
 							}
 						</script>	
 						<div class="print">
 							<p>All Matters </p> <!--<span onclick="printTMatters()" class="fa fa-print"></span>-->
 						</div>
 					</div>


 					<!-- tabla -->

 					<div class="col-md-12">

 						<div class="paginationWrap col-xs-3" > 

 							<div class="pagesList col-md-4" ><?php echo $links ?></div> 

 							<div class="resxP col-md-4">
 								<span class="l">Result per page: &nbsp;</span>

 								<button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown">

 									<?=$this->session->userdata("Mattxpage")?>
 									<span class="caret"></span>

 								</button>

 								<ul class="dropdown-menu btn-block" role="menu">
 									<li><a href="<?=base_app()?>Matters/MAxResultXPage/5">5</a></li>
 									<li><a href="<?=base_app()?>Matters/MAxResultXPage/10">10</a></li>
 									<li><a href="<?=base_app()?>Matters/MAxResultXPage/15">15</a></li>
 									<li><a href="<?=base_app()?>Matters/MAxResultXPage/20">20</a></li>
 								</ul>
 							</div>

 							<div class="resultInfo col-md-4">
 								<?=$startItem?>-<?=$endItem?> of <?=$totalMatter?> items
 							</div>

 							<div class="clearh1"></div>
 						</div>


 						<div id="resultTable">
 							<table  class="table table-bordered table-inverse">
 								<thead>
 									<tr>
 										<th> </th>
 										<th>Matter Name</th>
 										<th>ID</th>
 										<th>Client Name</th>
 										<th>Practice Area</th>
 										<th>Staff</th>
 										<th>Date Opened</th>
 										<th>Status</th>
 									</tr>
 								</thead>

 								<tbody>
 									<?php 

 									foreach ($Matters as $row){ 
 										$ci->load->model("ContactModel");
 										$contact=$ci->ContactModel->oneContact($row->Client);
 										$Area   =$ci->MatterModel->oneArea($row->Area);
 										$status  =$ci->MatterModel->oneStatus($row->Status);
 										$relatedStaff = $this->MatterModel->relatedStaff($row->Id);
 										$totSTF=count($relatedStaff);

 										$dateValidate =  strtotime($billing_status->DueDate);
 										$today = strtotime(date('Y-m-d'));

 										if (!empty($billing_status)) {
 											if (($billing_status->Status!= 'Draft' && $billing_status->Status) && $today>$dateValidate) {
 												$alert = "vencido";
 											}else{
 												$alert="";
 											}
 										}else{
 											$alert = '';
 										}

 										?>
 										<tr class="<?=$alert?>">
 											<td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>"></td>
 											<td><a href="<?=base_app()?>Matters/Details/<?=$row->Id?>"><?=$row->Name?></a></td>
 											<td><?=$row->MatterID?></td>
 											<td><?=$contact->FirstName." ".$contact->Middle." ".$contact->LastName." ".$contact->Contact?></td>
 											<td><?=$Area->Name?></td>
 											<td><?php
 											$i=1;
 											foreach($relatedStaff as $roww){

 												echo $roww->AtorneyName;

 												if($i>0 and $i<$totSTF){ echo ","; }

 												$i++;
 											} 
 											?></td>
 											<td><?php 
 											echo decodedate($row->DateOpen);

 											?></td>
 											<td><?=$status->State?></td>  
 										</tr>

 									<?php } 

 									?>

 								</tbody>
 							</table>
 						</div> <!-- fin print table -->   
 					</div><!-- fin col-md-9 -->

 				</form>	
 			</div><!-- fin contenedor de matters -->

 		</div><!-- fin clase maters content -->

 	</div>
 	<script>
 		var tab = "<?=$this->session->userdata("Class");?>";
 		$('.'+tab).addClass('selected');
 	</script>