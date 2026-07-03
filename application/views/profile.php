

        <!-- MAIN CONTENT -->

        <div class="col-lg-10">

            <!-- TOPBAR -->
            <div class="ntt-color text-white p-3 rounded-4 mb-4 mt-3 d-flex justify-content-between align-items-center">

                <h4 class="mb-0"><?= $page_title?></h4>

                <button class="btn btn-light d-lg-none" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </button>

            </div> 

                        <!-- UPDATE PROFILE -->

            <div class="form-box mt-4 mb-5"> 

                <form id="insertData" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="row">
                        <input type="hidden" name="id" value="<?= $userData->id ?>">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Name
                            </label>

                            <input type="text" name="name" class="form-control" placeholder="Enter full name" value="<?= $userData->name ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Email Address
                            </label>

                            <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?= $userData->email ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Mobile Number
                            </label>

                            <input type="text" name="phone" class="form-control" placeholder="Enter mobile number" value="<?= $userData->phone ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Password
                            </label>

                            <input type="text" name="password" class="form-control" placeholder="Enter mobile number" value="<?= $userData->password ?>">
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                Address
                            </label>

                            <textarea name="address" class="form-control" rows="4" placeholder="Enter address"><?= $userData->address ?></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="preview" class="col-sm-3 col-form-label">Preview</label>
                            <div class="col-sm-9">
                                <img id="blah" src="<?php if(!$userData->image==""){echo '../uploads/profile/'.$userData->image;}else{echo '../assets/img/default.jpg';}?>" class="img-thumbnail" width="125" height="100">
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

                    </div>
 
                    <button type="submit" id="submit" class="btn btn-primary px-4"><span id="load"></span>Update Profile</button>
                    <p id="update_msg" class="text-success" ></p>

                </form>

            </div> 

             

             

            

        </div>

    </div>

</div>

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
        
        $('#insertData').on('submit', function(e){  
            e.preventDefault(); 
            var formData = new FormData(this); 
            console.log('fd',formData);
            $.ajax({    
                     url:"<?php echo base_url(); ?>login/updateProfile/",    
                     method:"POST",  
                     data:formData,  
                     beforeSend: function() {
                        $('#submit').attr('disabled', true);
                        $('#load').html('<img src="../assets/img/loading.gif" style="width:30px;" />');
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
                            $('#update_msg').html(response.message).css('color','green');
                            setTimeout(function(){
                                $('#update_msg').html('');
                                $('#load').html('');
                                $('#submit').attr('disabled', false);
                            },2000)
                        }
                        else
                        {
            
                            alert(response.status);
            
                        }
                         
                    }
          
            });  
        });
        
                
                
            
                
	});	
		 
	</script>
          