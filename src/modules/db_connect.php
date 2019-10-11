<?php

namespace src\modules;
use PDO;

class db_connect
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;

    public function __construct($host, $dbname, $username, $password, $charset='utf8'){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    public function db_con(){
        try{
            $dbc = new PDO('mysql:host='. $this->host .';dbname='. $this->dbname .';charset='. $this->charset, $this->username, $this->password);
            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $dbc;
        }catch(\PDOException $e){
            print "Ошибка: ". $e->getMessage();
        }
    }
}