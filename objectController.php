<?php
if(!isset($_SESSION)){
    session_start();
}
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

if(!isset($_SESSION["userId"])){
    print("geen sessie");
    header("location: index.php");
    exit(0);
}

$userService=new UserService();
$user=$userService->getUser($_SESSION["userId"]);

if(!$user->isSuperuser()){
    header("location: index.php");
    exit(0);
}
if(isset($_POST["annuleerWijziging"])){
    header("location: index.php?action=config");
    exit(0);
}


$objectNaam="";
if(isset($_POST["object"])){
    $objectNaam=$_POST["object"];
}

// toont het formulier vd entiteiten, indien een POST-variabele wordt gevonden,
// wordt het object opgehaald en ingevuld in het formulier
if(isset($_POST["toonForm"])){
    if($objectNaam=="gemeente"){
        if(isset($_POST["gemeenteId"])){
            $adresService= new AdresService();
            $gemeente=$adresService->getGemeente($_POST["gemeenteId"]);
        }
    }elseif($objectNaam=="pizza"){
        if(isset($_POST["pizzaId"])){
            $pizzaService= new PizzaService();
            $pizza=$pizzaService->getPizza($_POST["pizzaId"]);
        }
    }elseif($objectNaam=="user"){
        if(isset($_POST["klantId"])){
            $userService= new UserService();
            $formUser=$userService->getUser($_POST["klantId"]);
        }
    }
    include("presentation/toonHeader.php");
    include("presentation/".$objectNaam."Form.php");
    include("presentation/toonFooter.php");
    exit(0);
}elseif(isset($_POST["insertEntity"])){
    if($objectNaam=="gemeente"){
        $adresService= new AdresService();
        $adresService->insertGemeente(
                        $_POST["postcode"],
                        $_POST["gemeenteNaam"],
                        $_POST["isLeveringMogelijk"]);
    }elseif($objectNaam=="pizza"){
        $pizzaService= new PizzaService();
        $pizzaService->insertPizza($_POST["pizzaNaam"],
                        $_POST["pizzaOmschr"],
                        $_POST["pizzaPrijs"]);
    }elseif($objectNaam=="ingredient"){
        $ingredientService= new IngredientService();
        $ingredientService->insertIngredient($_POST["naam"]);
    }
}elseif(isset($_POST["updateEntity"])){
    if($objectNaam=="gemeente"){
        $adresService= new AdresService();
        $adresService->updateGemeente($_POST["gemeenteId"],
                        $_POST["postcode"],
                        $_POST["gemeenteNaam"],
                        $_POST["isLeveringMogelijk"]);
    }elseif($objectNaam=="pizza"){
        $pizzaService= new PizzaService();
        $pizzaService->updatePizza($_POST["pizzaId"],
                        $_POST["pizzaNaam"],
                        $_POST["pizzaOmschr"],
                        $_POST["pizzaPrijs"],
                        $_POST["pizzaPromoPrijs"]);

        $pizzaService->updatePizzaIngredienten($_POST["pizzaId"], $_COOKIE["pizzaIngredienten"]);
    }elseif($objectNaam=="user"){
        $userService= new UserService();
        $userService->updateUser($_POST["userId"],
                        $_POST["naam"],
                        $_POST["voornaam"],
                        $_POST["isSuperUser"],
                        $_POST["isTijdelijkeUser"],
                        $_POST["heeftKorting"]);

    }

}elseif(isset($_POST["deleteEntity"])){
    if($objectNaam=="gemeente"){
        $adresService= new AdresService();
        $adresService->deleteGemeente($_POST["gemeenteId"]);
    }elseif($objectNaam=="pizza"){
        $pizzaService= new PizzaService();
        $pizzaService->deletePizza($_POST["pizzaId"]);
    }elseif($objectNaam=="ingredient"){
        $ingredientService= new IngredientService();
        $ingredientService->deleteIngredient($_POST["ingredientId"]);
    }elseif($objectNaam=="user"){
        $userService= new UserService();
        $userService->deleteUser($_POST["userId"]);
    }
}
header("location: index.php?action=config");
