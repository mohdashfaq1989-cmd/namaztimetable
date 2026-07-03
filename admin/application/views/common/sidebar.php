<?php $login_user = $this->session->userdata('admin_email'); ?>
<?php $contact_person = $this->db->get_where('admin')->row('contact_person'); ?>
    <!-- Left panel : Navigation area -->
    <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel">

        <!-- User info -->
        <div class="login-info">
            <span>
                <!-- User image size is adjusted inside CSS, it should stay as it -->

                <a href="javascript:void(0);">
                    <img src="assets/images/admin-profile.jpg" alt="me" class="online" />
                    <span>
                        <?= $contact_person ?>
                    </span>
                </a>

            </span>
        </div>
        <!-- end user info -->

        <!-- NAVIGATION : This navigation is also responsive-->
        <nav>
            <ul>
                <li id="dashboard">
                    <a href="dashboard" title="Dashboard">
                        <i class="fa fa-lg fa-fw fa-home"></i>
                        <span class="menu-item-parent">Dashboard</span>
                    </a> 
                </li>
                <li id="users">
                    <a href="user">
                        <i class="fa fa-lg fa-fw fa-users"></i>
                        <span class="menu-item-parent">Manage Users</span>
                    </a>
                </li>                
                <li id="masjid">
                    <a href="masjid">
                        <i class="fa fa-lg fa-fw fa-road"></i>
                        <span class="menu-item-parent">Manage Masjid</span>
                    </a>
                </li>     
                <li id="blog">
                    <a href="blog">
                        <i class="fa fa-lg fa-fw fa-clipboard"></i>
                        <span class="menu-item-parent">Manage Blog</span>
                    </a>
                </li>   
                <li id="gallery">
                    <a href="gallery">
                        <i class="fa fa-lg fa-fw fa-picture-o"></i>
                        <span class="menu-item-parent">Manage Gallery</span>
                    </a>
                </li>
                <li id="ads">
                    <a href="ads">
                        <i class="fa fa-lg fa-fw fa-empire"></i>
                        <span class="menu-item-parent">Manage Ads</span>
                    </a>
                </li>
                <li id="countries">
                    <a href="countries">
                        <i class="fa fa-lg fa-fw fa-globe"></i>
                        <span class="menu-item-parent">Manage Country</span>
                    </a>
                </li>
                <li id="states">
                    <a href="states">
                        <i class="fa fa-lg fa-fw fa-certificate"></i>
                        <span class="menu-item-parent">Manage State</span>
                    </a>
                </li>
                <li id="cities">
                    <a href="cities">
                        <i class="fa fa-lg fa-fw fa-circle-o"></i>
                        <span class="menu-item-parent">Manage Cities</span>
                    </a>
                </li>
                <li id="tehsil">
                    <a href="tehsil">
                        <i class="fa fa-lg fa-fw fa-dot-circle-o "></i>
                        <span class="menu-item-parent">Manage Tehsil</span>
                    </a>
                </li>
                <li id="rto">
                    <a href="rto">
                        <i class="fa fa-lg fa-fw fa-dot-circle-o "></i>
                        <span class="menu-item-parent">Manage Rto</span>
                    </a>
                </li>
                <li id="rto">
                    <a href="settings">
                        <i class="fa fa-lg fa-fw fa-dot-circle-o "></i>
                        <span class="menu-item-parent">Front Setting</span>
                    </a>
                </li>
                

            </ul>
        </nav>
        <span class="minifyme" data-action="minifyMenu">
            <i class="fa fa-arrow-circle-left hit"></i>
        </span>

    </aside>
    <!-- END NAVIGATION -->
    
     <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>
                    <a href="./">Home</a>
                </li>
                <li class="active"><?= $title ?></li>
            </ol>
            <!-- end breadcrumb -->

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="row">
                
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">  
  
 $(document).ready(function(){
     
    if (window.location.href.match('dashboard')) {
       $('#dashboard').addClass('active');
    }
    if (window.location.href.match('users')) { 
       $('#users').addClass('active');
    }
    if (window.location.href.match('transactions')) { 
       $('#transactions').addClass('active');
    }
    if (window.location.href.match('checklist')) {
        $('#checklist').addClass('active');
    }
    if (window.location.href.match('pricing')) {
        $('#pricing').addClass('active');
    }
    
 }); 
</script>
            