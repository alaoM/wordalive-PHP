<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
$res = $database->fetchWrittenSermon();
$relPost = $database->fetchSingleSeries();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Alive Ministry</title>

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

    <div class="sigma_subheader dark-overlay dark-overlay-2" style="background-image: url(assets/img/bg1.jpg)">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Blog Grid</h1>
                    <p class="text-white mb-0"> Promoting the gospel of Christ through Preaching and Teaching. </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <!-- partial -->

    <div class="section">
        <div class="container">

            <div class="row">
                
                <div class="col-lg-4">
                    <div class="sidebar">

                        <!-- Popular Feed Start -->
                        <div class="sidebar-widget widget-recent-posts">
                            <h5 class="widget-title">Recent Posts</h5>
                            <?php
                                if (mysqli_num_rows($relPost) > 0) :          
                                    while($row = mysqli_fetch_array($relPost)) :
                                        $date =  date('M j Y g:i A', strtotime($row['TimeStamp']));                                                         
                                ?>
                            <article class="sigma_recent-post">
                                <a href="series.php#<?=$row['category']?>"><img src="<?=$row['image_path']?>"
                                        alt="post"></a>
                                <div class="sigma_recent-post-body">
                                    <h6> <a href="series.php#<?=$row['category']?>"><?=$row['topic']?></a> </h6>
                                    <a href="series.php#<?=$row['category']?>"><i class="far fa-calendar"></i>
                                        <?=$date?></a>
                                </div>
                            </article>
                            <?php
                            endwhile;
                                endif;
                                ?>                          
                        </div>
                    </div>
                </div>
               

                <div class="col-lg-8">
                    <div class="row count">
                        <?php      
                         $sn = 1; 
                        if (mysqli_num_rows($res) > 0) {          
                            while($row = mysqli_fetch_array($res)){                               
                        ?>
                        <!-- Article Start -->
                        <div class="col-md-6">
                            <article class="sigma_post">
                                <div class="sigma_post-thumb">
                                    <a href="blog-details.php?<?=$row['checker']?>">
                                        <img src="<?=$row['image_path']?>" alt="<?=$row['topic']?>">
                                    </a>
                                </div>
                                <div class="sigma_post-body">
                                    <h6> <a href="blog-details.php?<?=$row['checker']?>"><?=$row['topic']?></a> </h6>
                                    <div class="sigma_post-single-author">
                                        <div class="sigma_post-single-author-content">
                                            <?php $string = $row['description'];  
                                                if (str_word_count($string) > 50) {
                                                $trimstring = implode(' ', array_slice(str_word_count($string, 1), 0, 50)) . '...';
                                                } else {
                                                $trimstring = $string;
                                                }
                                                echo $trimstring;
                                            ?>
                                        </div>
                                    </div>
                            </article>
                        </div>
                        <?php } }?>
                    </div>
                    <!-- Pagination Start -->
                    <ul class="pagination mb-0" id="tab">
                    </ul>
                    <ul class="pagination mb-0" id="tab">
                    </ul>
                </div>

            </div>

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

    <script src="assets/js/main.js"></script>
    <script src="assets/js/blogpagination.js"></script>

    <!-- partial -->

</body>

</html>