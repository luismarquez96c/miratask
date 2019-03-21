<?php 
 $ci =&get_instance();
 
 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
<form id="formNewInv" method="post"  >

		<div id=" " class="col-md-12 boxSlider">

			<div class="BoxtitleGray">
				<img src="<?=base_url()?>img/expense.png"> &nbsp;<?php echo $this->lang->line('apply_pay_1'); ?> <span onclick="CloseObject('newFolder')" >X</span>
			</div>
			
			<div class="boxheadButtons">
					 
			</div>
				
			 <div class="clearh50"></div>

		
			<div class="TaskallInputWrap allInputContainer">

				
				<div id="resultErrors"></div>
				
				<div class="form-group row btn-group ml-2  ">
			 
						<label><?php echo $this->lang->line('apply_pay_2'); ?></label> 

						<input id="EstimatedTime" class="largeselect lupa" name="BillToName" id="BillToName"   onkeyup="SearchInvoice(this.value)" placeholder="<?php echo $this->lang->line('apply_pay_3'); ?> " type="text" style="width:435px"> 

						 

						<div class="  dropdown-menu" id="MatterResult"></div>

						<input type="hidden" name="id_invoice" id="id_invoice"  />

				</div>
				

				<div class="form-group row btn-group ml-2">
			 
						 
					
					
						
					
					<div class="shortSelectWrap1 btn-group ml-2">

						<label><?php echo $this->lang->line('matters_detail_23'); ?></label> 
						     
						<input name="Datep" id="Datep" value="" class="shortSelect" type="text" >
						<button type="button" class="Tcarre calendarIco" id="DatepIco"></button>

					</div>	







					<div class="shortSelectWrap1 btn-group ml-2">
				 
						<label><?php echo $this->lang->line('apply_pay_4'); ?></label> 

						<script type="text/javascript">
							function sumDif(oper){

									if(oper=='sum'){

										 
										actualVal=actualVal + 0.1;
										//actualVal=parseFloat(actualVal).toFixed(1);

										$("#Amount").val(actualVal);	

									}

									if(oper=='dif'){
										 
										actualVal=actualVal - 0.1;
										//actualVal=parseFloat(actualVal).toFixed(1);

										if(actualVal<0){ actualVal=0; }

										$("#Amount").val(actualVal);	
									}
								}

						</script>
						
						<input id="Amount" name="Amount" class="shortSelect" type="text"> 

						<a class="TcarreDle">

							  <li class="c1" onclick="sumDif('sum')"> </li>
							  <li class="c2" onclick="sumDif('dif')"> </li>

						</a>
					
					 
					</div>



					 
							
							 
					

				</div>


				<div class="form-group row">



					<div class="shortSelectWrap1 btn-group ml-2">
					
					
						<label><?php echo $this->lang->line('apply_pay_5'); ?></label> 
						     
						<button id="TypePayButt" type="button" class="shortSelect">Normal</button>
						<input name="TypePay" id="TypePay" value="" type="hidden"> 
						
						<button type="button" class="Tcarre" data-toggle="dropdown">
							<span class="caret"></span> 
						</button>
						
						<ul class="dropdown-menu btn-block shortbox" role="menu">
								<li onclick="thisSelect('1', 'Cash', 'TypePay', 'TypePayButt' )"> 
								<?php echo $this->lang->line('apply_pay_6'); ?>    
								</li>
							 	<li onclick="thisSelect('2', 'Check', 'TypePay', 'TypePayButt' )"> 
								 <?php echo $this->lang->line('apply_pay_7'); ?> 
								</li>
							 	<li onclick="thisSelect('3', 'Credit Card ', 'TypePay', 'TypePayButt' )"> 
								 <?php echo $this->lang->line('apply_pay_8'); ?>   
								</li>
							 	<li onclick="thisSelect('4', 'EFT', 'TypePay', 'TypePayButt' )"> 
								 <?php echo $this->lang->line('apply_pay_9'); ?>  
								</li>

								<li onclick="thisSelect('4', 'Other', 'TypePay', 'TypePayButt' )"> 
								<?php echo $this->lang->line('apply_pay_10'); ?>
								</li>
						</ul>	 
							 
					</div>




					<div class="shortSelectWrap1 btn-group ml-2">
				 
						<label><?php echo $this->lang->line('apply_pay_11'); ?></label> 
						<input id="TransactionDetail" name="TransactionDetail" class="shortSelect"   type="text" style="width:155px !important;"> 

					</div>
					 





				</div>



				<div class="form-group row btn-group ml-2">
				 
					<label><?php echo $this->lang->line('apply_pay_12'); ?></label> 
					
					<textarea id="notes" name="notes" type="textarea" class="largeselect" placeholder="Type a description"></textarea>
				</div>





				 







				
				
				<div class="clearh50"></div>
				 
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

						<a onclick="savePay()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
						<?php echo $this->lang->line('apply_pay_13'); ?>
						</a>


						<a id="cancel"  onclick="CloseObject('newFolder')" class="btn btn-primary"><?php echo $this->lang->line('apply_pay_14'); ?></a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	

	<script>

  		 
  			
  		
              
               $( "#Datep" ).datepicker({
                      
                       format:'DD/MM/YYYY HH:mm',
                       inline: true
                });
                
                $("#DatepIco").click(function() {
                  $("#Datep").datepicker("show");
                });


                
                $("#MatterResult").mouseleave(function() {
			 
					$("#MatterResult").hide();
				});


    </script>            