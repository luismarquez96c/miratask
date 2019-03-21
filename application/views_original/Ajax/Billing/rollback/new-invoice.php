  <?php 
	$ci =&get_instance();
	$ci->load->model("DocumentModel");

 ?>

    <script src="<?php echo base_url(); ?>js/jquery-ui/jquery-ui.js"></script>
    <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">  


 

		<div id=" " class="col-md-12 boxSlider">

			<div class="BoxtitleGray">
				<img src="<?=base_url()?>img/billing_clok.png"> &nbsp; Create Invoice <span onclick="CloseObject('newFolder')" >X</span>
			</div>
			
			<div class="boxheadButtons">
					 
			</div>
				
			 <div class="clearh50"></div>

		
			<div class="TaskallInputWrap allInputContainer">

				<form id="formNewInv" >

					<div id="listErrors"></div>


					<div class="form-group row btn-group ml-2  ">
			 
						<label>Matter</label> 

						<input id="EstimatedTime" class="largeselect lupa" name="matterName" id="matterName"   onkeyup="SearchInvoiceMatter(this.value)" placeholder="Searh for Matter name" type="text"> 

						 

						<div class="dropdown-menu" id="MatterResult"></div>

						 <input type="hidden" name="idMatter" id="idMatter"  />

					</div>
					
					<div class="clearh50"></div>

					<div  >
						<label> </label> 
						<div   style="margin:0px;padding:0px;">

							&nbsp; &nbsp; &nbsp;<input type="radio" name="dateInvoice" value="all" checked="checked">
								 Include all uninvoiced time and expense entries for this matter.<br>

							&nbsp; &nbsp; &nbsp;<input type="radio" name="dateInvoice" value="times">
								Only include time and expense entries from:
						</div>

					</div>

					<div class="clearh50"></div>

					<div class="form-group row">
						<div class="shortSelectWrap1 btn-group ml-2">
						
							<label>Date</label> 
							     
							<input name="StartTime" id="StartTime" value="" class="shortSelect" type="text">
							<button type="button" class="Tcarre calendarIco" id="StartimeIco">
								  
							</button>
								 
						</div>
						<div class="shortSelectWrap2 btn-group ml-2">
						
							<label>To</label> 
							     
							<input id="EndTime" name="EndTime" value="" class="shortSelect" type="text">
							<button id="EndTimeIco" type="button" class="Tcarre calendarIco"></button>
							
						</div>	
						 
					</div>

						

					 
				
					
					 <div class="clearh50"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

							<a onclick="saveInvoice()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
								Save and Close
							</a>


							<a id="cancel"  onclick="CloseObject('newFolder')" class="btn btn-primary">Cancel </a>
						</div>
					</div>
				
				
				</form>	
				
			</div>	<!-- fin intput container --> 
			
			
		
		</div>
		
		<div class="clearh50"></div>

		<script>

  		 
  			
  		
              
               $( "#StartTime" ).datepicker({
                      
                       format:'DD/MM/YYYY HH:mm',
                       inline: true
                });
                
                $("#StartimeIco").click(function() {
                  $("#StartTime").datepicker("show");
                });


                $( "#EndTime" ).datepicker({
                      
                       format:'DD/MM/YYYY HH:mm',
                       inline: true
                });
                
                $("#EndTimeIco").click(function() {
                  $("#EndTime").datepicker("show");
                }); 

                $("#MatterResult").mouseleave(function() {
			 
					$("#MatterResult").hide();
				});
              
	 
    	</script>
 
	 