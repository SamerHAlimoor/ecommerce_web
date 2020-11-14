<?php

define('PAGNIATION_COUNT',15);
 function getFolder(){
return app()->getLocale()==='ar'? 'css-rtl':'css';
}


 function uploadImage($folder, $images)
 {
     $images->store('/', $folder);
     $filename= $images->hashName();
    // $path='images/'.$folder.'/'.$filename;
     return $filename;
 }
    