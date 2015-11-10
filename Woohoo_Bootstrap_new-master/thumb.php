<html>
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
</head>
<body>

<?php
$var = $_POST['cValues'];
foreach ($var as $value) {
    echo $value; 
} 
echo $var[0];
$imgSrc = str_replace("upload/", "", $var[0]);
echo $a;
//$imgSrc="'".$a."'";
$dest="test.jpg";
$quality="100";
header('Content-type: image/jpeg');
//getting the image dimensions
list($width, $height) = getimagesize($imgSrc);
echo $width;
//saving the image into memory (for manipulation with GD Library)
$myImage = imagecreatefromjpeg($imgSrc);

// calculating the part of the image to use for thumbnail
if ($width > $height) {
  $y = 0;
  $x = ($width - $height) / 2;
  $smallestSide = $height;
} else {
  $x = 0;
  $y = ($height - $width) / 2;
  $smallestSide = $width;
}
// copying the part into thumbnail
$thumbSize = 300;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
//final output
imagejpeg($thumb,$dest,$quality);
imagejpeg($thumb);
imagedestroy($img);
imagedestroy($thumb);
?>


</body>
</html>