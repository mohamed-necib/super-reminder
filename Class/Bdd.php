<?php

abstract class BDD
{

    private $db_name = "super_reminder";
    private $db_user = "root";
    private $db_pass = "";
    private $db_host = "localhost";
    private $pdo;

    protected $bdd;

    public function __construct($db_name, $db_user, $db_pass, $db_host)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
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
