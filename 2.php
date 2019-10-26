<?php
$res = imagecreatefromjpeg('test.jpg');
$icon = imagecreatefromjpeg('water.jpg');
// imagecopy($res, $icon, 400, 450, 0, 0, imagesx($icon), imagesy($icon));
imagecopymerge($res, $icon, 400, 450, 0, 0, imagesx($icon), imagesy($icon), 50);
header('Content-type:image/jpeg');
imagejpeg($res);
