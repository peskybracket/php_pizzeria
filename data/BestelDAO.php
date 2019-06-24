<?php
// data/BestelDAO
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class BestelDAO{

    // maakt record in tabel bestellingen met session-key, geeft nieuwe bestelId terug
    public function createTempBestelling($key){
        $sql="insert into bestellingen(sessionKey)"
                ." values(:key)";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":key"=>$key]);

        return $db->lastInsertId();
    }
    public function bestaatBestellingId($id){
        $sql="select 1 as result"
            ." from bestellingen "
            ." where bestelId=:id";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $rij= $stmt->execute([":id"=>$id]);

        if(!$rij){
            return false;
        }else{
            return true;
        }
    }
    public function bestellingBevatPizzaId($id,$pizzaId){
        $sql="select 1 as result "
            ." from bestellijnen "
            ." where bestelId=:id
                and pizzaId= :pizzaId";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":id"=>$id,":pizzaId"=>$pizzaId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rij&&$rij["result"]==1){
            return true;
        }else{
            return false;
        }
    }
    public function updateBestellingPizza($id,$pizzaId,$aantal){
        $sql="update bestellijnen "
            ." set aantal = aantal+ :aantal,"
            ."      lijnTotaal = aantal*(select prijs from pizzas as p where p.pizzaId=bestellijnen.pizzaId) "
            ." where bestelId= :bestelId
                and pizzaId=:pizzaId ";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$id,":pizzaId"=>$pizzaId,":aantal"=>$aantal]);

        $retval= $db->lastInsertId();
        $this->updateBestellingTotaal($id);

        return $retval;
    }
    public function removePizza($id,$pizzaId){
        $sql="delete from bestellijnen "
            ." where bestelId= :bestelId
                and pizzaId=:pizzaId ";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$id,":pizzaId"=>$pizzaId]);

        $retval= $db->lastInsertId();
        $this->updateBestellingTotaal($id);

        return $retval;
    }
    public function insertBestellingPizza($id,$pizzaId,$aantal){
        $lijnTotaal= $this->getPizzaPrijs($pizzaId)*$aantal;
        if(!$this->bestellingBevatPizzaId($id,$pizzaId)){
            $sql="insert into bestellijnen(bestelId,pizzaId,aantal,lijnTotaal) "
                ."values(:id,:pizzaId,:aantal,:lijnTotaal)";
        }
        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":id"=>$id,":pizzaId"=>$pizzaId,":aantal"=>$aantal,":lijnTotaal"=>$lijnTotaal]);

        $retval= $db->lastInsertId();
        $this->updateBestellingTotaal($id);

        return $retval;
    }
    private function updateBestellingTotaal($bestelId){
        $sql="update bestellingen as b"
            ." set b.totaalPrijs = (select sum(lijnTotaal) from bestellijnen as bl where bl.bestelId= b.bestelId)"
            ." where b.bestelId= :bestelId ";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$bestelId]);
    }
    private function getPizzaPrijs($pizzaId){
        $sql="select prijs "
            ." from pizzas "
            ." where pizzaId= :pizzaId";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":pizzaId"=>$pizzaId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $retval=0;
        if($rij){
            $retval=$rij["prijs"];
        }

        return $retval;
    }

    public function bestaatBestellingKey($key){
        $sql="select bestelId"
            ." from bestellingen "
            ." where sessionKey=:key";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":key"=>$key]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$rij){
            return -1;
        }else{
            return $rij["bestelId"];
        }
    }
    public function getBestellingId($key){
        $sql="select bestelId"
            ." from bestellingen "
            ." where sessionKey=:key";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([":key"=>$key]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$rij){
            return -1;
        }else{
            return $rij["bestelId"];
        }
    }
    public function setBestellingUser($bestelId,$userId){
       $sql="update bestellingen "
            ." set userId=:userId"
            ." where bestelId= :bestelId";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$bestelId,":userId"=>$userId]);

    }
    public function finalizeBestelling($bestelId){
       $sql="update bestellingen "
            ." set isClosed=1, "
                    ." sessionKey=null, "
                    ." totaalPrijs= (select sum(lijnTotaal) from bestellijnen as bl where bl.bestelId = bestellingen.bestelId)"
            ." where bestelId= :bestelId";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$bestelId]);
    }

    public function setBestellingAdres($bestelId,$adresId){
       $sql="update bestellingen "
            ." set adresId=:adresId"
            ." where bestelId= :bestelId";

        $db=DBConfig::getConnection();
        $stmt=$db->prepare($sql);
        $stmt->execute([":bestelId"=>$bestelId,":adresId"=>$adresId]);

    }

    public function getHuidigeBestelling($userId){
        $bestelId= $this->getHuidigeBestellingId($userId);
        return $this->getBestelling($bestelId);
    }
    public function getHuidigeBestellingId($userId){
         $sql="select bestelId "
            ." from bestellingen "
            ." where userId = :userId
                and isClosed=1
                and isDelivered=0";

        $db=DBConfig::getConnection();
        $stmt = $db->prepare($sql);

        $stmt->execute([":userId"=>$userId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $retval=null;
        if($rij){
            $retval=$rij["bestelId"];
        }
        return $retval;
    }

    public function getHistoriek($userId){
        $sql="select bestelId "
            ." from bestellingen "
            ." where userId=:userId "
            ." and isDelivered=1";

        $db=DBConfig::getConnection();
        $stmt = $db->prepare($sql);

        $stmt->execute([":userId"=>$userId]);
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list=array();
        foreach ($resultSet as $rij) {
           array_push($list,$this->getBestelling($rij["bestelId"]));
        }
        return $list;
    }

    public function getBestelling($bestelId){
        $sql="select bestelId,
                userId,
                totaalPrijs,
                orderTime"
            ." from bestellingen "
            ." where bestelId = :bestelId "
            ." order by orderTime desc";

        $db=DBConfig::getConnection();
        $stmt = $db->prepare($sql);

        $stmt->execute([":bestelId"=>$bestelId]);
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $bestelling=null;
        if($rij){
            $bestelling= new Bestelling($rij["bestelId"],$rij["userId"],
                                        $rij["totaalPrijs"],$rij["orderTime"]);

            $sql2="select bestellijnId,
                    bestelId,
                    p.pizzaId,
                    p.naam as pizzaNaam,
                    p.prijs as pizzaPrijs,
                    aantal,
                    lijnTotaal "
            ." from bestellijnen as bl
	               inner join pizzas as p on bl.pizzaId=p.pizzaId"
            ." where bestelId=:id"
            ." order by bestellijnId asc";

            $stmt2 = $db->prepare($sql2);

            $stmt2->execute([":id"=>$bestelId]);
            $resultSet2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $lijst = array();
            foreach ($resultSet2 as $rij2) {

                $lijn= new Bestellijn($rij2["bestellijnId"],$bestelId,$rij2["pizzaId"],$rij2["aantal"],$rij2["lijnTotaal"]
                                     ,$rij2["pizzaNaam"],$rij2["pizzaPrijs"]);
                array_push($lijst, $lijn);
            }
            $bestelling->setBestellijnen($lijst);
        }
        return $bestelling;
    }
}
