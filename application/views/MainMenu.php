
<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>
<?php 

foreach ($MainMenu as $row)
{
	echo '<li><a id="'.$row->cssId.'" class="'.$row->Class.'" href="'.base_app().$row->Link.'">'.$row->Text.'</a></li>';

}
if ($this->session->userdata('Role')==1) {
	echo '<li><a id="title_ts" class="" href="'.base_app().'Admin">'.$this->lang->line('menu_1').'</a></li>';
}else{
	echo '<li><a id="title_ts" class="" href="#">'.$this->lang->line('menu_1').'</a></li>';	
}
echo '<li><a id="Checkin" class="">'.$this->lang->line('menu_2').'</a></li>';
echo '<li><a id="Pause" class="active">'.$this->lang->line('menu_3').'</a></li>';
echo '<li><a id="Resume" class="active">'.$this->lang->line('menu_4').'</a></li>';
echo '<li><a id="Checkout" class="active">'.$this->lang->line('menu_5').'</a></li>';
if ($this->session->userdata('email_unread')) {
	echo "<li class='current-page'><a id='info_email' class='active'>".email_accounts($this->session->userdata('email_unread'),$this->session->userdata('pass_unread'))."</a></li>";
}else{
	echo "<li class='current-page'><a id='info_email' class=''>Emails : 0</a></li>";
}
?>