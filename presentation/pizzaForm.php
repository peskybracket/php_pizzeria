<?php
    $id="";
    $naam="";
    $omschr="";
    $prijs="";
    $promoprijs="";

    if(isset($_POST["pizzaId"])){
        $id=$_POST["pizzaId"];
        $pizzaService= new PizzaService();
        $pizza=$pizzaService->getPizza($id);
        $id=$pizza->getId();
        $naam=$pizza->getNaam();
        $omschr=$pizza->getOmschr();
        $prijs=$pizza->getPrijs();
        $promoprijs=$pizza->getPromoPrijs();

        $ingredientenLijst= $pizza->getIngredienten();
    }else{
        $pizzaService= new PizzaService();
        $ingredientenLijst= $pizzaService->getAlleIngredienten();
    }
?>
<table>
<form method="post" id="pizzaForm" name="pizzaForm" action="objectController.php" >
    <tr>
        <td><input type="text" name="object" value="pizza" hidden></td>
        <td><input name="pizzaId" type="hidden" value="<?php print($id); ?>"></td>
    </tr>
    <tr>
        <td><label for="pizzaNaam"></label>Naam</td>
        <td><input name="pizzaNaam" type="text" value="<?php print($naam); ?>"></td>
    </tr>
    <tr>
        <td><label for="pizzaOmschr"></label>Omschrijving</td>
        <td><textarea name="pizzaOmschr" type="text" rows="4" cols="40" ><?php print($omschr); ?></textarea></td>
    </tr>
    <tr>
        <td><label for="pizzaPrijs"></label>Prijs</td>
        <td><input name="pizzaPrijs" type="text" value="<?php print($prijs); ?>"></td>
    </tr>
    <tr>
        <td><label for="pizzaPromoPrijs"></label>PromoPrijs</td>
        <td><input name="pizzaPromoPrijs" type="text" value="<?php print($promoprijs); ?>"></td>
    </tr>
    <tr><td colspan="2">
        <ul id="pizzaIngredienten">
        <?php
            foreach($ingredientenLijst as $ingredient){ ?>
                <li  id="<?php print("ingredient".$ingredient->getId());?>"
                    class="pizzaIngredient
                    <?php if($ingredient->heeftIngredient()){print(" heeftIngredient");}?>" >


                    <?php
                        print($ingredient->getNaam());
                    ?>
                </li>
            <?php
            }
            ?>
        </ul>
        </td>
    </tr>
    <tr><td colspan="2">
    <input type="submit" name="annuleerWijziging" value="Annuleer">
    <?php
    if($id!=""){ ?>
        <input type="submit" name="updateEntity" value="Opslaan">
        <input type="submit" name="deleteEntity" value="Verwijder">
    <?php }else{ ?>
        <input type="submit" name="insertEntity" value="Toevoegen">
    <?php } ?>
        </td>
    </tr>
</form>
</table>
