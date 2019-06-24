<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");
?>


<section id="topMenu">
    <ul>
        <li id="productLink">Producten</li>
        <li id="klantLink">Klanten</li>
        <li id="gemeenteLink">Gemeentes</li>
        <li id="ingredientLink">Ingredienten</li>
    </ul>
</section>
<section id="productSection" class="config">
   <h1>Producten</h1>
    <form action="objectController.php" method="post">
        <input type="text" name="object" value="pizza" hidden>
        <input type="submit" name="toonForm" value="Pizza toevoegen">
    </form>
     <table>
        <thead>
            <th class="hidden">Id</th>
            <th>Naam</th>
            <th>Omschrijving</th>
            <th>Prijs(€)</th>
            <th>Promo prijs(€)</th>
        </thead>
        <tbody>
    <?php
        $pizzaService= new PizzaService();
        $pizzaLijst= $pizzaService->getAllPizzas();

    foreach($pizzaLijst as $pizza){ ?>
        <tr>
            <td class="hidden"><?php print($pizza->getId()); ?> </td>
            <td> <?php print($pizza->getNaam()); ?> </td>
            <td> <?php print($pizza->getOmschr());?> </td>
            <td> <?php print($pizza->getPrijs()); ?></td>
            <td> <?php print($pizza->getPromoPrijs()); ?></td>
            <td>
                <form action="objectController.php" method="post">
                    <input type="text" name="object"
                           value="pizza" hidden>
                    <input type="text" name="pizzaId" value="<?php print($pizza->getId()); ?>" hidden>
                    <input type="submit" name="toonForm" value="Wijzig">
                </form>
            </td>
        </tr>
   <?php } ?>
        </tbody>
        </table>

</section>
<section id="klantSection" class="config">
   <h1>Klanten</h1>
        <table>
        <thead>
            <th class="hidden">Id</th>
            <th>Naam</th>
            <th>Voornaam</th>
            <th>Superuser</th>
            <th>Tijdelijke user</th>
            <th> Beheer</th>
        </thead>
        <tbody>
    <?php
        $userService= new UserService();
        $userLijst= $userService->getAllUsers();

    foreach($userLijst as $userObject){ ?>
        <tr>
            <td> <?php print($userObject->getNaam()); ?>
            <td> <?php print($userObject->getVoornaam()); ?></td>
            <td> <?php print($userObject->isSuperUser()); ?></td>
            <td> <?php print($userObject->isTijdelijkeUser()); ?></td>
             <td>
                <form action="objectController.php" method="post">
                      <input type="text" name="object"
                           value="user" hidden>
                    <input type="text" name="klantId" value="<?php print($userObject->getId()); ?>" hidden>
                    <input type="submit" name="toonForm" value="Wijzig">
                </form>
            </td>
        </tr>
   <?php } ?>
        </tbody>
        </table>
</section>
<section id="gemeenteSection" class="config">
   <h1>Gemeentes</h1>

    <form action="objectController.php" method="post">
        <input type="text" name="object" value="gemeente" hidden>
        <input type="submit" name="toonForm" value="Gemeente toevoegen">
    </form>


          <table>
        <thead>
            <th class="hidden">Id</th>
            <th>Postcode</th>
            <th>Naam</th>
            <th>Leverbaar</th>
            <th>Beheer</th>
        </thead>
        <tbody>
    <?php
        $adresService= new AdresService();
        $gemeenteLijst= $adresService->getAllGemeentes();

    foreach($gemeenteLijst as $gemeente){ ?>
        <tr>
            <td class="hidden"> <?php print($gemeente->getId()); ?></td>
            <td> <?php print($gemeente->getPostcode()); ?></td>
            <td> <?php print($gemeente->getNaam()); ?> </td>
            <td> <?php if($gemeente->isLeveringMogelijk()){print("ja");}; ?></td>
            <td>
                <form action="objectController.php" method="post">
                    <input type="text" name="object"
                           value="gemeente" hidden>
                    <input type="text" name="gemeenteId" value="<?php print($gemeente->getId()); ?>" hidden>
                    <input type="submit" name="toonForm" value="Wijzig">
                </form>
            </td>
        </tr>
   <?php } ?>
        </tbody>
        </table>
</section>
<section id="ingredientSection" class="config">
   <h1>Ingredienten</h1>
       <form action="objectController.php" method="post">
        <input type="text" name="object" value="ingredient" hidden>
        <input type="text" name="naam" value="" >
        <input type="submit" name="insertEntity" value="Ingredient toevoegen">
    </form>


          <table>
        <thead>
            <th class="hidden">Id</th>
            <th>Naam</th>
        </thead>
        <tbody>
    <?php
        $ingredientService= new IngredientService();
        $ingredientLijst= $ingredientService->getAlleIngredienten();

    foreach($ingredientLijst as $ingredient){ ?>
        <tr>
            <td class="hidden"> <?php print($ingredient->getId()); ?></td>
            <td> <?php print($ingredient->getNaam()); ?></td>
           <!-- <td>
                <form action="objectController.php" method="post">
                    <input type="text" name="object"
                           value="ingredient" hidden>
                    <input type="text" name="ingredientId" value="< ?php print($ingredient->getId()); ?>" hidden>
                    <input type="submit" name="deleteEntity" value="Verwijder">
                </form>
            </td>-->
        </tr>
   <?php } ?>
        </tbody>
        </table>
</section>
