 <!-- MAIN CONTENT -->

        <div class="col-lg-10">
 <div class="ntt-color text-white p-3 rounded-4 mt-3 d-flex justify-content-between align-items-center">

                <h4 class="mb-0"><?= $page_title?></h4>

                <button class="btn btn-light d-lg-none" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </button>

            </div>
            
  <div class="d-flex justify-content-between align-items-center mt-4 mb-3"> 
                     
                    <a href="user/addAd" class="btn btn-primary btn-sm">Add Ad</a>
                     
                    
                </div>

                
                
                                    <table id="datatable_fixed_column" class="table table-striped table-bordered" 
                                        width="100%">

                                        <thead>
                                            
                                            <tr>
                                                <th data-class="expand">Sr. No.</th> 
                                                <th data-hide="phone,tablet">Image</th>
                                                <th data-hide="phone,tablet">Masjid Name</th> 
                                                <th data-hide="phone,tablet">Title</th>
                                                <th data-hide="phone,tablet">Description</th>
                                                <th data-hide="phone,tablet">Date</th>
                                                <th data-hide="phone,tablet">Status</th>
                                                <th data-hide="phone,tablet">Action</th>
                                            </tr>
                                        </thead>  
                                        <tbody> 
							                 <?php if(!empty($result)){ $i=0;  
							                    foreach($result as $row){ $i++; 
							                        $image = !empty($row['image'])?'<img src="'.base_url().'../uploads/ads/'.$row['image'].'" alt="" style="width:80px"/>':''; 
							                          
							                ?>
							                <tr>
							                    <td><?php echo $i; ?></td>
							                    <td><?php echo $image; ?></td>
                                                <td><?php echo $row['masjidName']; ?></td>
							                    <td><?php echo $row['title']; ?></td> 
                                                <td><?php echo $row['description']; ?></td>
							                    <td><?php echo $row['created']; ?></td>
							                    <td><span class="btn <?php echo ($row['status'] == 1)?'btn-success':'btn-danger'; ?>"><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></span></td>
							                    <td>
							                        <a href="<?= base_url('user/editAd/'.$row['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
							                        
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
         