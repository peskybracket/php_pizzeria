<div id="betaalDiv">
<?php
/***
variable $bestelling moet een bestelling-object bevatten!!
***/


    print("Huidige bestelling: ID=".$bestelId);

   $bestelDAO=new BestelDAO();
    $bestelling=$bestelDAO->getBestelling($bestelId);

    print("te betalen: ".$bestelling->getTotaalPrijs());
?>
<button id="betaalKnop">Doe betaling</button>

    </div>
<a href="index.php">Terug naar homepage</a>
