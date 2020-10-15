<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit User</h4>
            <span class="red">
              <?php echo validation_errors(); ?>
            </span>
            <?php if(isset($status) && $status == "success"){
            ?>
            <span class="green">
              <p><?=$message?><p>
            </span>
            <?php
            }?>  
  
            <form class="forms-sample" action="<?=ADMIN_PATH?>user/update" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="exampleInputName1">First Name</label><span class="red">*</span>
                  <input type="text" 
                         class="form-control" 
                         id="exampleInputName1" 
                         name="user[first_name]" 
                         placeholder="First Name" 
                         value="<?=isset($first_name)?$first_name:""?>">
                  <span class="text-danger" id="name_error"></span>
               </div>

               <div class="form-group">
                <label for="exampleInputName1">Last Name</label><span class="red">*</span>
                <input type="text" 
                       class="form-control"
                       id="exampleInputName1" 
                       name="user[last_name]" 
                       placeholder="Last Name" 
                       value="<?=isset($last_name)?$last_name:""?>">
                <span class="text-danger" id="name_error"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Username</label><span class="red">*</span>
                <input type="text" 
                       class="form-control" 
                       id="exampleInputName1" 
                       name="user[username]" 
                       placeholder="Username" 
                       value="<?=isset($username)?$username:""?>">
                <span class="text-danger" id="name_error"></span>
              </div>
               <div class="form-group">
                <label for="exampleInputEmail3">Email address</label><span class="red">*</span>
                <input type="email" 
                       class="form-control" 
                       id="exampleInputEmail3" 
                       name="user[email]" 
                       placeholder="Email" 
                       value="<?=isset($email)?$email:""?>">
                <span class="text-danger" id="name_error"></span>
              </div>  
              
              <div class="form-group">
                <label for="exampleInputName1">Mobile</label><span class="red">*</span>
                <input type="number" 
                       class="form-control" 
                       id="exampleInputName1" 
                       name="user[mobile]" 
                       placeholder="Mobile" 
                       value="<?=isset($mobile)?$mobile:""?>"> 
                <span class="text-danger" id="name_error"></span>
              </div>
             
              <!-- <div class="form-group">
                <label for="exampleInputPassword4">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword4" name="user[password]" placeholder="Password" value="<?=isset($password)?$password:""?>">
                <span class="text-danger" id="name_error"></span>
              </div> -->
              <?php 
               if(!is_company_user()){
               ?>
               <div class="form-group">
                  <label for="exampleInputName1">Company</label><span class="red">*</span>
                  <select class="form-control form-control-sm" 
                          id="exampleFormControlSelect3" 
                          name="user[company_id]">
                     <option value="">Select Company</option>
                     <?php 
                     if(isset($companies)){
                        foreach ($companies as $key => $value) {                         
                        ?>
                        <option value="<?=$value['id']?>" <?=($company_id == $value['id'])?"selected":""?>><?=$value['name']?></option>
                        <?php  
                        }
                     }   
                     ?>                
                  </select>
                  <span class="text-danger" id="name_error"></span>
               </div>
              <?php } ?> 
               <input type="hidden" name="id" value="<?=$id?>"/> 
               <div class="form-group">
                  <label>File upload</label>
                  <input type="file" name="profile_pic" class="file-upload-default">
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
                        <img src="<?=checkImage("profile",$profile_pic)?>" height="200"  />
                     </span>
                  </div>
               </div>
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
  