



	function setFields(id, name, HideField, textField, Resulbox){

		$('input[name="'+HideField+'"]').val(id);
		$('input[name="'+textField+'"]').val(name);
		
		$("#"+Resulbox).hide();
		 
	}
	
	

	//Used on step 2 for add other related contact with matter	
	//PASO 2.agrega campos Nombre y relation de un contacto relacionado al caso	  	
	function addFields(){ 
		
		CountInput=CountInput+1;
		
		$('input[name="totCont"]').val(CountInput);
		
		var f1='<div class="form-group row"><label for="" class="col-sm-1 col-form-label">Others Contact *</label>';
		var f2='<div class="col-md-5">';
		var f3='<input type="text" class="form-control" name="Contact'+CountInput+'" id="Contact'+CountInput+'"  onkeyup="showContacts(this.value,'+CountInput+')"  autocomplete="off" value="" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome" />';
		var f4='<div class="SearchBox" id="ContactResult'+CountInput+'"></div>';
		var f5='<input type="hidden" name="ContactID'+CountInput+'" value="" /></div>';
		var f6='<div class="col-md-5"><input type="text" name="Relation'+CountInput+'" class="form-control" placeholder="Relationship to Matter" value=""></div></div>';
	 
		
		var html=f1+f2+f3+f4+f5+f6;	
		
		$('#OtherContact').append(html);
		
		
		
	}


	//Show Contact list when key up on input search
	//cuando se escribe en campo Nombre del contacto, busca en db nombres
	function showContacts(valor,InputNumber) {
			
			$.ajax({
				url:  base_app + 'Ajax/showContact/'+InputNumber,
				type: 'POST',
				dataType: 'html',
				data: { Contact: valor},
			}).done(function (data) {
				$('#ContactResult'+InputNumber).html(data);
			});
			
			if($('#ContactResult'+InputNumber+':hidden')){
				
				$("#ContactResult"+InputNumber).show();
			}
	}




	//is activated when clik on Create contact button
	function createContact(IdField,nameField){
		      
		
		
		fieldContactID   = IdField;
		fieldContactName = nameField;
		
		//alert("nuevo valor Name " + fieldContactName+ " / nuevo valor ID " + fieldContactID);

		$.ajax({
		url:  base_app + 'Ajax/ContactNew',
		type: 'POST',
		dataType: 'html',
		}).done(function (data) {
			$("#newContactForm").html(data);
		});
		
		$("#newContactForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
		
		
	}
	
	//is activated when clik on Create contact button
	function createOtherContact(){
		
		
		
		var valorUltimoCampo=$("#Contact"+CountInput).val();	
		
		//alert("valor ultimo campo:  "+valorUltimoCampo);
		
		if(valorUltimoCampo==""){
			
			fieldContactID   = "ContactID"+CountInput;
			fieldContactName = "Contact"+CountInput;
			
		}
		if(valorUltimoCampo!=""){
			
			addFields();
			
			fieldContactID   = "ContactID"+CountInput;
			fieldContactName = "Contact"+CountInput;
			
		}
		
		
		
		//alert("nuevo valor Name " + fieldContactName+ " / nuevo valor ID " + fieldContactID);

		$.ajax({
		url:  base_app + 'Ajax/ContactNew',
		type: 'POST',
		dataType: 'html',
		data: { Contact: "dd"}
		}).done(function (data) {
			$("#newContactForm").append(data);
		});
		
		$("#newContactForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
		
		
	}

	/****************************************************related contacta to matter fluu*********************/
	
	function createRelContact(){
		
		$.ajax({
		url:  base_app + 'Ajax/loadRelContForm',
		type: 'POST',
		dataType: 'html',
		data: { Contact: "dd"}
		}).done(function (data) {
			$("#relContactForm").html(data);
		});
		
		$("#relContactForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}

	function closeRelContact(){
		$("#relContactForm").fadeOut(400);
		$("#fadeBlack").fadeOut(400);
	}
	
	
	/****************************************************Stafff fluu*********************/

	function searchStaff(valor) {
			
			$.ajax({
				url:  base_app + 'Ajax/SearchStaff/',
				type: 'POST',
				dataType: 'html',
				data: { OtherStaff: valor},
			}).done(function (data) {
				$('#resulAttorney').html(data);
			});
			
			if($('#resulAttorney:hidden')){
				
				$("#resulAttorney").show();
			}
	
	}
	
	function showAtorneys(valor) {
			
			$.ajax({
				url:  base_app + 'Ajax/OtherStaffByName/',
				type: 'POST',
				dataType: 'html',
				data: { OtherStaff: valor},
			}).done(function (data) {
				$('#resulAttorney').html(data);
			});
			
			if($('#resulAttorney:hidden')){
				
				$("#resulAttorney").show();
			}
	
	}
	
	function removeStaff(id){
		
		$.ajax({
				url:  base_app + 'Ajax/StaffRemove/',
				type: 'POST',
				dataType: 'html',
				data: { Staff: id},
			}).done(function (data) {
				$("#staffItem"+id).remove(); 
			});
	}

	
 
	
	 
	function addStaff(id, name, HideField, textField, Resulbox){
		
		$.ajax({
				url:  base_app + 'Ajax/StaffAdd/',
				type: 'POST',
				dataType: 'html',
				data: { Staff: id},
			}).done(function (data) {
				
				data.trim();

				if(data<1){
					
					var html='';
					html ='<span id="staffItem'+id+'" class="staffItem  btn btn-default btn-xs">';
					html+=name+'<span onclick="removeStaff('+id+')">X</span>';
					html+='</span>';
				
					$('#staffWrapBox').append(html);
					
				}else if(data>0){
					
					alert("Staff Already exist!");

				}
				
				
				
				$("#"+Resulbox).hide();
				
				 
			});
		
		 
	}
	
	function addFieldStaff(id, name, HideField, textField, Resulbox){
		
	    var html='';
		html ='<span id="staffItem'+id+'" class="staffItem  btn btn-default btn-xs">';
		html+=name+'<span onclick="removeStaff('+id+')">X</span>';
		html+='<input type="hidden" name="otherStaf[]" value="'+id+'"></span>';
	
		$('#staffWrapBox').append(html);
					
		$("#"+Resulbox).hide();

	}


	
	
	
	/*******************************************related matter*********************/
	function MatterRelToInvoice(valor) {
		$.ajax({
			url:  base_app + 'Ajax/MatterRelToInvoice',
			type: 'POST',
			dataType: 'html',
			data: { Criteria: valor},
		}).done(function (data) {
			$('#MatterResult').html(data);
		});
		
		if($('#MatterResult:hidden')){
			
			$("#MatterResult").show();
		}
	}
	
	
	function SearchMatter(valor) {
		$.ajax({
			url:  base_app + 'Ajax/SearchRelMatter/',
			type: 'POST',
			dataType: 'html',
			data: { IdMatter: valor},
		}).done(function (data) {
			$('#MatterResult').html(data);
		});
		
		if($('#MatterResult:hidden')){
			
			$("#MatterResult").show();
		}
	}
	
	function createRelMatter(){
		
		$.ajax({
		url:  base_app + 'Ajax/loadRelMattForm',
		type: 'POST',
		dataType: 'html',
		data: { Contact: "dd"}
		}).done(function (data) {
			$("#relContactForm").html(data);
		});
		
		$("#relContactForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}
	
	function closeRelMatter(){
		$("#relContactForm").fadeOut(400);
		$("#fadeBlack").fadeOut(400);
		
		if(refrr==1){
			location.reload();
		}
	}
	
	
	function removeRelMatter(id){
		
		$.ajax({
				url:  base_app + 'Ajax/MatterRelRemove/',
				type: 'POST',
				dataType: 'html',
				data: { IdMatter2: id},
			}).done(function (data) {
				
				data.trim();
				if(data==1){
				
					$("#MatterItem"+id).remove(); 
					refrr=1;
				}
				
			});

	}
	
	function addFieldMatter(id, name, Resulbox){
		
	    var html='';
		html ='<span id="staffItem'+id+'" class="staffItem  btn btn-default btn-xs">';
		html+=name+'<span onclick="removeStaff('+id+')">X</span>';
		html+='<input type="hidden" name="MatterRel[]" value="'+id+'"></span>';
	
		$('#MatterWrapBox').append(html);
					
		$("#"+Resulbox).hide();

	}
	
	/*****************************for add Contact *************/
	function addFieldIndividual(){
		
		
		$.ajax({
				url:  base_app + 'Ajax/ContIndividualField',
				type: 'POST',
				dataType: 'html'
			}).done(function (data) {
				
				$("#individualSection").html(data); 
					 
				
			});
		
		 
		
		 
		
		 
	}
	
	function RemoveFieldIndividual(){
		
		$("#individualSection").html("");
		 
	}


	
		//is activated when clik on Create contact button
	
	
	


	/***************************when add contacts and matters to task */


	//Show Contact list when key up on input search
	//cuando se escribe en campo Nombre del contacto, busca en db nombres

	function ContactAndMAtt(valor,Section) {
			
			$.ajax({
				url:  base_app + 'Ajax/ContactAndMAtt/'+Section,
				type: 'POST',
				dataType: 'html',
				data: { Criteria: valor},
			}).done(function (data) {
				$('#ContactResult'+Section).html(data);
			});
			
			if($('#ContactResult'+Section+':hidden')){
				
				$("#ContactResult"+Section).show();
			}
	}







	/********************************************************general function *************************/

	function addFieldButt(id, name, Section, idButton , Resulbox, typeAtach){
		
		var html;
		html ='<span id="'+idButton+'" class="staffItem  btn btn-default btn-xs">';
		html+=name+'<span onclick="remHtmlTag(\''+idButton+'\'),remHtmlTag(\''+id+typeAtach+'\')">X</span>';
		html+='<input type="hidden" name="ContMAtter'+Section+'[]" value="'+id+'_'+typeAtach+'"></span>';
	
		$('#ButtonsWrapBox'+Section).append(html);

		/*for buttom atach to, it send the id of task and id of object*/
		$('#listForm').append('<input type="hidden" name="ContMAtterAtach[]" id="'+id+typeAtach+'" value="'+id+'_'+typeAtach+'">');
		
		 
		$("#"+Resulbox).hide();

	}

	 



	function CloseObject(Objectt, reload){
		
		$("#"+Objectt).fadeOut(400);
		$("#"+Objectt).html("");
		$("#fadeBlack").fadeOut(400);

		if(reload=='reload'){
			location.reload();
		}


		
	}
	
	function thisSelect(valForHidden, selectedString, idHidden, button ){
		 $('#'+idHidden).val(valForHidden);
		 $('#'+button).html(selectedString.substring(0, 14));
	}


	function remHtmlTag(id){

		//alert("removing ID "+ id);
		$("#"+id).remove(); 
			 
	}
	function switchTag(act,id){
		 if(act=='off'){ $("#"+id).hide(400); }else{ $("#"+id).show(400);  }
	}
	
	function switchx(id){
		
		 if($("#"+id).is(":visible")){ 
                     $("#"+id).slideUp(400);
                     $(".modal-backdrop").fadeOut();
                     $("#fadeBlack").fadeOut(400);
                 }else{ 
                     $("#"+id).slideDown(400);  
                 }
	}









/*******************************************************************************************************/

	
	function createTask(idMatter, varsReolad){
		
		reloadAfterSave=varsReolad;
		      
		$.ajax({
		url:  base_app + 'Ajax/TaskNew',
		type: 'POST',
		dataType: 'html',
		data: { IdMatter: idMatter}
		}).done(function (data) {
			$("#taskForm").html(data);
		});
		
		$("#taskForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);

	}

	function detailTask(id,  varsReolad){
		
		reloadAfterSave=varsReolad;
		      
		$.ajax({
		url:  base_app + 'Ajax/TaskDetail/'+id,
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			$("#taskForm").html(data);
		});
		
		$("#taskForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);

	}

	/**************************SAve and update methods *********************************/
	function saveTask(){ 
	
		var style="background:#EAEAEA; color:#003942; border:3px solid #dadada;";
		$('#save').attr("style", style);
		
		$('#lodimg').show();
		
		$.ajax({
			url: base_app + 'Ajax/TaskSaveNew',
			type: 'POST',
			dataType: 'html',
			data: $("#formNewTask").serialize()
			}).done(function (data) {

				data.trim();
				if(data=="ok"){
					
					$("#taskForm").html(""); 
					$("#taskForm").hide(); 
					$("#fadeBlack").hide(); 
					
					if(reloadAfterSave==undefined){ reloadAfterSave=""; }

					alert("Task has been save!");
					if(reloadAfterSave!=''){  
						window.location.href = base_app+reloadAfterSave;
					}else{
						location.reload();
					}	
				}else{

					$("#resultErrors").html(data); 
					
					$('#save').removeAttr( "style" );
					$('#lodimg').hide();
				}


			});	
	} 

	function updateTask(IdTask){ 


		$.ajax({
			url: base_app + 'Ajax/updateTask/'+IdTask,
			type: 'POST',
			dataType: 'html',
			data: $("#formNewTask").serialize()
			}).done(function (data) {

				data.trim();
				if(data=="ok"){
					
					$("#taskForm").html(""); 
					$("#taskForm").hide(); 
					$("#fadeBlack").hide();

					alert("Task has been save!");

					if(reloadAfterSave.length > 0){ 
						window.location.href = base_app+reloadAfterSave;
						
					}else{
						location.reload();
					}

				}else{
					$("#resultErrors").html(data); 
				}


			});	
	} 



	function filtro(IdForm, url){ 


		$.ajax({
			url: base_app + url,
			type: 'POST',
			dataType: 'html',
			data: $("#"+IdForm).serialize()
			}).done(function (data) {

				data.trim();
				if(data=="ok"){
					location.reload();
					
				}else{
					$("#resultErrors").html(data); 
				}


			});	
	} 
	
	

	function deleteAtach(id,tipo,task){
		      
		$.ajax({
		url:  base_app + 'Ajax/deleteAtach/'+id+'/'+tipo+'/'+task,
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			//$("#taskForm").html(data);
		});
		
		 

	}
	
	
	


	function markComplete(IdTask){

		$.ajax({
			url: base_app + 'Ajax/completedTask',
			type: 'POST',
			dataType: 'html',
			data: { IdTask: IdTask},
			}).done(function (data) {
				
					$("#taskForm").html(data); 

			});	

	 }



	/****************************************************related contacta or matter to task fluu*********************/
	
	function atachTo(ajaxUrl){
		
		$.ajax({
		url:  base_app+ajaxUrl,
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			$("#atachTo").html(data);
		});
		
		$("#atachTo").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}

	function closeAtach(){
		$("#atachTo").fadeOut(400);
		$("#atachTo").html("");
		$("#fadeBlack").fadeOut(400);
	}


	function AtachList(actionAjax){
		
		var url = base_app+actionAjax; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#listForm").serialize(), 
			   success: function(data)
			   {
				   data.trim();
				   if(data==0){
						
						alert("No saved something wrong!"); 
						//$('.itemContact').attr('checked', false); 
						//$('.goupID').attr('checked', false);
						
						
				   }else if(data==1){
					   
					  alert("Task completed Succeful!"); 
					   //$('.itemContact').attr('checked', false);
					   //$('.goupID').attr('checked', false);
					   
					   location.reload();
					   
					}else if(data==3){
					
						alert("No selected items!");
					
					}
					
			   }
		});
		
	}


	function deleteTask(id_task){

		var retVal = confirm("Do you want to Erase Element ?");

       	if( retVal == true ){
          

       		$.ajax({
			url:  base_app+'ajax/deleteTask',
			type: 'POST',
			dataType: 'html',
			data: { id_task: id_task},
			}).done(function (data) {
				data.trim();
				 if(data==1){
				 location.reload();
				}else{
					alert("something wrong! try refresh page ");
				}
			});

       	}else{

          	return false;
          

       }


	}

	function  completeTask(id_task){

		var retVal = confirm("Do you want to Erase Element ?");

       	if( retVal == true ){
          

       		$.ajax({
			url:  base_app+'ajax/completeTask',
			type: 'POST',
			dataType: 'html',
			data: { id_task: id_task},
			}).done(function (data) {
				data.trim();
				 if(data==1){
				 location.reload();
				}else{
					alert("something wrong! try refresh page ");
				}
			});

       	}else{

          	return false;
          

       }


	}







	function loadEvent(id_event){

		$("#modal-event").modal("show");
		$.post(base_url+"Calendar/modal_event_detail",{id:id_event},function(response){
			$("#modal-event").html(response);

		});

	}

	function deleteEvent(id_event){

		var retVal = confirm("Do you want to Erase Element ?");

       	if( retVal == true ){
          

       		$.ajax({
			url:  base_app+'Calendar/event_detele',
			type: 'POST',
			dataType: 'html',
			data: { id_event: id_event},
			}).done(function (data) {
				 ocation.reload();
			});

       	}else{

          	return false;
          

       }


	}



	/*search barr*/
	
	
	function MarkClosedMatter(){
		
		var url = base_app+"Ajax/MarkClosedMatter"; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#formNewTask").serialize(), 
			   success: function(data)
			   {
				   data.trim();
				   if(data==1){
						
						
						
					  alert("Matter has closed Succeful!"); 
					  window.location.href= base_app+'Matters';
					  
					  //$('#atachTo').hide();
					  //$("#fadeBlack").fadeOut(400);
					  
							
				   }else{
					   
					  $("#resultErrors").html(data);
					   
					}
					
			   }
		});
		
	}

	
	/**************************************************** Stafff fluu *********************/	

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
	
	function deleteNote(id){
		
		var retVal = confirm("Do you want to Erase Element ?");

       	if( retVal == true ){
		
			$.ajax({
			url:  base_app + 'Ajax/BorrarNota/'+id,
			type: 'POST',
			dataType: 'html'
			}).done(function (data) {
				
				data.trim();
				   if(data==1){
					remHtmlTag('nn_'+id);
					remHtmlTag('db_'+id);
				}else{
					alert("No deleted element, something wrong!");
				}
				
				
			});
			
			 
		
		}
		
	}


	
	
	$( document ).ready(function() {
		
		$(".SearchBox").mouseleave(function() {
			 
			 $(".SearchBox").hide();
		});
		
		 
		
		$("#contorno").click(function() {
			 
			$(".SearchBox").hide();
		});
		
		$("#close_matter").click(function() {
			$('#listForm').attr('action', base_app + 'Task/MarkCompleted');
            $("#listForm").submit();
        });
		
		$("#showCompleted").click(function() {
			
			window.location.href= base_app+'Task/viewCompleted';			
			 
		});
		
		$(".dropdown-menu").mouseleave(function() {
			 
			$(".dropdown-menu").hide();
		});
		
	});	
	
	
	
	
	






