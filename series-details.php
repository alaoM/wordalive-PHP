<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
list($topic, $description, $image_path) = $database->fetchSeriesById();
$recentPost = $database->fetchWrittenSermon();
$relPost = $database->fetchSingleSeries();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Alive Blog Posts</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="ffjsk.png">

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

    <div class="sigma_subheader dark-overlay dark-overlay-2" style="background-image: url(assets/img/subheader.jpg)">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Blog Details</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <!-- partial -->

    <!-- Post Content Start -->
    <div class="section sigma_post-single">
        <div class="container">

            <div class="row">

                <div class="col-lg-8">
                    <div class="post-detail-wrapper">

                        <div class="entry-content">
                            <div class="sigma_post-meta">

                            </div>
                            <h4 class="entry-title text-center"><?=$topic?></h4>

                            <a href="<?=$image_path?>" class="gallery-thumb">
                                <img src="<?=$image_path?>" alt="<?=$topic?>">
                            </a>
                            <?=$description?>

                        </div>


                        <!-- Post Pagination Start -->
                        <div class="section">

                        </div>
                        <!-- Post Pagination End -->

                        <!-- Related Posts Start -->
                        <div class="section">
                            <h5>Related Posts</h5>
                            <div class="row">
                                <?php
                                    if (mysqli_num_rows($relPost) > 0) :          
                                        while($row = mysqli_fetch_array($relPost)) :
                                            $date =  date('M j Y g:i A', strtotime($row['TimeStamp']));                                                         
                                     ?>
                                <!-- Article Start -->
                                <div class="col-md-6">
                                    <article class="sigma_post">
                                        <div class="sigma_post-thumb">
                                            <a href="series.php#<?=$row['category']?>">
                                                <img src="<?=$row['image_path']?>" class="cropped1" alt="post">
                                            </a>
                                        </div>
                                        <div class="sigma_post-body">
                                            <div class="sigma_post-meta">
                                                <a href="series.php#<?=$row['category']?>" class="sigma_post-date"> <i
                                                        class="far fa-calendar"></i><?=$date?></a>
                                            </div>
                                            <h5> <a
                                                    href="series.php#<?=$row['category']?>"><?=substr($row['topic'], 0, 50,)?>...</a>
                                            </h5>
                                            <?php echo substr($row['description'], 0, 150)?><a
                                                href="series.php#<?=$row['category']?>"> ...Read More</a>
                                        </div>
                                    </article>
                                </div>
                                <?php
                                endwhile;
                            endif;
                                ?>
                            </div>
                        </div>
                        <!-- Related Posts End -->

                    </div>
                </div>

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget widget-recent-posts">
                            <h5 class="widget-title">Recent Posts</h5>
                            <?php      
                                if (mysqli_num_rows($recentPost) > 0) {          
                                    while($row = mysqli_fetch_array($recentPost)){  
                                    $date =  date('M j Y g:i A', strtotime($row['TimeStamp']));             
                            ?>
                            <article class="sigma_recent-post">
                                <a href="blog-details.php?<?=$row['checker']?>"><img src="<?=$row['image_path']?>"
                                        alt="post"></a>
                                <div class="sigma_recent-post-body">
                                    <h6> <a href="blog-details.php?<?=$row['checker']?>"><?=$row['topic']?></a> </h6>
                                    <a href="blog-details.php?<?=$row['checker']?>"> <i class="far fa-calendar"></i>
                                        <?=$date?></a>
                                </div>
                            </article>
                            <?php } }?>
                        </div>
                        <!-- Popular Feed End -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('admin/assets/includes/footer.html')?>
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