  <?php 
  $ci =&get_instance();
  $ci->load->model("DocumentModel");
  $ci->lang->load($this->session->userdata("lng") , 'labels');
  ?>






  <div id=" " class="col-md-12 boxSlider">

  	<div class="BoxtitleGray">
  		<img src="<?=base_url()?>img/billing_clok.png"> &nbsp; <?php echo $this->lang->line('new_invoice_1'); ?> <span onclick="CloseObject('newFolder')" >X</span>
  	</div>

  	<div class="boxheadButtons">

  	</div>

  	<div class="clearh50"></div>


  	<div class="TaskallInputWrap allInputContainer">

  		<form id="formNewInv" >

  			<div id="listErrors"></div>


  			<div class="form-group row btn-group ml-2  ">

  				<label style="width: 100px;float: left;"><?php echo $this->lang->line('new_invoice_2'); ?></label> 

  				<input id="EstimatedTime" class="largeselect lupa" name="matterName" id="matterName"   onkeyup="SearchInvoiceMatter(this.value)" placeholder="Search for Matter name" value="<?=$datos_matter->Name?>" type="text"> 



  				<div class="dropdown-menu" id="MatterResult"></div>

  				<input type="hidden" name="idMatter" id="idMatter" value="<?=$datos_matter->Id?>" />

  			</div>

  			<div class="clearh50"></div>

  			<div  >
  				<label> </label> 
  				<div style="margin:0px;padding:0px;">
  					<input type="radio" name="dateInvoice" value="all" checked="checked" onclick="switchTag('off','datepicker_wrap')">
  					<span class="label-invoice" style="float: none;width: auto;"><?php echo $this->lang->line('new_invoice_4'); ?></span>
  					<br>
  					<input type="radio" name="dateInvoice" value="times" onclick="switchTag('on','datepicker_wrap')" >
  					<span class="label-invoice" style="float: none;width: auto;"><?php echo $this->lang->line('new_invoice_5'); ?></span>
  				</div>

  			</div>

  			<div class="clearh50"></div>

  			<div class="form-group row " id="datepicker_wrap" style="display:none">

  				<div class="shortSelectWrap1 btn-group ml-2">

  					<label><?php echo $this->lang->line('matters_detail_31'); ?></label> 

  					<input name="StartTime" id="StartTime" value="" class="shortSelect" type="text">
  					<button type="button" class="Tcarre calendarIco" id="StartimeIco">

  					</button>

  				</div>
  				<div class="shortSelectWrap2 btn-group ml-2">

  					<label><?php echo $this->lang->line('list_2'); ?></label> 

  					<input id="EndTime" name="EndTime" value="" class="shortSelect" type="text">
  					<button id="EndTimeIco" type="button" class="Tcarre calendarIco"></button>

  				</div>	

  			</div>






  			<div class="clearh50"></div>
  			<div class="form-group">
  				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

  					<a onclick="saveInvoice()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
  						<?php echo $this->lang->line('new_billing_7'); ?>
  					</a>


  					<a id="cancel"  onclick="CloseObject('newFolder')" class="btn btn-primary"><?php echo $this->lang->line('new_billing_8'); ?> </a>
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

