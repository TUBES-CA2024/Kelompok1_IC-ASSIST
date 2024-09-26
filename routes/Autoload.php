<?php
$core = glob('../app/core/*.php');
$config = glob('../config/*.php');

foreach ($core as $file) {
    require $file;
}
foreach ($config as $file) {
    require $file;
}