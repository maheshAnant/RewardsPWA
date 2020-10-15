<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
               <h4 class="card-title">Edit Contest</h4>
               <span class="red">
                 <?php echo validation_errors(); ?>
               </span>          
               <form class="forms-sample" action="<?=ADMIN_PATH?>contest/update" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="exampleInputName1">Contest Name</label><span class="red">*</span>
                     <input type="text" class="form-control" id="exampleInputName1" name="contest[name]" placeholder="Contest Name" value="<?=isset($name)?$name:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                    <label>Icon</label><span class="red">*</span>
                    <input type="file" name="icon_img" class="file-upload-default">
                    <div class="input-group col-xs-12">
                      <input type="text" 
                             class="form-control file-upload-info" 
                             disabled="" 
                             placeholder="Upload Image">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                      </span>
                    </div> 
                    <div class="input-group col-xs-12">
                     <span class="input-group-append">
                        <img src="<?=checkImage("icon_img",$icon)?>" height="200"  />
                     </span>
                  </div>           
                 </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Start Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[start_date]" placeholder="Contest Start Date" value="<?=isset($start_date)?$start_date:""?>">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">End Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[end_date]" placeholder="Contest End Date" value="<?=isset($end_date)?$end_date:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Redemption End Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[redem_end_date]" placeholder="Redemption End Date" value="<?=isset($redem_end_date)?$redem_end_date:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Remarks</label><span class="red">*</span>
                     <input type="text" class="form-control" id="exampleInputName1" name="contest[remarks]" placeholder="Remarks" value="<?=isset($remarks)?$remarks:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <input type="hidden" name="id" value="<?=$id?>"/>
                 <button type="submit" class="btn btn-gradient-primary mr-2" >Submit</button>

                 <a href="<?=ADMIN_PATH?>contest" class="btn btn-light">Cancel</a>

               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
  <!-- content-wrapper ends -->
</div>