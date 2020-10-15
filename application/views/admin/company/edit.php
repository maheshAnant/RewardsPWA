<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Edit Company</h4>
                  <span class="red">
                    <?php echo validation_errors(); ?>
                  </span>  
                  <?php if(isset($status) && $status == "success"){?>
                     <span class="green">
                       <p><?=$message?><p>
                     </span>
                  <?php }?>  

                  <form class="forms-sample" action="<?=ADMIN_PATH?>company/update" method="post">
                     <div class="form-group">
                        <label for="exampleInputName1">Company Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="company[name]" placeholder="Company Name" value="<?=isset($name)?$name:""?>">
                        <span class="text-danger" id="name_error"></span>
                     </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Company Code</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="company[company_code]" placeholder="Company Code" value="<?=isset($company_code)?$company_code:""?>">
                        <span class="text-danger" id="company_code_error"></span>
                     </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Country</label>
                        <select class="form-control" name="company[country_id]" style="color:black;">
                           <option value="">Please Select</option>
                           <?php if(!empty($country)){
                              foreach ($country as $key => $value) {
                           ?>
                              <option value="<?=$value['id']?>" <?php if(isset($country_id) && ($country_id == $value['id']) ){?> selected <?php }?>><?= $value['name'] ?></option>
                           <?php } }?>
                        </select>
                        <span class="text-danger" id="name_error"></span>
                     </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Rs Conversion Points</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="company[rs_conversion_points]" placeholder="Company Code" value="<?=isset($rs_conversion_points)?$rs_conversion_points:""?>">
                        <span class="text-danger" id="company_code_error"></span>
                     </div>

                     <input type="hidden" name="id" value="<?=$id?>"/> 
             
                     <button type="submit" class="btn btn-gradient-primary mr-2" >Submit</button>
                     <a href="<?=ADMIN_PATH?>company" class="btn btn-light">Cancel</a>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   <!-- content-wrapper ends -->
  