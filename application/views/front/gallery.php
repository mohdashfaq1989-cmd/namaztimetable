
  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Gallery</h1>               
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current">Gallery</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
    <?php if(!empty($result)){ $i=0;  
        foreach($result as $row){ $i++; ?>  
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="<?php echo base_url('./uploads/gallery/').$row['image']; ?>" class="img-fluid" alt="<?= $row['title']; ?>">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="<?php echo base_url('./uploads/gallery/').$row['image']; ?>" title="<?= $row['title']; ?>" class="glightbox preview-link"><i
                    class="bi bi-arrows-angle-expand"></i></a>
                <a href="javascript:void" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Gallery Item -->

          <?php } }else{ ?>
            No record found..
          <?php } ?>
<?= $links; ?>
        </div>

      </div>

    </section><!-- /Gallery Section -->

  </main>