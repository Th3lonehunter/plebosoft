<?php
$img = @imagecreate(200, 50) or die("Cannot Initialize new GD image stream");
$backG = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
  imagefill($img, 0, 0, $backG);
  $lineC = imagecolorallocate($img, 0xCC, 0xCC, 0xCC);
  $textC = imagecolorallocate($img, 0x33, 0x33, 0x33);
for($i=0; $i < 6; $i++) {
    imagesetthickness($img, rand(1,3));
    imageline($img, 0, rand(0,30), 120, rand(0,30), $lineC);
    }
$pixelC = imagecolorallocate($img, 0,0,255);
for($i=0;$i<1000;$i++) {
    imagesetpixel($img,rand()%200,rand()%50,$pixelC);
} 
session_start(); 
$cap = '';
$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$len = strlen($letters);
for ($i = 0; $i< 6;$i++) {
    $letter = $letters[rand(0, $len-1)];
    imagestring($img, 5,  5+($i*30), 20, $letter, $textC);
    $cap.=$letter;
}
  $_SESSION['rand_code'] = $cap;



  header('Content-type: image/png');
  imagepng($img);
  imagedestroy($img);
?>