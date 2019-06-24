<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class IngredientService{
    public function getAlleIngredienten(){
        $ingredientDAO= new IngredientDAO();
        return $ingredientDAO->getAlleIngredienten();
    }

    public function insertIngredient($naam){
        $ingredientDAO= new IngredientDAO();
        $ingredientDAO->insertIngredient($naam);
    }
    public function deleteIngredient($id){
        $ingredientDAO= new IngredientDAO();
        $ingredientDAO->deleteIngredient($id);
    }
}
