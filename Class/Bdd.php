<?php

abstract class BDD
{
    private $db_name = "super_reminder";
    private $db_user = "root";
    private $db_pass = "root";
    private $db_host = "localhost"; //127.0.0.1:8889
    private $pdo;

    
    public function __construct()
    {
    }

    protected function getPDO()
    {

        $this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
    }

    public function query($statement)
    {
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;
    }
}
