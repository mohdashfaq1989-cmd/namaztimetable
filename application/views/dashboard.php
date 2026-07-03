<?php $userData = $this->db->get_where('user',array('id'=>$this->session->userdata('user_id')))->row(); ?>

        <!-- MAIN CONTENT -->

        <div class="col-lg-10">

            <!-- TOPBAR -->

            <div class="ntt-color text-white p-3 rounded-4 mt-3 d-flex justify-content-between align-items-center">

                <h4 class="mb-0"><?php  if($userData->role_id==1): echo "Imam"; endif;?> 
            <?php  if($userData->role_id==2): echo "Mutwalli"; endif;?>
            <?php  if($userData->role_id==3): echo "Student"; endif;?> Dashboard</h4>

                <button class="btn btn-light d-lg-none" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </button>

            </div>

            <!-- CARDS -->

            <div class="row mt-4 g-4">

                <div class="col-md-6 col-xl-3">
                    <div class="card dashboard-card p-4">
                        <i class="fa fa-mosque mb-3"></i>
                        <h2><?= $this->db->where('created_by',$userData->id)->count_all_results('masjid'); ?></h2>
                        <p class="text-muted mb-0">Total Masjid</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card dashboard-card p-4">
                        <i class="fa fa-users mb-3"></i>
                        <h2><?= $this->db->where('created_by',$userData->id)->count_all_results('ads'); ?></h2>
                        <p class="text-muted mb-0">Total Ads</p>
                    </div>
                </div> 

            </div>

            <!-- MASJID TABLE -->

            <div class="table-box mt-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Masjid List</h5>
                    <?php $this->db->where('created_by', $userData->id); $query = $this->db->get('masjid'); if (!$query->num_rows() > 0) { ?>
                    <a href="user/addMasjid" class="btn btn-primary btn-sm">Add Masjid</a>
                    <?php } ?>
                    
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">

                                        <thead class="table-light">
                                            
                                            <tr>
                                                <th data-class="expand">Sr. No.</th> 
                                                <th data-hide="phone,tablet">Image</th>
                                                <th data-hide="phone,tablet">Masjid Code</th>
                                                <th data-hide="phone,tablet">Masjid Name</th> 
                                                <th data-hide="phone,tablet">Imam Name</th>
                                                <th data-hide="phone,tablet">RTO Code</th>
                                                <th data-hide="phone,tablet">Date</th>
                                                <th data-hide="phone,tablet">Status</th>
                                                <th data-hide="phone,tablet">Action</th>
                                            </tr>
                                        </thead>  
                                        <tbody> 
							                 <?php if(!empty($result)){ $i=0;  
							                    foreach($result as $row){ $i++; 
							                        $image = !empty($row['image'])?'<img src="'.base_url().'./uploads/images/'.$row['image'].'" alt="" style="width:80px"/>':''; 
							                          
							                ?>
							                <tr>
							                    <td><?php echo $i; ?></td>
							                    <td><?php echo $image; ?></td>
                                                <td><?php echo $row['masjidCode']; ?></td>
							                    <td><?php echo $row['name']; ?></td> 
                                                <td><?php echo $row['imam']; ?></td>
							                    <td><?php echo $this->db->get_where('rto',array('rto_id' => $row['rto_id']))->row('rto_name'); ?></td>
							                    <td><?php echo $row['created']; ?></td>
							                    <td><span class="badge <?php echo ($row['status'] == 1)?'bg-success':'bg-danger'; ?>"><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></span></td>
							                    <td>
							                        <a href="<?= base_url('user/editMasjid/'.$row['id']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
							                        
							                    </td>
							                </tr>
							                <?php } }else{ ?>
							                <tr><td colspan="9">No image(s) found...</td></tr>
							                <?php } ?>
							            </tbody>
                                        
                                    <!--</table>-->
                                        
                                    </table>
                    

                </div>

            </div>

            

        </div>

    </div>

</div>


          