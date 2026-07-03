<!DOCTYPE html>
<html lang="en-us" id="extr-page">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Reset Password</title>
	<meta name="description" content="">
	<base href="<?=base_url()?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production-plugins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-skins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-rtl.min.css">
	<link rel="stylesheet" href="assets/css/pool_admin_style.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
    
	<!-- FAVICONS -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon"> 
    

</head>

<body>

	<div class="login-page">

		<div class="well no-padding login-form-section">
			<form id="login-form" method="post" class="smart-form client-form">
				<header class="text-center">
					<div id="logo">
						<span>Reset Password</span> 
					</div>
				</header>
                    
				<fieldset>
                    <p id="msg" class="text-danger text-center" ></p>
                	<p id="success_msg" class="text-success text-center" ></p>
                	<br>
					<section>
						<label class="label">E-mail</label>
						<label class="input"> <i class="icon-append fa fa-user"></i>
							<input type="email" name="email" id="email">
							<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>
								Please enter email ID</b></label>
								<em id="email_err" class="invalid">Please enter your email address</em> 
								<div class="note">
							<a href="login">Sign In</a>
						</div>
					</section>

					
				</fieldset>
				<footer>
					<button type="submit" id="submit" class="btn btn-primary"> Submit </button>
				</footer>
			</form>
		</div>

	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
</body>

</html>