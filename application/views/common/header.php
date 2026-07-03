<?php $userData = $this->db->get_where('user',array('id'=>$this->session->userdata('user_id')))->row(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $page_title ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url('./uploads/'.setting()->favicon); ?>" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center dark-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a
              href="mailto:contact@example.com"><?= setting()->email1; ?></a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+91-<?= setting()->phone1; ?></span></i>
        </div>
        <div class="profileBar d-none d-md-flex align-items-center">
        <?php if ($this->session->userdata('user_email')): ?> 
          <?php  if($userData->role_id==1): echo "Imam"; endif;?> 
            <?php  if($userData->role_id==2): echo "Mutwalli"; endif;?>
            <?php  if($userData->role_id==3): echo "Namazi"; endif;?> Dashboard
        <nav id="" class="navmenu">
          <ul>
            <li class="dropdown"><?= $userData->name ?> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>

              <li><a href="dashboard">My Account</a></li>
              <li><a href="masjidList">Masjid List</a></li>
              <li><a href="logout">Logout</a></li>
            </ul>
            </li>
            </ul>
          </nav>
         
        <?php else: ?> 
          <span class="tr-link"><a href="login">Login</a> | <a href="login/register">Signup</a></span>
          <?php endif;?>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="<?=base_url()?>" class="logo d-flex align-items-center">
          <img src="<?=base_url('./uploads/').setting()->logo;?>" alt="">
          
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="<?=base_url()?>" class="<?php if($this->uri->uri_string() == '') { echo 'active'; } ?>">Home</a></li>
            <li><a href="<?=base_url('about')?>" class="<?php if($this->uri->uri_string() == 'about') { echo 'active'; } ?>">About</a></li>
            <li><a href="<?=base_url('gallery')?>" class="<?php if($this->uri->uri_string() == 'gallery') { echo 'active'; } ?>">Photo Gallery</a></li>
            <li><a href="<?=base_url('faq')?>" class="<?php if($this->uri->uri_string() == 'faq') { echo 'active'; } ?>">Faq</a></li>
            <li><a href="<?=base_url('blog')?>" class="<?php if($this->uri->uri_string() == 'blog') { echo 'active'; } ?>">Blog</a></li>
            <li><a href="<?=base_url('masjid')?>" class="<?php if($this->uri->uri_string() == 'masjid') { echo 'active'; } ?>">Masjid List</a></li>
            <li><a href="<?=base_url('find')?>" class="<?php if($this->uri->uri_string() == 'find') { echo 'active'; } ?>">Find Your Mosque</a></li>            
            <li><a href="<?=base_url('contact')?>" class="<?php if($this->uri->uri_string() == 'contact') { echo 'active'; } ?>">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

