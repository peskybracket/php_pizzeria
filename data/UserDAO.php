<?php
// data/UserDAO
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class UserDAO{

    public function getUser($id){
        $sql="select userId,email,naam,voornaam,telefoon,adresId,superuser,isTijdelijkeUser,korting from users where userId= :id";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":id"=>$id]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $adresDAO=new AdresDAO();
        $adres= $adresDAO->getAdresById($rij["adresId"]);
        $user= new User($rij["userId"],$rij["email"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$adres,
                          $rij["isTijdelijkeUser"],$rij["superuser"]);

        $user->setKorting($rij["korting"]);
        return $user;
    }
    public function getAllUsers(){
        $sql="select userId,email,naam,voornaam,telefoon,adresId,superuser,isTijdelijkeUser from users";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $userList=array();
        foreach($resultSet as $rij){
             $adresDAO=new AdresDAO();
            $adres= $adresDAO->getAdresById($rij["adresId"]);
            $user= new User($rij["userId"],$rij["email"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$adres,
                              $rij["isTijdelijkeUser"],$rij["superuser"]);
            array_push($userList,$user);
        }

        return $userList;
    }
    public function createUser($email,$naam,$voornaam,$telefoon,$password,$adresId){
        $sql="insert into users(naam,voornaam,telefoon,paswoord,email,adresId) "
            ." values(:naam,:voornaam,:telefoon,:paswoord,:email,:adresId);";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":naam"=>$naam,
                        ":voornaam"=>$voornaam,
                        ":telefoon"=>$telefoon,
                        ":paswoord"=>md5($email.$password),
                        ":email"=>$email,
                        ":adresId"=>$adresId]);
        return $db->lastInsertId();
    }
    public function createTempUser($naam,$voornaam,$adresId){
        $sql="insert into users(naam,voornaam,adresId,isTijdelijkeUser) values(?,?,?,1);";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([$naam,$voornaam,$adresId]);
        return $db->lastInsertId();
    }

    public function getAdresOfUser($userId){
        $sql="select straat,huisnr,bus,postcode,gemeente "
            ." from adressen "
            ." where adresId in (select adresId from users where userId=:userId)";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $adres= new Adres($rij["straat"],$rij["huisnr"],$rij["bus"],$rij["postcode"],$rij["gemeente"]);

        return $adres;
    }


    public function getUserIdByEmail($email){
        $retval=null;
        $sql="select userId,email,naam,voornaam,telefoon,adresId,superuser,isTijdelijkeUser from users where email=?";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([$email]);

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!is_null($rij)){
            $adresDAO=new AdresDAO();
            $adres= $adresDAO->getAdresById($rij["adresId"]);
            $retval= new User($rij["userId"],$rij["email"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$adres,$rij["isTijdelijkeUser"],$rij["superuser"]);
        }

        return $retval;
    }
    public function credentialsCorrect($email,$password){
        $hash= md5($email.$password);

        $sql="select 1 as result from users where email=? and paswoord=?";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([$email,$hash]);

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rij&&$rij["result"]==1){
            return true;
        }

        return false;
    }
    public function deleteUser($userId){
        $sql="delete from users where userId=:userId";
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);

        $stmt->execute([":userId"=>$userId]);

    }
    public function updateUser($id,$naam,$voornaam,$isSuperUser,$isTijdelijkeUser,$heeftKorting){
        $sql="update users "
            ."set naam=:naam,voornaam=:voornaam,
                superuser=:isSuperUser,isTijdelijkeUser=:isTijdelijkeUser,korting=:korting"
            ." where userId=:userId";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":userId"=>$id,":naam"=>$naam,":voornaam"=>$voornaam,":usSuperuser"=>$isSuperUser,
                        ":isTijdelijkeUser"=>$isTijdelijkeUser,":korting"=>$heeftKorting]);
    }
}
