<?php
include 'Water.php';
try {
    $water = new Water('water.jpg');
    $water->make('test.jpg', '1.jpg');
} catch (Exception $e) {
    echo $e->getMessage();
}
