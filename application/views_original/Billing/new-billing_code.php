  <?php 
  $ci =&get_instance();
  $ci->load->model("DocumentModel");

  ?>

  <script src="<?php echo base_url(); ?>js/jquery-ui/jquery-ui.js"></script>
  <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">  


  

  <div id=" " class="col-md-12 boxSlider">

  	<div class="BoxtitleGray">
  		<img src="<?=base_url()?>img/billing_clok.png"> &nbsp; Create Billing code <span onclick="CloseObject('newFolder')" >X</span>
  	</div>
  	
  	<div class="boxheadButtons">
  		
  	</div>
  	
  	<div class="clearh50"></div>

  	
  	<div class="TaskallInputWrap allInputContainer">

  		<form id="formNewInv" >

  			<div id="listErrors"></div>



  			<div class="form-group row">
  				<div class="shortSelectWrap1 btn-group ml-2">

  					<label>Type: </label>


  					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  					<input type="radio" name="tipo" value="all" checked="checked">	
  					Time 
  					
  					
  					
  					
  				</div>
  				<div class="shortSelectWrap2 btn-group ml-2">
  					
  					
  					<input type="radio" name="tipo" value="all" checked="checked"></label>
  					Expense
  					
  					
  					
  					
  				</div>	
  				
  			</div>


  			<div class="form-group row btn-group ml-2  ">
  				
  				<label>Matter</label> 

  				<input id="CodeName" class="largeselect" name="CodeName"       placeholder="Name of Code" type="text"> 

  				

  				

  			</div>

  			<div class="form-group row btn-group ml-2  ">
  				
  				<label>Description</label> 

  				<textarea class="largeselect" required="" name="description"></textarea>

  			</div>


  			
  			<div class="clearh50"></div>

  			

  			

  			

  			

  			
  			
  			
  			
  			<div class="form-group">
  				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

  					<a onclick="saveCode()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
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
  	
  	
  </script>
  
  