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
    <link href="resources/stylesheet.css" rel="stylesheet" >
</head>
<body>

<div id="loginFormWrapper" class="cf">
    <form id="loginForm" method="post" name="loginForm" action="index.php?stage=payment&action=login">
        <div class="row">
            <div class="col"><label for="email">Naam</label> </div>
           <div class="col"> <input name="email" id="email" placeholder="e-mail"  value="<?php if(isset($email)){print($email);} ?>" type="text" required> </div>
        </div>
        <div class="row">
           <div class="col"><label for="paswoord" >Wachtwoord</label> </div>
           <div class="col"><input name="paswoord"  type="password" required> </div>
            <?php
                if(isset($loginError)&&$loginError){
                    ?>
                    <div><span class="error" >Foutieve gebruikersnaam en/of wachtwoord!</span></div>
            <?php
                    unset($loginError);
                }
            ?>
        </div>

        <div class="row">
            <div class="col"><input name="loginButton" type="submit" value="Log in"></div>
        </div>
    </form>
</div>
<div id="joinFormWrapper" class="cf">
    <form id="joinForm" method="post" name="joinForm" action="index.php?stage=payment">
        <div class="row">
            <div class="col"><label  for="naam" >Naam</label></div>
            <div class="col"><input name="naam" type="text" value="<?php print($naam); ?>" required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="voornaam" >Voornaam</label></div>
            <div class="col"><input name="voornaam" type="text" value="<?php print($voornaam); ?>" required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="telefoon" >Telefoon</label></div>
            <div class="col"> <input name="telefoon" type="text" value="<?php print($telefoon); ?>"  required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="straat" >Straat</label></div>
            <div class="col"> <input name="straat" type="text" value="<?php print($straat); ?>"  required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="huisnr" >Huisnummer</label></div>
            <div class="col"><input name="huisnr" type="text" value="<?php print($huisnr); ?>"  required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="bus" >Bus</label></div>
            <div class="col"><input name="bus" type="text" value="<?php print($bus); ?>" ></div>
        </div>
        <div class="row">
            <div class="col"><label  for="postcode" >Postcode</label></div>
            <div class="col"><input name="postcode" type="text" value="<?php print($postcode); ?>"  required></div>
        </div>
        <div class="row">
            <div class="col"><label  for="gemeente" >Gemeente</label></div>
            <div class="col"><input name="gemeente" type="text" value="<?php print($gemeente); ?>"  required>
            <?php
                if(isset($gemeenteError)){?>
                    <span class="error">Foutieve gemeente/postcode</span></div>
                <?php unset($gemeenteError);} ?>
        </div>
        <div class="row">
            <div class="col"><label  for="createAccount" >Account aanmaken</label></div>
            <div class="col"><input name="createAccount" id="createAccount" type="checkbox"></div>
        </div>

        <div class="row">
            <div class="col"><label  for="email" class="showOnJoin">e-mail</label></div>
            <div class="col"><input name="email" class="showOnJoin" type="text"></div>
        </div>
        <div class="row">
            <div class="col"><label  for="paswoord" class="showOnJoin">Wachtwoord</label></div>
            <div class="col"><input name="paswoord" class="showOnJoin"  type="password"></div>
         </div>
        <div class="row">
            <div id="confirmButton" class="col hideOnJoin"><input name="noJoinButton" type="submit" value="Bevestig"></div>
            <div id="joinButton" class="showOnJoin" class="col"><input name="joinButton" type="submit" value="Maak account"></div>
        </div>
    </form>
</div>
