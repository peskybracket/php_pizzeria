<?php

include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class IngredientDAO{

    public function getAlleIngredienten(){
        $sql="select ingredientId,naam from ingredienten order by naam asc";

        $db=DBConfig::getConnection();
        $resultSet=$db->query($sql);


        $ingredientenLijst=array();
        foreach ($resultSet as $rij) {
            $ingredient=new Ingredient($rij["ingredientId"],$rij["naam"]);

            array_push($ingredientenLijst,$ingredient);
        }

        return $ingredientenLijst;
    }
    public function insertIngredient($naam){
        $sql="insert into ingredienten(naam) values(?)";
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);

        $stmt->execute([$naam]);
    }
    public function deleteIngredient($ingredientId){
        $sql="delete from Ingredienten where ingredientId=:ingredientId";
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);

        $stmt->execute([":ingredientId"=>$ingredientId]);

    }

}
