<?php
require_once('assets/includes/gate.php');
session_start();
$status = "";
if (isset($_SESSION['data'])) {    
    $res = $_SESSION['data'];
    $res2 = json_decode($res);
    if ($res2 -> success){
        $status = 
        '<div class="alert alert-success form-group form-float" role="alert"><strong>'. $res2 -> message .'<strong/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>'
        ;
    }else (
        $status = '<div class="alert alert-danger form-group form-float" role="alert"><strong>'. $res2 -> message .'<strong/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>'
    );
    session_destroy();
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Word Alive: Reaching out to the unsaved">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.min.css" />
    <!-- Ajax Submit -->

</head>

<body class="theme-blush">
<?php include_once('assets/includes/nav.html')?>

    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>File Upload</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="zmdi zmdi-home"></i> Word Alive</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Forms</a>
                            </li>
                            <li class="breadcrumb-item active">Sermon Upload</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button">
                            <i class="zmdi zmdi-sort-amount-desc"></i>
                        </button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                            <i class="zmdi zmdi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form action="./assets/includes/uploadForm/forms.php" id="form_validation"
                    class="sermon_submit validate" method="POST" enctype="multipart/form-data">
                    <div class="row clearfix">
                        <div class="col-12 server_response">
                            <?= $status?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header"></div>
                        <div class="body">
                            <div class="form-group form-float">
                                <label for="sermon-title">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                    required />
                            </div>
                            <div class="form-group form-float">
                                <label for="subtitle"> Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" placeholder="Subtitle"
                                    required />
                            </div>
                            <div class="row clearfix form-group form-float">
                                    <div class="col-lg-12 col-md-6">
                                        <p><b>Select a category</b></p>
                                        <select name="category" class="form-control show-tick ms select2"
                                            data-placeholder="Select" required>
                                            <option disabled selected>Please Select an option</option>
                                            <option value="campus">Campus Outreach</option>
                                    <option value="village">Village and Mission Outreach</option>
                                    <option value="orphanage">Visit to Orphanage</option>   
                                        </select>
                                    </div>
                                </div>
                            
                            <div class="form-group form-float">
                                <label for="video link"> Video Link (if available)</label>
                                <input type="text" name="video_url" class="form-control" placeholder="Video Link"/>
                                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Upload Image</strong> </h2>
                                </div>
                                <div class="body">
                                    <p>Upload any of the following formats: PNG JPG JPEG </p>
                                    <input type="file" id="uploadImage" name="uploadImage" multiple="multiple"
                                        class="dropify" data-allowed-file-extensions="png jpg jpeg" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="header">
                                <h2><strong>Video (Optional)</strong></h2>
                                </div>
                                <div class="body">
                                    <p> Upload any of the following formats: mp4, mp3, mov, wmv,
                                        avi, aac, ogg </p>
                                        <input type="file" name="uploadVideo" class="dropify"
                                        data-allowed-file-extensions="mp4 mp3 mov wmv avi aac ogg"
                                        data-max-file-size="200M" />
                                </div>
                            </div>
                        </div>
                        <button id="submit" type="submit" class="btn btn-raised btn-primary waves-effect" name="submit">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
            <div class="body">
                <div class="progress m-b-5">
                    <div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100" style="height: 30px;"></div>
                </div>
            </div>
            <div id="targetLayer">

            </div>
        </div>

    </section>
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js -->

    <script src="assets/plugins/dropify/js/dropify.min.js"></script>

    <script src="assets/js/pages/forms/dropify.js"></script>

    <!-- Jquery form ajaxSubmit -->
    <script src="assets/plugins//jquery-form/jquery.form.min.js"></script>


    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="assets/js/pages/index.js"></script>

</body>

</html>