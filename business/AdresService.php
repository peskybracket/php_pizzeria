<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class AdresService{
    public function isLeveringMogelijk($postcode){
        $adresDAO= new AdresDAO();
        return $adresDAO->isLeveringMogelijk($postcode);
    }

    public function getGemeente($gemeenteId){
        $adresDAO= new AdresDAO();
        return $adresDAO->getGemeente($gemeenteId);
    }
    public function getAllGemeentes(){
        $adresDAO= new AdresDAO();
        return $adresDAO->getAllGemeentes();
    }

    public function createAdres($straat,$huisnr,$bus,$postcode,$gemeente){
        $adresDAO= new AdresDAO();
        $gemeenteId=$adresDAO->gemeenteExists($postcode,$gemeente);
        if(!$gemeenteId){
            throw new GemeenteException();
        }
        print($gemeenteId);
        $adresId= $adresDAO->createAdres($straat,$huisnr,$bus,$gemeenteId);

        return $adresId;
    }
    public function insertGemeente($postcode,$gemeente,$isLeveringMogelijk){
        $adresDAO= new AdresDAO();
        $adresDAO->insertGemeente($postcode,$gemeente,$isLeveringMogelijk);
    }
    public function updateGemeente($gemeenteId,$postcode,$gemeente,$isLeveringMogelijk){
        $adresDAO= new AdresDAO();
        $adresDAO->updateGemeente($gemeenteId,$postcode,$gemeente,$isLeveringMogelijk);
    }
    public function deleteGemeente($id){
        $adresDAO= new AdresDAO();
        $adresDAO->deleteGemeente($id);
    }
}
