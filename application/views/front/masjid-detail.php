<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title"><?= $masjidData->name ?></h1>
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
            <li class="current"><?= $masjidData->name ?></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Service Details 2 Section -->
    <section id="service-details-2" class="service-details-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">

          <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
            <div class="service-header">
              <div class="service-category">
                <span>About <?= $masjidData->name ?></span>
              </div>
              
            </div>
          </div>

        </div> 
        <div class="row">

          <div class="col-lg-8">
            <div class="masjidDetail">
              <h2><?= $masjidData->name ?></h2>
              <img src="<?php echo base_url('./uploads/images/').$masjidData->image; ?>" alt="<?= $masjidData->name; ?>" class="img-fluid">
           <table class="table">
            <tr><th>Masjid Code:</th><td><?= $masjidData->masjidCode ?></td></tr>
            <tr><th>Masjid Name:</th><td><?= $masjidData->name ?></td></tr>
            <tr><th>Masjid Imam:</th><td><?= $masjidData->imam ?></td></tr>
           <tr><th>Masjid Mutwalli:</th><td><?= $masjidData->mutwalli ?></td></tr>
           <tr><th>Rto_code:</th><td><?= $masjidData->rto ?></td></tr>
           <tr><th>country:</th><td><?= $masjidData->country ?></td></tr>
           <tr><th>state:</th><td><?= $masjidData->state ?></td></tr>
           <tr><th>city:</th><td><?= $masjidData->city ?></td></tr>
           <tr><th>tehsil:</th><td><?= $masjidData->tehsil ?></td></tr>
           <tr><th>address:</th><td><?= $masjidData->address ?></td></tr>
            <tr><th>Pincode:</th><td><?= $masjidData->pincode ?></td></tr>
            <tr><th>Created by:</th><td><?= $masjidData->userName ?></td></tr>
              </table>
              <p><?= $masjidData->description ?></p>
            </div> 
          </div>
          <div class="col-lg-4">
            <div class="namazTime">
              <h2>Namaz Time Table</h2>
              <table class="">
                   <tr><th>Fajr</th><td><?= date("h:i A", strtotime($masjidData->fajr)) ?></td></tr>
                   <tr><th>Dhuhr</th><td><?= date("h:i A", strtotime($masjidData->dhuhr)) ?></td></tr>
                   <tr><th>Asr</th><td><?= date("h:i A", strtotime($masjidData->asr)) ?></td></tr>
                   <tr><th>Maghrib</th><td><?= date("h:i A", strtotime($masjidData->maghrib)) ?></td></tr>
                   <tr><th>Isha</th><td><?= date("h:i A", strtotime($masjidData->isha)) ?></td></tr>
                   <tr><th>Juma</th><td><?= date("h:i A", strtotime($masjidData->juma)) ?></td></tr>
                   <tr><th>Eid</th><td><?= date("h:i A", strtotime($masjidData->eid)) ?></td></tr>
              </table>
            </div>
            <br><br><br>
            <div>
                
    <h3>Related Ads</h3>
    <?php if(!empty($adData)){ $i=0;  
   foreach($adData as $row){ $i++;  
    ?>
           
                <h4><?= $row['title']; ?></h4>
                <img src="<?php echo base_url('./uploads/ads/').$row['image']; ?>" alt="" class="img-fluid">
                 <p><?= $row['description']; ?></p>
          
          <?php } }else{ ?>
            No record found..
          <?php } ?>
            </div>
          </div>

        </div>

        

        

        

      </div>

    </section><!-- /Service Details 2 Section -->

  </main>