<?php
ini_set('display_errors', 1);
/*include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");*/
?>
<div id="mainWrapper">


<section id="bestelOverzicht">
    <?php

        if(isset($user)){
            print("<h1>Huidige bestelling</h1>");
            print("<h6>Bestellingen die afgesloten zijn, maar nog niet geleverd.</h6>");
            $bestelService=new BestellingService();
            $bestelling = $bestelService->getHuidigeBestelling($user->getId());
            include("toonBestelling.php");
        }elseif(isset($_COOKIE["PHPSESSID"])){
            $bestelService=new BestellingService();
            $bestelling=$bestelService->getBestellingByKey($_COOKIE["PHPSESSID"]);
            include("toonBestelling.php");
        }else{

            print("<h1>U heeft momenteel geen openstaande bestelling</h1>");
        }
    ?>

    </section>
    <section>
    <?php
        if(isset($user)){
            print("<h1>Leveradres</h1>");
            print("<p>Straat: ".$user->getStraat()." ".$user->getHuisnr()."</p>");
            print("<p>Gemeente: ".$user->getPostcode()." ".$user->getGemeente()."</p>");

            if($user->getAdres()->isLeveringMogelijk()){
                print("<h2>Uw bestelling wordt geleverd!</h2>");
            }else{
                print("<h2 class=\"error\">Uw bestelling wordt NIET geleverd! (Gemeente buiten bereik)</h2>");
            }
        }
    ?>
    </section>
</div>
