
<form id="formNewTask" method="post" action="<?=base_app()?>Matters/Close" >
	
	 
	
		
		<div  class="col-md-12 boxSlider">
			<div id="matters" class="x_title">
				  <img src="<?=base_url()?>img/close_matter.png"> &nbsp;  Close Matter <span class="close2" onclick="CloseObject('atachTo')"> x </span>  
			</div>
			
			 
				
			<div class="h50"></div>
		
			<div class="TaskallInputWrap" style="width:600px">
				
				<div id="resultErrors"></div>

				<div class="form-group row">

					<div class="btn-group ml-2">
								
						 <script>
							 
									$( "#StartTime" ).datepicker();
									
									$("#StartimeIco").click(function() {
										$("#StartTime").datepicker("show");
									});
							  

						</script>
					
					
						<label>Close on *</label> 
						     
						<input type="text" name="CloseOn" id="StartTime" value="" class="largeselect" style="margin-left:10px;" />

						<button type="button" class="Tcarre calendarIco" id="StartimeIco">
							  
						</button>

					</div>

					  
				</div> 

				<div class="form-group row">
								
					 <label for="" class="col-sm-1 col-form-label">Comments *</label>
					  

					  
					 
						<textarea  id="comments" name="comments" class="largeselect" style="margin-left:10px;"></textarea>
					  
				</div> 
				
				
				
				 
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<button onclick='MarkClosedMatter()' type="button" id="save_close"  class="btn btn-primary " >Save and Close</button>
				
						<a id="cancel"  onclick="CloseObject('atachTo')" class="btn btn-primary">Cancel </a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	