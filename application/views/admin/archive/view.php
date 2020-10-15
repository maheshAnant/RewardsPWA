<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Archive (<?=$contest_details['name'];?>) </h4>
                  <?php if($this->session->flashdata('msg')): ?>
                     <p class="green"><?php echo $this->session->flashdata('msg'); ?> 
                     </p>
                  <?php endif; ?>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th> Version </th>
                           <th> Upload Date </th>
                           <th> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($result)){
                           foreach ($result as $key => $value) {
                        ?>
                          <tr>
                              <td>Version <?=$value['version']?>.0.0</td>
                              <td><?=view_date_format($value['updated_at'])?></td>
                              <td><a href="<?=ADMIN_PATH?>archive/download?id=<?= encrypt_decrypt('encrypt',$value['contest_id'])?>&version=<?=$value['version']?>" class="" >Download</a>&nbsp;
                                 <a href="<?=ADMIN_PATH?>archive/details?id=<?= encrypt_decrypt('encrypt',$value['contest_id'])?>&version=<?=$value['version']?>" class="" >View</a><br/><br/></td>
                          </tr>
                        <?php 
                           }  
                        }else{?>
                           <tr> <td colspan="3"> <center> No records Found.. </center></td> </tr>
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
          