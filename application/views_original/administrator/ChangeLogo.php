<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script src="<?=base_url()?>js/util.js"></script>



<div class="col-xs-5 col-xs-offset-3" style="padding-top: 10%;padding-bottom:20%;">
	<?php echo form_open_multipart('Admin/upload_image');?>
	<legend>Upload Logo</legend>

	<div class="form-group">
		<label for="">Image</label>
		<input type="file" name="foto" required="" class="form-control" id="" placeholder="Input field">
	</div>



	<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>