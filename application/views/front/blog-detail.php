<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title"><?= $blogData->title ?></h1>
              <p class="mb-0">
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="current"><?= $blogData->title ?></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Service Details 2 Section -->
    <section id="service-details-2" class="service-details-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

         
        <div class="row">

          <div class="col-lg-8">
            <div class="masjidDetail">
              
              <img src="<?php echo base_url('./uploads/blog/').$blogData->image; ?>" alt="<?= $blogData->name; ?>" class="img-fluid">
           <h2><?= $blogData->title ?></h2>
              <p><?= $blogData->description ?></p>
            </div> 
          </div>
          <div class="col-lg-4">
            <div class="namazTime">
               
               
            </div>
          </div>

        </div>

        

        

        

      </div>

    </section><!-- /Service Details 2 Section -->

  </main>