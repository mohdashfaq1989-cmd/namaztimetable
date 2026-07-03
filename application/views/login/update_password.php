 

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
       
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Update</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->




    <!-- Appointmnet Section -->
    <section class="appointmnet section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-5 mx-auto">
            <div class="booking-wrapper">
              <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                <h2>Update Password</h2> 
              </div>             

              <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
                  
                	<form id="login-form" method="post" accept-charset="utf-8" >
                	    <p id="msg" class="text-danger text-center" ></p>
        		    <p id="success_msg" class="text-success text-center" ></p>
                	<br>
                	<input type="hidden" id="old_password" name="old_password" value="<?php echo base64_decode($password) ?>">
        			<input type="hidden" id="email" name="email" value="<?php echo !empty($email) ? $email :''; ?>" >
                  <div class="row gy-4">
                    <div class="col-md-12">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password" required=""> 
                    </div> 
                    <div class="col-md-12">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required=""> 
                    </div> 
                       
                    
                    <div class="col-6 mx-auto">                      
                      <button id="submit" type="submit" class="btn btn-book"><span id="load"></span>Update</button>
                    </div>
                    <p id="msg" class="text-danger text-center" ></p>
                	<p id="success_msg" class="text-success text-center" ></p>
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
    $(document).ready(function() {
      $('#submit').click(function(e) { 
          //console.log('ok');
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        
        if (password=="" && confirm_password=="") {
          $('#msg').text('Please fill all the fields.');
          return;
        }
        if (password=="") {
          $('#msg').text('Please Enter Password');
          return;
        }
        if (!password.match(/[a-z]/g) ) {
            $('#msg').text('Password must contain at least one letter.');
            return;
        }
        if (!password.match(/[A-Z]/) ) {
            $('#msg').text('Password must contain at least one capital letter.');
            return;
        }
        if (!password.match(/\d/) ) {
            $('#msg').text('Password must contain at least one number.');
            return;
        }
        if (!password.match(/[!@#\$%\^&\*]/) ) {
            $('#msg').text('Password must contain at least one special character.');
            return;
        }
        if (password.length < 6 ) { 
            $('#msg').text('Password length must be at least 6 characters.');
            return;
        }
        if (confirm_password=="") {
          $('#msg').text('Please Enter Confirm Password'); 
          return;
        }
        if (password!=confirm_password) {
          $('#msg').text('Password and Confirm Password do not match.');
          return;
        } 
        else{ 
            $.ajax({
               type:"post", 
               url:"<?= base_url()?>login/update_password",
               data:{
                   email:email,
                   password:password
               },
               cache:false,
               success: function(result){  
                    if(result!=0){   
                        $('#success_msg').text('Password updated successfully');
                        $('#msg').text('');
                        setTimeout(function(){
                            window.location.replace('login');
                        },1000) 
                    }  
                    else{  
                        $('#msg').text('Some problems occurred, please try again');  
                    } 
               }
                
           });
            
        }
        
      });

});
</script> 