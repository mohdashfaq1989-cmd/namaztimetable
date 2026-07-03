
<script src="<?php echo base_url()  ?>assets/ckeditor/ckeditor.js"></script> 
<script src="<?php echo base_url()  ?>assets/ckeditor/sample.js"></script>
            <!-- widget grid -->
            <section id="widget-grid" class="transaction-page">

                <!-- row -->
                <div class="row" id="documentEdit">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-"
                            data-widget-editbutton="false">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <span class="widget-icon"> <i class="fa fa-cogs"></i> </span>
                                <h2><?= $page_title; ?></h2>

                            </header>

                            <!-- widget div-->
                            <div>
                                <!-- widget content -->
                                <div class="widget-body">
                                    <form id="insertUserData" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <input type="hidden" name="user_id" value="<?php echo !empty($dbData['id'])?$dbData['id']:''; ?>" />

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input name="name" class="form-control" type="text" placeholder="Name" id="name" value="<?php echo !empty($dbData['name'])?$dbData['name']:''; ?>" />
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input name="email" class="form-control" type="email" placeholder="Enter Email" id="email" value="<?php echo !empty($dbData['email'])?$dbData['email']:''; ?>" /> 
            <div id="email_msg"></div>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input name="password" class="form-control" type="text" placeholder="Enter Password" id="password" value="<?php echo !empty($dbData['password'])?$dbData['password']:''; ?>" />
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
            <input type="text" name="phone" class="form-control" placeholder="Enter Phone" maxlength="10" value="<?php echo !empty($dbData['phone'])?$dbData['phone']:''; ?>" required="">
        </div>
    </div>

    
 
<div class="form-group row">
    <label for="preview" class="col-sm-3 col-form-label">Preview</label>
    <div class="col-sm-9">
        <img id="blah" src="<?php if(!$dbData['image']==""){echo './uploads/images/'.$dbData['image'];}else{echo './assets/images/default.jpg';}?>" class="img-thumbnail" width="125" height="100">
    </div>
    <input type="hidden" name="old_image" value="">
</div>
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Image</label>
        <div class="col-sm-9">
            <input type="file" name="image" id="image" aria-describedby="fileHelp" />
            <small id="fileHelp" class="text-muted"></small>
        </div>
    </div> 

    <div class="form-group row">
        <label for="status" class="col-sm-3 col-form-label">Status </label>
        <div class="col-sm-9">
            <label class="radio-inline">
                <input type="radio" name="status" value="1" id="status" <?php if($dbData['status']==1){echo'checked';} ?>/>
                Active
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" id="status" <?php if($dbData['status']==0){echo'checked';} ?>/>
                Inactive
            </label>
        </div>
    </div> 
    <div class="form-group row"> 
        <div class="col-sm-9">
        <button type="submit" id="submit" class="btn btn-primary w-md m-b-5"><span id="load"></span>Submit</button>
        <br>
        <p id="update_msg" class="text-success" ></p>
        </div>
    </div>
    
</form>



                                </div>
                                <!-- end widget content -->
                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                </div>
                
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <!-- Widget ID (each widget will need unique ID)-->
                        

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
<script>
    $(document).ready(function(){
        $('#email').keyup(function(){
            var email = $(this).val();
            $.ajax({
                url: "<?php echo base_url('user/check_email') ?>",
                method: "POST",
                data: {
                    email: email
                },
                dataType: "json",
                success: function(response)
                {
                    if(response.status == 'success')
                    {
                        $('#email_msg').html(
                            '<span style="color:green;">'+response.message+'</span>'
                        );
                    }
                    else
                    {
                        $('#email_msg').html(
                            '<span style="color:red;">'+response.message+'</span>'
                        );
                        setTimeout(function(){
                                $('#email_msg').html('');
                            },3000)
                    }
                }
            });
        });

    });
</script>    
    <script>
	$(document).ready(function(){
	      function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        
        $("#image").change(function() {
          readURL(this);
        });
        
        $('#insertUserData').on('submit', function(e){  
            e.preventDefault(); 
            //var doc_id = $('#doc_id').val();
            var formData = new FormData(this); 
            console.log('fd',formData);
            //formData.append('doc', CKEDITOR.instances['editor'].getData());
            $.ajax({    
                     url:"<?php echo base_url(); ?>user/edit_user/",    
                     method:"POST",  
                     data:formData,  
                     beforeSend: function() {
                        $('#submit').attr('disabled', true);
                        $('#load').html('<img src="./assets/images/loading.gif" style="width:30px;" />');
                    },
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){
                            //alert()
                            $('#update_msg').html('Updated successfully').css('color','green');
                            setTimeout(function(){
                                $('#update_msg').html('');
                                window.location.replace('user');
                            },1000)
                        }
                        
                        
                         
                }
          
            });  
        });
        
                
                
            
                
	});	
		 
	</script> 

  

  