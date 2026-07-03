

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
       
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Forget</li>
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
                <h2>Forget Password</h2> 
              </div>             

              <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
                 
                	<form method="post" accept-charset="utf-8" >
                  <div class="row gy-4">
                     
                     
                    <div class="col-md-12">
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Address" required="">
                        <div id="email_msg"></div>
                    </div> 
                       
                    
                    <div class="col-6 mx-auto">                      
                      <button id="submit" type="submit" class="btn btn-book"><span id="load"></span>Submit</button>
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
        
        if (email=="") {
          $('#msg').text('Please Enter Email');
          return;
        }
        if (!email.match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)) {
          $('#msg').text('Please Enter Valid Email');
          return;
        }
        else{
            $.ajax({
               type:"post", 
               url:"<?= base_url()?>login/reset_password",
               data:{
                   email:email
               }, 
               cache:false, 
               success: function(result){  
                    if(result==0){   
                        $('#msg').text('Email does not exist.');
                        $('#success_msg').text('');
                    }
                    if(result==1){   
                        $('#success_msg').html('A link has been sent to your email address.<br>Please visit your email to change password.<br>If you do not find your email, it is probably in your spam folder.');  
                        $('#msg').text(''); 
                        $('#email').attr('value','qqq'); 
                    }
                    if(result==2){   
                        $('#msg').html('Your Account not activated.'); 
                        $('#success_msg').text(''); 
                    } 
               }
                
           });
            
        }
        
      });

});
</script>


