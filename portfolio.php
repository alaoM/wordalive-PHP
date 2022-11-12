<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
$res = $database->fetchPortfolio();
?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission and Outreach - Word Alive</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="fjsk.png">

    <!-- partial:partial/__stylesheets.html -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <link rel="stylesheet" href="assets/css/plugins/slick-theme.css">
    <link rel="stylesheet" href="assets/css/plugins/ion.rangeSlider.min.css">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/plugins/font-awesome.min.css">
    <!-- Template Style sheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- partial -->

</head>

<body>
    <?php include_once('admin/assets/includes/navbar.html')?>
    <div class="sigma_subheader dark-overlay dark-overlay-2 wow slideInRight" data-wow-delay="0.2s"
        style="background-image: url(assets/img/subheader.jpg)">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Portfolio</h1>
                    <p class="text-white mb-0"> Archives of what we have been doing in the past. </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- partial -->

    <!-- Categories Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="text-center filter-items">
                <h5 class="active portfolio-trigger" data-filter="*">All Images</h5>
                <h5 class="portfolio-trigger" data-filter=".campus">Campus Outreach</h5>
                <h5 class="portfolio-trigger" data-filter=".village">Village and Mission Outreach</h5>
                <h5 class="portfolio-trigger" data-filter=".orphanage">Visit to Orphanage</h5>
            </div>
            <div class="portfolio-filter row">
                <?php
       
        if (mysqli_num_rows($res) > 0) :         
            while($row = mysqli_fetch_array($res)) :                      
            ?>
                <div class="col-lg-4 <?=$row['portfolio']?>">
                    <div class="sigma_portfolio-item">
                        <img src="<?=$row['image_path']?>" alt="portfolio">
                        <div class="sigma_portfolio-item-content">
                            <div class="sigma_portfolio-item-content-inner">
                                <h5 class="text-white"> <?= $row['title']?> </h5>
                                <p><?=$row['subtitle']?></p>
                            </div>
                            <?php if (!empty($row['video_uri'])) {
                                $video = $row['video_uri'];
                              echo '
                              <a href="'.$video.'" class="popup-youtube"><i class="fas fa-play"></i></a>';
                            }                            
                            ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif ?>
            </div>

        </div>
    </div>
    <!-- Categories End -->

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

    <script src="assets/js/main.js"></script>
    <!-- partial -->

</body>

</html>