<?php

function redirect($path) {
     header('Location: ' . APP_URL . '/' . ltrim($path, '/')); 
     die;
 }
 