<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Edit Voucher</h4>
                  <span class="red">
                    <?php echo validation_errors(); ?>
                  </span>  
                  <?php if(isset($status) && $status == "success"){?>
                     <span class="green">
                       <p><?=$message?><p>
                     </span>
                  <?php }?>  

                  <form class="forms-sample" action="<?=ADMIN_PATH?>voucher/update" method="post">
                     <input type="hidden" name="id" value="<?=$id?>"/> 
                     <div class="form-group">
                        <label for="exampleInputName1">Voucher Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="voucher[voucher_name]" placeholder="Voucher Name" value="<?=isset($voucher_name)?$voucher_name:""?>">
                        <span class="text-danger" id="name_error"></span>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputName1">Voucher Code</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="voucher[voucher_code]" placeholder="Voucher Code" value="<?=isset($voucher_code)?$voucher_code:""?>">
                        <span class="text-danger" id="name_error"></span>
                     </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Voucher Points</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="voucher[voucher_points]" placeholder="Voucher Points" value="<?=isset($voucher_points)?$voucher_points:""?>">
                        <span class="text-danger" id="name_error"></span>
                     </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Company</label>
                        <select class="form-control" name="voucher[company_id][]" style="color:black;" multiple="multiple">
                           <option value="">Please Select Company</option>
                           <?php if(!empty($company)){
                              foreach ($company as $key => $value) {
                           ?>
                              <option value="<?=$value['id']?>" <?php if(in_array($value['id'], $companies)){?> selected <?php } ?> ><?= $value['name'] ?> <?='('.$value['country_name'].')'?></option>
                           <?php } }?>
                        </select>
                        <span class="text-danger" id="name_error"></span>
                     </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2" >Submit</button>

                    <a href="<?=ADMIN_PATH?>voucher" class="btn btn-gradient-light btn-fw">Cancel</a>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   <!-- content-wrapper ends -->
  