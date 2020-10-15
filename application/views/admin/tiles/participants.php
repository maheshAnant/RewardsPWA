<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h3 class="card-title title_color"><?=$contest_details['name'];?></h3>
                  <h4 class="card-title">Participants</h4>
                  <?php if($this->session->flashdata('msg')): ?>
                     <p class="green"><?php echo $this->session->flashdata('msg'); ?> 
                     </p>
                  <?php endif; ?>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th> Mobile Number </th>
                           <th> First Name</th>
                           <th> Last Name</th>
                           <th> Points</th>
                           <th> Remark</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($result)){
                           foreach ($result as $key => $value) {
                        ?>
                           <tr>
                             <td><?=$value['mobile_number']?></td>
                             <td><?=$value['first_name']?></td>
                             <td><?=$value['last_name']?></td>
                             <td><?=$value['points']?></td>
                             <td><?=$value['remark']?></td>
                           </tr>
                        <?php 
                           }  
                        }else{?>
                           <tr> <td colspan="5"> <center> No records Found.. </center></td> </tr>
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
          