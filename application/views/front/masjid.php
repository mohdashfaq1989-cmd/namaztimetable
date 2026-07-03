<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Masjid</h1>
               
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Masjid</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
<?php if(!empty($result)){ $i=0;  
   foreach($result as $row){ $i++;  
    ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item">
              <div class="service-image">
                <img src="<?php echo base_url('./uploads/images/').$row['image']; ?>" alt="<?= $row['name']; ?>" class="img-fluid">
                <div class="service-overlay">
                  <i class="fas fa fa-mosque"></i>
                </div>
              </div>
              <div class="service-content">
                <h3><?= $row['name']; ?></h3>
                <p><?= $row['address']; ?></p>
                <div class="service-features">
                  <span class="feature-item"><i class="fas fa-home"></i> <?= $row['state']; ?></span>
                  <span class="feature-item"><i class="fas fa-building"></i> <?= $row['city']; ?></span>
                  <span class="feature-item"><a href="https://www.google.com/maps/search/?api=1&query=<?= $row['lng'].','.$row['lat']; ?>" target="_blank"><i class="fas fa-location-arrow"></i> Get Direction</a></span>
                </div>
                <a href="masjid/view/<?= $row['id']; ?>" class="service-btn">
                  <span>Read More</span>
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->
          
          <?php } }else{ ?>
            No record found..
          <?php } ?>

          <?= $links; ?>

        </div>

      </div>

    </section><!-- /Services Section -->

  </main>
 