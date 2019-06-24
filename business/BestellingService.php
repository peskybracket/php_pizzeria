<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class BestellingService{
    public function createTempBestelling($key){
        $bestelDAO= new BestelDAO();

        $bestelId=$bestelDAO->bestaatBestellingKey($key);

        if($bestelId==-1){
            //creeer nieuwe bestelling
            $bestelId= $bestelDAO->createTempBestelling($key);
        }

        return $bestelId;
    }
    public function addPizza($id,$pizzaId,$aantal){
        $bestelDAO= new BestelDAO();
        if(!$bestelDAO->bestaatBestellingId($id)){
            $bestelDAO->createTempBestelling($key);
        }
        if($bestelDAO->bestellingBevatPizzaId($id,$pizzaId)){
            $bestelDAO->updateBestellingPizza($id,$pizzaId,$aantal);
        }else{
            $bestelDAO->insertBestellingPizza($id,$pizzaId,$aantal);
        }

    }
    public function removePizza($id,$pizzaId){
        $bestelDAO= new BestelDAO();
        $bestelDAO->removePizza($id,$pizzaId);
    }

    public function getBestelling($id){
        $bestelDAO= new BestelDAO();
        return $bestelDAO->getBestelling($id);
    }
    /*
    public function getBestellijnenByKey($key){
        $bestelDAO= new BestelDAO();
        $bestelId= $this->getBestellingIdByKey($key);
        return $bestelDAO->getBestelLijnen($bestelId);
    }*/
    public function getBestellingIdByKey($key){
        $bestelDAO= new BestelDAO();
        return $bestelDAO->getBestellingId($key);
    }
    public function getBestellingByKey($key){
        $bestelDAO= new BestelDAO();
        return $bestelDAO->getBestelling($this->getBestellingIdByKey($key));
    }
    public function setBestellingUser($bestelId,$userId){
        $bestelDAO= new BestelDAO();
        $bestelId= $bestelDAO->setBestellingUser($bestelId,$userId);
    }
    public function finalizeBestelling($bestelId){
        $bestelDAO= new BestelDAO();
        $bestelId= $bestelDAO->finalizeBestelling($bestelId);
    }/*
    public function setBestellingAdres($bestelId,$adresId){
        $bestelDAO= new BestelDAO();
        $bestelId= $bestelDAO->setBestellingAdres($bestelId,$adresId);
    }*/
    public function getBestelAdres($bestelId){
        $bestelDAO= new BestelDAO();
        $adresDAO=new AdresDAO();
        $adres= $adresDAO->getAdresById($bestelDAO->getBestelAdrescode($bestelId));
        return $adres;
    }
    public function getHuidigeBestelling($userId){
        $bestelDAO= new BestelDAO();
        return $bestelDAO->getHuidigeBestelling($userId);
    }
    public function getHistoriek($userId){
        $bestelDAO= new BestelDAO();
        return $bestelDAO->getHistoriek($userId);
    }
}
