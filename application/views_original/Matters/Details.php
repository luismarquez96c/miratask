 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 $ci->load->model("MatterModel");
 $ci->load->model("Calendar_model","calendar");
 ?>


 <script src="<?=base_url()?>js/contactAjax.js"></script>
 <script src="<?=base_url()?>js/util.js"></script>
 <script src="<?=base_url()?>js/utildoc.js"></script>
 
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
 			<a id="close_matter" onclick="atachTo('Ajax/CloseMatter/<?=$actualMatter?>')" class="btn btn-primary btn-lg btn-block"> Close Matters</a>
 		</div>

 		<div class="col-md-2">
 			<a id="delete_matters"  href="<?=base_app()?>Matters/eraseMatterConfirm/<?=$actualMatter?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-trash"></i>  Delete Matters</a>
 		</div>

			<!-- <div class="btn-group ml-2 listButtWrap">

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
			</div> -->


			<?php 
			echo $this->session->userdata('message');  
			echo $this->session->userdata('Wmessage');  
			echo "<br>";   
			echo $this->session->userdata('validation_errors');  
			?>  


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
						<!--<i class="fa fa-print" onclick="printDetails()" style="font-size:24px"></i>-->
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
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Matter ID <span class="required"> </span></label>
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
											<input type="text"  value="<?=$ClientName->FirstName." ".$ClientName->Middle." ".$ClientName->LastName."  ".$ClientName->Suffix?>" name="Contact_A" onkeyup="showContacts(this.value,'_A')" required="required" class="form-control SS" placeholder="Search existing contacts" style="font-family:Arial, FontAwesome">

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
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Referred By  </label>
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
									<hr>
									<div class="form-group">

										<div class="mat_description_wrap">

											Description:
											<br>
											<br> 
											<textarea name="Description" style="width:100px !important; height:100px !important;"><?=$Matter->Description?></textarea>

										</div>
										<br>
										<br>
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

					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->
					<!-- ************************************************************************************************************************************* -->	 

					<!-- contenido 3 -->    
					<div role="tabpanel" class="tab-pane fade" id="tcontenido3" aria-labelledby="profile-tab">
						<div id="task1" class="col-md-12">
							
							
							<div id="listNoteWrap">


								<span class="plusRelCl" onclick="createRelContact()"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<button class="accordion">	
									Contacts(<?=count($ContactAsociated)?>)
								</button>
								
								<div class="panelaccc">

									<?php 
										//print_r($ContactAsociated);
									?>

									<table class="table2">
										<tr>
											<th>Contact Name</th>
											<th>Relationship Description</th>
											<th>Remove</th>
										</tr>



										<?php foreach($ContactAsociated as $row){?>


											<tr>
												<td> <a onclick="atachTo('AjaxContact/details/<?=$row->IdContact?>')" ><?=$row->ContactName?></a> </td>
												<td><?=$row->Relation?></td>
												<td>
													<a href="<?=base_app()?>Matters/deleteRelcontact/<?=$row->IdMatter?>/<?=$row->IdContact?>" > 
														<img src="<?=base_url()?>img/status_2.jpg">
													</a>
												</td>
											</tr>
										<?php } ?>

									</table>

								</div>

								<!-- Matters acordeon -->	

								<span class="plusRelCl" onclick="createRelMatter()"><img src="<?=base_app()?>/img/atach.png" ></span>
								<button class="accordion">Matters(<?=count($relatedMatter)?>)</button>
								<div class="panelaccc">
									<table class="table2">
										<tr>
											<th>Matters Name</th>
											<th>Date Opened</th>
											<th>Remove</th>
										</tr>	
										<?php foreach($relatedMatter as $row){?>
											<tr>
												<td>  
													<a href="<?=base_url()?>Matters/Details/<?=$row->IdMatter2?>">

														<?=$row->NameMatter?>  
													</a>		
												</td>
												<td><?=decodedate($row->DateOpen)?></td>

												<td>
													<a href="<?=base_app()?>Matters/deleteRelMatter/<?=$Matter->Id?>/<?=$row->IdMatter2?>" > 
														<img src="<?=base_url()?>img/status_2.jpg">
													</a>
												</td>

											</tr>
										<?php } ?>

									</table>
								</div>

								<!-- Document and folder -->

								<span class="plusRelCl"   onclick="newDocument('<?=$Matter->Id?>')"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>

								<span class="plusRelCl" id="addFol" onclick="RelDocToMatt()"><img src="<?=base_app()?>/img/atach.png" ></span>

								<button class="accordion">Documents and folder(<?=count($relatedDoc)?>)</button>

								<div class="panelaccc">
									<table class="table2">
										<tr>
											<th>Name</th>
											<th>Description </th>
											<th>Last Update</th>
											<th>Remove</th>
										</tr>	


										<?php 
										//print_r($relatedDoc);

										foreach($relatedDoc as $row){

											if($row->Type==".docx" or $row->Type==".doc"){ $Icon='<img src="'.base_url().'img/_doc.png" />';  }
											if($row->Type==".pdf"){ $Icon='<img src="'.base_url().'img/_pdf.png" />';  }
											if($row->Type=='.png' or $row->Type=='.jpeg' or $row->Type=='.jpg'){$Icon='<img src="'.base_url().'img/jpg2.png" />';}


											?>
											<tr>
												<td>
													<?php 
													if(substr($row->FisicalDir,0,1)==".")
														$ruta= $row->FisicalDir;
													else
														$ruta= 'docsxup/2018/';
													?>
													<a target="_blank"  href="<?=base_url().$ruta.$row->FileName?>"> 	
														<?=$Icon?> 
													</a>
													&nbsp; 
													<a onclick=" atachTo('AjaxDoc/DocumentDetails/<?=$row->Document?>')">

														<?=$row->FileName?> 
													</a> 

												</td>
												<td><?=$row->Description?>(<?=$row->Document?>)</td>
												<td>

													<?php
													if($row->DateUpdated!=""){

														decodedate($row->DateUpdated);

													}else{

														echo " No updated ";
													} 
													?>

												</td>
												<td>
													<a href="<?=base_app()?>Matters/deleteReldoc/<?=$Matter->Id?>/<?=$row->Document?>" > 
														<img src="<?=base_url()?>img/status_2.jpg">
													</a>
												</td>

											</tr>
										<?php } ?>

									</table>
								</div>
								<!-- events *************** Events  -->
								<span class="plusRelCl"   onclick="add_event(<?=$Matter->Id ?>)"><img src="<?=base_app()?>/img/add_adress.jpg" ></span>
								<?php $events=$ci->calendar->events_by_matter($Matter->Id); ?>

								<button class="accordion">Events(<?=count($events) ?>)</button>
								<div class="panelaccc">

									<table class="table2">
										<tr>
											<th>Subject</th>
											<th>Location </th>
											<th>Date </th>
											<th>Remove </th>
										</tr>	
										<?php
										foreach($events as $i => $event): ?>

											<tr>
												<td> <a onclick="loadEvent('<?=$event->id ?>')" > <?=$event->subject ?>  </a> </td>
												<td> <?=$event->location ?> </td>
												<td> <?php echo decodedate($event->start_date)." ".crear_hora($event->start_time);?></td>

												<td>
													<a href="<?=base_app()?>Matters/deleteRelEve/<?=$Matter->Id?>/<?=$event->id?>" > 
														<img src="<?=base_url()?>img/status_2.jpg">
													</a>

												</td>
											</tr>
										<?php endforeach;
										?>

									</table>

								</div>

								<!-- TASK -->		

								<span class="plusRelCl"   onclick="createTask('<?=$Matter->Id?>','Matters/Details/<?=$Matter->Id?>?tab=records')" >
									<img src="<?=base_app()?>/img/add_adress.jpg" ></span>
									<button class="accordion">Task(<?=count($relatedTask)?>)</button>
									<div class="panelaccc">

										<table class="table2">
											<tr>
												<th>Subject</th>
												<th>Assign To</th>
												<th>Date</th>
												<th>Remove</th>
											</tr>	
											<?php foreach($relatedTask as $row){

												$AssignTo   = $ci->UserModel->GetAttorney($row->AssignTo);

												?>
												<tr>
													<td>  
														<a onclick="detailTask('<?=$row->Task?>','Matters/Details/<?=$Matter->Id?>?tab=records')" > <?=$row->Subject?>   </a> 
													</td>
													<td>    <?=$AssignTo->Name?>  <?=$AssignTo->LastName?> </td>
													<td><?=decodedate($row->Date)?></td>



													<td>
														<a href="<?=base_app()?>Matters/deleteRelTask/<?=$Matter->Id?>/<?=$row->Task?>" > 
															<img src="<?=base_url()?>img/status_2.jpg">
														</a>

													</td>

												</tr>
											<?php } ?>

										</table>

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
							<?php
							$data = array();
							$data['id'] = $Matter->Id;
							$this->load->view('Matters/billing-matter',$data); 
							?>
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

			<!--<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumBillB')">
					<img src="<?=base_app()?>img/billing.png">
					&nbsp; &nbsp;Billing Sumary <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumBillB">

					<?php

					foreach ($billing as  $i => $row)
					{			
						?>

						<a href="javascript: add_entry(0,'<?=$row->id ?>')"> <?=decodedate($row->date_activity) ?> , <?=$row->code ?>, <?=$row->amount ?> </a>


						<?php 
					}
					?> 

				</div> 

			</div>-->
			
			
			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumTask')">
					<img src="<?=base_app()?>img/task.png">
					&nbsp; &nbsp; Task <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumTask">

					<?php 
					if(count($relatedTask)>0){  

						foreach ($relatedTask as $row)
						{			
							?>

							<a onclick="detailTask('<?=$row->Task?>','')" >

								<?=substr($row->Subject,0,23)?>...<span><?=decodedate($row->Date)?></span>
							</a>

							<?php
						}



					}else{
						echo '<br> &nbsp; &nbsp; No upcoming for this matter';	
						echo '<a onclick="createTask(\''.$Matter->Id.'\',\'Matters/Details/'.$Matter->Id.'?tab=records\')" >Add Task + </a>';
					}			 
					?>
				</div> 

			</div>

			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumBalance')">
					<img src="<?=base_app()?>img/Billing_menu_azul.png">
					&nbsp; &nbsp; Balance <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumBalance">
					<?php 			 
					echo'<a href="#"> $ '.$balance->Balance.'</a>';
					?> 
				</div> 

			</div>

			<div class="col-md-3 sum">

				<div class="desp"  onclick="slideDown('sumInvo')">
					<img src="<?=base_app()?>img/invoice.png">
					&nbsp; &nbsp;Invoices <span><img src="<?=base_app()?>img/sumaryRowl.png"></span>
				</div>

				<div class="matCat" id="sumInvo">
					<?php
					foreach ($InvoicesRel as $invo) {
						?>
						<a style="" href="<?=base_app()?>Billing/invoice_details/<?=$invo->Id.'?url='.$Matter->Id?>">
							<?php
							echo 'Number:'.$invo->Number.' | ';
							echo $invo->Status.' | ';
							echo decodedate($invo->DueDate);

							?>
						</a> 
						<?php
					}
					?>
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


								$img="recentactv.png";
								$enlace=' href="'.base_app().'Matters/Details/'.$row->Id.'?tab=notes" ';

							}elseif($row->Object=="matter"){

								$label="";
								$img="matters_blue.png";
								$enlace=' href="'.base_app().'Matters/Details" ';


							}elseif($row->Object=="task"){


								$img="task.png";
								$enlace=' onclick="detailTask(\''.$row->Id.'\')" ';  

							}elseif($row->Object=="doc"){


								$img="Document_blue.png";
								$enlace=' href="'.base_app().'docsxup/'.$row->titulo.'" ';

							}elseif($row->Object=="event"){


								$img="recentActivity.png";
								$enlace=' onclick="loadEvent(\''.$row->Id.'\')" ';      	

							}elseif($row->Object=="contact"){

								$img="contact_group.png";

							}elseif($row->Object=="Time and expense"){

								$label2=' ';
								$label="";
								$img="Billing_blue.png";
								$enlace=' onclick="add_entry_g(\'0\',\''.$row->Id.'\')" ';    	

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
										<a <?=$enlace?> ><?=$row->Object?></a> 

										<a <?=$enlace?> ><?=$row->titulo?></a>
										<?php
										if($row->Too!="vacio"){ echo " to the matter ".$row->Too; }
										?>
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
	<!-- Modal -->
	<div id="modal-event1" class="modal fade modal-mira" role="dialog">
		<div class="loading-modal"></div>
	</div>
	<script type="text/javascript">
		function add_event(id_matter){
			$("#modal-event1").modal("show");

			$.post(base_url+"Calendar/modal_event_detail",{matter_id:id_matter},function(response){
				$("#modal-event1").html(response);
				$(".calendar").datepicker({ "dateFormat":'mm/dd/yy',  changeMonth: true, changeYear: true});
			});
		}
		$(document).on("click",".event-detail-modal",function(event){
			event.preventDefault();
			id_event=$(this).data("id-event");
			$("#modal-event1").modal("show");
			$.post(base_url+"Calendar/modal_event_detail",{id:id_event},function(response){
				$("#modal-event1").html(response);

			});
		});
	</script>
