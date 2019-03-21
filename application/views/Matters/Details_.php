 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("MatterModel");
 ?>
<script>
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
} 
 
</script>

<script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?=base_url()?>js/util.js"></script>
 
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 


 
  


<!-- CONTENIDO MATTERS -->

    <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
		<h3>Matters Detail</h3>
		<hr>
    </div>

    <div class="row">
		<div class="matterContent">

			<!-- MATTERS DETAILS -->

			<div class="col-md-2">
				<a id="back_matter" href="<?=base_app()?>Matters"   class="btn btn-primary btn-lg btn-block"> Back to Matter</a>
			</div>


			<div class="col-md-2">
				<a id="close_matter" href="<?=base_app()?>Matters" class="btn btn-primary btn-lg btn-block"> Close Matters</a>
			</div>
			
			<div class="col-md-2">
				<a id="delete_matters"  href="<?=base_app()?>Matters/eraseMatterConfirm/<?=$actualMatter?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-trash"></i>  Delete Matters</a>
			</div>

			<div class="btn-group ml-2 listButtWrap">

				<button id="abc"type="button" class="btn btn-lg btn-secondary">ABC</button>
				<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >
				 
					<span class="caret"></span>
				 
				</button>
				<ul class="dropdown-menu btn-block" role="menu">
					<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/A">A</a></li>
					<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/B">B</a></li>
					<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/C">C</a></li>
					
					<div class="dropdown-divider"></div>
					<li><a class="dropdown-item" href="<?=base_app()?>Matters/ListAlpha/ALL">All Matters</a>
				</ul>
			</div>


			<div class="col-md-9" id="matters_details">

				<div id="matters" class="x_title">
					<?php
						$ResponsybleAtor=$ci->ContactModel->oneContact($Matter->Client);
						$actTab=$this->session->userdata("ActivateTap");
						//echo "<h1>Actual Tap: ".$actTab."</h1>";
					 
					?>
					
					<script>
						function printDetails() 
						{
							var divToPrint = document.getElementById('matters_details');
							var htmlToPrint = '<html><head>';

							

							htmlToPrint +='<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">';
							htmlToPrint +='<link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">';
							htmlToPrint +='<link href="<?php echo base_url(); ?>css/custom.min.css" rel="stylesheet">';
							htmlToPrint +='<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">';
							htmlToPrint +='<link href="<?php echo base_url(); ?>css/set.css" rel="stylesheet" type="text/css">';
							htmlToPrint +='<link href="<?php echo base_url(); ?>css/tinymce_style.css" rel="stylesheet" type="text/css">';

							htmlToPrint +=  '</head><body style="background: #fff;">';
							htmlToPrint += '' +
						        '<style type="text/css">' +
						        '#matters_details {' +
						        'width:100%;' +
						        '}' +
						        '</style>';
							htmlToPrint += divToPrint.outerHTML;
							htmlToPrint +=  '</body></html>';

							newWin = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
							newWin.document.write(htmlToPrint);
							newWin.print();
							newWin.close(); 
						}
					</script>
					 
					<h2> <?=$Matter->Name?>   </h2>
			  		
					<div class="der">
						<i class="fa fa-print" onclick="printDetails()" style="font-size:24px"></i>
					</div>
				</div>
				<script>
					function setTab(){
						
						tabpane = document.getElementsByClassName("tab-pane");
						for (i = 0; i < tabpane.length; i++) {
							tabpane[i].style.display = "none";
						}

						// Get all elements with class="tablinks2" and remove the class "active"
						tablinks2 = document.getElementsByClassName("tabLink2");
						for (i = 0; i < tablinks2.length; i++) {
							tablinks2[i].className = tablinks2[i].className.replace(" active", "");
						}
						
					}
				
					<?php 
					
					if($actTab=="template"){ 
					?>
					
						
						setTab();
						$("#tab2").addClass('active');
						
					<?php }?> 
					<?php 
					if($actTab=="note"){ 
					?>
						setTab();
						$("#tab4").addClass('active');
						 
						
					<?php }?> 
					
					$("#resulAttorney").mouseleave();
				</script>
				<div id="detail_matter" class="x_content">
					<div class="tabPanelWrap" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="opciones" class="nav nav-tabs bar_tabs" role="tablist">
							<li id="tab1" class="tabLink2"><a href="#mcontenido1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <i class="fa fa-balance-scale"></i> Details</a></li>
							<!-- <li id="tab2" class="tabLink2"><a href="#tcontenido2" role="tab" data-toggle="tab"><i class="fa fa-check-square-o"></i> Check List</a></li> -->
							<li id="tab3" class="tabLink2"><a href="#tcontenido3" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-list-alt"></i> Record</a></li>
							<li id="tab4" class="tabLink2"><a href="#tcontenido4" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-sticky-note-o"></i> Notes</a></li>
							<!-- <li id="tab5" class="tabLink2"><a href="#tcontenido5" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-clipboard"></i> Conflict</a></li> -->
							<li id="tab6" class="tabLink2"><a href="#tcontenido6" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-sticky-note-o"></i> Billing</a></li>
							<!-- <li id="tab7" class="tabLink2"><a href="#tcontenido7" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o"></i> Email</a></li> -->
						</ul>
					</div>
				</div>



				<div id="content_meetings_appointments" class="tab-content">

					<!-- contenido 1 -->
					<div role="tabpanel" class="tab-pane fade active in" id="mcontenido1" aria-labelledby="home-tab">
						
						<div class="col-md-12">
							<br>
							<br>
							 
							<?php 
							echo $this->session->userdata('Wmessage');  
							echo "<br>";   
							echo $this->session->userdata('validation_errors');  
                            ?>  

							<div class="tab">
								<button class="tablinks Mbasic active" onclick="openCity(event, 'Matterbasic')">Matter Basic</button>
								<button class="tablinks Intake" onclick="openCity(event, 'IntakeDetails')">Intake Detail</button> 
							</div>

							<form class="form-horizontal" role="form" id="form_details" method="post" action="<?=base_app()?>Matters/Update/<?=$actualMatter?>">	
					
								<div id="Matterbasic" class="tabcontent active" style="display:block">

								
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Matter Name <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="" name="Name" value="<?=$Matter->Name?>"   class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Matter ID <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text"  id="MatterID"  name="MatterID" value="<?=$Matter->MatterID?>"   class="form-control" placeholder="">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Client Name <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<?php 
											$ClientName=$ci->ContactModel->oneContact($Matter->Client);
											//echo "<pre>";
											//print_r($ClientName);
											//echo "</pre>";
											?>
											<input type="text"  value="<?=$ClientName->FirstName." ".$ClientName->LastName." ".$ClientName->Middle." ".$ClientName->Suffix?>" name="Contact_A" onkeyup="showContacts(this.value,'_A')"  class="form-control" placeholder="Search existing contacts" style="font-family:Arial, FontAwesome">
											<div  id="lupaIco"></div> 
											<div class="SearchBox" id="ContactResult_A"></div>
											<input type="hidden"     name="ContactID_A" value="<?=$Matter->Client;?>" />	
										
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<button type="button" class="btn btn-primary btn-lg btn-block" onclick="createContact('ContactID_A','Contact_A')"> 
												<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i> 
												Create Contact
											</button>
										</div>
									</div>

									<hr>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Responsible Attorney <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="input-group">
												
												<select name="ResponsibleAttorney" class="form-control" placeholder=""  > 
													<option value="">Select One</option>
													<?php 
														foreach ($Attorney as $row)
														{
															?>
															<option value="<?=$row->Id?>" <?php echo ($Matter->ResponsibleAttoney==$row->Id)?" selected=' selected'":""?>><?=$row->Name." ".$row->LastName?></option>
														<?php
														}
													?>
												</select>
												
											</div>
										</div>
									</div>
									<!-- ohter staff --> 
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Other Staff <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="OtherStaff" onkeyup="showAtorneys(this.value)" value=""  class="form-control" autocomplete="off" placeholder="Search Existing Staff" />
											<div id="staffWrapBox">
											<?php 
												foreach($relatedStaff as $row){
											?>
											
												<span id="staffItem<?=$row->IdUser?>" class="staffItem btn btn-default btn-xs">
													<?=$row->AtorneyName;?>
													<span onclick="removeStaff(<?=$row->IdUser?>)">X</span>
													<input type="hidden" name="otherStaf[]" value="<?=$row->IdUser?>">
												</span>
											
											
											<?php 
											} 
											
											?>
											
											</div>
											<div id="resulAttorney" class="SearchBox"></div>
										</div>
									</div>


									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Originating Attorney <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="input-group">
												<select name="OriginatingAttorney" class="form-control" placeholder=""  > 
															<option value="">Select One</option>
														<?php 
															foreach ($Attorney as $row)
															{
																?>
																<option value="<?=$row->Id?>" <?php echo ($Matter->Originating==$row->Id)?" selected=' selected'":""?>><?=$row->Name." ".$row->LastName?></option>
																
															<?php
															}
														?>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Referred By <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<?php 
												
												$ClientRefered=$ci->ContactModel->oneContact($Matter->ReferedBy);
											
											?>
											<input type="text" name="Contact_R" value="<?=$ClientRefered->FirstName." ".$ClientRefered->LastName." ".$ClientRefered->Middle." ".$ClientRefered->Suffix?>"   autocomplete="off" class="form-control"  onkeyup="showContacts(this.value,'_R')"  placeholder="Search existing Contact" style="font-family:Arial, FontAwesome"   value="<?= set_value('Contact_R');?>" >
											<div  id="lupaIco"></div> 
											<input type="hidden"     name="ContactID_R"  value="<?=$Matter->ReferedBy?>" />	
											<div  class="SearchBox" id="ContactResult_R" ></div>

										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Date Opened<span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="input-group">
												 <script>
												 $( function() {
														$( "#DateOpened" ).datepicker({
															constrainInput: true
														});
														
														$("#calendarIco").click(function() {
															$("#DateOpened").datepicker("show");
														});
												  });
												</script>
												 
												<input type="text" id="DateOpened" name="DateOpened" class="form-control blueText"  value="<?=decodeDate($Matter->DateOpen); ?>"   />
												 <div  id="calendarIco"></div> 
											</div>
										</div>
									</div>



									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<button type="button" onclick="createContact('ContactID_R','Contact_R')" class="btn btn-primary btn-lg btn-block">
											<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i> 
												Create Contact</button>
										</div>
									</div>


									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" value="Save and Close" id="save_close"  class="btn btn-primary " > 
											<a id="cancel" href="<?=base_app()?>Matters" class="btn btn-primary">Cancel </a>
											<button id="next" type="button"  onclick="openCity(event, 'IntakeDetails')" class="btn btn-primary">Next</button>
										</div>
									</div>
									
									
								</div><!-- fin tab1 **************-->

								
								
								<div id="IntakeDetails" class="tabcontent">
								
									<div class="form-group row">
										<label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Practice Area*</label>
										<div class="col-md-5">
											<div class="input-group">
											   <select name="Area" class="form-control blueText" placeholder=""  > 
													<option value="">Select One</option>
															<?php 
																foreach ($Areas as $row)
																{
																	?>
																	<option value="<?=$row->Id?>" <?php echo ($Matter->Area==$row->Id)?" selected=' selected'":""?>>
																		<?=$row->Name?>
																	</option>
																<?php
																}
															?>
												</select>
											</div>
										</div>
									</div><!-- fin form-group -->
									
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Originating Attorney <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="input-group">
												<select name="OriginatingAttorney" class="form-control" placeholder=""  > 
															<option value="">Select One</option>
														<?php 
															foreach ($Attorney as $row)
															{
																?>
																<option value="<?=$row->Id?>" <?php echo ($Matter->Originating==$row->Id)?" selected=' selected'":""?>><?=$row->Name?> <?=$row->LastName?></option>
																
															<?php
															}
														?>
												</select>
											</div>
										</div>
									</div><!-- fin form-group -->
									
									
									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<input type="submit" value="Save and Close" id="save_close"  class="btn btn-primary " > 
											<a id="cancel" href="<?=base_app()?>Matters" class="btn btn-primary">Cancel </a>
										</div>
									</div>
									
								</div><!-- fin tab2-->	
							</form>

						</div>

					</div> <!-- /contenido 1 -->


					<!-- contenido 2 -->
				    <!-- 			
					<div role="tabpanel" class="tab-pane fade" id="tcontenido2" aria-labelledby="profile-tab">
						
						
						
						 <form class="form-horizontal" role="form" id="form_details2" method="post" action="">	
					
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Switch Template <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="input-group">
										
										<select class="form-control blueText" placeholder="" name="Template"  onchange="javascript:handleSelect(this)" > 
											<option value="">Select One</option>
													<?php 
														foreach ($Templates as $row)
														{ ?>
															<option value="<?=$row->Id?>" <?php echo ($Matter->Template==$row->Id)?" selected=' selected'":""?>><?=$row->Template?></option>
												<?php   }
													
													?>
										</select>
										
									</div>
								</div>
							</div>
						</form>
						
						<script type="text/javascript">
						function handleSelect(pages)
						{
							window.location = "<?=base_app()?>Matters/ChangeTemplate/"+pages.value+"/<?=$actualMatter?>";
						}
						</script>
						
					</div> <!-- /contenido 2 -->


						 

					<!-- contenido 3 -->    
					<div role="tabpanel" class="tab-pane fade" id="tcontenido3" aria-labelledby="profile-tab">
						<div id="task1" class="col-md-12">
							
							
							<div id="listNoteWrap">

								 
								<span class="plusRelCl" onclick="createRelContact()"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<button class="accordion">	
									Contacts(<?=count($ContactAsociated)?>)
								</button>
								
								<div class="panelaccc">
								
									<table id="relContacts">
										<tr>
											<th>Contact Name</th>
											<th>Relationship Description</th>
										</tr>	
										<?php foreach($ContactAsociated as $row){?>
										<tr>
											<td><?=$row->ContactName?></td>
											<td><?=$row->Relation?></td>
										</tr>
										<?php } ?>
										
									</table>
									
								</div>
									
									
								<span class="plusRelCl" onclick="createRelMatter()"><img src="<?=base_app()?>/img/atach.png" ></span>
								<button class="accordion">Matters(<?=count($relatedMatter)?>)</button>
								<div class="panelaccc">
									<table id="relContacts">
										<tr>
											<th>Matters ID</th>
											<th>Matter Relationship</th>
										</tr>	
										<?php foreach($relatedMatter as $row){?>
										<tr>
											<td><?=$row->IdMatter2?></td>
											<td><?=$row->NameMatter?></td>
										</tr>
										<?php } ?>
										
									</table>
								</div>
								
								<span class="plusRelCl"   onclick="createRelContact()"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<span class="plusRelCl" id="addFol" onclick="createRelContact()"><img src="<?=base_app()?>/img/atach.png" ></span>
								<button class="accordion">Documents and folder(1)</button>
								<div class="panelaccc">
									<p>asdfasdf</p>
								</div>
								
								<span class="plusRelCl"   onclick="createRelContact()"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<button class="accordion">Events(1)</button>
								<div class="panelaccc">
									<p>asdfasdf</p>
								</div>
								
								<span class="plusRelCl"   onclick="createRelContact()"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<button class="accordion">Task(1)</button>
								<div class="panelaccc">
									<p>asdfasdf</p>
								</div>

							 

							</div><!-- fin listNoteWrap -->
							
							
						</div>
					</div> <!-- /contenido3 -->

					<div role="tabpanel" class="tab-pane fade" id="tcontenido4" aria-labelledby="profile-tab">
						<div id="task1" class="col-md-12">
							 
							<?php 
								$this->load->view("Matters/newNote");
							?>
						</div>
					</div><!-- /contenido 4 -->
					
					
					<!-- contenido 5 -->    
					<!--<div role="tabpanel" class="tab-pane fade" id="tcontenido5" aria-labelledby="profile-tab">
						<div id="task1" class="col-md-12">
							 
						</div>
					</div> <!-- /contenido5 -->
					
					<!-- contenido 6 -->    
					<div role="tabpanel" class="tab-pane fade" id="tcontenido6" aria-labelledby="profile-tab">
						<div id="task1" class="col-md-12">
							 
						</div>
					</div> <!-- /contenido6 -->
					
					

				</div><!-- fin class tab-content-->
				
			</div><!-- matters_details -->


			<script>
				function slideDown(objeto) {	
					if($("#"+objeto).is( ":visible" )){
						$("#"+objeto).slideUp("fast");
					}else{
						
						$("#"+objeto).slideDown( "fast" );
					}
				} 	
			</script> 

			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumBillB')">
					<img src="<?=base_app()?>img/billing.png">
					&nbsp; &nbsp;Billing Sumary <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumBillB">
					<a href="#">A</a> 
					<a href="#">B</a> 
					<a href="#">C</a> 
				</div> 
		
			</div>
			
			
			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumTask')">
					<img src="<?=base_app()?>img/task.png">
					&nbsp; &nbsp;Task <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumTask">
					<a href="#">A</a> 
					<a href="#">B</a> 
					<a href="#">C</a> 
				</div> 
		
			</div>
			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumInvo')">
					<img src="<?=base_app()?>img/invoice.png">
					&nbsp; &nbsp;Invoices <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumInvo">
					<a href="#">A</a> 
					<a href="#">B</a> 
					<a href="#">C</a> 
				</div> 
		
			</div>

			 


			 


		   

			 
				 
				 <!-- RECENT ACTIVITY -->
				<div class="col-md-9 recentbox ">
					<div class="x_panel">

						<div id="recent-activity" class="x_title">
							<h2> &nbsp; <img src="<?=base_app()?>img/recentActivity.png"> &nbsp; Matter Activity</h2>
							<div class="clearfix"></div>
						</div>

						<!-- contenido -->

						<div id="content_recent_activity" class="x_content">

							 

							<?php           
							foreach ($recentActi as $row){ 

								 

								if($row->Object=="note"){

									$label="to the matter";
									$img="recentactv.png";

								}elseif($row->Object=="matter"){

									$label="";
									$img="matters_blue.png";
									
								}elseif($row->Object=="contact"){
									$label="to the matter";
									$img="contact_group.png";
								}else{

									$label="";
									$img="";
								}

								$this->load->helper("caltime");





									  
							?>

								<article class="media event">

									<a class="pull-left date">
										<p class="day"><img src="<?=base_url()?>img/<?=$img?>"></p>
									</a>

									<div class="media-body">
										<p>
											<?=$row->Creator. "   ".$row->Actions ?> a 
											<a href=""><?=$row->Object?></a> 
											<?=$label?> 
											<a href=""><?=substr($row->titulo,0,100)?></a>
										</p>
										<small><?=caltime($row->fecha)?> ago</small>
									</div>

								</article>

							<?php 
							}
							?>


							 

						</div><!-- x-content -->
					</div>    
				</div><!-- fin recent activity -->
				 
			 


		</div><!-- fin matter content -->

    </div><!-- fin row  -->
