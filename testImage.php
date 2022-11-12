<?php



$im ='assets/img/subheader.jpg';
$max_resolution = 200;
$height = 200;
  
    if(file_exists($im)){
        $info = getimagesize($im);
        $extension = image_type_to_extension($info[2]);
        echo $extension;
        if ($extension == ".jpeg"){
            $original_image = imagecreatefromjpeg($im);   
        }
        else if ($extension == ".png"){
            $original_image = imagecreatefrompng($im);   
        }     
        else return;  
             
        $w = imagesx($original_image);
        $h = imagesy($original_image);
        if($h > $w) {
            $ratio = $max_resolution / $w;
            $new_width = $max_resolution;
            $new_height = $h * $ratio;

            $diff = $new_height - $new_width;
            $x = 0;
            $y = round($diff/2);

        }
        else{
            $ratio = $max_resolution / $h;
            $new_height = $max_resolution;
            $new_width = $w * $ratio;

            $diff = $new_width - $new_height; 
            $x = round($diff/2);
            $y = 0;
        }
        
        if($original_image){
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0,0,0,0, $new_width, $new_height, $w, $h);

            $new_crop_image = imagecreatetruecolor($max_resolution, $max_resolution);
            imagecopyresampled($new_crop_image, $new_image, 0,0,$x,$y, $max_resolution, $max_resolution, $max_resolution, $max_resolution);

            imagejpeg($new_crop_image, $im, 90);
        }
    }
// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     if(isset($_FILES['file'])){
//         move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
//         $file = $_FILES['file']['name'];
       
//         crop_image($file, "100");
//         echo "<img src='$file'/>";
//     }
//     else echo "file not supported";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--  -->
  
</body>

</html>