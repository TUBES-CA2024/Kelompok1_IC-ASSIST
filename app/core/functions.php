<?php

function view ($name,$folder, $data = []) {
   $filename = "../app/View/" . $folder . "/" . $name . ".php";

   if(file_exists($filename)) {
       require $filename;
   } else {
       redirect('miscellaneous/404');
   }
}

function redirect($path) {
     header('Location: ' . APP_URL . '/' . ltrim($path, '/')); 
     die;
 }
 