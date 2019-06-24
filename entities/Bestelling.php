<?php

class Bestelling{
    private $bestelId;
    private $userId;
    private $totaalPrijs;
    private $orderTime;
    private $bestellijnen;

    public function __construct($bestelId,$userId,$totaalPrijs,$orderTime){
        $this->bestelId = $bestelId;
        $this->userId = $userId;
        $this->totaalPrijs = $totaalPrijs;
        $this->orderTime = $orderTime;
        $this->bestellijnen=array();
    }
    ///// GETTERS
    public function getId(){
        return $this->bestelId;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getTotaalPrijs(){
        return $this->totaalPrijs;
    }
    public function getOrderTime(){
        return $this->orderTime;
    }
    public function getBestellijnen(){
        return $this->bestellijnen;
    }
    //// SETTERS
    public function setBestelId($bestelId){
        $this->bestelId=$bestelId;
    }
    public function setUserId($userId){
        $this->userId=$userId;
    }
    public function setTotaalPrijs($totaalPrijs){
        $this->totaalPrijs=$totaalPrijs;
    }
    public function setOrderTime($orderTime){
        $this->orderTime=$orderTime;
    }
    public function setBestellijnen($bestellijnen){
        $this->bestellijnen=$bestellijnen;
    }
}
