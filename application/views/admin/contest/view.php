<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Contests</h4>
                  <?php if($this->session->flashdata('msg')): ?>
                     <p class="green"><?php echo $this->session->flashdata('msg'); ?></p>
                     <?php
                       if(check_participant_error_log($error_log)){
                       ?>
                       <a href="<?=ADMIN_PATH?>participant/error_log"/>Error Log</div>
                       <?php                     
                       }
                    ?>
                  <?php endif; ?>
                  <p class="userBtn">
                     <a href="contest/add" class="btn btn-primary btn-fw">Add Contest</a><br/><br/>
                     <a href="<?=ADMIN_PATH?>participant/download" class="">Download upload format</a>
                  </p>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th> Icon </th>
                           <th> Contest Name </th>
                           <th> Start Date</th>
                           <th> End Date</th>
                           <th> Remark</th>
                           <th> Redemption End Date</th>
                           <th> Action </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($result)){
                           foreach ($result as $key => $value) {
                        ?>
                           <tr>
                              <td class="py-1">
                               <img src="<?=checkImage("icon_img",$value['icon'])?>" alt="image" />
                             </td>
                              <td><?=$value['name']?></td>
                              <td><?=view_date_format($value['start_date'])?></td>
                              <td><?=view_date_format($value['end_date'])?></td>
                              <td><?=$value['remarks']?></td>
                              <td><?=view_date_format($value['redem_end_date'])?></td>
                              <!-- <td><?=contest_status($value['status'])?></td> -->
                               <form class="forms-sample" action="<?=ADMIN_PATH?>participant/upload" method="post" enctype="multipart/form-data" id="upload_data<?=$value['id']?>">
                                 <input type="file" name="upload_participants" class="hidden" id="upload<?=$value['id']?>" onchange="upload(<?=$value['id']?>);"/>
                                 <input type="hidden" name="company_id" value="<?=$company_id;?>"/>
                                 <input type="hidden" name="contest_id" value="<?=$value['id'];?>"/>
                              </form>
                              
                              <td>
                                 <a href="<?=ADMIN_PATH?>contest/edit?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="btn btn-gradient-primary btn-sm">Edit</a>
                                 <a href="<?=ADMIN_PATH?>contest/delete?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="btn btn-gradient-primary btn-sm">Delete</a><br/><br/>
                                 <a href="#" class="btn btn-gradient-primary btn-sm" onclick="select_upload_file(<?=$value['id']?>)">Upload Participants</a><br/><br/>
                                 <a href="<?=ADMIN_PATH?>participant?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="" >View Participants</a><br/><br/>
                                 <a href="<?=ADMIN_PATH?>archive?id=<?= encrypt_decrypt('encrypt',$value['id'])?>" class="" >Archive</a><br/><br/>
                              </td>
                           </tr>
                        <?php 
                           }  
                        }else{?>
                           <tr> <td colspan="7"> <center> No records Found.. </center></td> </tr>
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
          