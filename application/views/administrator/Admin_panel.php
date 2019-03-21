<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>

<div class="admin-panel-container">
	<h3 class="text-center arvo"><?php echo $this->lang->line('timesheet_1'); ?></h3>

	<div class="container-options-panel workin-time">
		<div class="header-options-panel">
			<h3 class="text-center arvo"><?php echo $this->lang->line('timesheet_2'); ?></h3>
		</div>
		<div class="body-options-panel bwt">
			<a href="<?=base_url();?>Admin/changeLogo?role=admin"><h4 class="text-center wt"><?=$this->lang->line('timesheet_3')?></h4></a>
		</div>
	</div>

	<div class="container-options-panel">
		<div class="header-options-panel">
			<h3 class="text-center arvo"><?php echo $this->lang->line('timesheet_4'); ?></h3>
		</div>
		<div class="body-options-panel bat">
			<a href="<?=base_url()?>Admin/Adjust_time"><h4 class="text-center at"><?php echo $this->lang->line('timesheet_5'); ?></h4></a>
		</div>
	</div>

	<div class="container-options-panel workin-time">
		<div class="header-options-panel">
			<h3 class="text-center arvo"><?php echo $this->lang->line('timesheet_6'); ?></h3>
		</div>
		<div class="body-options-panel bwt">
			<a href="<?=base_url();?>Admin/Working_time"><h4 class="text-center wt"><?php echo $this->lang->line('timesheet_7'); ?></h4></a>
		</div>
	</div>

</div>