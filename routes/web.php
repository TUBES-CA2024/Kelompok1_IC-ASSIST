<?php

use App\Controllers\Home\HomeController;
use App\Core\Router;

Router::get('/about', function() {
    echo "WELCOME from web.php";
});
Router::get('/',[new HomeController, 'index']);
Router::get('/contact', function() {
    echo "Route contact successfully reached.";
});

Router::get('/mantap', function() {
    echo "Route home successfully reached.";
});




