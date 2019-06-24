<?php
if(!isset($_SESSION)){
    session_start();
}
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

if(!isset($_SESSION["userId"])){
    header("location: index.php");
    exit(0);
}

$userService=new UserService();
$user=$userService->getUserById($_SESSION["userId"]);

if(!$user->isSuperuser()){
    header("location: index.php");
    exit(0);
}


if(isset($_POST["wijzigFormPizza"])){
    include("pizzaForm.php");
}

header("location: index.php?action=config");
