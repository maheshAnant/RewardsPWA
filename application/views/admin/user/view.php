<div class="main-panel">
   <div class="content-wrapper">
     <div class="row">
       <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Users</h4>
               <?php if($this->session->flashdata('msg')): ?>
               <p class="green"><?php echo $this->session->flashdata('msg'); ?></p>
               <?php endif; ?>
               <p class="userBtn">
                  <a href="user/add" class="btn btn-primary btn-fw">Add User</a>
               </p>
               <br/><br/>   
               <form class="form-inline" action="<?=ADMIN_PATH?>user" id="search"  method="GET">
                  <div class="row">            
                     <div class="col-md-3">
                       <div class="form-group row">
                         <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Name" name="name" value="<?=isset($_GET['name'])?$_GET['name']:''?>">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group row">
                         <input type="text" name="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Email" value="<?=isset($_GET['email'])?$_GET['email']:''?>">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group row">
                         <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Company Name" name="company_name" value="<?=isset($_GET['company_name'])?$_GET['company_name']:''?>">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group row">
                         <button type="submit" class="btn btn-gradient-primary mb-2" align="right">Search</button>
                       </div>
                     </div>         
                  </div>
               </form><br/>   
               <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Profie Pic </th>
                      <th> Name </th>
                      <th> Username </th>
                      <th> Email </th>
                      <th> Mobile </th>
                      <th> Company Name </th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if(!empty($result)){
                     foreach ($result as $key => $value) {
                     ?>
                     <tr>
                       <td class="py-1">
                         <img src="<?=checkImage("profile",$value['profile_pic'])?>" alt="image" />
                       </td>
                       <td> <?=$value['first_name']." ".$value['last_name']?> </td>
                       <td>
                         <?=$value['username']?>
                       </td>
                       <td> <?=$value['email']?> </td>
                       <td> <?=$value['mobile']?> </td>
                       <td> <?=$value['company_name']?> </td>
                       <td>
                          <a href="<?=ADMIN_PATH?>user/edit?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="btn btn-gradient-primary btn-sm">Edit</a> 
                          <a href="<?=ADMIN_PATH?>user/delete?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="btn btn-gradient-primary btn-sm">Delete</a><br/><br/>
                          <a href="<?=ADMIN_PATH?>resetpassword?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="btn btn-gradient-primary btn-sm">Reset Password</a>
                       </td>
                     </tr>
                      <?php  
                      } 
                  }else{
                  ?>
                     <tr>
                        <td colspan="7" align="center"> No Record Found..</td>
                     </tr>  
                  <?php
                  }
                  ?> 
                  </tbody>
               </table>
            </div>
           <p class="paginationLinks" align="right"><?php echo $links; ?></p> 
         </div>
       </div>
     </div>
   </div>
  <!-- content-wrapper ends --> 
</div>     
