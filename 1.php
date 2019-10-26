<?php
$res = imagecreatefromjpeg('test.jpg');
// var_dump($res);
$water = imagecreatefromjpeg('water.jpg');
// echo imagesx($water);
// echo imagesy($water);

$info = getimagesize('water.jpg');
print_r($info);
