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
                            <?php !empty($userData['id'])?$userData['id']:''; ?>
                        </div>
                    </div>
                </div>

                <div class="claim-data">
                    <div class="heading text-center mt-3">
                        <h2 class="text-primary"><?= $page_title ?></h2>
                    </div>
                     
                    <div class="alert-danger">
	    <?php validation_errors(); ?>
	</div>
	<!-- Display status message -->
    <?php if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
                        
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            </thead>
                            <tbody>
                              <form method="post" action="" enctype="multipart/form-data">  
                                
                                <tr>
                                    <td>Name: </td>
                                    <td><input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $userData['name'] ?>" ></td>
                                    <?php echo form_error('name','<p class="help-block text-danger">','</p>'); ?>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td><input type="email" name="email" class="form-control" placeholder="email" value="<?php echo $userData['email'] ?>" ></td>
                                    <?php echo form_error('email','<p class="help-block text-danger">','</p>'); ?>
                                </tr>
                                <tr>
                                    <td>Password: </td>
                                    <td><input type="password" name="password" class="form-control" placeholder="password" value="<?php echo $userData['password'] ?>"></td>
                                    <?php echo form_error('password','<p class="help-block text-danger">','</p>'); ?>
                                </tr>
                                <tr>
                                    <td>Phone: </td>
                                    <td><input type="text" name="phone" class="form-control" placeholder="phone" value="<?php echo $userData['phone'] ?>" ></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"><input type="submit" name="userSubmit" class="btn btn-danger profile-sbutmit" value="Update"></td>
                                </tr>
                                
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main> 
    <br><br>