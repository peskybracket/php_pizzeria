<?php

class Ingredient{
    private $ingredientId;
    private $naam;

    public function __construct($ingredientId,$naam){
        $this->ingredientId=$ingredientId;
        $this->naam=$naam;
    }

    public function getId(){
        return $this->ingredientId;
    }
    public function getNaam(){
        return $this->naam;
    }

    public function setNaam($naam){
        $this->naam=$naam;
    }
}
