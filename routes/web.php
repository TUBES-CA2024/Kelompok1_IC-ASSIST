<?php

use App\Core\Router;

Router::get('/about', function() {
    echo "WELCOME from web.php";
});

Router::get('/contact', function() {
    echo "Route contact successfully reached.";
});
Router::get('/{any}', function() {
    echo "Route not found";
});




