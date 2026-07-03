

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
       
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Register</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->




    <!-- Appointmnet Section -->
    <section class="appointmnet section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6 mx-auto">
            <div class="booking-wrapper">
              <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                <h2>Register</h2> 
              </div>             

              <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
                 
                	<form id="signup" method="post" accept-charset="utf-8" >
                  <div class="row gy-4">
                    <div class="col-sm-12">
                      <!-- <label for="name" class="col-form-label">User Type</label> -->
                      <select id="role_id" name="role_id" class="form-control" required/>
                          <option value="">Choose User Type</option>
                          <?php $query = $this->db->order_by('role_id', 'ASC')->get_where('user_role'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                          <option value="<?php echo $val->role_id;?>"><?php echo $val->role_name;?></option>
                       <?php  }} ?>
                      </select>
                  </div>
                    <div class="col-md-6">
                      <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required="">
                    </div>
                    <div class="col-md-6">
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Address" required="">
                        <div id="email_msg"></div>
                    </div> 
                    <div class="col-md-6">
                      <input type="text" name="password" class="form-control" placeholder="Enter Password" maxlength="10" required="">
                    </div> 
                    <div class="col-md-6">
                      <input type="text" name="phone" class="form-control" placeholder="Enter Phone" maxlength="10" required="">
                    </div>
                    <div class="col-md-12">     
                    <span id="email_error"></span>                 
                      <div id="errorMsg" class="error-message"></div>
                      <div id="successMsg" class="sent-message"></div>
                    </div>   
                    <div class="col-6 mx-auto">                      
                      <button id="submit" type="submit" class="btn btn-book"><span id="load"></span>Submit</button>
                    </div>
                  </div>
                </form>
                <br><style>
                  
                </style>
                <div class="row justify-content-between mt-15 ">
                        <div class="col-6 "><a href="<?=base_url()?>">Home</a></div>
                        <div class="col-6 text-right"><a href="login">Sign In</a></div>
                    </div>
              </div>

              <div class="emergency-infoz" data-aos="fade-up" data-aos-delay="500">
                
              </div>
              

            </div>
          </div>
        </div>

      </div>

    </section><!-- /Appointmnet Section -->

  </main>
<script>
    $(document).ready(function(){
        $('#email').keyup(function(){
            var email = $(this).val();
            $.ajax({
                url: "<?php echo base_url('login/check_email') ?>",
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
                        $('#submit').attr('disabled', false);
                    }
                    else
                    {
                        $('#email_msg').html(
                            '<span style="color:red;">'+response.message+'</span>'
                        );
                        $('#submit').attr('disabled', true);
                    }
                }
            });
        });

    });
</script>
<script>
	$(document).ready(function(){  
        
        $('#signup').on('submit', function(e){  
            e.preventDefault(); 
            var formData = new FormData(this); 
            console.log('fd',formData); 
            $.ajax({    
                     url:"<?php echo base_url(); ?>login/signup/",    
                     method:"POST",  
                     data:formData,  
                     beforeSend: function() {
                        $('#submit').attr('disabled', true);
                        $('.loading').css('display','block');
                    },
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){
                             
                            $('#successMsg').html('Signup successfully');
                            $('.sent-message').css('display','block');
                            setTimeout(function(){
                                $('#successMsg').html('');
                                $('.sent-message').css('display','none');
                                $('.loading').css('display','none');
                                window.location.replace('login');
                            },2000)
                        }else{
                			$('#errorMsg').html('Signup Error ');
                			$('.error-message').css('display','block');
                		} 
                         
                	}          
            });  
        });                 
	});	
		 
	</script> 
 

  

  

 

 