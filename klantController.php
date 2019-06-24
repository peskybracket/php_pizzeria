<?php
if(!isset($_SESSION)){
    session_start();
}
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

if(!isset($_SESSION["userId"])){
    print("geen sessie");
    header("location: index.php");
    exit(0);
}

$userService=new UserService();
$user=$userService->getUserById($_SESSION["userId"]);

if(!$user->isSuperuser()){
    header("location: index.php");
    exit(0);
}

if(isset($_POST["wijzigFormUser"])){
    $klantId=$_POST["klantId"];
    $klantService=new UserService();
    $klant= $klantService->getUserById($klantId);
    include("presentation/userForm.php");
    exit(0);
}
