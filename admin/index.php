<?php
require_once('assets/includes/gate.php');
require_once('assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(1);
ini_set('error_reporting', E_ALL);

// Count Mail
list($total_Mails, $unread_mail, $percentage_read, $events, $portfolio, $series,$sermon,$writtensermon) = $database->count();
 
// Read Email
$res = $database->readEmail();

?>
<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Word Alive: Reaching out to the unsaved">
    <title>Dashboard</title>
    <link rel="icon" href="logo.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css" />

    <link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48"
                    alt="Aero"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Main Content -->
    <?php include_once('assets/includes/nav.html')?>

    <section class="content">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> Word
                                    Alive</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon email">
                            <a href="#email">
                                <div class="body">
                                    <h6>Email</h6>
                                    <h2>
                                        <?=$unread_mail?> <small class="info">of
                                            <?=$total_Mails?>
                                        </small>
                                    </h2>
                                    <small>Total Unread Emails</small>
                                    <div class="progress">
                                        <div class="progress-bar l-purple" role="progressbar" aria-valuenow=""
                                            aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage_read."%"?>"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon documents">
                            <div class="body">
                                <h6>Events</h6>
                                <h2> <?=$events?></h2>
                                <small>Total Events Uploaded</small>
                                <div class="progress">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon documents">
                            <div class="body">
                                <h6>Series</h6>
                                <h2> <?=$series?></h2>
                                <small>Total Series Uploaded</small>
                                <div class="progress">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon documents">
                            <div class="body">
                                <h6>Sermon</h6>
                                <h2> <?=$sermon?></h2>
                                <small>Total Sermon Uploaded</small>
                                <div class="progress">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                         <div class="card widget_2 big_icon documents">
                            <div class="body">
                                <h6>Past Events</h6>
                                <h2> <?=$portfolio?></h2>
                                <small>Past Events Uploaded</small>
                                <div class="progress">
                                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon documents">
                            <div class="body">
                                <h6>Written Sermon</h6>
                                <h2> <?=$writtensermon?></h2>
                                <small>Bible Study Uploaded</small>
                                <div class="progress">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="89"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div id="emails" class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>New Emails</strong></h2>
                            </div>
                            <div class="body">
                                <p>New Unread Emails</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Subject</th>
                                                <th>Action</>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                    $sn = 1; 

                                    if (mysqli_num_rows($res) > 0) {
                                        while($row = mysqli_fetch_array($res)){           
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $sn++?>
                                                </th>
                                                <td>
                                                    <?php echo $row['sender_name']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['phoneNumber']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['subject']?>
                                                </td>
                                                <td><a href="mailto: <?php echo $row['sender_email']?>"><i
                                                            class="zmdi zmdi-eye"></a></td>
                                            </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/js/pages/forms/main.js"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
    <script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
    <script src="assets/bundles/c3.bundle.js"></script>

    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="assets/js/pages/index.js"></script>
</body>


</html>