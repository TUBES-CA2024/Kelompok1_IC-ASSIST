<?php

function redirect($path) {
     header('Location: ' . APP_URL . '/' . $path);
     header('Location: ' . APP_URL . '/' . 'miscellaneous/404');
     die;
}