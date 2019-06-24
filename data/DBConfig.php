<?php
//data/DBConfig.php
class DBConfig {
    public static $DB_CONNSTRING = "mysql:host=localhost;dbname=testphp;charset=utf8";
    public static $DB_USERNAME = "pizzaAdmin";
    public static $DB_PASSWORD = "password";


    public static function getConnection(){
        return new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    }
}
