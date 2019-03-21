
   




  <h3><strong>Change your password </strong></h3>
  <br>
   Enter your Email for Get link to reset your Password
   <br>
   <strong class="red"> <?php if(isset($Wmessage)){ echo $Wmessage; } ?></strong>

   <?= form_open("Login/SavePassword/".$code)?>
    <div class="row row-sm-offset">

     <div class="col-xs-12 col-md-12">
      <div class="form-group">
       <input type="password" class="form-control" name="Password" required="" id="Password" placeholder="Enter New Password">
      </div>
     </div>

     <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <input type="password" class="form-control" name="Password2" required="" id="Password2" placeholder="Enter New Password Again ">
      </div>
     </div>
    </div>




    <div><button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #0055a5">Change Password</button></div>



<?= form_close(); ?>

    <div class="col-md-6" style="float: left;"><p><a href="<?=base_app()?>login" style="color: #0055a5">I have an Account , login here</a></p></div>
  </form>





