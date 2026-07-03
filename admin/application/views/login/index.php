<!DOCTYPE html>
<html lang="en-us" id="extr-page">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Masjid Admin</title>
	<meta name="description" content="">
	<base href="<?=base_url()?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production-plugins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-skins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-rtl.min.css">
	<link rel="stylesheet" href="assets/css/admin_style.css">
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
						<span>Masjid Admin</span>
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
					</section>

					<section>
						<label class="label">Password</label>
						<label class="input"> <i class="icon-append fa fa-lock"></i>
							<input type="password" name="password" id="password">
							<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>
								Enter your password</b> </label>
								<em id="password_err" class="invalid">Please enter your email address</em>
						<div class="note">
							<a href="password_reset">Forgot password?</a>
						</div>
					</section>
				</fieldset>
				<footer>
					<button type="submit" id="submit" class="btn btn-success"> Sign in </button>
				</footer>
			</form>
		</div>

	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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

</body>

</html>

