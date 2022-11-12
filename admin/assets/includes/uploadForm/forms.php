<?php
require_once('../libs.php');
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
error_reporting(E_ALL);
error_reporting(-1);
session_start();
$errors = [];
$data = [];
ini_set('error_reporting', E_ALL);

// Upload Bible Study
if (isset($_POST['submit']) && (!empty($_POST['topic'])) && (!empty($_POST['description']))):
    $topic = $database->sanitize($_POST['topic']);
    $description = $database->sanitize($_POST['description']);
    $category = $database->sanitize($_POST['category']);

    // Upload Image
    $image = $_FILES["uploadImage"]["tmp_name"];
    $image_name = $_FILES['uploadImage']['name'];

    $image_folderPath = "../../../img/Wseries/";
    if (!file_exists($image_folderPath)) {
        mkdir($image_folderPath);
    }
    $image_path = str_ireplace(array('../../'), '', $image_folderPath . $image_name);
    $uploadImage = (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $image_folderPath . $_FILES["uploadImage"]["name"]));
    if (!is_writable($image_folderPath) || !is_dir($image_folderPath)) {
        $data['success'] = false;
        $data['message'] = 'Could not upload Image, Please try again.';
        exit();
    }
    if ($uploadImage) {
        $res = $database->writtenSermon($topic, $description, $image_path);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        elseif ($res == 'XJCTUKnkjslk133') {
            $data['success'] = false;
            $data['message'] = 'Record Exists, Please enter new event.';
        }
        else {
            $data['success'] = true;
            $data['message'] = 'Successfully Uploaded.';
        }
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    $_SESSION['data'] = $json_response;
    header("location: ../../../writtensermon.php");
    exit;
endif;

// PortFolio begins here
if (isset($_POST['submit']) && (!empty($_POST['title'])) && (!empty($_POST['subtitle']))):
    $title = $database->sanitize($_POST['title']);
    $subtitle = $database->sanitize($_POST['subtitle']);
    $portfolio = $database->sanitize($_POST['category']);
    $video_url = $database->sanitize($_POST['video_url']);

    // Upload Image
    $image = $_FILES["uploadImage"]["tmp_name"];
    $image_name = $_FILES['uploadImage']['name'];
    $image_folderPath = "../../../img/Portfolio/";
    if (!file_exists($image_folderPath)) {
        mkdir($image_folderPath);
    }
    $image_path = str_ireplace(array('../../'), '', $image_folderPath . $image_name);
    $uploadImage = (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $image_folderPath . $_FILES["uploadImage"]["name"]));
    if (!is_writable($image_folderPath) || !is_dir($image_folderPath)) {
        $data['success'] = false;
        $data['message'] = 'Could not upload Image, Please try again.';
        exit();
    }
    if ($uploadImage) {
        $res = $database->portfolio($title, $subtitle, $portfolio, $image_path, $video_url);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        else {
            $data['success'] = true;
            $data['message'] = 'Event successfully Added.';
        }
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    $_SESSION['data'] = $json_response;
    header("location: ../../../uploadportfolio.php");
    exit;
endif;
// PortFolio ends here


// Events begins here
if (isset($_POST['submit']) && (!empty($_POST['title'])) && (!empty($_POST['title']) || !empty($_POST['title']))):
    $title = $database->sanitize($_POST['title']);
    $location = $database->sanitize($_POST['location']);
    $date = $_POST['date'];
    // Upload Flier
    $image = $_FILES["uploadImage"]["tmp_name"];
    $image_name = $_FILES['uploadImage']['name'];
    $image_folderPath = "../../../img/Fliers/";
    if (!file_exists($image_folderPath)) {
        mkdir($image_folderPath);
    }
    $flier_path = str_ireplace(array('../../'), '', $image_folderPath . $image_name);
    $uploadImage = (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $image_folderPath . $_FILES["uploadImage"]["name"]));
    if (!is_writable($image_folderPath) || !is_dir($image_folderPath)) {
        $data['success'] = false;
        $data['message'] = 'Could not upload Image, Please try again.';
        exit();
    }
    if ($uploadImage) {
        $res = $database->events($title, $location, $date, $flier_path);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        elseif ($res == 'XJCTUKnkjslk133') {
            $data['success'] = false;
            $data['message'] = 'Record Exists, Please enter new event.';
        }
        else {
            $data['success'] = true;
            $data['message'] = 'Event successfully Added.';
        }
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    $_SESSION['data'] = $json_response;
    header("location: ../../../newevents.php");
    exit;
endif;
// Events ends here


// Upload Series
if (isset($_POST['postSeries']) && !empty($_POST['series_title'])) {
    $topic = $database->sanitize($_POST['series_title']);
    $category = $database->sanitize($_POST['category']);
    $preacher = $database->sanitize($_POST['preacher']);
    $description = $database->sanitize($_POST['description']);
    $video_link = $database->sanitize($_POST['video_link']);

    // Upload Image
    $image = $_FILES["uploadImage"]["tmp_name"];
    $image_name = $_FILES['uploadImage']['name'];
    $image_folderPath = "../../../img/Series/";
    if (!file_exists($image_folderPath)) {
        mkdir($image_folderPath);
    }
    $image_path = str_ireplace(array('../../'), '', $image_folderPath . $image_name);
    $uploadImage = (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $image_folderPath . $_FILES["uploadImage"]["name"]));

    // Upload Video
    $video = $_FILES["uploadVideo"]["tmp_name"];
    $video_name = $_FILES['uploadVideo']['name'];
    $video_folderPath = "../../../vids/Series/";
    if (!file_exists($video_folderPath)) {
        mkdir($video_folderPath);
    }
    $video_path = str_ireplace(array('../../'), '', $video_folderPath . $video_name);
    $uploadVideo = (move_uploaded_file($_FILES["uploadVideo"]["tmp_name"], $video_folderPath . $_FILES["uploadVideo"]["name"]));
    if (!is_writable($image_folderPath) || !is_dir($image_folderPath)) {
        $data['success'] = false;
        $data['message'] = 'Could not upload Image, Please try again.';
        exit();
    }
    if ($uploadImage || $uploadVideo) {
        $res = $database->series($topic, $category, $description, $preacher, $image_path, $video_link, $video_path);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        elseif ($res == 'XJCTUKnkjslk133') {
            $data['success'] = false;
            $data['message'] = 'Record Exists, Please enter new event.';
        }
        else {
            $data['success'] = true;
            $data['message'] = 'Successfully Uploaded.';
        }
    }
    else {
        $data['success'] = false;
        $data['message'] = 'Something went wrong, please try again.';
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    $_SESSION['data'] = $json_response;
    header("location: ../../../series.php");
    exit;
}

// Upload Sermon
if (isset($_POST['submit']) && (!empty($_POST['sermon_title']))) {
    //if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $title = $database->sanitize($_POST['sermon_title']);
    $preacher = $database->sanitize($_POST['preacher']);
    $video_link = $database->sanitize($_POST['video_link']);
    $date = $_POST['sermon_date'];
    // Upload Image
    $image = $_FILES["uploadImage"]["tmp_name"];
    $image_name = $_FILES['uploadImage']['name'];
    $image_folderPath = "../../../img/Sermon/";
    if (!file_exists($image_folderPath)) {
        mkdir($image_folderPath);
    }
    $image_path = str_ireplace(array('../../'), '', $image_folderPath . $image_name);
    $uploadImage = (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $image_folderPath . $_FILES["uploadImage"]["name"]));

    //  Upload Video
    $video = $_FILES["uploadVideo"]["tmp_name"];
    $video_name = $_FILES['uploadVideo']['name'];
    $video_folderPath = "../../../vids/Sermon/";
    if (!file_exists($video_folderPath)) {
        mkdir($video_folderPath);
    }
    $video_path = str_ireplace(array('../../'), '', $video_folderPath . $video_name);
    $uploadVideo = (move_uploaded_file($_FILES["uploadVideo"]["tmp_name"], $video_folderPath . $_FILES["uploadVideo"]["name"]));
    if (!is_writable($image_folderPath) || !is_dir($image_folderPath)) {
        $data['success'] = false;
        $data['message'] = 'Could not upload Image, Please try again.';
        exit();
    }
    if ($uploadImage && $uploadVideo) {
        $res = $database->sermon($title, $date, $preacher, $image_path, $video_path, $video_link);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        elseif ($res == 'XJCTUKnkjslk133') {
            $data['success'] = false;
            $data['message'] = 'Record Exists, Please enter new event.';
        }
        else {
            $data['success'] = true;
            $data['message'] = 'Sermon Uploaded.';
        }
    }
    else {
        $data['success'] = false;
        $data['message'] = 'Something went wrong, please try again, Please ensure you upload both video and image.';
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    $_SESSION['data'] = $json_response;
    header("location: ../../../uploadsermon.php");
    exit();
}

if (isset($_POST['func'])) {
    if ($_POST['func'] === "login") {
        if (!$_POST["email"] || !$_POST["pswd"]) {
            $data['success'] = false;
            $data['message'] = 'Empty Data';
        }
        $email = $_POST['email'];
        $psd = $_POST['pswd'];
     
     
        $jwt = $database->verify($email, $psd);       
        $data['status'] = $jwt===false ?false : true;
        $data['message'] = $jwt === false ? $database->error : $jwt;     
       
    };
    if ($_POST['func'] === "signup") {      
        if (!$_POST["email"] || !$_POST["pswd"]) {
            exit("No Data");
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $psd = $_POST['pswd'];
        // 80===dummy user; 90===admin
        $user = $database->save($role=80, $name, $username, $email, $psd, $id = null);            
        $data['status'] = $user===false ?false : true;
        $data['message'] = $user === false ? $database->error : $user;  
   
    }
    ;

    if ($_POST['func'] === "del") {
        $user = $database->validate($_POST["auth"]);
        if ($user===false) { exit("NO"); }
        $menu_type = $_POST['getMenu'];
        $id = $_POST['data_id'];
        $res = $database->deletePost($menu_type, $id);
        if ($res == 'XJCTUKnkjslk123') {
            $data['success'] = false;
            $data['message'] = 'Operation could not be performed, please try again.';
        }
        else if ($res == 'XJCTUKnkjslk143') {
            $data['success'] = true;
            $data['message'] = 'Record Deleted.';
        }
        else {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
    }
    elseif ($_POST['func'] === "edit") {
        $user = $database->validate($_POST["auth"]);
        if ($user===false) { exit("NO"); }
        $menu_type = $_POST['getMenu'];
        $id = $_POST['data_id'];
        if ($menu_type === 'portfolio') {
            $data = $database->fetchPortfolioByID($menu_type, $id);
        }
        if ($menu_type === 'writtensermon') {
            $data = $database->fetchWrittenSermonID($menu_type, $id);
        }
        if ($menu_type === 'series') {
            $data = $database->fetchSeriesID($menu_type, $id);
        }
        if ($menu_type === 'sermon') {
            $data = $database->fetchSermonID($menu_type, $id);
        }
        if ($menu_type === 'events') {
            $data = $database->fetchEventID($menu_type, $id);
        }
        if (!$data || $data == "XJCTUKnkjslk123") {
            $data['success'] = false;
            $data['message'] = 'Something went wrong, please try again.';
        }
        ;
    }
    elseif ($_POST['func'] === "fet") {
        $data = $database->fetchPortfolio($menu_type, $id);
    }
    $json_response = json_encode($data, JSON_FORCE_OBJECT);
    echo $json_response;
    exit();

}
?>