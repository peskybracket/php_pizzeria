<div id="mainWrapper">

    <h1>Afrekenen</h1>
<section id="bestelOverzicht">
    <?php
        if(isset($user)){
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
        //if(isset($_COOKIE["PHPSESSID"])){
    /*    if(isset($_SESSION["userId"])){
            $bestelService=new BestellingService();
            $bestelling = $bestelService->getHuidigeBestelling($_SESSION["userId"]);
            include("toonBestelling.php");
        }*/
    ?>

    </section>
     <section>
         <h1>Leveradres</h1>
    <?php
        if(isset($user)){
            print("<h1>Leveradres</h1>");
            print("<p>Straat: ".$user->getStraat()." ".$user->getHuisnr()."</p>");
            print("<p>Gemeente: ".$user->getPostcode()." ".$user->getGemeente()."</p>");

            if($user->getAdres()->isLeveringMogelijk()){
                print("<h2>Uw bestelling wordt geleverd!</h2>");
            }else{
                print("<h2 class=\"error\">Uw bestelling wordt NIET geleverd!</h2>");
            }
        }
    ?>
    </section>
</div>
