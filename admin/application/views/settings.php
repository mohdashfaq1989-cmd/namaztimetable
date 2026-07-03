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

    <div class="form-group row">
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Site Name</label>
            <input name="siteName" class="form-control" type="text" placeholder="Name" value="<?php echo !empty($setting->siteName)?$setting->siteName:''; ?>" />
        </div>
    
        <div class="col-sm-6">
            <label for="email" class="col-form-label">Email 1</label>
            <input name="email1" class="form-control" type="email" placeholder="Enter Email 1"  value="<?php echo !empty($setting->email1)?$setting->email1:''; ?>" /> 
            <div id="email_msg"></div>
        </div>
        <div class="col-sm-6">
            <label for="email" class="col-form-label">Email 2</label>
            <input name="email2" class="form-control" type="email" placeholder="Enter Email 2"  value="<?php echo !empty($setting->email2)?$setting->email2:''; ?>" /> 
            <div id="email_msg"></div>
        </div>
        
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Phone Number 1</label>
            <input name="phone1" class="form-control" type="text" placeholder="Enter Phone Number 1"  maxlength="10" value="<?php echo !empty($setting->phone1)?$setting->phone1:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Phone Number 2</label>
            <input name="phone2" class="form-control" type="text" placeholder="Enter Phone Number 2"  maxlength="10" value="<?php echo !empty($setting->phone2)?$setting->phone2:''; ?>" />
        </div>
        
        <div class="col-sm-6">
            <label for="email" class="col-form-label">Address</label>
            <input name="address" class="form-control" type="text" placeholder="Enter Address"  value="<?php echo !empty($setting->address)?$setting->address:''; ?>" /> 
            <div id="email_msg"></div>
        </div>
        <div class="col-sm-6">
            <label for="email" class="col-form-label">Footer Copyrights</label>
            <input name="copyrights" class="form-control" type="text" placeholder="Footer Copyrights"  value="<?php echo !empty($setting->copyrights)?$setting->copyrights:''; ?>" /> 
            <div id="email_msg"></div>
        </div>
    </div>

    
 
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Logo</label>
        <div class="col-sm-9">
            <img id="blah" src="<?php if(!$setting->logo==""){echo '../uploads/'.$setting->logo;}else{echo '../assets/img/default.jpg';}?>" class="img-thumbnail" width="80">
            <input type="file" name="logo" aria-describedby="fileHelp" />
            
        </div>
    </div> 
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Favicon</label>
        <div class="col-sm-9">
            <img id="blah" src="<?php if(!$setting->favicon==""){echo '../uploads/'.$setting->favicon;}else{echo '../assets/img/default.jpg';}?>" class="img-thumbnail" width="80">
            <input type="file" name="favicon" aria-describedby="fileHelp" />
            <small id="fileHelp" class="text-muted"></small>
        </div>
    </div> 

    <div class="form-group row"> 
        <div class="col-sm-9">
        <button type="submit" id="submit" class="btn btn-primary w-md m-b-5"><span id="load"></span>Update</button>
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
            $.ajax({    
                     url:"<?php echo base_url(); ?>login/updateSetting/",    
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
                                $('#submit').attr('disabled', false);
                                $('#update_msg').html('');
                                $('#load').html('');
                            },1000)
                        }
                        
                        
                         
                }
          
            });  
        });
                
	});	
		 
	</script> 

  

  