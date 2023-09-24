<?php


if (!isset($_FILES['upload']) || (isset($_FILES['upload']) && empty($_FILES['upload']['tmp_name']))) {
    echo "<script>alert(`Please Upload Image First.`); location.replace('./');</script>";
    exit;
}


//File Extension
$ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

//File Type
$type = mime_content_type($_FILES['upload']['tmp_name']);

// Allowed File Type
$allowed_type = ["image/jpeg", "image/png"];
if (!in_array($type, $allowed_type)) {
    echo "<script>alert(`Upload File type is invalid.`); location.replace('./');</script>";
    exit;
}
// upload directory
$dir = "upload/";

if (!is_dir($dir))
    mkdir($dir);

// orginal file name
$original = "original.png";
// with watermark file name
$ww_copy = "copy_w_watermark.png";
if (is_file($dir . $original)) {
    unlink($dir . $original);
}
if (is_file($dir . $ww_copy)) {
    unlink($dir . $ww_copy);
}

// watermark image
$watermark = "watermark.png";
// $watermark = "upload/resized_wm.png";
$wm_img = imagecreatefrompng($watermark);


// watermark image size
list($width, $height) = getimagesize($watermark);
$w_width = $width;
$w_height = $height;

// Creating an GD Image

if ($type == 'image/png')
    $img = imagecreatefrompng($_FILES['upload']['tmp_name']);
else {
    $img = imagecreatefromjpeg($_FILES['upload']['tmp_name']);
}
// getting the Image size

list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);
imagepng($img, $dir . $original);

// rescale the watermark size if it larger than the uploaded image
if ($w_width > $width) {
    $perc = ($w_width - ($width * .6)) / ($width * .6);
    $w_width = ($width * .6);
    $w_height = $w_height - ($w_height * $perc);
    $new_wm_img = imagescale($wm_img, $w_width, $w_height);
    imagealphablending($new_wm_img, true);
    imagesavealpha($new_wm_img, true);
}

// if($w_height > $height){
//     $perc = ($w_height - ($height * .6)) / ($height * .6);
//     $w_height = ($height * .6);
//     $w_width = $w_width - ($w_width * $perc);
//     $new_wm_img =imagescale($wm_img, $w_width, $w_height);
//     imagealphablending($new_wm_img, false);
//     imagesavealpha($new_wm_img, true);
// }
if (isset($new_wm_img)) {
    imagepng($new_wm_img, "upload/resized_wm.png");
    imagedestroy(($new_wm_img));
    imagedestroy(($wm_img));
    $wm_img = imagecreatefrompng("upload/resized_wm.png");
    list($w_width, $w_height) = getimagesize("upload/resized_wm.png");
}


// Combine Image
// imagecopy($img, $wm_img,
//         $width,
//         $height,
//         (($width > $w_width) ? ($width - $w_width) / 2 : 0),
//         (($height > $w_height) ? ($height - $w_height) / 2 : 0),
//         (($width > $w_width) ? $w_width : $width),
//         (($height > $w_height) ? $w_height : $height)
// );
imagecopy($img, $wm_img,
    (($width > $w_width) ? ($width - $w_width) / 2 : 0),
    (($height > $w_height) ? ($height - $w_height) / 2 : 0),
    0,
    0,
    (($width > $w_width) ? $w_width : $width),
    (($height > $w_height) ? $w_height : $height)
);

// imagecopy($img, $wm_img,
//         $width-10,
//         $height-10,
//         0,
//         0,
//         (($width > $w_width) ? $w_width : $width),
//         (($height > $w_height) ? $w_height : $height)
// );

imagepng($img, $dir . $ww_copy);
imagedestroy($img);
imagedestroy($wm_img);
if (is_file("upload/resized_wm.png"))
    unlink("upload/resized_wm.png");
echo "<script>alert(`File has been uploaded successfully.`); location.replace('./');</script>";
exit;
