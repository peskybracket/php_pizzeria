<?php
class PizzaIngredient{
    private $ingredientId;
    private $pizzaId;
    private $naam;
    private $heeftIngredient;

    public function __construct($ingredientId,$pizzaId,$naam, $heeftIngredient ){
        $this->ingredientId=$ingredientId;
        $this->pizzaId=$pizzaId;
        $this->setNaam($naam);
        $this->setHeeftIngredient($heeftIngredient);
    }

    // getters
    public function getId(){
        return $this->ingredientId;
    }
    public function getNaam(){
        return $this->naam;
    }

    //Setters
    public function setNaam($naam){
        $this->naam=$naam;
    }
    public function heeftIngredient(){
        return $this->heeftIngredient;
    }
    //Setters
    public function setHeeftIngredient($heeftIngredient){
        $this->heeftIngredient=$heeftIngredient;
    }
}
