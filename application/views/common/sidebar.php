 

<div class="container-fluid" style="margin-top: 10rem !important;">

    <div class="row">

        <!-- SIDEBAR -->

        <div class="col-lg-2 p-0">

            <div class="sidebar p-3" id="sidebar">

                <div class="text-center profile-box mb-4">
                    
                    <img src="<?php if(!$userData->image==""){echo './uploads/profile/'.$userData->image;}else{echo './assets/img/avatar.jpg';}?>" alt="">
                    <h5 class="mt-3 mb-1"><?=  $userData->name ?></h5>
                    <small class="text-muted">User Account</small>
                </div>

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a href="dashboard" class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
                            <i class="fa fa-home"></i>
                            Dashboard
                        </a>
                    </li> 

                    <li class="nav-item">
                        <a href="masjidList" class="nav-link <?= ($this->uri->segment(1) == 'masjidList') ? 'active' : ''; ?>">
                            <i class="fa fa-mosque"></i>
                            Masjid List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="adList" class="nav-link <?= ($this->uri->segment(1) == 'adList') ? 'active' : ''; ?>">
                            <i class="fa-brands fa-adversal"></i>
                            Masjid Ads
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="profile" class="nav-link <?= ($this->uri->segment(1) == 'profile') ? 'active' : ''; ?>">
                            <i class="fa fa-pen"></i>
                            Update Profile
                        </a>
                    </li>

                   
                    <li class="nav-item">
                        <a href="logout" class="nav-link">
                            <i class="fa fa-right-from-bracket"></i>
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        </div>