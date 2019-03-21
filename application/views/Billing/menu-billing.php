<?php 
 $ci =&get_instance();
 
 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
		<div id="" class="billingMenuTitle">
				<img src="<?=base_url()?>img/billing_dashboard.png"  > &nbsp; &nbsp; <?php echo $this->lang->line('billing_1'); ?>
			</div>

			<!-- Folders cat  -->
			<div id="folders_tree" class="tabcontent matCat"   style="display:block">

				<a href="<?=base_app()?>Billing/time_expense"> 
					<img src="<?=base_url()?>img/billing_clok.png"  > &nbsp;  <?php echo $this->lang->line('billing_2'); ?>
				</a>

				<a href="<?=base_app()?>Billing/invoices"> 
					<img src="<?=base_url()?>img/billing_invoices.png"  > &nbsp;  <?php echo $this->lang->line('billing_3'); ?>
				</a>

				<a href="<?=base_app()?>User"> 
					<img src="<?=base_url()?>img/Billing_setting.png"  > &nbsp;  <?php echo $this->lang->line('billing_4'); ?>
				</a>

				<a href="<?=base_app()?>Billing/codes"> 
					<div> <?php echo $this->lang->line('billing_5'); ?></div>
				</a>
 

			</div>

			
			

