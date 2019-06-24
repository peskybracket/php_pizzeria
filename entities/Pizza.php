<?php
class Pizza{
    private $id;
    private $naam;
    private $omschr;
    private $prijs;
    private $ingredienten;
    private $promoprijs;

    public function __construct($id,$naam,$omschr,$prijs){
        $this->id=$id;
        $this->setNaam($naam);
        $this->setOmschr($omschr);
        $this->setPrijs($prijs);
        $this->setPromoPrijs($prijs);
    }

    // getters
    public function getId(){
        return $this->id;
    }
    public function getNaam(){
        return $this->naam;
    }
    public function getOmschr(){
        return $this->omschr;
    }
    public function getPrijs(){
        return $this->prijs;
    }
    public function getPromoPrijs(){
        return $this->promoprijs;
    }
    public function getIngredienten(){
        return $this->ingredienten;
    }
    //Setters
    public function setNaam($naam){
        $this->naam=$naam;
    }
    public function setOmschr($omschr){
        $this->omschr=$omschr;
    }
    public function setPromoPrijs($promoprijs){
        $this->promoprijs=$promoprijs;
    }
    public function setPrijs($prijs){
        $this->prijs=$prijs;
    }
    public function setIngredienten($ingredienten){
        return $this->ingredienten=$ingredienten;
    }
}
