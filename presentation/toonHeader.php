<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");
?>
<!DOCTYPE HTML>
<!-- presentation/toonGastenboek.php -->
<html>

<head>
    <meta charset=utf-8>
    <title></title>
    <link rel="shortcut icon" type="image/png" href="resources/pizza_logo.png"/>
    <link href="resources/stylesheet.css" rel="stylesheet" >
</head>
<body>
<header>
   <!-- <img id="siteLogo" src="resources/pizzabanner.jpg">-->
    </header>
<?php

    if(isset($_SESSION["userId"])){
        $userService=new UserService();
        $user=$userService->getUser($_SESSION["userId"]);?>
        <?php if(!$user->isTijdelijkeUser()){
    ?>
        <p>Welkom, <?php print($user->getVoornaam()." ".$user->getNaam()."(".$user->getId().")"); ?></p>
            <p><a href="index.php?action=logout" id="logout">Logout</a></p>
    <?php } ?>
  <?php
        if($user->isSuperuser()){
            if(!isset($_GET["action"])||$_GET["action"]!="config"){
                print("<a href=\"index.php?action=config\">Beheer</a>");
            }
        }
    }else{

        include("loginForm.php");
    ?>
        <p>Welkom, gast</p>
    <?php
    }
?>
    <nav>
        <a href="index.php?show=toonPizzaLijst">Overzicht pizza's</a>
    <?php if(isset($user)&&!$user->isTijdelijkeUser()){ ?>
        <a href="index.php?show=toonHuidigeBestelling">Huidige bestelling</a>
        <a href="index.php?show=toonHistoriek">Historiek bestellingen</a>
    <?php   } ?>
    </nav>
