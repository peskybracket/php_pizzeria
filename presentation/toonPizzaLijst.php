<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");
?>

<h1>Pizzalijst</h1>


<section id="mainSection">
    <table id="pizzaTable">
        <thead>
            <th class="hidden">Id</th>
            <th>Naam</th>
            <th>Omschrijving</th>
            <th>Prijs</th>
        </thead>
        <tbody>
     <?php
        $pizzaService=new PizzaService();
        $pizzaLijst= $pizzaService->getAllPizzas();
    foreach($pizzaLijst as $pizza){ ?>
        <tr><form action="index.php" method="post">
            <td class="hidden"> <?php print($pizza->getId()); ?> </td>
            <td> <?php print($pizza->getNaam()); ?>
                   <span class="showIngredients">Ingredienten</span>

                <ul class="hidden ingredientList">
                <?php
                   // ingredienten oplijsten
                     foreach($pizza->getIngredienten() as $ingredient){
                         print("<li>".$ingredient."</li>");
                     }
                ?>
                </ul>
            </td>
            <td> <?php print($pizza->getOmschr()); ?> </td>
            <td> <?php print($pizza->getPrijs()); ?> €
                <input type="text" class="hidden" name="pizzaId" value="<?php print($pizza->getId()); ?>">
            </td>
            <td>
                <input type="button" name="btnPlus" value="+">
                <input type="text" name="aantal" value="1" size="2" >
                <input type="button" name="btnMin" value="-">
                <input type="text"class="hidden" name="action" value="addPizza">
                <input type="submit"  value="Toevoegen">
            </td>
            </form>
        </tr>
   <?php } ?>
        </tbody>
        </table>
</section>
<section id="sideBarRight">
    <section>
        <table  id="winkelkar">
            <thead>
                <th class="hidden">id</th>
                <th>Pizza</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Lijntotaal</th>
            </thead>
            <tbody>
                <?php
                if(isset($_COOKIE["PHPSESSID"])){
                    $bestelService=new BestellingService();
                    $bestelling= $bestelService->getBestellingByKey($_COOKIE["PHPSESSID"]);

                    if($bestelling&&sizeof($bestelling->getBestellijnen())>0){
                        foreach($bestelling->getBestellijnen() as $bestellijn){ ?>
                            <tr>
                                <td> <?php print($bestellijn->getPizzaNaam()); ?></td>
                                <td> <?php print($bestellijn->getPizzaPrijs()); ?></td>
                                <td> <?php print($bestellijn->getAantal()); ?> </td>

                                <td class="priceField"> <?php print($bestellijn->getLijnTotaal()); ?></td>
                                <form action="index.php" method="post">
                                    <td>
                                        <input type="text" class="hidden" name="pizzaId" value="<?php print( $bestellijn->getPizzaId());?>">
                                        <input type="text" class="hidden" name="action" value="removePizza">
                                        <input type="submit" id="removeBtn" alt="verwijder" name="btnSubmit" value="x">
                                    </td>
                                </form>
                            </tr>
            <?php
                        }
            ?>
                        <tr>
                                <td colspan="3">Totaal:</td>
                                <td id="totalPriceField"></td>
                            </tr>
                        <tr>
                            <td colspan="2">
                                <form method="post" action="index.php">
                                    <input type="text" name="action" value="finalize" hidden>
                                    <input type="submit" value="Afrekenen">
                                </form>
                            </td>
                            <td colspan="2"></td>
                        </tr>
            <?php
                    }else{
            ?>
                            <tr id="legeRij">
                                <td colspan="4">Uw winkelkar is leeg.</td>
                            </tr>
            <?php
                    }
                }else{
            ?>
                    <tr id="legeRij">
                                <td colspan="4">Uw winkelkar is leeg.</td>
                            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </section>
</section>
