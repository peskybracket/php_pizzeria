<?php
// data/UserDAO
include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."kristof"
        .DIRECTORY_SEPARATOR."Test_PHP_Adv"
        .DIRECTORY_SEPARATOR."autoloader.php");

class PizzaDAO{

    public function getAllPizzas(){
        $sql="select pizzaId,naam,omschr,ifnull(prijs,0) as prijs from pizzas order by naam asc";

        $db=DBConfig::getConnection();
        $resultSet=$db->query($sql);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $pizza=new Pizza($rij["pizzaId"],$rij["naam"],$rij["omschr"],$rij["prijs"]);

            $sql2="select naam"
                ." from ingredienten as i
                    inner join pizzaingredienten as pi
                        on pi.pizzaId=:pizzaId
                            and i.ingredientId=pi.ingredientId";
            $stmt=$db->prepare($sql2);
            $stmt->execute([":pizzaId"=>$rij["pizzaId"]]);
            $resultSet2=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $ingredientenLijst=array();
            foreach($resultSet2 as $rij2){
                array_push($ingredientenLijst,$rij2["naam"]);
            }
            $pizza->setIngredienten($ingredientenLijst);

            array_push($lijst,$pizza);

            $pizza=null;
        }
        $db=null;

        return $lijst;
    }
    public function getPizza($pizzaId){
        $sql="select pizzaId,naam,omschr,ifnull(prijs,0) as prijs,ifnull(promoprijs,prijs) as promoprijs "
            ." from pizzas "
            ." where pizzaId=:pizzaId";
        $db=DBConfig::getConnection();

        $stmt=$db->prepare($sql);
        $stmt->execute([":pizzaId"=>$pizzaId]);
        $rij=$stmt->fetch(PDO::FETCH_ASSOC);

        $pizza=new Pizza($rij["pizzaId"],$rij["naam"],$rij["omschr"],$rij["prijs"]);
        $pizza->setPromoPrijs($rij["promoprijs"]);

        //ingredienten ophalen
        $sql2="SELECT ingredientId, naam, "
                    ." (select count(*) from pizzaingredienten as pi where pi.ingredientId=i.ingredientId
                                  and pi.pizzaId=:pizzaId) as heeftIngredient "
                    ." FROM ingredienten as i "
                    ." order by naam asc";
        $stmt=$db->prepare($sql2);
        $stmt->execute([":pizzaId"=>$pizzaId]);
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $list= array();
        foreach($resultSet as $rij){
            array_push($list,new PizzaIngredient($rij["ingredientId"],$pizzaId,$rij["naam"],$rij["heeftIngredient"]));
        }
        $pizza->setIngredienten($list);

        return $pizza;
    }
    public function getAlleIngredienten(){
        //ingredienten ophalen
        $sql="SELECT ingredientId, naam "
                    ." FROM ingredienten "
                    ." order by naam asc";
        $db=DBConfig::getConnection();
        $stmt=$db->query($sql);
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $list= array();
        foreach($resultSet as $rij){
            array_push($list,new PizzaIngredient($rij["ingredientId"],-1,$rij["naam"],0));
        }
        return $list;
    }
    public function insertPizza($naam,$omschr,$prijs){
        $sql="insert into pizzas(naam,omschr,prijs) values(?,?,?);";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([$naam,$omschr,$prijs]);
    }
    public function updatePizza($id,$naam,$omschr,$prijs,$promoprijs){
        $sql="update pizzas "
            ."set naam= ?,omschr=?,prijs=?,promoprijs=?"
            ." where pizzaId= ?";
        $db=DBConfig::getConnection();

        $stmt= $db->prepare($sql);
        $stmt->execute([$naam,$omschr,$prijs,$promoprijs,$id]);
    }
     public function deletePizza($pizzaId){
        $sql="delete from pizzas where pizzaId=:pizzaId";
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);

        $stmt->execute([":pizzaId"=>$pizzaId]);

    }
    public function insertPizzaIngredienten($pizzaId,$ingredienten){
        print($pizzaId."<>".$ingredienten);
        $paramList=array();
        $lijst=explode("-",$ingredienten);
        if(sizeof($lijst)>0){
            $sql="insert into pizzaIngredienten(pizzaId,ingredientId) ";
            $sqlValues="values";
            foreach($lijst as $item){
                $sqlValues=$sqlValues."(?,?),";
                array_push($paramList,$pizzaId);
                array_push($paramList,$item);
            }
            $sqlValues=substr($sqlValues,0,strlen($sqlValues)-1);
            print($sql.$sqlValues);
            var_dump($paramList);
            $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql.$sqlValues);

            $stmt->execute($paramList);
        }
    }
    public function deletePizzaIngredienten($pizzaId){
        $sql="delete from pizzaIngredienten where pizzaId=:pizzaId";
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING,          DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);

        $stmt->execute([":pizzaId"=>$pizzaId]);

    }

}
