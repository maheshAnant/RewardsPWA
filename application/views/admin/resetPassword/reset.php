<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
               <h4 class="card-title">Reset Password</h4>
               <span class="red">
                 <?php echo validation_errors(); ?>
               </span>          
               <form class="forms-sample" action="<?=ADMIN_PATH?>resetpassword/update" method="post">
                  <div class="form-group">
                     <label for="exampleInputName1">New Password</label><span class="red">*</span>
                     <input type="password" class="form-control" id="exampleInputName1" name="password" placeholder="password" value="<?=isset($_POST['password'])?$_POST['password']:""?>">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Confirm Password</label><span class="red">*</span>
                     <input type="password" class="form-control" id="exampleInputName1" name="cpassword" placeholder="confirm password" value="<?=isset($_POST['cpassword'])?$_POST['cpassword']:""?>">
                  </div>
                  <input type="hidden" name="id" value="<?=$id?>"/>
                 <button type="submit" class="btn btn-gradient-primary mr-2" >Submit</button>
                 <a href="<?=ADMIN_PATH?>user" class="btn btn-light">Cancel</a>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
  <!-- content-wrapper ends -->
</div>