<?php
class User{
    private $id;
    private $email;
    private $naam;
    private $voornaam;
    private $telefoon;
    private $adres;
    private $tijdelijkeUser;
    private $superUser;
    private $korting;


    public function __construct($id,$email,$naam,$voornaam,$telefoon,$adres,$tijdelijkeUser,$superUser){
        $this->id=$id;
        $this->setEmail($email);
        $this->setNaam($naam);
        $this->setVoornaam($voornaam);
        $this->setTelefoon($telefoon);
        $this->setAdres($adres);
        $this->setTijdelijkeUser($tijdelijkeUser);
        $this->setSuperUser($superUser);
        $this->korting=0;
    }

    // getters
    public function getId(){
        return $this->id;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getNaam(){
        return $this->naam;
    }
    public function getVoornaam(){
        return $this->voornaam;
    }
    public function getTelefoon(){
        return $this->telefoon;
    }
    public function getAdresId(){
        return $this->adres->getId();
    }
    public function getStraat(){
        return $this->adres->getStraat();
    }
    public function getHuisnr(){
        return $this->adres->getHuisnr();
    }
    public function getBus(){
        return $this->adres->getBus();
    }
    public function getPostcode(){
        return $this->adres->getPostcode();
    }
    public function getGemeente(){
        return $this->adres->getGemeente();
    }
    public function getAdres(){
        return $this->adres;
    }

    public function heeftKorting(){
        return $this->korting;
    }
    public function isSuperUser(){
        return $this->superUser==1;
    }
    public function isTijdelijkeUser(){
        return $this->tijdelijkeUser==1;
    }
    //Setters
    public function setEmail($email){
        $this->email=$email;
    }
    public function setNaam($naam){
        $this->naam=$naam;
    }
    public function setVoornaam($voornaam){
        $this->voornaam=$voornaam;
    }
    public function setTelefoon($telefoon){
        $this->telefoon=$telefoon;
    }
    public function  setAdres($adres){
        $this->adres= $adres;
    }
    public function setSuperuser($superUser){
        $this->superUser=$superUser;
    }
    public function setTijdelijkeUser($tijdelijkeUser){
        $this->tijdelijkeUser=$tijdelijkeUser;
    }
    public function setKorting($korting){
        $this->korting=$korting;
    }
}
