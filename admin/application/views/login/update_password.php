<!DOCTYPE html>
<html lang="en-us" id="extr-page">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Update Password</title>
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
						<span>Update Password</span>
					</div>
				</header> 
				<fieldset>
                    <p id="msg" class="text-danger text-center" ></p>
        		    <p id="success_msg" class="text-success text-center" ></p>
                	<br>
                	<input type="hidden" id="old_password" name="old_password" value="<?php echo base64_decode($password) ?>">
        			<input type="hidden" id="email" name="email" value="<?php echo !empty($email) ? $email :''; ?>" >
					

					<section>
						<label class="label">New Password</label>
						<label class="input"> <i class="icon-append fa fa-lock"></i>
							<input type="password" id="password" name="password">
							<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>
								Enter New Password</b> </label>
								
						
					</section>
					<section>
						<label class="label">Confirm Password</label>
						<label class="input"> <i class="icon-append fa fa-lock"></i>
							<input type="password" id="confirm_password" name="confirm_password">
							<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>
								Confirm New Password</b> </label>
								
						
					</section>
				</fieldset>
				<footer>
					<button type="submit" id="submit" class="btn btn-primary"> Update </button>
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
</body>

</html>
