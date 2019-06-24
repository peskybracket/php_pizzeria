<?php
if(!isset($_SESSION)){
    session_start();
}
ini_set('display_errors', 1);
set_include_path($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv".DIRECTORY_SEPARATOR."presentation");
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

// redirects
if(isset($_GET["show"])){
    if($_GET["show"]=="toonPizzaLijst"){
        include("toonHeader.php");
        include("toonPizzaLijst.php");
        include("toonFooter.php");
        exit(0);
    }elseif($_GET["show"]=="toonHuidigeBestelling"){
        include("toonHeader.php");
        include("toonHuidigeBestelling.php");
        include("toonFooter.php");
        exit(0);
    }elseif($_GET["show"]=="toonHistoriek"){
        include("toonHeader.php");
        include("toonHistoriek.php");
        include("toonFooter.php");
        exit(0);
    }

}elseif(isset($_POST["action"])){
    if($_POST["action"]=="addPizza"){
        $bestelService= new BestellingService();
        $bestelId= $bestelService->createTempBestelling($_COOKIE["PHPSESSID"]);
        $bestelService->addPizza($bestelId,$_POST["pizzaId"],$_POST["aantal"]);
        $_SESSION["bestelId"]=$bestelId;
    }elseif($_POST["action"]=="removePizza"){
        $bestelService= new BestellingService();
        $bestelId=$_SESSION["bestelId"];
        $bestelService->removePizza($bestelId,$_POST["pizzaId"]);

    }elseif($_POST["action"]=="finalize"){

        if(isset($_SESSION["userId"])){
            $userDAO=new UserDAO();
            $user=$userDAO->getUser($_SESSION["userId"]);
            $bestelId=$_SESSION["bestelId"];
            if(!$user->isTijdelijkeUser()){
                include("toonHeader.php");
                include("toonBetalingsPagina.php");
                include("toonFooter.php");
                exit(0);
            }
        }

        $naam=getPOSTvariable("naam");
        $voornaam=getPOSTvariable("voornaam");
        $straat=getPOSTvariable("straat");
        $huisnr=getPOSTvariable("huisnr");
        $telefoon=getPOSTvariable("telefoon");
        $bus=getPOSTvariable("bus");
        $postcode=getPOSTvariable("postcode");
        $gemeente=getPOSTvariable("gemeente");
        $createAccount=getPOSTvariable("createAccount");
        include("toonFinalize.php");
        include("toonFooter.php");
        exit(0);

    }
}elseif(isset($_GET["stage"])&&$_GET["stage"]=="payment"){
    // fetch post variables
    $email=getPOSTvariable("email");
    $password=getPOSTvariable("paswoord");
    $naam=getPOSTvariable("naam");
    $voornaam=getPOSTvariable("voornaam");
    $straat=getPOSTvariable("straat");
    $huisnr=getPOSTvariable("huisnr");
    $telefoon=getPOSTvariable("telefoon");
    $bus=getPOSTvariable("bus");
    $postcode=getPOSTvariable("postcode");
    $gemeente=getPOSTvariable("gemeente");
    $createAccount=getPOSTvariable("createAccount");
///// LOGIN on PAYMENT
   if(isset($_GET["action"])){
       if($_GET["action"]=="login"){
        $userService=new UserService();
        try{
            //throws error if wrong credentials
            $userService->credentialsCorrect($email,$password);

            $user= $userService->getUserIdByEmail($email);
            $_SESSION["userId"]=$user->getId();
            $_SESSION["userNaam"]=$user->getNaam();

            setcookie("emailadres",$email,time()+60*60*24*30);

            $bestelService=new BestellingService();
            $bestelling=$bestelService->getHuidigeBestelling($user->getId());
            $bestelId=$bestelling->getId();

            include("toonHeader.php");
            include("toonBetalingsPagina.php");
            include("toonFooter.php");
            exit(0);
        } catch(CredentialException $ex){
            $loginError=true;
            include("toonFinalize.php");
            include("toonFooter.php");
            exit(0);
        }
       }
   //    }elseif($_GET["action"]=="join"){
    }else{
    ///////// ANONYMOUS USER on PAYMENT
        try{
            // user + adres aanmaken
            $adresService=new AdresService();
            $adresId=$adresService->createAdres($straat,$huisnr,$bus,$postcode,$gemeente);

            $userService=new UserService();

            $bestelService= new BestellingService();
            $bestelId=$bestelService->getBestellingIdByKey($_COOKIE["PHPSESSID"]);

            if(isset($_POST["joinButton"])){
                //create new user
                $email=getPOSTvariable("email");
                $paswoord=getPOSTvariable("paswoord");
                $userId=$userService->createUser($email,$naam,$voornaam,$telefoon,$paswoord,$adresId);

                $_SESSION["userId"]=$userId;
                $bestelService->setBestellingUser($bestelId,$userId);
            }else{ //nojoinButton
                //create temp user
                $userId=$userService->createTempUser($naam,$voornaam,$adresId);
                $_SESSION["userId"]=$userId;
                $bestelService->setBestellingUser($bestelId,$userId);
            }
            $bestelService->finalizeBestelling($bestelId);
        }catch(CredentialException $ex){
            $loginError=true;
            include("toonFinalize.php");
            include("toonFooter.php");
            exit(0);
        }catch(GemeenteException $ex){
            $gemeenteError=true;
            include("toonFinalize.php");
            include("toonFooter.php");
            exit(0);
        }
        $user=$userService->getUser($userId);
        if(!$user->isTijdelijkeUser()){
            include("toonHeader.php");
            include("toonBetalingsPagina.php");
            include("toonFooter.php");
            exit(0);
        }
   }// einde stage=payment
    exit(0);
 }elseif(isset($_GET["action"])){
    if($_GET["action"]=="config"){
        if(isset($_SESSION["userId"])){
            include("toonHeader.php");
            include("toonConfig.php");
            include("toonFooter.php");
            exit(0);
        }
    }elseif($_GET["action"]=="login"){

        $email=getPOSTvariable("email");
        $password=getPOSTvariable("paswoord");

        $userService=new UserService();
        try{
            //throws error if wrong credentials
            $userService->credentialsCorrect($email,$password);

            $user= $userService->getUserIdByEmail($email);
            $_SESSION["userId"]=$user->getId();
            $_SESSION["userNaam"]=$user->getNaam();

            setcookie("emailadres",$email,time()+60*60*24*30);
            if(isset($_GET["stage"])){
                if($_GET["stage"]=="payment"){

                    include("toonHeader.php");
                    include("toonBestelOverzicht.php");
                    include("toonFooter.php");
                    exit(0);
                }
            }


        } catch(CredentialException $ex){
            $loginError=true;
        }

    }elseif($_GET["action"]=="logout"){
        unset($_SESSION["userNaam"]);
        unset($_SESSION["userId"]);
    }
}

include("toonHeader.php");
include("toonPizzaLijst.php");
include("toonFooter.php");
exit(0);

function getPOSTvariable($varname){
    if(isset($_POST[$varname])){
        return trim(htmlspecialchars($_POST[$varname]));
    }else{
        return "";
    }
}
