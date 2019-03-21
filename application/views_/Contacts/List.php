 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("MatterModel");
 ?>

 <script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script src="<?=base_url()?>js/util.js"></script>

<script>
 $( function() {
    $( "#DateOpened" ).datepicker();
  } );
</script>
<!-- CONTENIDO Contacts -->



 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Contacts</h3><hr>
 </div>

 <div class="row">
	
	<div class="matterContent">
		<!-- Contacts -->
		
		<div class="col-md-3 panel_cat">
			<div class="x_panel">
			   
				<div id="matters" class="x_title">
					<h2><i class="fa fa-balance-scale"></i> &ensp;All Contacts</h2>
					<div class="clearfix"></div>
				</div>
			 
				<!-- matter cat  -->
				<div id="content-matters" class="matCat">
					

					
					<a href="<?=base_app()?>Contacts/setGroup/ALL">
						   All Groups
					</a>

					<?php 
						foreach ($Groups as $row)
						{ ?>
					
					<a href="<?=base_app()?>Contacts/setGroup/<?=$row->Id?>">
						   <?=$row->Name?>
					</a>

					<?php } ?>

					<script type="text/javascript">
						function showCreateNew(){

							if($("#newGroupForm").is( ":visible" )){
								$("#newGroupForm").slideUp("fast");
							}else{
						
								$("#newGroupForm").slideDown( "fast" );
							}
						}

					</script> 
					<a>
						   <span class="underLineText" onclick="showCreateNew()" >
						   		<img src="<?=base_app()?>/img/add_adress.jpg" > Add Group
						   </span>
						    <div class="clearh1"></div>
						   
					</a>
					
					<div class="clearh1"></div>
					
					<div id="newGroupForm">
						<?php
							echo $this->session->set_userdata('message', $message);
							echo $this->session->set_userdata('Wmessage', $message);
						?>
						<form action="<?=base_app()?>Contacts/saveGroup" method="POST" id="WrapCreateGrp">
							<input type="text" name="GroupName" />
							<div class="clearh10"></div>
							
							<input type="button" value="X" onclick="showCreateNew()" id="close" />
							<input  type="submit" value="" id="save" />
						</form>

				    </div>

					
					
					
				</div>
			</div>
		</div>
			
			 
		<div class="col-xs-9 ListWrap">		
			  
			<form   action="<?=base_app()?>Contacts/eraseListConfirm" method="POST" id="contactList" >
			  
			  <div class="col-xs-12  buttWrap">

				  	<!-- boton " + add Contact"-->
					<div class="col-md-3 pl0">
						<a id="add_matters" onclick="createContact('ContactID_A','Contact_A')" class="btn btn-primary btn-lg btn-block" >
						<i class="fa fa-plus"></i> &nbsp; Add Contact
						</a>
					</div>
				  

					<!-- boton " Delete Contacts" -->
					<div class="col-md-3">
						<input type="submit" id="delete_matters"   class="btn fa-trash btn-block" value="&#xf1f8; Delete Contacts" style="font-family:Arvo, FontAwesome" />
					</div>

					<div class="col-md-3">
						 

						<div class="btn-group ml-2 listButtWrap">

					      <button id="abc"type="button" class="btn btn-lg btn-secondary">ABC</button>
					      <button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >
					         
								<span class="caret"></span>
							 
					      </button>
					      <ul class="dropdown-menu btn-block listABC" role="menu">
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/A">A</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/B">B</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/C">C</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/D">D</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/E">E</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/F">F</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/G">G</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/H">H</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/I">I</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/J">J</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/K">K</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/L">L</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/M">M</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/N">N</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/N">Ñ</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/O">O</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/P">P</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Q">Q</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/R">R</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/S">S</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/T">T</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/U">U</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/V">V</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/W">W</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/X">X</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Y">Y</a></li>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Z">Z</a></li>
					        	<div class="dropdown-divider"></div>
					        	<li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/ALL">All</a>
					      </ul>
					    </div><!-- fin wrap ml 2 -->

					</div><!-- fin md 3 -->

					<div class="col-md-3">
						

						<div class="btn-group ml-2 listButtWrap">

					      <button id="abc"type="button" class="btn btn-lg btn-secondary">Groups</button>
					      <button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >
					         
								<span class="caret"></span>
							 
					      </button>
					      <ul class="dropdown-menu btn-block groupTopList" role="menu">

								<?php 
								foreach ($Groups as $row)
								{ ?>

					        	<li class="">
									<input type="checkbox" name="goupID[]" class="goupID" value="<?=$row->Id?>" onclick="addHiddenGroups(this.value)">
									 <?=$row->Name?> 
								</li>
					        	
					        	<?php  
								} 
								?>  
			                    
					        	<div class="dropdown-divider"></div>
								
								<li class="">
									<button type="button" class="btn btn-default btn-xs" onclick="ContactsTo(1)">
										 Add to Group 
									</button>	
								</li>
								<li>
									<button type="button" class="btn btn-default btn-xs" onclick="ContactsTo(2)">	
										Remove From Group 
									</button>
								</li>		
								
					      </ul>
						  
					    </div><!-- fin wrap ml 2 -->

						





					</div><!-- fin md 3 -->


				</div><!-- fin xs 9 -->

				<div class="col-xs-12 wrapMess">
				<?php 
				if(isset($message)){ echo $message; }   
				echo $this->session->userdata("Wmessage");
				echo $this->session->set_userdata("message","");
				?>
				</div>





				<!-- all Contacts -->


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
						    newWin.close(); 
						}
				</script>

				<div class="col-xs-12">
					<div class="print">
						<p>All Contacts</p> <span onclick="printTMatters()"  class="fa fa-print  fa-2x"  ></span>
					</div>
				</div>


				<!-- tabla -->

				<div class="col-xs-12" >
					
					<div class="paginationWrap" > 
						<div class="pagesList col-md-4" ><?php echo $links ?></div> 
						<div class="resxP     col-md-4">
							
							<span class="l">Result per page: &nbsp;</span>
							
							<button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown">
								
								Change
									<span class="caret"></span>
								
							</button>

							<ul class="dropdown-menu btn-block" role="menu">
								 <li><a href="<?=base_app()?>Contacts/MAxResultXPage/5">5</a></li>
								 <li><a href="<?=base_app()?>Contacts/MAxResultXPage/10">10</a></li>
								 <li><a href="<?=base_app()?>Contacts/MAxResultXPage/15">15</a></li>
								 <li><a href="<?=base_app()?>Contacts/MAxResultXPage/20">20</a></li>
							</ul>


							
						</div>
						<div class="resultInfo col-md-4">
							<?=$startItem?>-<?=$endItem?> of <?=$totalContact?> items
						</div>
						<div class="clearh1"></div>
					</div>


					
					<div id="resultTable"> 
					
						<table class="table table-bordered table-inverse">
							<thead>
								<tr>
									<th> </th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Group List</th>
									 
								</tr>
							</thead>

						<tbody>
						<?php 
						
						foreach ($Contacts as $row){ 
							$ci->load->model("ContactModel");
							
							$Phone = $ci->ContactModel->onePhone($row->Id);
							$Email = $ci->ContactModel->oneEmail($row->Id);
							$Groups = $ci->ContactModel->GroupsOFContacts($row->Id);
							

							 if($row->Class=="Business-Org"){

							 	$name = $row->Company;

							 }else{
							 	$name = $row->FirstName." ".$row->LastName;
							 }
						 
						 
							 
						?>
						 <tr>
							  <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>" class="itemContact"> </td>
							  <td><a onclick="atachTo('AjaxContact/details/<?=$row->Id?>')"><?=$name?></a></td>
							  <td><?=$Phone->Phone?></td>
							  <td><?=$Email->Email?></td>
							  <td><?php
									if(count($Groups)>0){
										foreach($Groups as $row  ){
											echo $row->NameGroup.",";
										}
									}
							  
							  ?></td>
						 </tr>
						
						<?php } ?>
						  
						</tbody>
					   </table>
					</div><!-- fin result table -->   
				</div><!-- fin col-md-9 -->
			</form>	
		</div>	
	</div><!-- fin clase maters content -->

 </div>
 