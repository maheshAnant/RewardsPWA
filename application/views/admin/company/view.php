<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Company</h4>
                  <?php if($this->session->flashdata('msg')): ?>
                     <p class="green"><?php echo $this->session->flashdata('msg'); ?></p>
                  <?php endif; ?>
                  <p class="userBtn">
                     <a href="company/add" class="btn btn-primary btn-fw">Add Company</a>
                  </p>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th> Company Name </th>
                           <th> Company Code </th>
                           <th> Country Name </th>
                           <th> Rs Conversion Points </th>
                           <th> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($result)){
                           foreach ($result as $key => $value) {
                        ?>
                           <tr>
                              <td><?=$value['name']?></td>
                              <td><?=$value['company_code']?></td>
                              <td><?=$value['country_name']?></td>
                              <td><?=$value['rs_conversion_points']?></td>
                              <td>
                                 <a href="<?=ADMIN_PATH?>company/edit?id=<?= $value['id']?>" class="btn btn-gradient-primary btn-sm">Edit</a>
                                 <a href="<?=ADMIN_PATH?>company/delete?id=<?= $value['id']?>" class="btn btn-gradient-primary btn-sm">Delete</a>
                              </td>
                           </tr>
                        <?php 
                           }  
                        }else{?>
                           <tr> <td colspan="5"> <center> No record Found </center></td> </tr>
                        <?php } ?> 
                     </tbody>
                  </table>
               </div>
               <p class="paginationLinks" align="right"><?php echo $links; ?></p> 
            </div>
         </div>
      </div>
   </div>
</div>
          