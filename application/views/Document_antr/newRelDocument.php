

<form id="formRelDoc" method="post" action="" >
	
	 
	
		
		<div id=" " class="col-md-12 boxSlider">
			<div class="Boxtitle">Add Documents Related</div>
			
			<div class="boxheadButtons">
					Attach an existing Document by typing the name in the Search field.
			</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer TaskallInputWrap">

				<div id="listErrors"></div>
				
				
				<div class="form-group row">
								
					 <label for="" class="col-sm-1 col-form-label">Document Name *</label>
					 
					 <div class="col-md-8">
						<input type="text" class="form-control largeselect" name="Contact1" id="Contact1" onkeyup="showDocuments(this.value,'1')" autocomplete="off" placeholder="Search existing Document"    />
						<div class="dropdown-menu" id="DocumentResult"></div>
						<div id="ButtonsWrapBox"></div>
					 </div>

					  
					  
				</div> 
				
				
				
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

						<a class="btn btn-primary" onclick="saveRelDoc(<?=$this->session->userdata("IDMatterActual")?>)"  id="save_close"  class="btn btn-primary " >Save and Close</a>

						<a id="cancel"  onclick="closeRelContact()" class="btn btn-primary">Cancel </a>

					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	

	<script type="text/javascript">
		$(".dropdown-menu").mouseleave(function() {
			 
			$(".dropdown-menu").hide();
		});
	</script>