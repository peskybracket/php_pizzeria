<?php
// data/UserDAO
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class AdresDAO{
    public function createAdres($straat,$huisnr,$bus,$gemeenteId){
        $db=DBConfig::getConnection();

        $sql="insert into adressen(straat,huisnr,bus,gemeenteId) values(?,?,?,?);";
        $stmt= $db->prepare($sql);
        $stmt->execute([$straat,$huisnr,$bus,$gemeenteId]);

        $adresId=$db->lastInsertId();

        return $adresId;
    }
    public function gemeenteExists($postcode,$gemeente){
        $db=DBConfig::getConnection();

        $sql="select gemeenteId from gemeentes where naam=:gemeente and postcode=:postcode";
        $stmt= $db->prepare($sql);
        $stmt->execute([":gemeente"=>$gemeente,":postcode"=>$postcode]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rij){
            return $rij["gemeenteId"];
        }

        return false;
    }
    public function getAdresById($adresId){
        $sql="select straat,huisnr,bus,a.gemeenteId,postcode,g.naam as gemeente,leveringMogelijk "
            ." from adressen a inner join gemeentes g on a.gemeenteId=g.gemeenteId "
            ." where adresId = :adresId";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":adresId"=>$adresId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $adres= new Adres($rij["straat"],$rij["huisnr"],$rij["bus"],
                          new Gemeente($rij["gemeenteId"],$rij["postcode"],$rij["gemeente"],$rij["leveringMogelijk"]));

        return $adres;
    }
    public function getAllGemeentes(){
        $sql="select gemeenteId,naam,postcode,leveringMogelijk "
            ."from gemeentes"
            ." order by postcode asc";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $gemeenteList=array();
        foreach($resultSet as $rij){
            array_push($gemeenteList,
                       new Gemeente($rij["gemeenteId"],$rij["postcode"],$rij["naam"],$rij["leveringMogelijk"]));
        }

        return $gemeenteList;
    }
    public function getGemeente($gemeenteId){
        $sql="select gemeenteId,naam,postcode,leveringMogelijk "
            ."from gemeentes"
            ." where gemeenteId=:gemeenteId";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":gemeenteId"=>$gemeenteId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $gemeente= new Gemeente($rij["gemeenteId"],$rij["postcode"],$rij["naam"],$rij["leveringMogelijk"]);

        return $gemeente;
    }
    public function isLeveringMogelijk($postcode){
        $sql="select leveringMogelijk "
            ." from gemeentes "
            ." where postcode=:postcode";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":postcode"=>$postcode]);

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rij&&$rij["leveringMogelijk"]==1){
            return true;
        }

        return false;
    }


    public function insertGemeente($postcode,$gemeenteNaam,$isLeveringMogelijk){
        $sql="insert into gemeentes (naam,postcode,leveringMogelijk) "
             ."values(:gemeenteNaam,:postcode,:leveringMogelijk) ";

        $db=DBConfig::getConnection();
        $stmt= $db->prepare($sql);
        $stmt->execute([":gemeenteNaam"=>$gemeenteNaam,
                        ":postcode"=>$postcode,
                        ":leveringMogelijk"=>$isLeveringMogelijk
                       ]);
    }
    public function updateGemeente($gemeenteId,$postcode,$gemeenteNaam,$isLeveringMogelijk){
        $sql="update gemeentes "
             ." set naam= :gemeenteNaam,postcode=:postcode,leveringMogelijk=:isLeveringMogelijk "
             ." where gemeenteId=:gemeenteId";

        $db=DBConfig::getConnection();
        $stmt= $db->prepare($sql);
        $stmt->execute([":gemeenteId"=>$gemeenteId,
                        ":gemeenteNaam"=>$gemeenteNaam,
                        ":postcode"=>$postcode,
                        ":isLeveringMogelijk"=>$isLeveringMogelijk
                       ]);
    }

    public function deleteGemeente($gemeenteId){
        $sql="delete from gemeentes "
             ." where gemeenteId=:gemeenteId";

        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":gemeenteId"=>$gemeenteId]);

    }
}
