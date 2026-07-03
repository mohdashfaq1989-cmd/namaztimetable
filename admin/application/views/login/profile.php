<?php $login_user = $this->session->userdata('admin_email'); ?>
<?php $user_id = $this->db->get_where('admin',array("email"=>$login_user))->row('id'); ?> 

            <!-- widget grid -->
            <section id="widget-grid" class="transaction-page">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-"
                            data-widget-editbutton="false">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <span class="widget-icon"> <i class="fa fa-cogs"></i> </span>
                                <h2>Edit Settings </h2>

                            </header>

                            <!-- widget div-->
                            <div>
                                <!-- widget content -->
                                <div class="widget-body">
                                    <form id="updateUserData" method="post">
                                        <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="company_name">Company Name:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="company_name" id="company_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="contact_person">Contact Person:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="contact_person" id="contact_person" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="profile_image">Profile Image:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                                            <img id="profile_image_view" src="" class="img-fluid" width="50px">
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="email">Email ID:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="email" name="email" id="email" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="a_b_n">Password:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="password" name="password" id="password" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="contact_no">Contact No.:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" name="phone" id="phone" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="local_address">Local Address:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="local_address" id="local_address" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="suburb">City / Suburb:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="city_suburb" id="city_suburb" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="state">State:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="state" id="state" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="country">Country:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="country" id="country" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="postcode">Postcode:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="postcode" id="postcode" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="a_b_n">ABN:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="abn_no" id="abn_no" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="a_b_n">Invoice Prefix:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="invoice_prefix" id="invoice_prefix" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="g_s_t">Tax Type::</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select name="tax_type" id="tax_type" class="form-control">
                                                                <option value="Inclusive">Inclusive</option>
                                                                <option value="Exclusive">Exclusive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="a_b_n">Tax Rate %:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="tax_rate" id="tax_rate" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div> 
                                            
                                            
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                        <br>
                                        <p id="update_msg" class="text-success"></p>
                                        <br>
                                    </form>
                                    <!--<button id="change-password-button" class="btn btn-primary">Change Password</button>-->
                                </div>
                                <!-- end widget content -->
                                
                                <!-- change-password -->
                                <!-- <div class="change-password" >
												<div class="row">
													<div class="col-md-6">
														
														<form method="post">
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label for="old-password">Old Password:</label>
																</div>
																<div class="col-md-8">
																	<input type="password" name="old_pass" id="old_pass" class="form-control">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label for="new-password">New Password:</label>
																</div>
																<div class="col-md-8">
																	<input type="password" name="new_pass" id="new_pass" class="form-control">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label for="confirm-new-password">Confirm New Password:</label>
																</div>
																<div class="col-md-8">
																	<input type="password" name="confirm_pass" id="confirm_pass" class="form-control">
																</div>
															</div>
														</div>
														 
														<input type="submit" name="submit" id="updatePassword" value="Change Password" class="btn btn-primary">
														 
														<br>
														<p id="update_pwd_msg" class="text-success"></p>
														<p id="update_pwd_msg_err" class="text-danger" ></p> 
														</form>
													</div>
												</div>
											</div>-->
											
									 <!-- change-password -->		

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
<script>
	$(document).ready(function(){
	    $('.change-password').hide();
	    $('#change-password-button').click(function (){
		    $('.edit-account-details').hide();
			$('.change-password').slideToggle('slow');
		})
            var user_id = $('#user_id').val();
            $.ajax({   
                     url:"<?php echo base_url(); ?>login/profile_fetch/"+user_id,   
                     method:"POST",     
                     dataType: "json",
                     success:function(response)  
                     {  
                         console.log(response['local_address']) 
                        if (response['company_name']) {
                            $('#company_name').attr('value',response['company_name']);
                        }
                        if (response['contact_person']) {
                            $('#contact_person').attr('value',response['contact_person']);
                        }
                        if (response['local_address']) {
                            $('#local_address').attr('value',response['local_address']);
                        }
                        if (response['city_suburb']) {
                            $('#city_suburb').attr('value',response['city_suburb']);
                        }
                        if (response['state']) {
                            $('#state').attr('value',response['state']);
                        }
                        if (response['country']) {
                            $('#country').attr('value',response['country']);
                        }
                        if (response['postcode']) {
                            $('#postcode').attr('value',response['postcode']);
                        }
                        if (response['abn_no']) {
                            $('#abn_no').attr('value',response['abn_no']);
                        }
                        if (response['tax_type']) {
                            optionText = response['tax_type']; 
                            optionValue = response['tax_type'];
                            $('#tax_type').prepend(`<option value="${optionValue}" selected>${optionText}</option>`);  
                        }
                        if (response['tax_rate']) {
                            $('#tax_rate').attr('value',response['tax_rate']);
                        }
                        if (response['phone']) {
                            $('#phone').attr('value',response['phone']);
                        }
                        if (response['email']) {
                            $('#email').attr('value',response['email']);
                        }
                        if (response['password']) {
                            $('#password').attr('value',response['password']);
                        }
                        if (response['invoice_prefix']) {
                            $('#invoice_prefix').attr('value',response['invoice_prefix']);
                        }
                        if (response['profile_image']) {
                            $('#profile_image_view').attr('src','../uploads/'+response['profile_image']);
                        }
                     }  
                });
                
	});	
		 
	</script>
	
	<script type="text/javascript">  
  
 $(document).ready(function(){
        $('#updateUserData').on('submit', function(e){  
            e.preventDefault();
            var formData = new FormData(this); 
            $.ajax({    
                     url:"<?php echo base_url(); ?>login/profile_update",   
                     method:"POST",  
                     data:formData,   
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){
                            //alert()
                            $('#update_msg').html('Profile updated successfully').css('color','green'); 
                            setTimeout(function(){
                                $('#update_msg').html('');
                                location.reload();
                            },1000)
                            
                        }
                        
                        
                         
                }
          
            });  
        });
        $('#updatePassword').click(function(e) { 
          //console.log('ok');
            e.preventDefault();
            var user_id = $('#user_id').val(); 
            var old_pass = $('#old_pass').val();
            var new_pass = $('#new_pass').val();
            var confirm_pass = $('#confirm_pass').val();
            
            if (old_pass=="" && new_pass=="" && confirm_pass=="") {
              $('#update_pwd_msg_err').text('Please fill all fields');
              return;
            }
            if (old_pass=="") {
              $('#update_pwd_msg_err').text('Please Enter Old Password');
              return;
            }
            if (new_pass=="") {
              $('#update_pwd_msg_err').text('Please Enter New Password');
              return;
            }
            if (!new_pass.match(/[a-z]/g) ) {
                $('#update_pwd_msg_err').text('Password must contain at least one letter');
                return;
            }
            if (!new_pass.match(/[A-Z]/) ) {
                $('#update_pwd_msg_err').text('Password must contain at least one capital letter.');
                return;
            }
            if (!new_pass.match(/\d/) ) {
                $('#update_pwd_msg_err').text('Password must contain at least one number.');
                return;
            }
            if (!new_pass.match(/[!@#\$%\^&\*]/) ) {
                $('#update_pwd_msg_err').text('Password must contain at least one special character.');
                return;
            }
            if (new_pass.length < 6 ) { 
                $('#update_pwd_msg_err').text('Password length at least 6 characters');
                return;
            }
            if (confirm_pass=="") {
              $('#update_pwd_msg_err').text('Please Enter Confirm New Password');
              return;
            }
            if (new_pass!=confirm_pass) {
              $('#update_pwd_msg_err').text('New Password and Confirm New Password do not match');
              return;
            }
            else{
                $.ajax({
                  type:"post", 
                  url:"<?= base_url()?>login/password_change",
                  data:{
                      user_id:user_id,
                      old_pass:old_pass, 
                      new_pass:new_pass,
                      confirm_pass:confirm_pass
                  },
                  cache:false,
                  success: function(result){  
                        if(result!=0){   
                            $('#update_pwd_msg').text('Password updated successfully'); 
                            $('#update_pwd_msg_err').text('');
                            setTimeout(function(){
                                $('.change-password').slideToggle('slow'); 
                                $('#update_pwd_msg').text('');
                                $('#update_pwd_msg_err').text('');
                                location.reload();
                            },1000)
                        }  
                        else{ 
                            $('#update_pwd_msg_err').text('Old Password do not matched');  
                        } 
                  }
                    
              });
                
            }
        
        });
        
        
     
     if (window.location.href.match('profile')) {
        $('#my_account').addClass('active');
    }
 }); 
</script>
  