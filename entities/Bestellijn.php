<?php

class Bestellijn{
    private $bestellijnId;
    private $bestelId;
    private $pizzaId;
    private $aantal;
    private $lijnTotaal;
    private $pizzaNaam;
    private $pizzaPrijs;

    public function __construct($bestellijnId,$bestelId,$pizzaId, $aantal,$lijnTotaal,$pizzaNaam,$pizzaPrijs){
        $this->bestellijnId=$bestellijnId;
        $this->bestelId=$bestelId;
        $this->pizzaId=$pizzaId;
        $this->aantal=$aantal;
        $this->lijnTotaal=$lijnTotaal;
        $this->pizzaNaam=$pizzaNaam;
        $this->pizzaPrijs=$pizzaPrijs;
    }

    // getters
    public function  getBestellijnId(){
        return $this->bestellijnId;
    }
    public function  getBestelId(){
        return $this->bestelId;
    }
    public function  getPizzaId(){
        return $this->pizzaId;
    }
    public function  getAantal(){
        return $this->aantal;
    }
    public function  getLijnTotaal(){
        return $this->lijnTotaal;
    }
    public function  getPizzaNaam(){
        return $this->pizzaNaam;
    }
    public function  getPizzaPrijs(){
        return $this->pizzaPrijs;
    }
    // setters
    public function  setBestellijnId($bestellijnId){
        $this->bestellijnId=$bestellijnId;
    }
    public function  setBestelId($bestelId){
        $this->bestelId=$bestelId;
    }
    public function  setPizzaId($pizzaId){
        $this->pizzaId=$pizzaId;
    }
    public function  setAantal($aantal){
        $this->aantal=$aantal;
    }
    public function  setLijnTotaal($lijnTotaal){
        $this->lijnTotaal=$lijnTotaal;
    }
    public function setPizzaNaam($pizzaNaam){
        $this->pizzaNaam= $pizzaNaam;
    }
    public function setPizzaPrijs($pizzaPrijs){
        $this->pizzaPrijs=$pizzaPrijs;
    }
}
