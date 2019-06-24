<?php
ini_set('display_errors', 1);
/*include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");*/
?>
<div id="mainWrapper">


<section id="bestelHistoriek">
    <?php

        if(isset($user)){
            print("<h1>Historiek bestelling</h1>");
            print("<h6>Bestellingen geleverd werden.</h6>");
            $bestelService=new BestellingService();
            $bestellingLijst = $bestelService->getHistoriek($user->getId());

            foreach($bestellingLijst as $bestelling){
                include("toonBestelling.php");
            }
        }else{

            print("<h3>Geen bestellingen gevonden</h3>");
        }
    ?>

    </section>
</div>
