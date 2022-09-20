<?php

// Class de connexion à la base de données
// Database connection class

class Database extends PDO
{
    private $servername = 'localhost';
    private $dbname = 'capane';
    private $username = 'root';
    private $password = '';
    private $db;

    public function __construct()
    {
        try {
            parent::__construct("mysql:host=$this->servername;dbname=$this->dbname; charset=utf8", $this->username, $this->password);
        } catch (Exception $e) {
            print_r($e);
        }
    }

}