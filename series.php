<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
$dis = $database->fetchSeries();
$mar = $database->fetchSeries();
$sin = $database->fetchSeries();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Word Alive Series</title>

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
    <div class="sigma_subheader dark-overlay dark-overlay-2 wow slideInRight" data-wow-delay="0.2s"
        style="background-image: url(assets/img/banner/3.jpg)">
        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Series</h1>
                    <p class="text-white mb-0">
                        Promoting the gospel of Christ throgh preaching and teaching.
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="btn-link" href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Series</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- partial -->

    <!-- Discipleship Start -->
    <div id="dicipleship" class="section section-padding">
        <div class="container">
            <div class="section-title text-center">
                <p class="subtitle">Dicipleship</p>
                <h4 class="title">Teachings from the word of God</h4>
            </div>

            <div class="row sigma_broadcast-video">
                <div class="col-12 mb-5">
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6">
                            <div class="sigma_video-popup-wrap">
                                <img src="assets/img/about-me/qjsk450.jpeg" alt="video" />
                               <!--  <a href="https://www.youtube.com/watch?v=KH1pcNUTa6U"
                                    class="sigma_video-popup popup-youtube">
                                    <i class="fas fa-play"></i>
                                </a> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="sigma_box m-0">
                                <h4 class="title">A few words about us</h4>
                                <p class="m-0">
                                    But as many as received him, to them gave he power to become
                                    the sons of God, even to them that believe on his name:
                                    Which were born, not of blood, nor of the will of the flesh,
                                    nor of the will of man, but of God.
                                </p>
                                <small class="text-right">John 1: 12-13</small>
                            </div>
                        </div>
                    </div>
                </div>
                  <?php
                    if (mysqli_num_rows($dis) > 0) :          
                      while($row = mysqli_fetch_array($dis)): 
                        if ($row['category'] == 'Discipleship') : 
                        
                    ?>
                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="sigma_video-popup-wrap">
                        <img src="<?=$row['image_path']?>" class="cropped1" alt="<?=$row['topic']?>" />
                        <a href="<?=$row['video_path']?>" class="sigma_video-popup popup-sm popup-youtube">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    <a href="series-details.php?<?=$row['checker']?>"><h6 class="mb-0 mt-3"><?=$row['topic'] ?></h6></a>
                </div>
                  <?php
                    endif;
                    endwhile;
                  endif;                         
                  ?>

            </div>
        </div>
    </div>
    <!-- Discipleship End -->


    <!-- Marriage Start -->
    <div id="married" class="section section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <p class="subtitle">Marriage</p>
                <h4 class="title">What you should know as married couple</h4>
            </div>


            <div class="row">
                <!-- Article Start -->
                <?php      
          if (mysqli_num_rows($mar) > 0) :   
           while($row = mysqli_fetch_array($mar))  :    
            
         if ($row['category'] == 'Married') : 
                                  
        ?>
                <div class="col-lg-4 col-md-6">
                    <article class="sigma_post">
                        <div class="sigma_post-thumb">
                        <a href="series-details.php?<?=$row['checker']?>">
                                <img src="<?=$row['image_path']?>" class="cropped2" alt="post" />
                            </a>
                        </div>
                        <div class="sigma_post-body">
                            <div class="sigma_post-meta">
                                <div class="me-3">
                                    <?php
                    if ($row['video_path'] != ""){
                     echo '<i class="fas fa-video"></i>';
                    }
                    else echo '<i class="fas fa-book"></i>'
                    ?>
                                    <a href="series-details.php?<?=$row['checker']?>" class="sigma_post-category"><?=$row['topic']?></a>
                                </div>
                            </div>
                            <h5><a href="series-details.php?<?=$row['checker']?>">Love the Lord your God</a></h5>
                            <div class="sigma_post-single-author">
                                <div class="sigma_post-single-author-content">
                                    By
                                    <p>Pst. Alao Miracle</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <?php 
          endif;
        endwhile;
        endif?>
                <!-- Article End -->
            </div>
        </div>
    </div>
    <!-- Marriage End -->




    <!-- singles Start -->
    <div id="singles" class="section section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <p class="subtitle">Singles Digest</p>
                <h4 class="title">Things to knnow as singles</h4>
            </div>

            <div class="row">
                <?php        
          if (mysqli_num_rows($sin) > 0) :   
           while($row = mysqli_fetch_array($sin)):   
           
          if ($row['category'] == 'Singles Digest') :
                                   
         ?>
                <!-- Article Start -->

                <div class="col-lg-4 col-md-6">
                    <article class="sigma_post">
                        <div class="sigma_post-thumb">
                            <a href="blog-details.html">
                                <img src="<?=$row['image_path']?>" alt="post" />
                            </a>
                        </div>
                        <div class="sigma_post-body">
                           
                            <h5><a href="series-details.php?<?=$row['checker']?>"><?=$row['topic']?></a></h5>
                        </div>
                    </article>
                </div>
                <?php endif;
          endwhile;
          endif?>                
            </div>
        </div>
    </div>
    <!-- Singles End -->

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