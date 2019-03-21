

   
   <h3><strong>Get Link  </strong></h3>
  <br>
   Enter your Email for send link to reset your Password
   <br>
   <strong class="red"><?php if(isset($Wmessage)){ echo $Wmessage; } ?></strong> 

   <?= form_open("Login/SendLinkCode")?>
    <div class="row row-sm-offset">

     <div class="col-xs-12 col-md-12">
      <div class="form-group">
       <input type="email" class="form-control" name="Email" required="" id="correo" placeholder="Enter you email">
      </div>
     </div>

     <div class="col-xs-12 col-md-12">
      <div class="form-group">
        
      </div>
     </div>
    </div>




    <div><button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #0055a5">Get Link code</button></div>



<?= form_close(); ?>

    <div class="col-md-6" style="float: left;"><p><a href="<?=base_app()?>login" style="color: #0055a5">I have an Account , login here</a></p></div>
  </form>

