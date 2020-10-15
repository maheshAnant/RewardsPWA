<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
               <h4 class="card-title">Add Contest</h4>
               <span class="red">
                 <?php echo validation_errors(); ?>
               </span>          
               <form class="forms-sample" action="<?=ADMIN_PATH?>contest/store" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="exampleInputName1">Contest Name</label><span class="red">*</span>
                     <input type="text" class="form-control" id="exampleInputName1" name="contest[name]" placeholder="Contest Name" value="<?=isset($_POST['contest']['name'])?$_POST['contest']['name']:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                    <label>Icon</label><span class="red">*</span>
                    <input type="file" name="icon_img" class="file-upload-default" onchange="readImage(this);" >
                    <div class="input-group col-xs-12">
                      <input type="text" 
                             class="form-control file-upload-info" 
                             disabled="" 
                             placeholder="Upload Image">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                      </span>
                    </div> 
                    <br/>
                    <div class="input-group col-xs-12 hidden" id="img_div">
                      <span class="input-group-append">
                        <i class="mdi mdi-close-box delete_icon" onClick="deleteImage()"></i>
                        <img src="" height="200" id="img_upload" />
                      </span>
                    </div>             
                 </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Start Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[start_date]" placeholder="Contest Start Date" value="<?=isset($_POST['contest']['start_date'])?$_POST['contest']['start_date']:""?>">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">End Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[end_date]" placeholder="Contest End Date" value="<?=isset($_POST['contest']['end_date'])?$_POST['contest']['end_date']:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Redemption End Date</label><span class="red">*</span>
                     <input type="text" class="form-control datepicker" id="datepicker" name="contest[redem_end_date]" placeholder="Redemption End Date" value="<?=isset($_POST['contest']['redem_end_date'])?$_POST['contest']['redem_end_date']:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputName1">Remarks</label><span class="red">*</span>
                     <input type="text" class="form-control" id="exampleInputName1" name="contest[remarks]" placeholder="Remarks" value="<?=isset($_POST['contest']['remarks'])?$_POST['contest']['remarks']:""?>">
                     <span class="text-danger" id="name_error"></span>
                  </div>
                
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