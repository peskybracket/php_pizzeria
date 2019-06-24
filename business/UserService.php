<?php
ini_set('display_errors', 1);
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class UserService{
    public function getUser($id){
        $userDAO= new UserDAO();
        return $userDAO->getUser($id);
    }
    public function getUserIdByEmail($email){
        $userDAO= new UserDAO();
        return $userDAO->getUserIdByEmail($email);
    }
    public function getAllUsers(){
        $userDAO= new UserDAO();
        return $userDAO->getAllUsers();
    }

    public function credentialsCorrect($username,$password){
    /** controleert of user bestaat en of het paswoord overeenkomt
        geeft userId terug indien ok, anders Exception**/

        $userDAO= new UserDAO();
        if(!$userDAO->credentialsCorrect($username,$password)){
            throw new CredentialException();
        }
        return true;
    }
    public function getUserAdres($id){
        $userDAO= new UserDAO();
        return $userDAO->getAdresOfUser($id);
    }
    public function deleteUser($id){
        $userDAO= new UserDAO();
        return $userDAO->deleteUser($id);
    }

    public function isLeverGemeente($postcode){
        $userDAO= new UserDAO();
        return $userDAO->isLeverGemeente($postcode);
    }

    public function createUser($email,$naam,$voornaam,$telefoon,$password,$adresId){
        $userDAO= new UserDAO();
        return $userDAO->createUser($email,$naam,$voornaam,$telefoon,$password,$adresId);
    }
    public function createTempUser($naam,$voornaam,$adresId){
        $userDAO= new UserDAO();
        return $userDAO->createTempUser($naam,$voornaam,$adresId);
    }
    public function updateUser($id,$naam,$voornaam,$isSuperUser,$isTijdelijkeUser,$heeftKorting){
        $userDAO= new UserDAO();
        $userDAO->updateUser($id,$naam,$voornaam,$isSuperUser,$isTijdelijkeUser,$heeftKorting);
    }
}
