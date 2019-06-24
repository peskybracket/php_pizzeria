<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class PizzaService{
    public function getAllPizzas(){
        $pizzaDAO= new PizzaDAO();
        return $pizzaDAO->getAllPizzas();
    }
    public function getPizza($pizzaId){
        $pizzaDAO= new PizzaDAO();
        return $pizzaDAO->getPizza($pizzaId);
    }

    public function insertPizza($naam,$omschr,$prijs){
        $pizzaDAO= new PizzaDAO();
        $pizzaDAO->insertPizza($naam,$omschr,$prijs);
    }
    public function updatePizza($id,$naam,$omschr,$prijs,$promoprijs){
        $pizzaDAO= new PizzaDAO();
        $pizzaDAO->updatePizza($id,$naam,$omschr,$prijs,$promoprijs);
    }
    public function deletePizza($id){
        $pizzaDAO= new PizzaDAO();
        $pizzaDAO->deletePizza($id);
    }
    public function updatePizzaIngredienten($id,$ingredienten){
        $pizzaDAO= new PizzaDAO();
        $pizzaDAO->deletePizzaIngredienten($id);
        $pizzaDAO->insertPizzaIngredienten($id,$ingredienten);
    }
    public function getAlleIngredienten(){
        $pizzaDAO= new PizzaDAO();
        return $pizzaDAO->getAlleIngredienten();
    }
    public function getPizzaIngredienten($id){
        $pizza=$this->getPizza();

        return $pizza->getIngredienten();
    }

}
