<?php
require_once('assets/includes/gate.php');
require_once('assets/includes/libs.php');
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
$res = $database->fetchSeries();
?>
<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Word Alive</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<!-- Sweet Alert -->
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
<!-- Custom Css -->

<link  rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">

<?php include_once('assets/includes/nav.html')?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Series DataTables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Word Alive</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Series</a></li>
                        <li class="breadcrumb-item active">Uploaded Records</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
           <div class="row clearfix js-sweetalert">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Exportable</strong> Examples </h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                       
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Topic</th>
                                            <th>Category</th>
                                            <th>Preacher</th>
                                            <th>Details</th>
                                           <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                    <?php
                                        $sn = 1; 
                                            foreach($res as $row):                     
                                            ?>
                                        <tr>     
                                            <td id="sn"><?=$sn++?></td>
                                            <td id="title"><?=substr($row['topic'], 0, 50)?></td>
                                            <td id="subtitle"><?=$row['category']?></td>
                                            <td id="portfolio"><?=$row['preacher']?></td>   
                                            <td id="portfolio"><?=substr($row['description'], 0, 200)?>...</td>                                             
                                            <td>
                                                <button id="edit" data-id1="<?=$row['id']?>" data-id2="series" class="btn btn-primary waves-effect waves-light edit" data-toggle="modal" data-target="#largeModal"> <i class="zmdi zmdi-eye"></i> Preview </button>
                                                <button id="delete" data-id3="<?=$row['id']?>" data-id4="series" class="btn btn-danger waves-effect waves-light delete"> <i class="zmdi zmdi-delete"></i> Delete </button>
                                            </td>                                         
                                        </tr>
                                        <?php endforeach;  ?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Topic</th>
                                            <th>Category</th>
                                            <th>Preacher</th>
                                            <th>Details</th>
                                           <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
            </div>           
            <div class="modal-body" >        
               
                <div class="blogitem mb-5">
                    <div class="blogitem-image">
                        <a href="#"><img id="largeModalImage" src="" alt=""></a>
                        <span id="item-date" class="blogitem-date"></span>
                    </div>
                    <div class="blogitem-content">  
                    <div class="blogitem-header">
                                    <div class="blogitem-meta">
                                        <span><i class="zmdi zmdi-account"></i>By <a id="preacher" href="javascript:void(0);"></a></span>
                                        <span><i class="zmdi zmdi-comments"></i><a id="category" href="#"></a></span>
                                        <span><i class="zmdi zmdi-videocam"></i><a id="video" href="#">Video Link</a></span>
                                    </div>
                                </div>                             
                        <h3 class="mb-0"><a id="largeModalLabel" href="#"></a></h3>                               
                        <h5 id="largeModalLabelSubtitle"></h5>
                        <p id="modal-body"></p>
                        <p></p>                        
                    </div>
                </div>          
           </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-danger waves-effect closebtn" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>



<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/js/pages/forms/main.js"></script>
<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/pages/ui/sweetalert.js"></script>


</body>



</html>