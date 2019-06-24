<?php
class Adres{
 //   private $id;
    private $straat;
    private $huisnr;
    private $bus;
    private $gemeente;

    public function __construct(//$id,
        $straat,$huisnr,$bus,$gemeente){
        $this->setStraat($straat);
        $this->setHuisnr($huisnr);
        $this->setBus($bus);
        $this->setGemeente($gemeente);
    }

    // getters
    public function getStraat(){
        return $this->straat;
    }
    public function getHuisnr(){
        return $this->huisnr;
    }
    public function getBus(){
        return $this->bus;
    }
    public function getPostcode(){
        return $this->gemeente->getPostcode();
    }
    public function getGemeente(){
        return $this->gemeente->getNaam();
    }
    public function isLeveringMogelijk(){
        return $this->gemeente->isLeveringMogelijk();
    }

    //Setters
    public function setStraat($straat){
        $this->straat=$straat;
    }
    public function setHuisnr($huisnr){
        $this->huisnr=$huisnr;
    }
    public function setBus($bus){
        $this->bus=$bus;
    }
    public function setPostcode($postcode){
        $this->postcode=$postcode;
    }
    public function setGemeente($gemeente){
        $this->gemeente=$gemeente;
    }
}
