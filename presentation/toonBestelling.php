<?php
/***
variable $bestelling moet een bestelling-object bevatten!!
***/

if($bestelling){
    print("Huidige bestelling: ID=".$bestelling->getId()); ?>
    <table>
        <thead>
            <th class="hidden">id</th>
            <th>Pizza</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Lijntotaal</th>
        </thead>
        <tbody>
            <?php

                foreach($bestelling->getBestellijnen() as $bestellijn){ ?>
                    <tr>
                        <td> <?php print($bestellijn->getPizzaNaam()); ?></td>
                        <td> <?php print($bestellijn->getPizzaPrijs()); ?></td>
                        <td> <?php print($bestellijn->getAantal()); ?></td>
                        <td class="priceField"> <?php print($bestellijn->getLijnTotaal()); ?></td>
                    </tr>
    <?php
                }
    ?>
                    <tr>
                        <td colspan="3">Totaal:</td>
                        <td id="totalPriceField"><?php print($bestelling->getTotaalPrijs()); ?></td>
                    </tr>
        </tbody>
    </table>
<?php
}else{
    print("geen bestelling gevonden");
}
?>
