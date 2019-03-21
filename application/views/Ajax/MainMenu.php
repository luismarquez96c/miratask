<?php 

foreach ($MainMenu as $row)
{
	echo '<li><a id="'.$row->cssId.'" class="'.$row->Class.'" href="'.base_app().$row->Link.'">'.$row->Text.'</a></li>';

}
if ($this->session->userdata('Role')==1) {
	echo '<li><a id="title_ts" class="" href="'.base_app().'Admin">TimeSheet</a></li>';
}else{
	echo '<li><a id="title_ts" class="" href="#">TimeSheet</a></li>';	
}
echo '<li><a id="Checkin" class="" href="#">Check in</a></li>';
echo '<li><a id="Pause" class="active" href="#">Pause Time</a></li>';
echo '<li><a id="Resume" class="active" href="#">Resume</a></li>';
echo '<li><a id="Checkout" class="active" href="#">Check Out</a></li>';
if ($this->session->userdata('email_unread')) {
	echo "<li class='current-page'><a id='info_email' class='active' href='#'>".email_accounts($this->session->userdata('email_unread'),$this->session->userdata('pass_unread'))."</a></li>";
}else{
	echo "<li class='current-page'><a id='info_email' class='' href='#'>Emails : 0</a></li>";
}
?>