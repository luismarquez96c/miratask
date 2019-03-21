<?php 
	
	foreach ($MainMenu as $row)
	{
		echo '<li><a id="'.$row->cssId.'" class="'.$row->Class.'" href="'.base_app().$row->Link.'">'.$row->Text.'</a></li>';
		               
	}


?>