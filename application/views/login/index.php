

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
       
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Login</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->




    <!-- Appointmnet Section -->
    <section id="appointmnet" class="appointmnet section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-5 mx-auto">
            <div class="booking-wrapper">
              <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                <h2>Login</h2> 
              </div>

              

              <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
                <form action="forms/book-appointment.php" method="post" class="php-email-form">
                  <div class="row gy-4">
                    
                    <div class="col-md-12">
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email " required="">
                      <em id="email_err" class="invalid">Please enter your email address</em>
                    </div>   
                    <div class="col-md-12">
                      <input type="password" name="password" id="password" class="form-control" placeholder="password" required="">
                      <em id="password_err" class="invalid">Please enter your email address</em>
                    </div> 
                    <div class="col-12">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your appointment has been scheduled. Thank you!</div>
                      <button type="submit" id="submit" class="btn-book">Submit</button>
                    </div>
                  </div>
                </form>
                 <p id="msg" class="text-danger text-center" ></p>
                  <p id="success_msg" class="text-success text-center" ></p>
                <div class="row justify-content-between mt-15 ">
                        <div class="col-6 "><a href="forget">Forget Password</a></div>
                        <div class="col-6 text-right"><a href="register">Create My Account</a></div>
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
        $('#email_err').text('');
        $('#password_err').text('');
        
      $('#submit').click(function(e) {
        e.preventDefault();
        var email = $('#email').val(); 
        var password = $('#password').val();
        
        
        if (email=="" && password=="") {
            $('#email_err').text('Please enter your email address').addClass( "invalid" );
            $('.input').addClass( "state-error" );
            $('#password_err').text('Please enter your password').addClass( "invalid" );
          return;
        }
        if (email=="") {
            $('.input').addClass( "state-error" );
          $('#email_err').text('Please enter your email address').addClass( "invalid" );
          return;
        }
        if (password=="") {
            $('.input').addClass( "state-error" );
          $('#password_err').text('Please enter your password').addClass( "invalid" ); 
          return;
        }
        else
        {
            $('.input').removeClass( "state-error");
            $('#email_err').text('');
            $('#password_err').text('');
            
            $.ajax({
              type:"post", 
              url:"<?= base_url()?>login/check_login",
              data:{
                  email:email, 
                  password:password,
              },
              cache:false,
              success: function(result){  
                    if(result!=0){    
                        $('#success_msg').text('Login Successfully');
                        $('#msg').text('');
                        setTimeout(function(){
                            window.location.replace(result);
                        },1000)
                    }  
                    else{  
                        $('#msg').text('Incorrect User Email Id and Password');  
                    } 
              }
                
            });
            
        }
        
      });

});
</script>



 

 