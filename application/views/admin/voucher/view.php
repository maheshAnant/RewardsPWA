<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Vouchers</h4>
                  <?php if($this->session->flashdata('msg')): ?>
                     <p class="green"><?php echo $this->session->flashdata('msg'); ?></p>
                  <?php endif; ?>
                  <p class="userBtn">
                     <a href="voucher/add" class="btn btn-primary btn-fw">Add Voucher</a>
                  </p>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th> Voucher Name </th>
                           <th> Voucher Code </th>
                           <th> Voucher Points </th>
                           <th> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($result)){
                           foreach ($result as $key => $value) {
                        ?>
                           <tr>
                              <td><?=$value['voucher_name']?></td>
                              <td><?=$value['voucher_code']?></td>
                              <td><?=$value['voucher_points']?></td>
                              <td>
                                 <a href="<?=ADMIN_PATH?>voucher/edit?id=<?= $value['id']?>" class="btn btn-gradient-primary btn-sm">Edit</a>
                                 <a href="<?=ADMIN_PATH?>voucher/delete?id=<?= $value['id']?>" class="btn btn-gradient-primary btn-sm">Delete</a>
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
          