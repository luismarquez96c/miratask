<script src="<?=base_url()?>js/mattersAjax.js"></script>
<script src="<?=base_url()?>js/contactAjax.js"></script>

CreateContact


<form action="<?=base_url()?>Matters/SaveNew" method="post">


	Matter Name<input type="text" name="Name" />

		<br>
		<br>

	Description<input type="text" name="Description" />

		<br>
		<br>

	Contact<input type="text" name="Contact" id="Contact" autocomplete="off" />
		   <input type="hidden"     name="ContactID" id="ContactID"/>	
			<div id="ContactResult"></div>
			<a id="CreateContact"   >Create New Contact</a>

		<br>
		<br>
		<br>
		<br>

	Practice Area  :<select name="Area"> 
						<?php 
							foreach ($Areas as $row)
							{
							    echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
							}
						?>
					</select>


		<br>
		<br>	


	Matters Template:<select name="MatterTemplate"> 
						<?php 
							foreach ($Templates as $row)
							{
							    echo '<option value="'.$row->Id.'">'.$row->Template.'</option>';
							}
						?>
					</select>

		<br>
		<br>

	Date Opened: <input type="text" name="DateOpened" id="DateOpened" />
		
		<br>
		<br>

	Responsible Attorney: <input type="text" name="ResponsibleAttorney" id="ResponsibleAttorney" autocomplete="off" />
			<input type="hidden"     name="ResponsibleID" id="ResponsibleID"/>	
			<div id="ResponsibleResult"></div>



		<br>
		<br>

		Other Staff: <input type="text" name="OtherStaff" id="OtherStaff" />


		<br>
		<br>


		Referred By: <input type="text" name="ContactReferred" id="ContactReferred" autocomplete="off" />
		<input type="hidden"     name="ContactReferredID" id="ContactReferredID"/>	
		<div id="ContactReferredResult"></div>
		
		
		
		<a id="CreateReferredContact" >Create New Contact</a>



		<br>
		<br>
		<br>
		<br>


		Originating Attorney: <input type="text" name="OriginatingAttorney" id="OriginatingAttorney"  autocomplete="off"/>
		<input type="hidden"     name="OriginatingID" id="OriginatingID"/>	
		<div id="OriginatingResult"></div>

		<br>
		<br>

		 
		Send Notification every :<select name="Notifications"> 
						<?php 
							foreach ($Notifications as $row)
							{
							    echo '<option value="'.$row->Id.'">'.$row->Laps.'</option>';
							}
						?>
					</select>

		<br>
		<br>
		<input type="submit" value="Save And Close" />
		<a >Cancel</a><a >Next</a>




</form>


<div id="newContactForm">
</div>
