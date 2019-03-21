<script src="<?=base_url()?>js/tinymce/tinymce.min.js"></script>

 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("MatterModel");
	$ci->load->model("UserModel");
 ?>

<script>
	tinymce.init({
	  selector: "textarea",
	  height: 200,
	  width:600,
	  plugins: [
		"advlist autolink autosave link  lists hr anchor pagebreak",
		" wordcount     insertdatetime   nonbreaking",
		" contextmenu directionality  template textcolor  textcolor colorpicker textpattern"
	  ],

	  toolbar1: "bold italic underline strikethrough forecolor bullist numlist",
	
	   

	  menubar: false,
	  statusbar: false,
	  toolbar_items_size: 'small',

	   
	});
</script>


<div class="formNote" >

	<form action="<?=base_app()?>Matters/SaveNote/<?=$actualMatter?>" method="post" >



	<br>

	<textarea name="note">
		

	</textarea>
	<br>
	<br>
	<br>
		<div class="notesSend">
			<input type="submit" value="Save" id="save_close"  class="btn btn-primary " >
			<?php echo "<br>You have ".$notesCreated->total." notes "; ?>
		</div>
	</form> 
	
	<div>

		<div><?=substr($row->note,0,100)?></div>
		
		
	</div>



<div id="listNoteWrap">

	<?php
		 
		if(count($notes)>0){
			
		foreach($notes as $row){

			//echo "<br>Created by ".$row->CreatedBy;

			$author=$ci->UserModel->GetAttorney($row->Creator);


			 
		?>
	<span id="db_<?=$row->Id?>" class="delete" onclick="deleteNote('<?=$row->Id?>')">x</span>
	<button class="accordion" id="nn_<?=$row->Id?>" >
		Date: <span class="cc"><?=decodedate($row->Date)?> </span> &nbsp; &nbsp; 
		Author: <span class="cc"><?=$author->Name?>  <?=$author->LastName?> </span> &nbsp; &nbsp;  <?=substr(strip_tags($row->Note),0,20)?>
	</button>
		
	<div class="panelaccc">
	  	<p><?=$row->Note?></p>
	</div>

	<?php } } ?>

</div><!-- fin listNoteWrap -->


<script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].onclick = function(){
	        /* Toggle between adding and removing the "active" class,
	        to highlight the button that controls the panel */
	        this.classList.toggle("active");

	        /* Toggle between hiding and showing the active panel */
	        var panelaccc = this.nextElementSibling;
	        if (panelaccc.style.display === "block") {

	            /*panelaccc.style.display = "none";*/
	            $(panelaccc).slideUp('fast');

	        } else {
	            /*panelaccc.style.display = "block";*/
	            $(panelaccc).slideDown('fast');
	        }
	    }
	} 

</script>


<div class="clearh20"></div>
	
</div>




