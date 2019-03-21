<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 

<!-- CONTENIDO MATTERS -->
<script src="<?=base_url()?>js/util.js"></script>



<?php if(isset($message)){ echo $message; }  ?>

<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3><?=$this->lang->line('billing_13')?></h3><hr>
</div>

<div class="row">

	<div class="matterContent">
		<!-- MATTERS -->

		<!-- Menu de categorias  -->
		<div class="col-xs-3 folderNav">
			<?php $this->load->view('Billing/menu-billing'); ?>
		</div><!-- fin menu de categorias -->

		<div class="col-xs-9 ListWrap">

			<?php $this->load->view($vista_billing); ?>
			
		</div><!-- fin contenedor de matters -->

		<div class="clearh50"></div>

	</div><!-- fin clase maters content -->

</div>



