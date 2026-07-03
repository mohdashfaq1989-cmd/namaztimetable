
  <footer id="footer" class="footer-16 footer position-relative">

    <div class="container">

      <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-start">

          <div class="col-lg-5">
            <div class="brand-section">
              <a href="index.html" class="logo d-flex align-items-center mb-4">
                <span class="sitename"></span>
                <img src="<?= base_url('./uploads/'.setting()->logo); ?>" width="150px">
              </a>
              <p class="brand-description"></p>

              <div class="contact-info mt-5">
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span><?= setting()->address; ?></span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>+91-<?= setting()->phone1; ?></span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope"></i>
                  <span><?= setting()->email2; ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="footer-nav-wrapper">
              <div class="row">

                <div class="col-6 col-lg-3">
                  <div class="nav-column">
                    <h6>Links</h6>
                    <nav class="footer-nav">
                    <a href="<?=base_url()?>">Home</a>
                    <a href="about">About</a>
                    <a href="gallery">Gallery</a> 
            
                    </nav>
                  </div>
                </div>

                <div class="col-6 col-lg-3">
                  <div class="nav-column">
                    <h6>Links</h6>
                    <nav class="footer-nav">
                      <a href="faq">Faq</a>
                        <a href="blog">Blog</a> 
                        <a href="masjid">Masjid List</a>
            
                    </nav>
                  </div>
                </div>

                <div class="col-6 col-lg-3">
                  <div class="nav-column">
                    <h6>Links</h6>
                    <nav class="footer-nav">
                      <a href="find" >Find Your Mosque</a>          
                        <a href="contact">Contact</a>
                    <a href="login">Login</a>
                    <a href="register">Signup</a>
                    </nav>
                  </div>
                </div>

                 

              </div>
            </div>
          </div>

        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="bottom-content" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center">

            <div class="col-lg-6">
              <div class="copyright">
                <p><?= setting()->copyrights; ?></p>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="legal-links">
                <a href="#!">Privacy Policy</a>
                <a href="#!">Terms of Service</a>
                <a href="#!">Cookie Policy</a>
                <div class="credits">
                  Designed by <a href="#">Abaris Softech</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </footer>


<a href="https://wa.me/91<?= setting()->phone1; ?>" target="_blank" class="whatsapp-float">
    <i class="fab fa-whatsapp"></i>
</a>


<style>
.whatsapp-float{
    position: fixed;
    right: 15px;
    bottom: 70px;
    width: 60px;
    height: 60px;
    background: #25D366;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    z-index: 9999;
    transition: all 0.3s ease;
}

.whatsapp-float:hover{
    transform: scale(1.1);
    color: #fff;
}

.whatsapp-float::before{
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #25D366;
    opacity: 0.5;
    animation: pulse 1.8s infinite;
    z-index: -1;
}

@keyframes pulse{
    0%{
        transform: scale(1);
        opacity: 0.5;
    }
    100%{
        transform: scale(1.8);
        opacity: 0;
    }
}
</style>
<script>

function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("show");
}
</script>
 
  <!-- Scroll Top -->
  <a href="#!" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>