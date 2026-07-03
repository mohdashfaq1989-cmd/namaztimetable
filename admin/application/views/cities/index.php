

            <!-- widget grid -->
            <section id="widget-grid" class="customers-page">

                <!-- row -->
                <div class="row"> 

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <p id="success_msg"></p>
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1"
                            data-widget-editbutton="false">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2><?php echo $page_title; ?></h2>

                            </header>

                            <!-- widget div-->
                            <div>
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <div class="col-md-12 col-sm-12 col-xs-12 alert-block">
                                         <?php if(!empty($success_msg)){ ?>
                                         <p class="success alert alert-success" style="color:green;"><?php echo $success_msg; ?></p>
                                         <?php }elseif(!empty($error_msg)){ ?>
                                         <p class="error alert alert-danger" style="color:red;"><?php echo $error_msg; ?></p>
                                         <?php } ?>
                                    </div>
                                    <div class="add-new text-right mr-bottom-15">
                                    <a  href="<?php echo base_url('cities/add'); ?>" class="btn btn-primary">Add <?php echo $page_title; ?></a>
                                </div>
                                    <table id="datatable_fixed_column" class="table table-striped table-bordered" 
                                        width="100%">

                                        <thead>
                                            
                                            <tr>
                                                <th data-class="expand">Sr. No.</th> 
                                                <th data-hide="phone,tablet">State Name</th>
                                                <th data-hide="phone,tablet">City Name</th>  
                                                <th data-hide="phone,tablet">Action</th>
                                            </tr>
                                        </thead>  
                                        <tbody> 
                                             <?php if(!empty($result)){ $i=0;  
                                                foreach($result as $row){ $i++; 
                                                      
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td> 
                                                <td><?php echo $this->db->get_where('states',array('state_id' => $row['state_id']))->row('state_name'); ?></td>
                                                <td><?php echo $row['city_name']; ?></td> 
                                                <td>
                                                    <a href="<?= base_url('cities/edit/'.$row['city_id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-danger dataDelete" data-type="user" data-id="<?= $row['city_id'] ?>" data-name="<?= $row['city_name']?>" href="javascript:;"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php } }else{ ?>
                                            <tr><td colspan="6">No image(s) found...</td></tr>
                                            <?php } ?>
                                        </tbody>
                                        
                                    <!--</table>-->
                                        
                                    </table> 
                                </div> 
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                </div>

                <!-- end row -->

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div> 
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
<div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document" style="margin-top: 10%;">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Delete</h5>
              </div>
              <div class="modal-body text-center">
              </div>
              <div class="modal-footer text-center">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
            <p id="modal_msg"></p>
          </div>
        </div>
        
        <script>
            $(".dataDelete").click(function(){
            var data_id = $(this).data('id');
            var data_name = $(this).data('name');
            var data_type = $(this).data('type');
            if (data_type == 'msg') {
                $('.modal-title').html(data_name);
                $('.modal-body').html('<p>Cant Delete, Please delete associated applications</p>');
                $('.modal-footer').html('<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>');
                $('#DeleteModal').modal('show')
            }
            if (data_type == 'user') {
                $('.modal-title').html('Delete : ' + data_name);
                $('.modal-body').html('<p>Do you want to delete this record?</p>');
                $('.modal-footer').html('<a href="#" class="btn btn-primary btn-sm" data-dismiss="modal">No</a><a href="javascript:void(0)" data-id="'+data_id+'" class="btn btn-danger btn-sm deleteUser"><i class="icon-trash icon-white"></i> Yes</a><br><br><p id="modal_msg" class="text-center"></p>');
                $('#DeleteModal').modal('show')
            }
            
            return false;
        });
        </script>
        
        
    <script type="text/javascript">   
 $(document).ready(function(){ 
        $(document).delegate('.deleteUser', 'click', function () {
            var city_id = $(this).data('id');
            console.log('city_id',city_id); 
            console.log('modal')
            $.ajax({    
                     url:"<?php echo base_url(); ?>cities/deleteCities",       
                     method:"POST",  
                     data:{
                         city_id:city_id,
                     },    
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){ 
                            $('#modal_msg').html('City deleted Successfully').css('color','green');
                            setTimeout(function(){
                                $('#modal_msg').html('');
                                location.reload();
                            },1000)
                            
                        }
                        
                        
                         
                    }
          
            });  
        });
        
 });  
</script>


  
  
            

  
            


  
            