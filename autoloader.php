<?php


spl_autoload_register(function($className) {

    $baseDir= $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof".DIRECTORY_SEPARATOR."Test_PHP_Adv";

   if(strEndsWith($className,"controller")){
        // basedir
    }elseif(strEndsWith($className,"Service")){
        // business
        $baseDir=$baseDir.DIRECTORY_SEPARATOR."business";
    }elseif(strStartsWith($className,"toon")
           ||  strEndsWith($className,"form")>0){
        //view / forms
        $baseDir=$baseDir.DIRECTORY_SEPARATOR."presentation";
    }elseif($className=="DBConfig"|| strEndsWith($className,"DAO")){
        $baseDir=$baseDir.DIRECTORY_SEPARATOR."data";
    }elseif(strEndsWith($className,"Exception")){
        $baseDir=$baseDir.DIRECTORY_SEPARATOR."exceptions";
    }else{
       // entities
       $baseDir=$baseDir.DIRECTORY_SEPARATOR."entities";
   }


    $baseDir=$baseDir.DIRECTORY_SEPARATOR.$className.".php";

    if(file_exists($baseDir)){
        require_once($baseDir);
    }

});

function strEndsWith($haystack,$needle){
    /** returns true if $haystack ends with $needle **/

    if(strlen($haystack)<=strlen($needle)){
        return false;
    }
    $pos=stripos($haystack,$needle,0-strlen($needle));

    if($pos==(strlen($haystack)-strlen($needle))){
        return true;
    }
    return false;
}
function strStartsWith($haystack,$needle){
    /** returns true if $haystack starts with $needle **/

    if(strlen($haystack)<strlen($needle)){
        return false;
    }
    $pos=stripos($haystack,$needle);
    if(!$pos||$post>0){
        return false;
    }
    return true;
}
