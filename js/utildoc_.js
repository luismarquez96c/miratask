
	function newFolder(){
		
		$.ajax({
		url:  base_app + 'AjaxDoc/newFolder',
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			$("#newFolder").html(data);
		});
		
		$("#newFolder").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}



	 
	
	
	/****************************************************Stafff fluu*********************/	

	function SaveFolder(){
		
		//$('#tasklistForm').attr('action', base_app+'Ajax/AtachTaskList');
		
		

		var url = base_app+'AjaxDoc/SaveNewFolder'; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#formNewFolder").serialize(), 
			   success: function(data)
			   {
				   data.trim();
				   if(data==0){
						
						alert("No saved something wrong!"); 
						
						
						
				   }else if(data==1){
					   
					  alert("Folder completed Succeful!");

					  $("#newFolder").html("");
					  $("#newFolder").hide();
					  $("#fadeBlack").hide();
					  
					  location.reload();
						 
					}else{
						$("#newFolder").html(data);
					} 
					
			   }
		});
		
	}



	function newDocument(IdMAtter){
		
		$.ajax({
		url:  base_app + 'AjaxDoc/newDocument/'+IdMAtter,
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			$("#newFolder").html(data);
		});
		
		$("#newFolder").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}

	function ChangeFolder(idFolder, selectedString, button ){
		 

		 $('#'+button).html(selectedString.substring(0, 30));

		 $.ajax({
		url:  base_app + 'AjaxDoc/setFolderAct',
		type: 'POST',
		dataType: 'html',
		data: { ActualFol: idFolder},
		}).done(function (data) {
			//$("#newFolder").html(data);
		});

		html='<input type="hidden" name="Folder" value="'+idFolder+'">';
	
		$('.foldWrap').append(html);
		
 
	}


	function moveToFolder(idFolder){
		$('#listForm').attr('action', base_app+'Document/MoveToFolder/'+idFolder);
        $("#listForm").submit();
    }


	function saveDataOfDoc(){

		var url = base_app+'AjaxDoc/saveDetailOfDocuments'; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#formNewDocs").serialize(), 
			   success: function(data)
			   {
				    data.trim();
				    if(data==1){
					
				       	alert("Folder completed Succeful!");

					  	$("#newFolder").html("");
					  	$("#newFolder").hide();
					  	$("#fadeBlack").hide();

					   	location.reload();
						
				   }else{
					   
					  	$("#listErrors").html(data);

					} 
					
			   }
		});
		
	}
	
	function deleteAtachDoc(id,tipo,task){
		      
		$.ajax({
		url:  base_app + 'AjaxDoc/deleteAtach/'+id+'/'+tipo+'/'+task,
		type: 'POST',
		dataType: 'html'
		}).done(function (data) {
			//$("#taskForm").html(data);
		});
		
		 

	}
	

	
	function showDocuments(valor) {
			
			$.ajax({
				url:  base_app + 'AjaxDoc/showDocList/',
				type: 'POST',
				dataType: 'html',
				data: { Document: valor},
			}).done(function (data) {
				$('#DocumentResult').html(data);
			});
			
			if($('#DocumentResult:hidden')){
				
				$("#DocumentResult").show();
			}
	}
	
	function addFieldDoc(id, name){
		
		var html;
		html ='<span id="butt'+id+'" class="staffItem  btn btn-default btn-xs">';
		html+= name+'<span onclick="remHtmlTag(\'butt'+id+'\')">X</span>';
		html+='<input type="hidden" name="RelDoc[]" value="'+id+'"></span>';
	
		$('#ButtonsWrapBox').append(html);
 
		$("#DocumentResult").hide();

	}
	
	function RelDocToMatt(){
		
		$.ajax({
		url:  base_app + 'AjaxDoc/loadRelDocForm/',
		type: 'POST',
		dataType: 'html',
		data: { Contact: "dd"}
		}).done(function (data) {
			$("#relContactForm").html(data);
		});
		
		$("#relContactForm").fadeIn(400);
		$("#fadeBlack").fadeIn(400);
		
	}
	
	function saveRelDoc(idMatterAct){

		var url = base_app+'AjaxDoc/saveRelDoc'; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#formRelDoc").serialize(), 
			   success: function(data)
			   {
				    data.trim();
				    if(data==1){
					
				       	alert("Folder completed Succeful!");

					  	 
					  	$("#relContactForm").hide();
					  	$("#fadeBlack").hide();

					   	window.location.href = base_app+"Matters/Details/"+idMatterAct+"?tab=records";
						
				   }else{
					   
					  	$("#listErrors").html(data);

					} 
					
			   }
		});
		
	}
	
	



	
	
	$( document ).ready(function() {	
		
		
		
	
	});	
	
	
	
	
	






