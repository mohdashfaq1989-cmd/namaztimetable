<?php $login_user = $this->session->userdata('super_username'); ?>
<?php $user_id = $this->db->get_where('admin',array("email"=>$login_user))->row('id'); ?>
<br><br>
    <main>
        <div class="container main-content">
            <div class="dashboard">
                <div class="row">
                    <div class="col-md-7">
                        <div class="heading">
                            <h4>
                                <span class="text-primary">
                                    <a href="./" class="text-primary">Dashboard</a>
                                </span>
                                <span class="angle"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                <span class="active-page"><?= $page_title ?></span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="search-box text-right">
                             
                        </div>
                    </div>
                </div>

                <div class="claim-data">
                    <div class="heading text-center mt-3">
                        <h2 class="text-primary"><?= $page_title ?></h2>
                    </div>
                    <div class="my-profile change_pass"> 
		<p id="msg" class="text-danger text-center" ></p>
        		    <p id="success_msg" class="text-success text-center" ></p>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-row">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" >
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputPassword4">Old Password<span>*</span></label>
                    <input type="password" id="old_pass" name="old_pass" id="name" class="form-control" placeholder="Old Password">
                    <?php echo form_error('old_pass','<p class="help-block text-danger">','</p>'); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputPassword4">New Password<span>*</span></label>
                    <input type="password" id="new_pass" name="new_pass" id="password" class="form-control" placeholder="New Password">
                    <?php echo form_error('new_pass','<p class="help-block text-danger">','</p>'); ?>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputPassword4">Confirm Password<span>*</span></label>
                    <input type="password" id="confirm_pass" name="confirm_pass" id="password" placeholder="Confirm Password" class="form-control" placeholder="New Password">
                    <?php echo form_error('confirm_pass','<p class="help-block text-danger">','</p>'); ?>
                </div>

            </div>
		
            <input type="hidden" id="" name="id" value="">
                <input type="submit" id="change_pass" name="change_pass" class="btn btn-primary profile-sbutmit" value="Submit" >
        </form>
    </div>
                </div>
            </div>
        </div>
    </main> 
    <br><br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    $(document).ready(function() {
      $('#change_pass').click(function(e) { 
          //console.log('ok');
        e.preventDefault();
        var user_id = $('#user_id').val(); 
        var old_pass = $('#old_pass').val();
        var new_pass = $('#new_pass').val();
        var confirm_pass = $('#confirm_pass').val();
        
        if (old_pass=="" && new_pass=="" && confirm_pass=="") {
          $('#msg').text('Please fill all fields');
          return;
        }
        if (old_pass=="") {
          $('#msg').text('Please Enter Old Password');
          return;
        }
        if (new_pass=="") {
          $('#msg').text('Please Enter New Password');
          return;
        }
        if (!new_pass.match(/[a-z]/g) ) {
            $('#msg').text('Password must contain at least one letter');
            return;
        }
        if (!new_pass.match(/[A-Z]/) ) {
            $('#msg').text('Password must contain at least one capital letter.');
            return;
        }
        if (!new_pass.match(/\d/) ) {
            $('#msg').text('Password must contain at least one number.');
            return;
        }
        if (!new_pass.match(/[!@#\$%\^&\*]/) ) {
            $('#msg').text('Password must contain at least one special character.');
            return;
        }
        if (new_pass.length < 6 ) { 
            $('#msg').text('Password length at least 6 characters');
            return;
        }
        if (confirm_pass=="") {
          $('#msg').text('Please Enter Confirm New Password');
          return;
        }
        if (new_pass!=confirm_pass) {
          $('#msg').text('New Password and Confirm New Password do not match');
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
                        $('#success_msg').text('Password updated successfully'); 
                        $('#msg').text('');
                        // setTimeout(function(){
                        //     window.location.replace('user');
                        // },1000)
                    }  
                    else{ 
                        $('#msg').text('Old Password do not matched');  
                    } 
              }
                
          });
            
        }
        
      });

});
</script>	