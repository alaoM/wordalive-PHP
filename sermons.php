
<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
$res = $database->fetchSermonPageSermons();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Word Alive Sermon</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="fjsk.png" />

    <!-- partial:partial/__stylesheets.html -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick-theme.css" />
    <link rel="stylesheet" href="assets/css/plugins/ion.rangeSlider.min.css" />

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="assets/fonts/flaticon/flaticon.css" />
    <link rel="stylesheet" href="assets/css/plugins/font-awesome.min.css" />
    <!-- Template Style sheet -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!-- partial -->
  </head>

  <body>
  <?php include_once('admin/assets/includes/navbar.html')?>
    <div
      class="sigma_subheader dark-overlay dark-overlay-2 wow slideInLeft" data-wow-delay="0.2s"
      style="background-image: url(assets/img/subheader.jpg)"
    >
      <div class="container">
        <div class="sigma_subheader-inner">
          <div class="sigma_subheader-text">
            <h1>Sermon</h1>
            <p class="text-white mb-0">
              Promoting the Gospel of Christ through daily teachings.
            </p>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a class="btn-link" href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Sermon</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- partial -->

    <!-- Sermon Start -->
    <div class="section section-padding">
      <div class="container">
        <div class="row count">
        <?php
        $sn = 1; 
        if (mysqli_num_rows($res) > 0) {          
            while($row = mysqli_fetch_array($res)){                       
            ?>
          <div class="col-lg-4 col-sm-6 justify-content-center wow fadeInDown" data-wow-delay="0.2s">
            <div class="sigma_sermon-box">
              <div class="sigma_video-popup-wrap">
                <img src="<?=$row['image_path']?>" alt="video" />
                <a
                  href="<?=$row['video_path']?>"
                  class="sigma_video-popup popup-youtube"
                >
                  <i class="fas fa-play"></i>
                </a>
              </div>

              <div class="sigma_box">
                <h4 class="title mb-0">
                  <h6><?=$row['title']?></h6>
                </h4>
                <ul class="sigma_sermon-info mb-0">
                  <li>
                    <i class="far fa-user"></i>
                    Message by
                    <a href="" class="ms-2"><u><?=$row['preacher']?></u></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>   
          <?php } }?>        
        </div>
        <!-- Pagination Start -->
        <ul class="pagination mb-0" id="tab">
        </ul>
        <!-- Pagination End -->
      </div>
    </div>
   
<?php include_once('admin/assets/includes/footer.html')?>

    <!-- partial:partia/__scripts.html -->
    <script src="assets/js/plugins/jquery-3.4.1.min.js"></script>
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/imagesloaded.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/jquery.inview.min.js"></script>
    <script src="assets/js/plugins/jquery.event.move.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="assets/js/plugins/audio_custome.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/sermonpagination.js"></script>    
  </body>
</html>
