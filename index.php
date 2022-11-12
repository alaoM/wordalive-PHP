
<?php
require_once('admin/assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

// Latest Sermon
list($sermon_title, $preacher, $date, $video_path) = $database->fetchHomePageSermons();
// Latest Event
list($title, $location, $eventDate) = $database->fetchEvents();


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Word Alive Ministry</title>

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

    <!-- Banner Start -->
    <div class="sigma_banner banner-2">
      <div class="sigma_banner-slider">
        <!-- Banner Item Start -->
        <div
          class="light-bg sigma_banner-slider-inner bg-cover bg-center dark-overlay dark-overlay-2 bg-norepeat"
          style="background-image: url('assets/img/banner/1.jpg')"
        >
          <div class="sigma_banner-text">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-6 text-center">                 
                  <h1 class="text-white title">The Word Lives International Ministry</h1>
                  
                  <p class="mb-0">
                  Promoting the gospel of Christ through Preaching and Teaching
                  </p>
                  <span class="highlight-text border">Rev.d & Mrs. Adesoye Owolabi</span><br>
                  <a
                    href="about-us.php"
                    class="sigma_btn-custom section-button"
                    >Explore <i class="far fa-arrow-right"></i>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Banner Item End -->

        <!-- Banner Item Start -->
        <div
          class="light-bg sigma_banner-slider-inner bg-cover bg-center dark-overlay dark-overlay-2 bg-norepeat"
          style="background-image: url('assets/img/about-me/qjsk450.jpeg')"
        >
          <div class="sigma_banner-text">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-6 text-center">                  
                  <h1 class="text-white title">Word Alive ministry</h1>
                  <p class="mb-0">
                   Promoting the gospel of Christ through Preaching and Teaching
                  </p>
                  <span class="highlight-text">Rev.d & Mrs. Adesoye Owolabi</span><br>
                  <a
                    href="#"
                    class="sigma_btn-custom section-button"
                    >Rev.d & Mrs. Adesoye Owolabi <i class="far fa-arrow-right"></i>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Banner Item End -->
      </div>
    </div>
    <!-- Banner End -->

    <!-- Sermons Start -->
    <div class="section section-padding light-bg">
      <div class="container">
        <div class="row sigma_sermon-box-wrapper">
          <div class="col-lg-6">
            <div class="sigma_sermon-box">
              <div class="sigma_box">
                <span class="subtitle">Next Event</span>
                <h4 class="title mb-0">
                  <a href="#"><?=$title?></a>
                </h4>
                <div class="sigma_sermon-info">
                  <div class="sigma_sermon-date">
                    <span class="days"></span>
                    <div class="row">
                      <div class="col p-0 m-0">
                        <p class="hours"></p>
                      </div>
                      <div class="col p-0 m-0">
                        <p class="minutes"></p>
                      </div>
                      <div class="col p-0 m-0">
                        <p class="seconds"></p>
                      </div>
                    </div>                  
                    
                  </div>
                  <ul class="sigma_sermon-descr m-0">
                    <li>
                      <i class="far fa-clock"></i>
                      <div id="time"><?=$eventDate?></h2>
                      
                    </li>
                    
                    <li>
                      <i class="far fa-map-marker-alt"></i>
                      <?=$location?>
                    </li>
                  </ul>
                </div>
                <!-- <div class="section-button d-flex align-items-center"> -->
                  <!-- <a href="#" class="sigma_btn-custom secondary">Join Now <i class="far fa-arrow-right"></i> -->
                   <!-- <span></span> -->
                    <!-- <span></span> -->
                    <!-- <span></span> -->
                    <!-- <span></span> -->
                  <!-- </a> -->
                <!-- </div> -->
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sigma_sermon-box">
              <div class="sigma_box">
                <span class="subtitle">Latest Sermons</span>
                <h4 class="title mb-0">
                  <a href="#"
                    ><?=$sermon_title?></a
                  >
                </h4>
                <ul class="sigma_sermon-info mb-0">
                  <li>
                    <i class="far fa-user"></i>
                    Message From
                    <a href="#" class="ms-2"><u><?=$date?></u></a>
                  </li>
                  <li class="mt-0 ms-4">
                    <i class="far fa-calendar-check"></i>
                    <?=$preacher?>
                  </li>
                </ul>
                <div class="sigma_audio-player row">                  
                  <div class="audio-wrapper" id="player-container">
                    <audio id="player" controls class="col-12">
                      <source src="<?=$video_path?>"  type="audio/mp3">
                      <source                      
                      src="<?=$video_path?>"
                        type="audio/mp3"
                      />
                    </audio>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Sermons End -->

    <!-- Icons Start -->
    <div class="section section-padding">
      <div class="container">
        <div class="section-title section-title-2 text-center">
          <p class="subtitle">Features</p>
          <h4 class="title">Christian Growth</h4>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="sigma_icon-block icon-block-2">
              <div class="icon-wrapper">
                <img src="assets/img/about-group/knowl23fd.jpg" alt="" srcset="" height="100px" width="100px">               
              </div>
              <div class="sigma_icon-block-content wow fadeInLeft" data-wow-duration="0.2s">
                <h5>Knowledge</h5>
                <p>
                 Read the Bible everyday.
                </p>
                <small>Joshua 1:8</small>
               
              </div>
            </div>
          </div>
          <div class="col-md-6 awow fadeInLeft" data-wow-duration="0.2s">
            <div class="sigma_icon-block icon-block-2 ">
              <div class="icon-wrapper">
                <img src="assets/img/about-group/2.jpg" alt="" srcset="" height="100px" width="100px">               
              </div>
              <div class="sigma_icon-block-content">
                <h5>Spirituality</h5>
                <p>
                  Live a holy life.
                </p>
                <small>Hebrews 12:14</small>
               
              </div>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-duration="0.2s">
            <div class="sigma_icon-block icon-block-2">
              <div class="icon-wrapper">
                <img src="assets/img/about-group/commxyz.png" alt="" srcset="" height="100px" width="100px">               
              </div>
              <div class="sigma_icon-block-content">
                <h5>Community</h5>
                <p>
                  Fellowship with other believers
                </p>  
                <small>Hebrews 12:14</small>              
              </div>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-duration="0.2s">
            <div class="sigma_icon-block icon-block-2">
              <div class="icon-wrapper">
                <img src="assets/img/about-group/ser12v.webp" alt="" srcset="" height="100px" width="100px">               
              </div>
              <div class="sigma_icon-block-content">
                <h5>Service</h5>
                <p>
                  Sercive to humanity
                </p>
                <small>Hebrews 12:14</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Icons End -->

    <!-- About Start -->
    <section class="section section-md light-bg wow fadeInUp" data-wow-duration="0.2s">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-lg-30">
            <div class="section-title section-title-2 text-start">
              <p class="subtitle">Ministry Focus</p>
              <h4 class="title">
                
               Our Passion is to foster the Total Personal and Spiritual Growth of each Young person 
              </h4>
              <p>
                Ministering to foster positive Youthful Development and Growth in both Christian discipleship and Christian identity; addressing their unique developmental, social and religious needs and nurturing the qualities and assets necessary for Christlikeness
              </p>
            </div>
            <div class="d-flex align-items-center mt-5">
              <div class="sigma_round-button me-4 sm">
                <span>
                  <b class="counter" data-to="100" data-from="0">0</b>
                  <span class="custom-primary" style="text-align: center;">%</span>
                </span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 197 197"
                  enable-background="new 0 0 197 197"
                  xml:space="preserve"
                >
                  <circle
                    class="sigma_round-button-stroke"
                    stroke-linecap="round"
                    cx="98.5"
                    cy="98.6"
                    r="97.5"
                  ></circle>
                  <circle
                    data-to="105"
                    class="sigma_progress-round sigma_round-button-circle"
                    stroke-linecap="round"
                    cx="98.5"
                    cy="98.6"
                    r="97.5"
                  ></circle>
                </svg>
              </div>
              <div>
                <h5 class="mb-2">Mission and Discipleship </h5>
                <p class="mb-0">
                  Proclaiming the gospel and discipling youths into maturity.
                  •	Mission outreach to campuses with free materials given to them.
                  •	Empowering the less privileged in and around us by organizing poverty alleviation programs (Entrepreneurship)
                  
                </p>
              </div>
            </div>
            <div class="d-flex align-items-center mt-5">
              <div class="sigma_round-button me-4 sm">
                <span>
                  <b class="counter" data-to="100" data-from="0">0</b>
                  <span class="custom-secondary">%</span>
                </span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 197 197"
                  enable-background="new 0 0 197 197"
                  xml:space="preserve"
                >
                  <circle
                    class="sigma_round-button-stroke"
                    stroke-linecap="round"
                    cx="98.5"
                    cy="98.6"
                    r="97.5"
                  ></circle>
                  <circle
                    data-to="100"
                    class="sigma_progress-round sigma_round-button-circle secondary"
                    stroke-linecap="round"
                    cx="98.5"
                    cy="98.6"
                    r="97.5"
                  ></circle>
                </svg>
              </div>
              <div>
                <h5 class="mb-2">Dynamic Worship Experience</h5>
                <p class="mb-0">
                  Exalting Christ and expressing our love for God in Spirit and truth through contemporary worship service that will lift men to God in Spirit and truth and Supernatural Manifestation of God’s presence in our services
                  
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-none d-lg-block">
            <div class="me-lg-30 img-group-2">
              <img src="assets/img/about-me/fvshdth23443.jpeg" alt="about" />            
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About End -->

    <!-- CTA Start -->
    <div class="section mt-negative-md p-0 d-none d-lg-block">
      <div class="container">
        <div
          class="p-5 bg-cover d-block d-md-flex align-items-center justify-content-between"
          style="background-image: url(assets/img/textures/abstract2.png)"
        >
          <div>
            <h5 class="text-white mb-2">Patner With Us</h5>
            <p class="text-white mb-0">
              Don't wait make a smart & Logical quote here. It's pretty easy.
            </p>
          </div>
          <a
            href="about-us.php#details"
            class="mt-3 mt-md-0 sigma_btn-custom text-white light"
            >Learn More
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
      </div>
    </div>
    <!-- CTA End -->

    <!-- About Start -->
    <section
      class="section section-padding wow fadeInLeft" data-wow-duration="0.2s"     
    >
      <div class="container">
        <div class="sigma_why-us">
          <div class="section-title section-title-2 text-center">
            <p class="subtitle">About Us</p>
            <h4 class="title">
              We are Community That Believes in the power of <u>God</u> to:
            </h4>
          </div> 
            <p>	To empower young people to live as disciples of Jesus Christ in our world today. </p>
            <p>To help young people learn what it means to follow Jesus Christ and to live as his disciples today, and empowering them to serve others and to work toward a world built on the visions and values of the reign of God.
          </p>
          <p>To draw Young people to responsible participation in the life, mission, and work of the Kingdom.</p>
            
          </p>
        </div>
        <div class="text-center">
          <a href="#" class="sigma_btn-custom"
            >Read More <i class="far fa-arrow-right"></i>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
      </div>
    </section>
    <!-- About End -->  

    <!-- Portfolio Start -->
    <div
      class="section section-padding bg-cover portfolio-section light-bg wow fadeInUp" data-wow-duration="0.2s"
      
    >
      <div class="container">
        <div class="section-title section-title-2 flex-title">
          <div>
            <p class="subtitle dark">Portfolio</p>
            <h4 class="title mb-lg-0">Bible Nuggets</h4>
          </div>
          <div class="sigma_arrows">
            <i class="far fa-chevron-left slick-arrow slider-prev"></i>
            <i class="far fa-chevron-right slick-arrow slider-next"></i>
          </div>
        </div>

        <div class="portfolio-slider">
          <div class="sigma_portfolio-item style-3">
            <img src="assets/img/about-group/1.jpg" alt="portfolio" />
            <div class="sigma_portfolio-item-content">
              <div class="sigma_portfolio-item-content-inner">
                <a href="#">Mysteries of New Month</a>
                <h5><a href="#">Sermon </a></h5>
              </div>
              <a href="#"
                ><i class="far fa-arrow-right"></i
              ></a>
            </div>
          </div>

          <div class="sigma_portfolio-item style-3">
            <img src="assets/img/about-group/sdf3.jpg" alt="portfolio" />
            <div class="sigma_portfolio-item-content">
              <div class="sigma_portfolio-item-content-inner">
                <a href="#">Blessings of Easter</a>
                <h5><a href="#"> Sermon </a></h5>
              </div>
              <a href="#"
                ><i class="far fa-arrow-right"></i
              ></a>
            </div>
          </div>

          <div class="sigma_portfolio-item style-3">
            <img src="assets/img/about-group/1.jpg" alt="portfolio" />
            <div class="sigma_portfolio-item-content">
              <div class="sigma_portfolio-item-content-inner">
                <a href="#">Christ is risen</a>
                <h5><a href="#"> Sermons </a></h5>
              </div>
              <a href="#"
                ><i class="far fa-arrow-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Portfolio End -->

    <!-- FAQ Start -->
    <section class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 d-none d-lg-block">
            <img src="assets/img/about-me/ftgdrt334.jpeg" class="w-100" alt="about" />
          </div>
          <div class="col-lg-6">
            <div class="me-lg-30">
              <div class="section-title section-title-2 text-start">
                <p class="subtitle">FAQ</p>
                <h4 class="title">Get Answers To All your Questions through Christ</h4>
                <p>
                  The Center is committed to preserving an Church identity
                  creative freedom
                </p>
              </div>
              <div class="accordion with-gap" id="generalFAQExample">
                <div class="card">
                  <div
                    class="card-header"
                    data-bs-toggle="collapse"
                    role="button"
                    data-bs-target="#generalOne"
                    aria-expanded="true"
                    aria-controls="generalOne"
                  >
                   How Can i be saved
                  </div>

                  <div
                    id="generalOne"
                    class="collapse show"
                    data-bs-parent="#generalFAQExample"
                  >
                    <div class="card-body">
                     For God so love the world, that he gave his only begotten son...
                    </div>
                    <small style="float: right; padding: 10px;">John 3:16</small>
                  </div>
                </div>
                <div class="card">
                  <div
                    class="card-header"
                    data-bs-toggle="collapse"
                    role="button"
                    data-bs-target="#generalTwo"
                    aria-expanded="false"
                    aria-controls="generalTwo"
                  >
                   How to study the Bible appropirately
                  </div>                  
                  <div
                    id="generalTwo"
                    class="collapse"
                    data-bs-parent="#generalFAQExample"
                  >
                    <div class="card-body">
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione similique dicta at exercitationem, optio, molestias officiis, corporis repellendus qui dolore eaque magnam! Nulla minus non, debitis qui sunt tenetur vero.
                    </div>
                    <small style="float: right; padding: 10px;">John 3:16</small>
                  </div>
                </div>
                <div class="card">
                  <div
                    class="card-header"
                    data-bs-toggle="collapse"
                    role="button"
                    data-bs-target="#generalThree"
                    aria-expanded="false"
                    aria-controls="generalThree"
                  >
                    How can i be born again?
                  </div>

                  <div
                    id="generalThree"
                    class="collapse"
                    data-bs-parent="#generalFAQExample"
                  >
                    <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eveniet esse ullam provident voluptatem nisi praesentium est, odio quod delectus quos aspernatur facere beatae iste deserunt similique, neque, vel repudiandae!
                    </div>
                    <small style="float: right; padding: 10px;">John 3:16</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FAQ End -->  
    <!-- Portfolio Start -->
    <div class="section section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 coaching">
            <div class="sigma_portfolio-item">
              <img src="assets/img/about-group/sdf3.jpg" alt="portfolio" />
              <div class="sigma_portfolio-item-content">
                <div class="sigma_portfolio-item-content-inner">
                  <h5><a href="#"> Preaching the Gospel</a></h5>
                  <p>
                    The Center is committed to preserving an Church identity,
                    building.
                  </p>
                </div>
                <a href="#"><i class="fal fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 strategy">
            <div class="sigma_portfolio-item">
              <img src="assets/img/about-group/1.jpeg" alt="portfolio" />
              <div class="sigma_portfolio-item-content">
                <div class="sigma_portfolio-item-content-inner">
                  <h5><a href="#"> Bible Nuggets </a></h5>
                  <p>
                    The Center is committed to preserving an Church identity,
                    building.
                  </p>
                </div>
                <a href="#"><i class="fal fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 coaching strategy">
            <div class="sigma_portfolio-item">
              <img src="assets/img/about-group/4.jpeg" alt="portfolio" />
              <div class="sigma_portfolio-item-content">
                <div class="sigma_portfolio-item-content-inner">
                  <h5><a href="#"> Help Poor </a></h5>
                  <p>
                    The Center is committed to preserving an Church identity,
                    building.
                  </p>
                </div>
                <a href="#"><i class="fal fa-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Portfolio End -->
   

    <!-- Icons Start -->
    <div class="section mb-negative p-0">
      <div class="container">
        <div class="sigma_box pb-0 m-0">
          <div class="row">
            <div class="col-md-3">
              <div class="sigma_icon-block icon-block-3">
                <div class="icon-wrapper">
                  <i class="fa fa-church"></i>
                </div>
                <div class="sigma_icon-block-content">
                  <h5>Mission and Outreach</h5>
                  <p>
                    Reach out to the unsaved
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="sigma_icon-block icon-block-3">
                <div class="icon-wrapper">
                  <i class="fa fa-bullhorn"></i>
                </div>
                <div class="sigma_icon-block-content">
                  <h5>Sermons</h5>
                  <p>
                   Preach the Gospel of Christ till last breath
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="sigma_icon-block icon-block-3">
                <div class="icon-wrapper">
                  <i class="fa fa-bible"></i>
                </div>
                <div class="sigma_icon-block-content">
                  <h5>Books</h5>
                  <p>
                    Increase your wealth of Knowledge by reading
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="sigma_icon-block icon-block-3">
                <div class="icon-wrapper">
                  <i class="fa fa-calendar-day"></i>
                </div>
                <div class="sigma_icon-block-content">
                  <h5>Events</h5>
                  <p>
                   What can be here, i dont know
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Icons End -->

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
    <!-- partial -->
  </body>
</html>
