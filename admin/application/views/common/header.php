
<!DOCTYPE html>
<html lang="en-us">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <base href="<?=base_url()?>">

    <title><?= $page_title ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/font-awesome.min.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-skins.min.css">

    <!-- SmartAdmin RTL Support  --> 
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/smartadmin-rtl.min.css">
    <link rel="stylesheet" href="assets/css/admin_style.css">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<?php $login_email = $this->session->userdata('admin_email'); ?>

<body class="desktop-detected  smart-style-6  pace-done fixed-header fixed-navigation">

    <!-- HEADER -->
    <header id="header">
        <div id="logo-group">
            <!-- PLACE YOUR LOGO HERE -->
            <span id="logo">
                <?php $this->session->userdata('admin_id'); ?>
                
                <?php base_url('../uploads/').$this->db->get_where('admin')->row('profile_image'); ?>
                <img src="assets/images/logo.png" style="width:70px">
                <!--<a href="./"> <span><?= $this->db->get_where('admin')->row('company_name'); ?></span> </a>-->
            </span>
            <!-- END LOGO PLACEHOLDER -->

            <!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
            <!--<a href="chat" ><span  class=""> <i class="fa fa-user"></i> <b class="badge"> 0 </b> </span></a>-->
            <br><style>
                .notify{border: 1px solid grey;
    padding: 4px;}
    .notify i{color:grey;}
            </style>
            
        </div>

        <!-- projects dropdown -->

        <!-- end projects dropdown -->

        <!-- pulled right: nav area -->
        <div class="pull-right">

            <!-- collapse menu button -->
            <div id="hide-menu" class="btn-header pull-right">
                <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                            class="fa fa-reorder"></i></a> </span>
            </div>
            <!-- end collapse menu -->

            <!-- logout button -->
            <div id="logoutzz" class="btn-header transparent pull-right">
                <span> <a href="<?= base_url('../') ?>" target="_blank" title="" ><i
                            class="fa fa-eye"></i> </a> </span>
            </div>
            <!-- end logout button -->
            <!-- logout button -->
            <div id="logout" class="btn-header transparent pull-right">
                <span> <a href="login/logout" title="Sign Out" data-action="userLogout"
                        data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i
                            class="fa fa-sign-out"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- fullscreen button -->
            <div id="fullscreen" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
                            class="fa fa-arrows-alt"></i></a> </span>
            </div>
            <!-- end fullscreen button -->

        </div>
        <!-- end pulled right: nav area -->

    </header>
    <!-- END HEADER -->
<script>
$(document).ready(function(){ 
  /*  function admin_chat_count() {
       var admin_id = $('#admin_id').val();
       var app_id = $('#app_id').val();
       var user_id = $('#user_id').val();
        $.ajax({ 
            url:"<?php echo base_url(); ?>chat/admin_chat_count",
            method:"POST",
            data:{
                admin_id:admin_id,
                app_id:app_id,
                user_id:user_id
                
            },
            dataType: "json",
            success:function(response)
            {
                console.log(response)
                
    			   $('.badge').html(response);
    		 
                
            }
        });
        setTimeout(function(){
            admin_chat_count(); 
        }, 500);
    }admin_chat_count();*/  
        
});
</script>